<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar project.
        $query = Project::with('category');

        // SEARCH: pencarian berdasarkan judul dan deskripsi.
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // FILTER: penyaringan berdasarkan status.
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // PAGINATION: menampilkan 6 project per halaman.
        $projects = $query->latest()->paginate(6)->withQueryString();

        return view('posts.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('posts.projects.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                'dimensions:min_width=400,min_height=300',
            ],
        ]);

        $newPath = null;

        if ($request->hasFile('thumbnail')) {
            $newPath = $request->file('thumbnail')
                ->store('projects/thumbnails', 'public');

            $validated['thumbnail'] = $newPath;
        }

        try {
            Project::create($validated);
        } catch (\Throwable $e) {
            if ($newPath) {
                Storage::disk('public')->delete($newPath);
            }

            throw $e;
        }

        return redirect()
            ->route('post.projects.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function show(Project $project)
    {
        $project->load(['category', 'images']);

        return view('posts.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $project->load('images');

        return view('posts.projects.edit', [
            'project' => $project,
            'categories' => Category::all(),
        ]);
    }


    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:min_width=400,min_height=300',
        ]);

        $oldThumbnail = $project->thumbnail;

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('projects/thumbnails', 'public');
        }

        $project->update($validated);

        if (
            $request->hasFile('thumbnail') &&
            $oldThumbnail
        ) {
            Storage::disk('public')->delete($oldThumbnail);
        }

        return redirect()
            ->route('post.projects.index')
            ->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        $project->load('images');

        // Simpan referensi file sebelum record dihapus.
        $paths = $project->images
            ->pluck('image')
            ->filter()
            ->all();

        if ($project->thumbnail) {
            $paths[] = $project->thumbnail;
        }

        // Menghapus project juga menghapus record gallery
        // melalui foreign key cascadeOnDelete.
        $project->delete();

        // File fisik dibersihkan setelah record berhasil dihapus.
        Storage::disk('public')->delete($paths);

        return redirect()
            ->route('post.projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }
}

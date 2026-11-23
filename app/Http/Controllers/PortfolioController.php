<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data kategori dan technology untuk pilihan filter.
        $categories = Category::orderBy('name')->get();
        $technologies = Technology::orderBy('name')->get();

        // Query dasar project beserta relasi yang dibutuhkan.
        $query = Project::with(['category', 'technologies']);

        // SEARCH: pencarian berdasarkan judul dan deskripsi.
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // FILTER: penyaringan berdasarkan kategori.
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // LATIHAN 1: filter berdasarkan technology.
        if ($request->filled('technology')) {
            $technologyId = $request->technology;

            $query->whereHas('technologies', function ($q) use ($technologyId) {
                $q->where('technologies.id', $technologyId);
            });
        }

        // SORTING: pengurutan project.
        $sort = $request->input('sort', 'latest');

        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;

            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;

            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;

            // LATIHAN 2: tanggal project terbaru.
            case 'project_date_desc':
                $query->orderBy('project_date', 'desc');
                break;

            // LATIHAN 2: tanggal project terlama.
            case 'project_date_asc':
                $query->orderBy('project_date', 'asc');
                break;

            default:
                $sort = 'latest';
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Pagination: menampilkan 6 project per halaman.
        // Query string tetap dipertahankan ketika berpindah halaman.
        $projects = $query->paginate(6)->withQueryString();

        return view('portfolio.index', compact(
            'projects',
            'categories',
            'technologies',
            'sort'
        ));
    }

    public function show(Project $project)
    {
        $project->load(['category', 'images', 'technologies']);

        return view('portfolio.show', compact('project'));
    }
}

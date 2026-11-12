<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProjectGalleryController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'images' => 'required|array|min:1|max:10',

            'images.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
                'dimensions:min_width=800',
            ],
        ]);

        $files = $request->file('images');
        $storedPaths = [];

        try {
            DB::transaction(function () use (
                $project,
                $files,
                &$storedPaths
            ) {
                // Kunci project selama proses pengecekan jumlah.
                Project::whereKey($project->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $currentCount = $project->images()->count();

                if ($currentCount + count($files) > 10) {
                    throw ValidationException::withMessages([
                        'images' => 'Maksimal 10 gambar per project.',
                    ]);
                }

                foreach ($files as $file) {
                    $path = $file->store(
                        'projects/gallery',
                        'public'
                    );

                    if (!$path) {
                        throw new \RuntimeException(
                            'Gagal menyimpan gambar gallery.'
                        );
                    }

                    $storedPaths[] = $path;

                    $project->images()->create([
                        'image' => $path,
                    ]);
                }
            });
        } catch (\Throwable $e) {
            foreach ($storedPaths as $path) {
                Storage::disk('public')->delete($path);
            }

            throw $e;
        }

        return back()->with(
            'success',
            'Gambar gallery berhasil ditambahkan.'
        );
    }

    public function destroy(
        Project $project,
        ProjectImage $image
    ) {
        abort_if($image->project_id !== $project->id, 404);

        $path = $image->image;

        $image->delete();

        Storage::disk('public')->delete($path);

        return back()->with(
            'success',
            'Gambar berhasil dihapus.'
        );
    }

    public function updateCaption(
        Request $request,
        Project $project,
        ProjectImage $image
    ) {
        abort_if(
            $image->project_id !== $project->id,
            404
        );

        $validated = $request->validate([
            'caption' => 'nullable|string|max:255',
        ]);

        $image->update($validated);

        return back()->with(
            'success',
            'Caption berhasil diperbarui.'
        );
    }

}

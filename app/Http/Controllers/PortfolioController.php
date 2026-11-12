<?php

namespace App\Http\Controllers;

use App\Models\Project;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects = Project::with('category')
            ->latest()
            ->get();

        return view('portfolio.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $project->load(['category', 'images']);

        return view('portfolio.show', compact('project'));
    }
}

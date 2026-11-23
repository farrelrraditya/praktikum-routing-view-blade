<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Technology;

class DashboardController extends Controller
{
    public function index()
    {
        return view('posts.dashboard', [

            'totalProjects' => Project::count(),

            'totalCategories' => Category::count(),

            'totalTechnologies' => Technology::count(),

            'totalSkills' => Skill::count(),

            'latestProjects' => Project::with('category')
                ->latest()
                ->take(5)
                ->get(),

            'publishedProjects' => Project::where(
                'status', 'published'
            )->count(),

            'draftProjects' => Project::where(
                'status', 'draft'
            )->count(),

            'categoriesWithCount' => Category::withCount(
                'projects'
            )->get(),

            'topSkill' => Skill::latest('id')->first(),

        ]);
    }
}

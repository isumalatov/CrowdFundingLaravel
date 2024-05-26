<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('user')->paginate(8);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'publication_date' => 'required|date|after_or_equal:today',
            'completion_date' => 'required|date|after_or_equal:publication_date|before_or_equal:'.now()->addMonths(3)->format('Y-m-d'),
            'required_funds' => 'nullable|numeric',
            'rewards.*.title' => 'required|string|max:255',
            'rewards.*.description' => 'required|string',
            'rewards.*.required_funds' => 'required|numeric',
            'rewards.*.stock' => 'required|integer',
        ]);

        $project = new Project($request->all());
        $project->user_id = Auth::id();
        $project->save();

        if ($request->has('rewards')) {
            foreach ($request->rewards as $rewardData) {
                $reward = new Reward($rewardData);
                $reward->project_id = $project->id;
                $reward->save();
            }
        }

        return redirect()->route('my_activity')->with('success', 'Project created successfully');
    }

    public function edit(Project $project)
    {
        $project->load('rewards');
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'publication_date' => 'required|date|after_or_equal:today',
            'completion_date' => 'required|date|after_or_equal:publication_date|before_or_equal:'.now()->addMonths(3)->format('Y-m-d'),
            'required_funds' => 'nullable|numeric',
            'rewards.*.title' => 'required|string|max:255',
            'rewards.*.description' => 'required|string',
            'rewards.*.required_funds' => 'required|numeric',
            'rewards.*.stock' => 'required|integer',
        ]);

        $project->update($request->all());

        $project->rewards()->delete();
        if ($request->has('rewards')) {
            foreach ($request->rewards as $rewardData) {
                $reward = new Reward($rewardData);
                $reward->project_id = $project->id;
                $reward->save();
            }
        }

        return redirect()->route('my_activity')->with('success', 'Project updated successfully');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('my_activity')->with('success', 'Project deleted successfully');
    }

    public function show(Project $project)
    {
        $project->load('contributions.user', 'rewards');
        return view('projects.show', compact('project'));
    }
}

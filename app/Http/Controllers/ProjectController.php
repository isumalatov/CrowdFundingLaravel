<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(8);
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
            'publication_date' => 'nullable|date',
            'completion_date' => 'nullable|date',
            'required_funds' => 'nullable|numeric',
        ]);
        $project = new Project($request->all());
        // Asignar el propio user_id 
        //$project->user_id = Auth::id();
        //Reemplazo hasta que se haga la parte de usuario y authentication
        $project->user_id = 1;
        $project->save();

        return redirect()->route('projects.index')->with('success', 'Project created successfully');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'publication_date' => 'nullable|date',
            'completion_date' => 'nullable|date',
            'required_funds' => 'nullable|numeric',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Project updated successfully');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }

    public function show(Project $project)
    {
        $project->load('contributions.user'); 
        return view('projects.show', compact('project'));
    }
    
}

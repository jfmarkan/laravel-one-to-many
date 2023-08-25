<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectList=Project::Paginate(10);
        return view('admin.projects.index', compact('projectList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newProject = Project::create($data);
        $img_path = Storage::put('uploads', $request['image']);
        $data['image']=$img_path;
        $newProject->save();

        return redirect()->route('admin.projects.index')->with('created', $newProject->title);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $project = Project::findOrFail($id);
        $img_path = Storage::put('uploads', $request['image']);
        $data['image'] = $img_path;
        $project->update($data);
        return redirect()->route('admin.projects.index')->with('updated', $project->title);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);

        $project->delete();
        return redirect()->route('admin.projects.index')->with('deleted', $project->title);
    }

    public function binned()
    {
        $projectList=Project::onlyTrashed()->paginate(10);
        return view('admin.projects.bin', compact('projectList'));
    }

    public function restore($id)
    {
        $project = Project::withTrashed()->findOrFail($id);

        $project->restore();
        return redirect()->route('admin.projects.index')->with('restored', $project->title);
    }
}

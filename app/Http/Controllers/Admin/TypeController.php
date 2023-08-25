<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typeList=Type::Paginate(15);
        return view('admin.types.index', compact('typeList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newType = Type::create($data);
        $newType->save();

        return redirect()->route('admin.types.index')->with('created', $newType->name);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $type = Type::findOrFail($id);
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $type = Type::findOrFail($id);
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $type = Type::findOrFail($id);
        $type->update($data);
        return redirect()->route('admin.types.index')->with('updated', $type->title);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

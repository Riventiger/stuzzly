<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Blog::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Blog::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation logic can go here
        // Example: $data = $request->validate([...]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('Blog::show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('Blog::edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Update logic can go here
        // Example: $item->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Destroy logic can go here
        // Example: Model::destroy($id);
    }
}

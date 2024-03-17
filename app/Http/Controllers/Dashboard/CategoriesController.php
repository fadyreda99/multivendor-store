<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CAtegoryValidationRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CAtegoryValidationRequest $request)
    {
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');
            $data['image'] = $path;
        }
        $category = Category::create($data);
        return redirect()->route('categories.index')->with('success', 'category created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if ($category) {
            return view('dashboard.categories.show', compact('category'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->where('parent_id', '<>', $id);
            })

            ->get();
        $category = Category::find($id);
        if ($category) {
            return view('dashboard.categories.edit', compact('category', 'categories'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CAtegoryValidationRequest $request, string $id)
    {
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);
        $data = $request->except('image');
        $category = Category::where('id', $id)->first();
        if ($category) {
            $old_image = $category->image;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('uploads', 'public');
                $data['image'] = $path;
            }
            $category->update($data);
            if($old_image && isset($data['image'])){
                Storage::disk('public')->delete($old_image);
            }
            return redirect()->route('categories.index')->with('success', 'category updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::where('id', $id)->first();
        if ($category) {
            $category->delete();
            if($category->image){
                Storage::disk('public')->delete($category->image);
            }
            return redirect()->route('categories.index')->with('success', 'category deleted');
        }
    }
}

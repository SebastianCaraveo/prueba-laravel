<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'name_category' => 'required|unique:categories,name|max:255',
                'description_category' => 'nullable|string',
            ]);

            Category::create([
                'name' => $request->name_category,
                'description' => $request->description_category,
                'is_active'=>true,
            ]);


            return redirect()->route('categories')->with('success', 'Categoria registrada con exito!');
        } catch (\Throwable $th) {
            return redirect()->route('categories')->with('error', 'Error al registrar la categoria!' . $th->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name_category' => 'required|unique:categories,name,'. $id . '|max:255',
                'description_category' => 'nullable|string',
            ]);

            $category = Category::findOrFail($id);
            $category->name = $request->name_category;
            $category->description = $request->description_category;
            $category->is_active = $request->has('is_active') ? true : false;
            $category->save();

            return redirect()->route('categories')->with('success', 'Se ha modificado con exito la categoria');
        } catch (\Throwable $th) {
            return redirect()->route('categories')->with('error', 'No se ha modificado la categoria:' . $th->getMessage());
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('categories')->with('success', 'Categoria eliminada exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('categories')->with('error', 'No ha sido posible eliminar la catgoria: ' . $th->getMessage());
        }

    }
}

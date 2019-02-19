<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\FileBase6;
use App\Http\Requests\Admin\CategoryStore;
use App\Http\Requests\Admin\CategoryUpdate;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')
                            ->paginate(10);

        return view('admin.categories.index')
            ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStore $request)
    {
        $category = new Category;

        //$image = FileBase6::pullFile($request->get('image_url'), 'app/public/images/categories/');

        $category->fill($request->all());
        $category->config = $request->get('config');
        //$category->image = $image;
        $category->save();

        return response()->json([
            'title' => 'Completado',
            'message' => "Categoria {$category->name} registrada con éxito",
            'interceptor' => true,
            'plugin' => 'modal',
            'category' => $category,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit')
            ->with('category', json_encode($category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdate $request, Category $category)
    {
        $category->fill($request->all());
        $category->config = $request->get('config');
        $category->update();

        return response()->json([
            'title' => 'Completado',
            'message' => "Categoria {$category->name} editada con éxito",
            'interceptor' => true,
            'plugin' => 'modal',
            'category' => $category,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Alert::success('Completado', 'Categoria eliminada con exito.');
        return redirect()->route('admin.categories.index');
    }
}

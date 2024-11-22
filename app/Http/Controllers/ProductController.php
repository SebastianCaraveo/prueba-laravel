<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        /* $products = Product::with('category')->get(); */
        $products = Product::take(3)->with('category')->get();
        return view('admin.products', compact('products', 'categories'));
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
                'name_product' => 'required|string|max:255',
                'description_product' => 'nullable|string',
                'price_product' => 'required|numeric',
                'stock_product' => 'required|integer',
                'category_id_product' => 'required|exists:categories,id',
                'images' => 'nullable|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);


            $product = Product::create([
                'name' => $request->name_product,
                'description' => $request->description_product,
                'price' => $request->price_product,
                'stock' => $request->stock_product,
                'is_active' => true,
                'category_id' => $request->category_id_product,
            ]);

            if($request->hasFile('images')){
                foreach($request->file('images') as $image){
                    $path = $image->store('public/img/products');
                    $product->images()->create([
                        'image_path' => $path,
                    ]);
                }
            }

            return redirect()->route('products.index')->with('success', 'Producto insertado con exito!');
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with('error', 'El producto no pudo ser insertado: ' . $th->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $validate = $request->validate([
                'name_product' => 'required|string|max:255',
                'description_product' => 'nullable|string',
                'price_product' => 'required|numeric|min:0',
                'stock_product' => 'required|integer|min:0',
                'category_id_product' => 'required|exists:categories,id',
                'image.*' => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
            ]);

            $product->update([
                'name'=>$validate['name_product'],
                'description'=>$validate['description_product'],
                'price'=>$validate['price_product'],
                'stock'=>$validate['stock_product'],
                'category_id'=>$validate['category_id_product'],
            ]);

            if($request->hasFile('image')){
                foreach ($request->file('image') as $image) {
                    $path = $image->store('products', 'public');
                    $product->images()->create(['image_path' => $path]);
                }
            }

            return redirect()->back()->with('success', 'Producto actualizado correctamente');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'No se pudo actualizar el producto por:' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $products = Product::with('images')->find($id);//Busca el producto por su ID y carga relacion de las imagenes

            if (!$products) {
                return redirect()->route('products.index')->with('error', 'El producto no existe.');
            }

            foreach($products->images as $image){ //Eliminar imagenes asociadas
                Storage::delete($image->image_path); //Eliminar el archivo de la imagen de almacenamiento
                $image->delete(); //Eliminar registro de la base de datos
            }

            $products->delete();

            return redirect()->route('products.index')->with('success', 'Se ha eliminado el producto con exito!');
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with('error', 'No se pudo eliminar el producto: ' . $th->getMessage());
        }
    }

    public function deleteImage($productId, $imageId){
        $image = ProductImage::where('product_id', $productId)->where('id', $imageId)->first();

        if($image){
            Log::info("Intentando eliminar imagen: " . $image->image_path);

            if(Storage::exists($image->image_path)){ // Verificamos si existe una imagen en el storage, utilizando la ruta guardada en atributo image_path en la tabala imagenes del producto de nuestra base de datos
                Storage::delete($image->image_path); // Elimina la imagen del storage (Recuerda que es nuestra carpeta de almacenamiento para el proyecto), esta enlazada a nuestra carpeta publica que pueden ingresar los usuarios pero a la storage no.
                $image->delete(); // Elimina la imagen de la base de datos
                return redirect()->back()->with('success', 'La imagen ha sido eliminada correctamente!');
            }else{
                return redirect()->back()->with('error', 'El archivo de la imagen no existe en el almacenamietno.');
            }
        }
        return redirect()->back()->with('error', 'No se pudo eliminar la imagen');
    }
}

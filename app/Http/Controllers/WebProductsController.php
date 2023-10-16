<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class WebProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.products.index', [
            'products' => Product::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.products.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'title' => 'required|max:255',
    //         'category_id' => 'required|exists:categories,id',
    //         'slug' => 'required|unique:products|max:255',
    //         'price' => 'required',
    //         'stock' => 'required',
    //         'image' => 'image|file|max:1024',
    //         'description' => 'required',
    //     ]);

    //     if ($request->file('image')) {
    //         // $validatedData['image'] = $request->file('image')->store('ProductImages');
    //         $filename = $request->file('image')->store('product-images', 'public_uploads');
    //         $validatedData['image'] = 'storage/' . $filename;
    //     }

    //     $validatedData['user_id'] = auth()->user()->id;
    //     $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);

    //     Product::create($validatedData);

    //     return redirect('/products')->with('createProduct', 'New product has been posted');
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('dashboard.products.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'image|file|max:1024',
            'description' => 'required',
        ];

        if ($request->slug != $product->slug) {
            $rules['slug'] = 'required|unique:products';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                $destination = public_path('img/' . $request->oldImage);
                if (File::exists($destination)) {
                    File::delete($destination);
                }
            }
            $validatedData['image'] = $request->file('image')->store('product-images', 'public_uploads');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->description), 200);

        Product::where('id', $product->id)
            ->update($validatedData);

        return redirect('/dashboard/products')->with('successUpdate', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }
        Product::destroy($product->id);

        return redirect('/dashboard/products')->with('successDelete', 'Product has been deleted');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }

    public function createProduct(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'required|unique:products|max:255',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'image|file|max:1024',
            'description' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('product-images', 'public_uploads');
            // $filename = $request->file('image')->store('product-images', 'public_uploads');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);

        Product::create($validatedData);

        return redirect('/products')->with('createProduct', 'New product has been posted');
    }

    public function updateProduct(Request $request, Product $product)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'image|file|max:1024',
            'description' => 'required',
        ];

        if ($request->slug != $product->slug) {
            $rules['slug'] = 'required|unique:products';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                $destination = public_path('img/' . $request->oldImage);
                if (File::exists($destination)) {
                    File::delete($destination);
                }
            }
            $validatedData['image'] = $request->file('image')->store('product-images', 'public_uploads');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->description), 200);

        Product::where('id', $product->id)
            ->update($validatedData);

        return redirect('/products')->with('successUpdate', 'Product has been updated');
    }
}

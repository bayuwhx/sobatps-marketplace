<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductShow;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{
    public function indexCategory()
    {
        $category = Category::all();
        return response()->json($category);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::latest()->get();

        if ($request['search_category']) {
            $searchCategory = $request['search_category'];
            $products = Product::where('category_id', 'like', '%' . $searchCategory . '%')->latest()->get();
        }

        if ($request['search_product']) {
            $searchProduct = $request['search_product'];
            $products = Product::where('title', 'like', '%' . $searchProduct . '%')->latest()->get();
        }

        foreach ($products as $key => $val) {
            $products[$key]['category_id'] = json_decode($val['category_id']);
        }

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $user = auth()->guard('api')->user();

        $product = $user->products()->create([
            'category_id' => request('category_id'),
            'title' => request('title'),
            'description' => request('description'),
            'price' => request('price'),
        ]);

        $filename = "";
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('product-images', 'public');
        }

        //!! Firebase
        // $imageData = $request->input('image');
        // // $base64Image = substr($imageData, strpos($imageData, ',') + 1);
        // $imageData = base64_decode($imageData);
        // $fileName = date('Ymdhis') . $product->id . '.jpg';
        // $firebaseStoragePath = "ProductImages/{$fileName}";
        // Storage::disk('local')->put("public/ProductImages/{$fileName}", $imageData);
        // $uploadedFile = fopen(storage_path("app/public/ProductImages/{$fileName}"), 'r');
        // app('firebase.storage')->getBucket()->upload($uploadedFile, ['name' => $firebaseStoragePath]);
        // Storage::disk('local')->delete("public/ProductImages/{$fileName}");
        // $expiresAt = new DateTime('2030-01-01');
        // $imageReference = app('firebase.storage')->getBucket()->object($firebaseStoragePath);
        // $imageUrl = $imageReference->signedUrl($expiresAt);
        // $product->image = $imageUrl;
        //!! Firebase

        // $product->image = 'storage/' . $filename;
        $product->image = $filename;
        $product->save();

        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::find($id);

        return response()->json(new ProductShow($products));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'isSold' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $user = auth()->guard('api')->user();
        $product = Product::find($id);

        if ($user->id != $product->user_id) {
            return response()->json([
                "success" => false,
                "message" => "You're not the owner of the product!",
            ], 403);
        }

        if ($request->hasFile('image')) {
            if ($product->image) {
                $destination = public_path($product->image);
                if (File::exists($destination)) {
                    File::delete($destination);
                }

                //!! Firebase
                // $oldData = $product->image;
                // $oldUri = explode('/', $oldData);
                // $filename = explode('?', $oldUri[5])[0];
                // $old_firebase_storage_path = $oldUri[4] . '/' . $filename;
                // app('firebase.storage')->getBucket()->object($old_firebase_storage_path)->delete();
                //!! Firebase
            }

            $filename = $request->file('image')->store('product-images', 'public');

            //!! Firebase
            // $imageData = $request->input('image');
            // // $base64Image = substr($imageData, strpos($imageData, ',') + 1);
            // $imageData = base64_decode($imageData);
            // $fileName = date('Ymdhis') . $product->id . '.jpg';
            // $firebaseStoragePath = "ProductImages/{$fileName}";
            // Storage::disk('local')->put("public/ProductImages/{$fileName}", $imageData);
            // $uploadedFile = fopen(storage_path("app/public/ProductImages/{$fileName}"), 'r');
            // app('firebase.storage')->getBucket()->upload($uploadedFile, title'name' => $firebaseStoragePath]);
            // Storage::disk('local')->delete("public/ProductImages/{$fileName}");
            // $expiresAt = new DateTime('2030-01-01');
            // $imageReference = app('firebase.storage')->getBucket()->object($firebaseStoragePath);
            // $imageUrl = $imageReference->signedUrl($expiresAt);
            // $product->image = $imageUrl;
            //!! Firebase

            // $product->image = 'storage/' . $filename;
            $product->image = $filename;
        }

        $product->category_id = $request->category_id;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->isSold = $request->isSold;
        $product->save();

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->guard('api')->user();
        $product = Product::find($id);

        if ($user->id != $product->user_id) {
            return response()->json([
                "success" => false,
                "message" => "You're not the owner of the product!",
            ], 403);
        }

        if ($product->image) {
            $destination = public_path($product->image);
            if (File::exists($destination)) {
                File::delete($destination);
            }

            //!! Firebase
            // $oldData = $product->image;
            // $oldUri = explode('/', $oldData);
            // $filename = explode('?', $oldUri[5])[0];
            // $old_firebase_storage_path = $oldUri[4] . '/' . $filename;
            // app('firebase.storage')->getBucket()->object($old_firebase_storage_path)->delete();
            //!! Firebase
        }

        $product->delete();

        return response()->json($product);
    }
}

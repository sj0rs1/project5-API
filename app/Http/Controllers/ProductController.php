<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // name code quantity reorder_point
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
            'color' => 'required',
            'height_cm' => 'required',
            'width_cm' => 'required',
            'depth_cm' => 'required',
            'weight_gr' => 'required',
            'quantity' => 'required',
            'reorder_point' => 'required'
        ]);

        try {
            $newProduct = new Product();
            $newProduct->name = $request->input('name');
            $newProduct->price = $request->input('price');
            $newProduct->quantity = $request->input('quantity');
            $newProduct->description = $request->input('description');
            $newProduct->image = $request->input('image');
            $newProduct->color = $request->input('color');
            $newProduct->height_cm = $request->input('height_cm');
            $newProduct->width_cm = $request->input('width_cm');
            $newProduct->depth_cm = $request->input('depth_cm');
            $newProduct->weight_gr = $request->input('weight_gr');
            $newProduct->reorder_point = $request->input('reorder_point');
            $newProduct->last_edited_by = ($request->input('last_edited_by') || null);
            $newProduct->save();

            return response()->json([
                'error' => false,
                'message' => 'Succesfully created'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Could not create'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            Product::find($id)->update($request->only(['name', 'price','quantity', 'reorder_point','description','image','color','height_cm','width_cm','depth_cm','weight_gr','last_edited_by']));
            $product = Product::find($id);
            return response()->json([
                'error' => false,
                'message' => 'Succesfully edited'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Could not edit'
            ]);
        }
    }

    public function removeStock(Request $request)
    {
        try {
            $id = $request->input('id');
            $quantityToRemove = $request->input('quantity');

            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'error' => true,
                    'message' => 'Product not found'
                ]);
            }

            $newStock = max(0, $product->quantity - $quantityToRemove);
            $product->update(['quantity' => $newStock]);

            return response()->json([
                'error' => false,
                'message' => 'Stock removed successfully'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Could not remove stock'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Product::find($id)->delete();

            return response()->json([
                'error' => false,
                'message' => 'Succesfully deleted'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Could not delete'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // name code quantity reorder_point
    {
        $this->validate($request, [
            'productIds' => 'required',
            'amounts' => 'required',
            'status' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'postal' => 'required',
            'number' => 'required',
            'phone' => 'required'
        ]);

        try {
            $newOrder = new Order();
            $newOrder->orderedBy = $request->input('orderedBy');
            $newOrder->productIds = $request->input('productIds');
            $newOrder->amounts = $request->input('amounts');
            $newOrder->status = $request->input('status');
            $newOrder->firstname = $request->input('firstname');
            $newOrder->lastname = $request->input('lastname');
            $newOrder->postal = $request->input('postal');
            $newOrder->number = $request->input('number');
            $newOrder->phone = $request->input('phone');
            $newOrder->save();

            return response()->json([
                'error' => false,
                'message' => 'Succesfully created'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Could not create ' . $e
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Order::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            Order::find($id)->update($request->only(['orderedBy', 'productIds','amounts', 'status','firstname','lastname','postalcode','number','phone']));
            $product = Order::find($id);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Order::find($id)->delete();

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

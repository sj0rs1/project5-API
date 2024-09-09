<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KuinOrder;

class KuinOrdersController extends Controller
{
    public function index()
    {
        return KuinOrder::all();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'productIds' => 'required',
            'amounts' => 'required',
            'status' => 'required'
        ]);

        try {
            $newKuinOrder = new KuinOrder();
            $newKuinOrder->productIds = $request->input('productIds');
            $newKuinOrder->amounts = $request->input('amounts');
            $newKuinOrder->status = $request->input('status');
            $newKuinOrder->save();

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
        return KuinOrder::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            KuinOrder::find($id)->update($request->only(['productIds','amounts', 'status']));
            $product = KuinOrder::find($id);
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
            KuinOrder::find($id)->delete();

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

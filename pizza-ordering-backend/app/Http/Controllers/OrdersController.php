<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource as OrderCollections;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = [
            'orders' => OrderCollections::collection(Order::orderBy('id','DESC')->get()),
        ];
        return response($response, 200);
        // return OrderCollections::collection(Order::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required|string',
            'total_amount' => 'required',
            'total_tax_amount' => 'required|string',
        ]);
        //Create Order
        $order =  Order::create([
            'order_no' => '#' . time() . str_pad(1, 8, "0", STR_PAD_LEFT),
            'customer_id' => $request->customer_id,
            'total_amount' => $request->total_amount,
            'total_tax_amount' => $request->total_tax_amount
        ]);
        //Getting the length of Pizza Items
        $index = count($request->pizza_id);
        if ($index != 0) {
            for ($item_index = 0; $item_index < $index; $item_index++) {
                //Create Order-details
                $orderDetails =  OrderDetails::create([
                    'order_id' => $order->id,
                    'pizza_id' => $request->pizza_id[$item_index],
                    'qty' => $request->qty[$item_index]
                ]);
            }
        }
        $response = [
            'message' => 'Thanks for placing order,shortly we will confirm your order'
        ];
        return response($response, 201);
    }

    //Complete  Orders
    public function completeOrder($id)
    {
        $order = Order::find($id);
        if (!is_null($order)) {
            $order->status = 'true';
            $order->update();
            $response = [
                'message' => 'The Order has been delivered successfully'
            ];
            return response($response, 200);
        } else {
            $response = [
                'message' => 'The Order record has not been Founded'
            ];
            return response($response, 404);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Order $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $orders)
    {
        //
    }
}

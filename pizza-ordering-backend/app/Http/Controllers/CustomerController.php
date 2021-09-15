<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource as CustomerCollection;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = [
            'customers' => CustomerCollection::collection(Customer::orderBy('id','DESC')->get()),
        ];
        return response($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'mobile' => 'required|numeric|digits_between:10,11|unique:customers',
            'city' => 'required|string',
            'address' => 'required|string'
        ]);
        Customer::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'city' => $request->city,
            'address' => $request->address,
        ]);
        $response = [
            'customers' => 'Customer Record has been Created Successfully'
        ];
        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        if (!is_null($customer)) {
            $response = [
                'customer' => $customer->toArray()
            ];
            return response($response, 200);
        } else {
            $response = [
                'message' => 'The Customer record has not been Founded'
            ];
            return response($response, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!is_null($customer)) {
            $request->validate([
                'name' => 'required|string',
                'mobile' => 'required|numeric|digits_between:10,11|unique:customers,mobile,'.$id,
                'city' => 'required|string',
                'address' => 'required|string'
            ]);
            $customer['name'] = $request->name;
            $customer['mobile'] = $request->mobile;
            $customer['city'] = $request->city;
            $customer['address'] = $request->address;
            $customer->update();
            $response = [
                'message' => 'Customer Record has been Updated Successfully'
            ];
            return response($response, 200);
        } else {
            $response = [
                'message' => 'The Customer record has not been Founded'
            ];
            return response($response, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!is_null($customer)) {
            $customer->delete();
            $response = [
                'message' => 'The Customer record has been deleted successfully'
            ];
            return response($response, 200);
        } else {
            $response = [
                'message' => 'The Customer record has not been Founded'
            ];
            return response($response, 404);
        }
    }
}

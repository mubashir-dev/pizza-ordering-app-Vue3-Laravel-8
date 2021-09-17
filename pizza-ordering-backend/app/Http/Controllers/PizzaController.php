<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use App\Http\Resources\PizzasResource as PizzasCollection;
use Illuminate\Support\Facades\Storage;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = [
            'pizzas_list' => PizzasCollection::collection(Pizza::orderBy('id', 'DESC')->get()),
        ];
        return response()->json($response, 200);
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
            'title' => 'required|string',
            'pizza_category_id' => 'required',
            'description' => 'required|string',
            'photo_url' => 'required|mimes:png,jpg,jpeg|max:2048',
            'ingredients' => 'required',
            'price' => 'required|numeric',
            'tax' => 'required|numeric'
        ]);
        if ($request->has('photo_url')) {
            $name = time() . '_' . $request->photo_url->getClientOriginalName();
            $filePath = $request->file('photo_url')->storeAs('uploads/pizza-images', $name, 'public');
            $filePath = '/storage/' . $filePath;
            $pizza =  Pizza::create([
                'title' => $request->title,
                'pizza_category_id' => $request->pizza_category_id,
                'description' => $request->description,
                'photo_url' =>  $filePath,
                'ingredients' => json_encode($request->ingredients),
                'price' => $request->price,
                'tax' => $request->tax
            ]);
            return response('Pizza Record has been Created Successfully', 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pizza = Pizza::find($id);
        if (!is_null($pizza)) {
            $response = [
                'pizza' => new PizzasCollection($pizza)
            ];
            return response($response, 200);
        } else {
            $response = [
                'message' => 'The Pizza record has not been Founded'
            ];
            return response($response, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pizza = Pizza::find($id);
        $filePath = ''; //For holding the path of image_url
        if (!is_null($pizza)) {
            $this->validate($request, [
                'title' => 'required|string',
                'pizza_category_id' => 'required',
                'description' => 'required|string',
                'ingredients' => 'required',
                'price' => 'required|numeric',
                'tax' => 'required|numeric'
            ]);
            if ($request->has('photo_url')) {
                $this->validate($request, [
                    'photo_url' => 'required|mimes:png,jpg,jpeg|max:2048',
                ]);
                $name = time() . '_' . $request->photo_url->getClientOriginalName();
                $filePath = $request->file('photo_url')->storeAs('uploads/pizza-images', $name, 'public');
                $filePath = '/storage/' . $filePath;
                Storage::delete($pizza->photo_url);
                $pizza['photo_url'] = $filePath;
            }
            $pizza['title'] = $request->title;
            $pizza['pizza_category_id'] = $request->pizza_category_id;
            $pizza['description'] = $request->description;
            $pizza['ingredients'] = json_encode($request->ingredients);
            $pizza['tax'] = $request->tax;
            $pizza['price'] = $request->price;
            $pizza->update();
            $response = [
                'message' => 'Pizza Record has been Updated Successfully'
            ];
            return response($response, 200);
        } else {
            $response = [
                'message' => 'The Pizza record has not been Founded'
            ];
            return response($response, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pizza = Pizza::find($id);
        if (!is_null($pizza)) {
            if (is_null($pizza->orderDetails)) {
                $pizza->delete();
                $response = [
                    'message' => 'The Pizza record been Deleted'
                ];
                return response($response, 200);
            } else {
                $response = [
                    'message' => 'The Pizza record can not be Deleted',
                    'status' => '409'
                ];
                return response($response, 200);
            }
        } else {
            $response = [
                'message' => 'The Pizza record has not been Founded'
            ];
            return response($response, 404);
        }
    }
}

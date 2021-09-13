<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\PizzaCategory;
use Illuminate\Http\Request;

class PizzaCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pizzaCategories = PizzaCategory::orderBy('id', 'DESC')->get();
        $response = [
            'PizzaCategories' => $pizzaCategories->toArray()
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
            'title' => 'required|string|unique:pizza_categories',
        ]);
        $pizzaCategory =  PizzaCategory::create([
            'title' => $request->title,
            'description' => $request->description ?? "N/A",
        ]);
        $response = [
            'message' => 'The Pizza Category has been Created'
        ];
        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PizzaCategory  $pizzaCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pizzaCategory = PizzaCategory::find($id);

        if (!is_null($pizzaCategory)) {
            $response = [
                'pizza-category' => $pizzaCategory->toArray()
            ];
            return response($response, 200);
        } else {
            $response = [
                'message' => 'The Pizza Category has not been Founded'
            ];
            return response($response, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PizzaCategory  $pizzaCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pizzaCategory = PizzaCategory::find($id);
        if (!is_null($pizzaCategory)) {
            $this->validate($request, [
                'title' => 'required|string'
            ]);
            $pizzaCategory['title'] = $request->title;
            $pizzaCategory['description'] = $request->description??"N/A";
            $pizzaCategory->update();
            $response = [
                'message' => 'The Pizza Category has been Updated'
            ];
            return response($response, 200);
        } else {
            $response = [
                'message' => 'The Pizza Category has not been Founded'
            ];
            return response($response, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PizzaCategory  $pizzaCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pizzaCategory = PizzaCategory::find($id);
        if (!is_null($pizzaCategory)) {
            $pizzaCategory->delete();
            $response = [
                'message' => 'The Pizza Category has been Deleted'
            ];
            return response($response, 200);
        } else {
            $response = [
                'message' => 'The Pizza Category has not been Founded'
            ];
            return response($response, 404);
        }
    }
}

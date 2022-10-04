<?php

namespace App\Http\Controllers\Odoo;

use App\Services\Odoo\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ripoo\Exception\{CodingException, ResponseException, ResponseEntryException, ResponseFaultException, ResponseStatusException};


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories()
    {
        try {
            // Validate the value...
            $categories = Category::allCategory();
            if (count($categories) > 0) {
                return response()->json([
                    'categories' => $categories,
                    'statusCode' => 200,

                ], 200);
            } else {
                return response()->json([
                    'message' => 'No categories ',
                    'statusCode' => 404,

                ], 404);
            }
        } catch (ResponseException $e) {
            report($e);

            return response()->json([
                'message' => 'something went wrong',
                'statusCode' => 500,

            ], 500);
        }
    }


    public function subCategory($id)
    {
        try {
            $category = Category::subCategory($id);
            if (count($category) > 0) {
                return response()->json([
                    'categories' => $category,
                    'statusCode' => 200,

                ], 200);
            } else {
                return response()->json([
                    'message' => 'No categories ',
                    'statusCode' => 404,

                ], 404);
            }
        } catch (ResponseException $e) {
            report($e);

            return response()->json([
                'message' => 'something went wrong',
                'statusCode' => 500,

            ], 500);
        }
    }



    public function getSingleCategory($id)
    {
        return Category::singleCategory($id);
    }


    // fields
    public function getFields()
    {
        return Category::categoryFields();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

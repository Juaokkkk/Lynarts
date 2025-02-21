<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;

use App\Http\Requests\ClothesRequest;

use App\Models\Clothes;
use App\Models\Size;
use App\Models\Style;


class ClothesController extends Controller
{
    public function index()
    {
        
    }

 
    public function create()
    {
        return view("pages.clothes");
    }


    public function store(ClothesRequest $request)
    {
        // $size = new Size();
        // $size->name = "banana";
        // $size->save();

        // $style = new Style();
        // $style->name = "banana";
        // $style->save();

        // Clothes::create($request->validated());
        // return dd("olá mundo");

        die("estou o store");

    }

    
    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(ClothesRequest $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}

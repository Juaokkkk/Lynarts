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


    public function store(Request $request)
    {
      
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'id_size' => 'required|numeric|min:0',
            'id_style' => 'required|numeric|min:0',
        ]);
    
        // Criando um novo registro no banco
        $clothes = Clothes::create([
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'id_size' => $validatedData['id_size'],
            'id_style' => $validatedData['id_style']
        ]);
 
       return redirect()->route('clothes.create')->with('success', 'Roupa cadastrada com sucesso!');

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

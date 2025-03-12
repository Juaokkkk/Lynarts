<?php

namespace App\Http\Controllers\Products;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;

use App\Http\Requests\Products\ClothesRequest;

use App\Models\Products\Clothes;
use App\Models\Products\Size;
use App\Models\Products\Style;
use League\Uri\QueryString;

class ClothesController extends Controller
{
    public function index()
    {
            // Pega todos os produtos cadastrados
    $clothes = Clothes::all();

    // Retorna a view 'pages.catalog' com os dados dos produtos
    return view('pages.catalog', ['clothes' => $clothes]);
    }

 
    public function create()
    {
        $sizes =  Size::all();
        $styles = Style::all();
        
        return view("pages.clothes", ['sizes' => $sizes], ['styles' => $styles]);
    }


    public function store(ClothesRequest $request)
    {
        try{

            $data = $request->validated();
            // dd($data);
            Clothes::create($data);
     
           return redirect()->route('clothes.create')
            ->with('success', 'Roupa cadastrada com sucesso!');

        } catch (QueryException $error){

            return redirect()->route('clothes.create')
                ->with('error', 'Falha ao cadastrar a roupa!' . $error->getMessage());

        }


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

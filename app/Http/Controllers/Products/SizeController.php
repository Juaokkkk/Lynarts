<?php

namespace App\Http\Controllers\Products;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;

use App\Http\Requests\Products\SizeRequest;

use App\Models\Products\Size;

class SizeController extends Controller
{
    public function index(){

    }

    public function create(){

        return view("pages.size");

    }

    public function store(SizeRequest $request){

        try {

            $data = $request->validated();
            Size::create($data);

            return  redirect()->route('clothes.create')->with('sucess', 'Novo tamanho cadastrado com sucesso!');
        }

        catch(QueryException $error){

            return  redirect()->route('clothes.create')->with('error', 'Erro ao cadastrar novo modelo');
        }

    }

    public function show(string $id){

    }

    public function edit(string $id){

    }

    public function update(Request $request, string $id){

    }

    public function destroy(string $id){

    }
}

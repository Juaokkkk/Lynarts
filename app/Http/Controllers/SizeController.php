<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;

use App\Http\Requests\SizeRequest;

use App\Models\Size;

class SizeController extends Controller
{
    public function index(){

    }

    public function create(){

        return view("pages.size");

    }

    public function store(SizeRequest $request){

        try {

            Size::create($request->validated());

            return  redirect()->route('clothes.index')->with('sucess', 'Novo tamanho cadastrado com sucesso!');
        }

        catch(QueryException $error){

            return  redirect()->route('clothes.index')->with('error', 'Erro ao cadastrar novo modelo');
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

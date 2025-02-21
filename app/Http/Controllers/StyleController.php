<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;

use App\Http\Requests\StyleRequest;

use App\Models\Style;

class StyleController extends Controller
{
    public function index(){

    }

    public function create(){

        return view("pages.style");

    }

    public function store(StyleRequest $request){

        try {

            Style::create($request->validated());

            return  redirect()->route('clothes.index')->with('sucess', 'Novo modelo cadastrado com sucesso!');
        }

        catch(QueryException){

            return  redirect('pages.clothes')->with('error', 'Erro ao cadastrar novo modelo');
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

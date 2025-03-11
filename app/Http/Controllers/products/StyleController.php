<?php

namespace App\Http\Controllers\Products;
use App\Http\Controllers\Controller;

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

            return  redirect()->route('clothes.create')
                ->with('sucess', 'Novo modelo cadastrado com sucesso!');
        }

        catch(QueryException){

            return  redirect('pages.clothes')->route('clothes.create')
                ->with('error', 'Erro ao cadastrar novo modelo');
        }

    }

    public function show(string $id){

    }

    public function edit(string $id){

    }

    public function update(StyleRequest $request, string $id){

    }

    public function destroy(string $id){

    }
}

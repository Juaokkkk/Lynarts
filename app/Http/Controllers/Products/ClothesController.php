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

    $clothes = Clothes::with(['size', 'style'])->get();

    return view('pages.catalog', compact('clothes'));
    }

    public function delete(){

        $clothes = Clothes::with(['size', 'style'])->get();
        
        return view('pages.delete', compact('clothes'));
    }

 
    public function create()
    {
        $sizes =  Size::all();
        $styles = Style::all();
        
        return view("pages.clothes", compact('sizes', 'styles'));
    }


    public function store(ClothesRequest $request)
    {
        try{


            $data = $request->validated();   

            if ($request->hasFile('img') && $request->file('img')->isValid()) {

                $imgFile = $request->file('img'); 

                $extension = $imgFile->extension();
                
                $imageName = md5($imgFile->getClientOriginalName() . strtotime("now")) . "." . $extension;
            
                $imgFile->move(public_path('assets/img'), $imageName);
            
                $data['path'] = $imageName;
            }

            
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
        $sizesAll =  Size::all();
        $stylesAll = Style::all();
        $clothing = Clothes::where('id', $id)->first();
        $size= Size::where('id', $clothing->id_size)->first();
        $style= Style::where('id', $clothing->id_style)->first();

        return view("pages.clothesEdit", compact('clothing', 'sizesAll', 'stylesAll', 'size', 'style'));
    }


    public function update(ClothesRequest $request, string $id)
    {
        $data = $request->validated();
        
        $clothing = Clothes::findOrFail($id);
        $clothing->update($data);

        return redirect()->route('deletar')->with('success', 'Produto editado com sucesso!');

    }

    public function destroy(string $id){

    $cloth = Clothes::findOrFail($id);

    $cloth->delete();

    return redirect()->route('deletar')->with('success', 'Produto deletado com sucesso!');
}

}


<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Sales\SaleRequest;

use App\Models\Products\Clothes;
use App\Models\Entities\User;
use App\Models\Entities\Customer;
use App\Models\Sales\Method;
use Illuminate\Support\Facades\Auth;


class SaleController extends Controller
{
    public function index(){

        $User = Auth::user();
        $Users = User::all();
        $Clothes = Clothes::all();
        $Customers = Customer::all();
        $Methods = Method::all();


        return view("pages.sale", compact('User','Users', 'Clothes', 'Customers', 'Methods'));

    }

    public function create(){

    }

    public function store(SaleRequest $request){

    }

    public function show(string $id){

    }

    public function edit(string $id){


    }

    public function update(SaleRequest $request, string $id){

    }

    public function destroy(string $id){

    }

  public function search(Request $request)
{
    $query = $request->get('q');
    $products = Clothes::where('description', 'LIKE', "%{$query}%")->get();

    return response()->json($products);
}


}

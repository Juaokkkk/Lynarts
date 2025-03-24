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

class SalesController extends Controller
{
    public function index(){

        $user = Auth::user();
        $users = User::all();
        $clothes = Clothes::all();
        $customers = Customer::all();
        $methods = Method::all();

        return view("pages.sale", compact('user','users', 'clothes', 'customers', 'methods'));

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
}

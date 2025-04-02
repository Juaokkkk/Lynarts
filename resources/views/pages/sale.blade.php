@extends('layouts.main')
@section('title', 'Criar Produto')

@section('content')

<div class="setor setor-imagens">
    <h3>Imagens dos Produtos</h3>
    <div class="produtos-imagem-container">
        <img src="\assets/img/JA-picture.PNG" alt="Produto 1">
        <img src="\assets/img/Lynarts.png" alt="Produto 2">
        <img src="\assets/img/JV-picture.PNG" alt="Produto 3">
    </div>
</div>
<div class="container-sale">
    <div class="setor setor-esquerdo">
        <div class="logo-sale">
            <img src="\assets/img/Lynarts.png" alt="">
        </div>
        <div class="valor-total">
            <h2>Total: R$ 0,00</h2>
        </div>
    </div>

    <div class="setor setor-central">
        <form>
            @csrf

            <label for="id_user">Vendedor</label>
            <select name="id_user">
                <option selected value="">Vendedor</option>

                @foreach ($Users as $u)
                <option
                    <?php if($u->id == $User->id){echo "selected"; }else{echo  ""; } ?> 
                    value={{ $u->id }}>{{ $u->name }}
                    </option>
                @endforeach

            </select>

            <label for="id_cliente">Cliente</label>
            <select name="id_custumer">
                <option selected value="">Cliente</option>

                @foreach ($Customers as $customer)
                    <option value={{ $customer->id }}>{{ $customer->name }}</option>
                @endforeach

            </select>
            <label for="search">Produto</label>
            <div>
            <input list="clothes" id="search" name="search" style="width: 80%">
            
            <datalist id="clothes">
                @foreach ($Clothes as $clothing)
                    <option value="{{ $clothing->id }} - {{ $clothing->description }}">
                @endforeach
            </datalist>
            <button style="width: 15%;">+</button>
            </div>

        </form>
    </div>

    <div class="setor setor-direito">
        <div class="historico">
            <h3>Histórico</h3>
            <p>Produto 1</p>
            <p>Produto 2</p>
            <p>Produto 3</p>
        </div>
    </div>
    
@endsection

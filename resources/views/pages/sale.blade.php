@extends('layouts.main')
@section('title', 'Criar Produto')

@section('content')

<div class="setor setor-imagens">
    <h3>Imagens dos Produtos</h3>
    <div class="produtos-imagem-container">
        <img src="\assets/img/produto1.jpg" alt="Produto 1">
        <img src="\assets/img/produto2.jpg" alt="Produto 2">
        <img src="\assets/img/produto3.jpg" alt="Produto 3">
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
            <input type="text" placeholder="Campo 1">
            <input type="text" placeholder="Campo 2">
            <input type="text" placeholder="Campo 3">
            <input type="text" placeholder="Campo 4">
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

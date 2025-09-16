@extends('layouts.main')
@section('title', 'Criar Produto')

@section('content')

<div class="setor setor-imagens">
    <div class="return-button">
        <button onclick="window.history.back()">⬅ Voltar</button>    
    </div>
    <h3>Imagens dos Produtos</h3>
    <div class="produtos-imagem-container">
        <img src="{{ asset('assets/img/Lynarts.png') }}" alt="Produto exemplo">   
        <img src="{{ asset('assets/img/Lynarts.png') }}" alt="Produto exemplo">
        <img src="{{ asset('assets/img/Lynarts.png') }}" alt="Produto exemplo">
    </div>
</div>

<div class="container-sale">
    <!-- LADO ESQUERDO -->
    <div class="setor setor-esquerdo text-center">
        <div class="logo-sale">
            <img id="product-image" src="{{ asset('assets/img/Lynarts.png') }}" alt="Produto">
        </div>
        <div class="valor-total mt-3">
            <h2 id="total">Total: R$ 0,00</h2>
        </div>
    </div>

    <!-- CENTRO -->
    <div class="setor setor-central">
        <form onsubmit="return false;">
            @csrf

            <label for="id_user">Vendedor</label>
            <select name="id_user">
                <option selected value="">Vendedor</option>
                @foreach ($Users as $u)
                    <option @if($u->id == $User->id) selected @endif value="{{ $u->id }}">
                        {{ $u->name }}
                    </option>
                @endforeach
            </select>

            <label for="id_cliente">Cliente</label>
            <select name="id_customer">
                <option selected value="">Cliente</option>
                @foreach ($Customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>

            <label for="search">Produto</label>
            <div style="position: relative;">
                <input type="text" id="search" name="search" autocomplete="off">
                <div id="search-results" class="list-group"></div>
            </div>
        </form>
    </div>

    <!-- LADO DIREITO -->
    <div class="setor setor-direito">
        <div class="historico">
            <h3>Histórico</h3>
            <ul id="sale-history" class="list-group"></ul>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    let total = 0;
    let defaultImage = "{{ asset('assets/img/Lynarts.png') }}";

    function atualizarTotal() {
        let novoTotal = 0;
        $('#sale-history li').each(function() {
            novoTotal += parseFloat($(this).data('price'));
        });
        total = novoTotal;
        $('#total').text('Total: R$ ' + total.toFixed(2).replace('.', ','));
    }

    // Buscar produtos
    $('#search').on('keyup', function(){
        let query = $(this).val();
        if(query.length > 1){
            $.ajax({
                url: "{{ route('sale.search') }}",
                type: "GET",
                data: {q: query},
                success: function(data){
                    let results = '';
                    data.forEach(product => {
                        results += `
                            <a href="#" class="list-group-item list-group-item-action select-product"
                               data-id="${product.id}" 
                               data-name="${product.description}" 
                               data-price="${product.price}" 
                               data-image="${product.image ?? defaultImage}">
                                ${product.description} - R$ ${parseFloat(product.price).toFixed(2).replace('.', ',')}
                            </a>
                        `;
                    });
                    $('#search-results').html(results);
                }
            });
        } else {
            $('#search-results').html('');
        }
    });

    // Selecionar produto
    $(document).on('click', '.select-product', function(e){
        e.preventDefault();
        let name = $(this).data('name');
        let price = parseFloat($(this).data('price') || 0);

        $('#product-image').attr('src', $(this).data('image'));

        $('#sale-history').append(`
            <li class="list-group-item" data-price="${price}">
                <div class="item-info">
                    ${name}
                </div>
                <div class="item-actions">
                    <span>R$ ${price.toFixed(2).replace('.', ',')}</span>
                    <button class="remove-item">✖</button>
                </div>
            </li>
        `);

        atualizarTotal();

        $('#search-results').html('');
        $('#search').val('');
    });

    // Remover item do histórico
    $(document).on('click', '.remove-item', function(){
        $(this).closest('li').remove();
        atualizarTotal();
    });

});
</script>

<!-- CSS -->
<link rel="stylesheet" href="{{ asset('css/sale.css') }}">

@endsection

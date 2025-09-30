@extends('layouts.main')
@section('title', 'Criar Produto')

@section('content')

<div class="setor setor-topo">
    <div class="return-button">
        <button onclick="window.history.back()">
            ⬅ Voltar
        </button>    
    </div>
    <h2>VENDAS</h2>
</div>

<div class="container-sale">
    <!-- LADO ESQUERDO -->
    <div class="setor setor-esquerdo text-center">
        <div class="logo-sale">
            <img id="product-image" src="\assets/img/Lynarts.png" alt="Produto">
        </div>
        <div class="valor-total mt-3">
            <h2 id="total">Total: R$ 0,00</h2>
        </div>
    </div>

    <!-- CENTRO -->
    <div class="setor setor-central">
        <form>
            @csrf

            <label for="id_user">Vendedor</label>
            <select name="id_user">
                <option selected value="">Vendedor</option>
                @foreach ($Users as $u)
                <option
                    @if($u->id == $User->id) selected @endif
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
                <input type="text" id="search" name="search" autocomplete="off" style="width: 80%">
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
    let defaultImage = "/assets/img/Lynarts.png";

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
                                <img src="${product.image ?? defaultImage}" width="40"> 
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
        let image = $(this).data('image');
        let price = parseFloat($(this).data('price'));

        // trocar logo pela imagem do produto
        $('#product-image').attr('src', image);

        // adicionar no histórico
        $('#sale-history').append(`
            <li class="historico-item">
                <div class="info">
                    <img src="${image}" class="thumb">
                    <span class="nome">${name}</span>
                </div>
                <span class="preco">R$ ${price.toFixed(2).replace('.', ',')}</span>
                <button class="remove-item">X</button>
            </li>
        `);

        // atualizar total
        total += price;
        $('#total').text('Total: R$ ' + total.toFixed(2).replace('.', ','));

        // limpar input
        $('#search-results').html('');
        $('#search').val('');
    });

    // Remover item do histórico
    $(document).on('click', '.remove-item', function() {
        let item = $(this).closest('.historico-item');
        let priceText = item.find('.preco').text().replace('R$ ', '').replace(',', '.');
        let price = parseFloat(priceText);

        total -= price;
        $('#total').text('Total: R$ ' + total.toFixed(2).replace('.', ','));

        item.remove();
    });

});
</script>

<!-- Importa o CSS separado -->
<link rel="stylesheet" href="{{ asset('css/sale.css') }}">

@endsection

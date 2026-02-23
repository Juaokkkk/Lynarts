@extends('layouts.main')
@section('title', 'Criar Produto')

@section('content')

<div class="setor setor-topo">
    <div class="return-button">
        <button onclick="window.location.href='{{ route('home') }}'">
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

          <label for="id_customer">Cliente</label>
            <select name="id_customer"> <option selected value="">Selecione o Cliente</option>
                @foreach ($Customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
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
        <button id="finalizar-venda" class="btn-finalizar">
            Finalizar compra
        </button>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function(){
    console.log("Script de vendas carregado com sucesso.");

    let total = 0;
    let defaultImage = "/assets/img/Lynarts.png";

    // --- 1. BUSCAR PRODUTOS (AUTOCOMPLETE) ---
    $('#search').on('keyup', function(){
        let query = $(this).val();
        if(query.length > 1){
            $.ajax({
                url: "{{ route('sale.search') }}",
                type: "GET",
                data: { q: query },
                success: function(data){
                    let results = '';
                    data.forEach(product => {
                        results += `
                            <a href="#" class="list-group-item list-group-item-action select-product"
                               data-id="${product.id}" 
                               data-name="${product.description}" 
                               data-price="${product.price}" 
                               data-image="${product.image ?? defaultImage}">
                                <img src="${product.image ?? defaultImage}" width="40" style="margin-right:10px"> 
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

    // --- 2. SELECIONAR PRODUTO E ADICIONAR AO HISTÓRICO ---
    $(document).on('click', '.select-product', function(e){
        e.preventDefault();
        
        let id = $(this).data('id');
        let name = $(this).data('name');
        let image = $(this).data('image');
        let price = parseFloat($(this).data('price'));

        // Trocar imagem principal
        $('#product-image').attr('src', image);

        // Adicionar ao histórico visual (IMPORTANTE: Guardamos o data-id aqui para o loop final)
        $('#sale-history').append(`
            <li class="historico-item" data-id="${id}">
                <div class="info">
                    <img src="${image}" class="thumb" style="width:30px; height:30px; border-radius:5px; margin-right:10px">
                    <span class="nome">${name}</span>
                </div>
                <span class="preco">R$ ${price.toFixed(2).replace('.', ',')}</span>
                <button type="button" class="remove-item" style="color:red; margin-left:10px; border:none; background:none; cursor:pointer">X</button>
            </li>
        `);

        // Atualizar total acumulado
        total += price;
        updateTotalDisplay();

        // Limpar busca
        $('#search-results').html('');
        $('#search').val('').focus();
    });

    // --- 3. REMOVER ITEM DO HISTÓRICO ---
    $(document).on('click', '.remove-item', function() {
        let item = $(this).closest('.historico-item');
        let priceText = item.find('.preco').text().replace('R$ ', '').replace(',', '.');
        let price = parseFloat(priceText);

        total -= price;
        updateTotalDisplay();
        item.remove();
    });

    // --- 4. FUNÇÃO PARA ATUALIZAR O TEXTO DO TOTAL ---
    function updateTotalDisplay() {
        if(total < 0) total = 0;
        $('#total').text('Total: R$ ' + total.toFixed(2).replace('.', ','));
    }

    // --- 5. FINALIZAR VENDA (ENVIAR PARA O BANCO) ---
    $('#finalizar-venda').on('click', function(e){
        e.preventDefault();

        // Criar array com os IDs de todos os produtos que estão no histórico
        let produtosIds = [];
        $('.historico-item').each(function() {
            produtosIds.push($(this).data('id'));
        });

        // Validações básicas antes de enviar
        let id_user = $('select[name="id_user"]').val();
        let id_customer = $('select[name="id_customer"]').val();

        if(!id_user) { alert('Selecione um Vendedor'); return; }
        if(!id_customer) { alert('Selecione um Cliente'); return; }
        if(produtosIds.length === 0) { alert('Adicione pelo menos um produto ao carrinho'); return; }

        // Desativar botão para evitar cliques duplicados
        let btn = $(this);
        btn.prop('disabled', true).text('Processando...');

        $.ajax({
            url: "{{ route('sales.store') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id_user: id_user,
                id_customer: id_customer,
                total: total,
                products: produtosIds // Enviado como array para o Controller
            },
            success: function(response){
                // Redirecionamento para a rota do PIX usando o ID retornado pelo banco
                window.location.href = "/sales/sales/" + response.id + "/pix";
            },
            error: function(xhr){
                btn.prop('disabled', false).text('Finalizar compra');
                console.error("Erro no servidor:", xhr.responseText);
                alert('Erro ao salvar venda. Verifique o console para detalhes.');
            }
        });
    });
});
</script>

<!-- Importa o CSS separado -->
<link rel="stylesheet" href="{{ asset('css/sale.css') }}">

@endsection

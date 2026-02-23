{{-- Essa parte aqui é o PDV que ta fazendo o extends pro Sale.blade.php, provavelmente vai estar feio pra caralho
     Pq apagou o sale.blade.php e só deixou o extends do @livewire('pos'), mas acontece! --}}
<div class="container-sale">
    <div class="setor setor-esquerdo">
        <div class="logo-sale">
            <img src="\assets/img/Lynarts.png" alt="">
        </div>
        <div class="valor-total">
             <h2>Total: R$ {{ number_format($total, 2, ',', '.') }}</h2>   {{--Deixa como valor Decimal --}}
        </div>
    </div>

    <div class="setor setor-central">
        <label for="id_user">Vendedor</label>
        <select wire:model="id_user">
            <option value="">Selecione</option>
            @foreach ($Users as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>     {{-- Option de vendedor --}}
            @endforeach
        </select>

        <label for="id_customer">Cliente</label>
        <select wire:model="id_customer">
            <option value="">Selecione</option>
            @foreach ($Customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>  {{-- Nome do Cliente (sinceramente nao sei
                                                                                         se Tem no PDV, mas se nao tiver pode Cortar) --}}
            @endforeach
        </select>

        <label for="search">Produto</label>
        <div>
            <input list="clothes" wire:model="search" style="width: 80%">
            <datalist id="clothes">
                @foreach ($Clothes as $clothing)
                    <option value="{{ $clothing->id }} - {{ $clothing->description }}">         {{-- Id das Clothes --}}
                @endforeach
            </datalist>
            <button type="button" style="width: 15%" wire:click="addProduct">+</button>
        </div>
    </div>

    <div class="setor setor-direito">
        <h3>Histórico</h3>
        @forelse ($cart as $item)
            <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                <span>{{ $item['description'] }} - R$ {{ number_format($item['subtotal'], 2, ',', '.') }}</span> {{-- Historico da Venda --}}
                <button type="button" wire:click="removeProduct({{ $item['id'] }})">❌</button>  {{-- Botao de Remove  --}}
            </div>
        @empty
            <p>Nenhum produto adicionado</p>
        @endforelse
    </div>

    <button type="button" wire:click="saveSale" @if (empty($cart)) disabled @endif
        wire:loading.attr="disabled">
        Finalizar Venda
    </button>

    @if (session()->has('success'))
        <p style="color:green">{{ session('success') }}</p>    {{-- Tipo um Toast de Sucesso e error --}}                                              
    @endif
    @if (session()->has('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif
</div>

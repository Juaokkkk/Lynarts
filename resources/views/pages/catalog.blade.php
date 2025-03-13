@extends('layouts.main')
@section('title','Catalogo')
{{-- @php
    dd($clothes);
@endphp --}}
@section('content')
    
    <div class="container-catalog">
        @if($clothes->isEmpty())
            <p>Não há produtos cadastrados.</p>
        @else
            <div class="product-box">
                @foreach($clothes as $cloth)
                    <div class="product-item">
                        <div class="product-image"></div>
                        <h3>{{ $cloth->description }}</h3>
                        <p>Valor: R$ {{ number_format($cloth->price, 2, ',', '.') }}</p>
                        <p>Tamanho: {{ $cloth->size ? $cloth->size->name : 'Não especificado' }}</p>
                        <p>Estilo: {{ $cloth->style ? $cloth->style->name : 'Não especificado' }}</p>
                        <p>Quantidade: {{ $cloth->amount }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
    

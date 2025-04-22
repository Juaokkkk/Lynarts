@extends('layouts.main')
@section('title','Catalogo')
@section('content')

<h1> Hello Word!</h1>

<h2>Produtos:</h2>
@php
    $count = 0;
    foreach ($Clothes as $Clothing)
    {
        $count += 1;
    }
@endphp
<p>{{ $count }}</p>


<h2>Vendas:</h2>
@php
    $count = 0;
    foreach ($Sales as $sale)
    {
        $count += 1;
    }
@endphp
<p>{{ $count }}</p>


@endsection
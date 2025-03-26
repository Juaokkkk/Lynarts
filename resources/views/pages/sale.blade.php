@extends('layouts.main')
@section('title', 'Criar Produto')

@section('content')

<div class="container-form">

    <div class="box-form mini">

<form>
    @csrf

    <select>
        <option>Vendedor</option>
    </select>

    <select>
        <option>Cliente</option>
    </select>

    <select>
        <option>Adicionar Produto</option>
    </select>

    <label></label>
    <input>

    <button type="submit">Enviar</button>
</form>

</div>

</div>

@endsection
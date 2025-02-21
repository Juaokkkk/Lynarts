    @extends('layouts.main')
    @section('title','Criar Produto')

    @section('content')

    <div class="container-form">


        <div class="box-form">

    <form action="{{route('clothes.store')}}" method="POST">
        @csrf

        <h1>{{ session('error') }}</h1>
        <h1>{{ session('success') }}</h1>


        <label for="description">Descrição</label>
        <input type="text" name="description">

        <label for="price">Valor</label>
        <input type="number" step="0.01" name="price">

        <select name="id_size">
            <option selected value="">Tamanho</option>
            <option value="1">P</option>
            <option value="2">M</option>
            <option value="3">G</option>
        </select>
        <a href="{{ route('size.create') }}"><button type="button">+</button></a>

        <select name="id_style">
            <option selected value="">Estilo</option>
            <option value="1">Oversized</option>
            <option value="2">Fittness</option>
            <option value="3">BabyLook</option>
        </select>
        <a href="{{ route('style.create') }}"><button type="button">+</button></a>

        <button type="submit">Enviar</button>
    </form>
        </div>
            </div>
    @endsection
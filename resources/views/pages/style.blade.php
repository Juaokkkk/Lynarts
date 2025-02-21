@extends('layouts.main')
@section('title', 'Criar Produto')

@section('content')

    <div class="container-form">
        <div class="box-form style">

            <form action="{{ route('style.store') }}" method="POST">
                <label for="name">Modelo novo</label>
                <input type="text" name="name">
                <button type="submit">Cadastrar</button>
            </form>

        </div>
    </div>

@endsection

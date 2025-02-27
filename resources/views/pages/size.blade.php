@extends('layouts.main')
@section('title', 'Criar Produto')

@section('content')

    <div class="container-form">
        <div class="box-form size">

            <form action="{{ route('sizes.store') }}" method="POST">
                @csrf
                <label for="name">Tamanho novo</label>
                <input type="text" name="name">
                <button type="submit">Cadastrar</button>
            </form>

        </div>
    </div>

@endsection

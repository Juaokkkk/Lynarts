@extends('layouts.main')
@section('title', 'Criar Produto')

@section('content')

    <div class="container-form">
        <div class="style">

            <form action="{{ route('styles.store') }}" method="POST">
                @csrf
                <label for="name">Modelo novo</label>
                <input type="text" name="name">
                <button type="submit">Cadastrar</button>
            </form>

        </div>
    </div>

@endsection

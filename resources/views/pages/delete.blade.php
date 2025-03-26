@extends('layouts.main')
    @section('title', 'Deletar produto')

    @section('content')

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="container-delete">
        @foreach ($clothes as $cloth)
            
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Tamanho</th>
                    <th>Estilo</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $cloth->description }}</td>
                    <td> R$ {{ number_format($cloth->price, 2, ',', '.') }}</td>
                    <td>{{ $cloth->size ? $cloth->size->name : 'Não especificado' }}</td>
                    <td>{{ $cloth->style ? $cloth->style->name : 'Não especificado' }}</td>
                    <td>{{ $cloth->amount }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('clothes.edit', $cloth->id) }}" class="edit-btn">Editar</a>

                            <form action="{{ route('clothes.destroy', $cloth->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
                                @csrf
                                @method('DELETE')
                                <button class="delete-btn" onclick="confirmDelete()">Apagar</button>
                            </form>
                            
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        @endforeach
    </div>
    
    @endsection
@extends('layouts.main')
@section('title', 'Criar Produto')

@section('content')

    <div class="container-form">
        
        <div class="box-form">

            <form action="{{ route('clothes.update', $clothing->id) }}" method="POST">

                @csrf
                @method('PUT')

                <h5 style="text-align: center; color: red;">{{ session('error' )}}</h5>
                <h5 style="text-align: center; color:rgb(0, 255, 0);">{{ session('success') }}</h5>
               

                <label for="description">Descrição</label>
                <input type="text" name="description" value="{{ $clothing->description }}">

                <label for="price">Valor</label>
                <input type="number" step="0.01" oninput="formatarNumero(this)"
                    onblur="fixarNumero(this)" name="price" value="{{ $clothing->price }}">

                <script>
                    function formatarNumero(input) {
                        if (input.value) {
                            // Garante que há pelo menos uma casa decimal visível
                            input.value = input.value.replace(/[^0-9.]/g, '').replace(/^0+(?!$)/, '');
                        }
                    }

                    function fixarNumero(input) {
                        if (input.value) {
                            input.value = parseFloat(input.value).toFixed(2);
                        }
                    }
                </script>


                <select name="id_size">

                    <option value="">Tamanho</option>

                    @foreach ($sizesAll as $sz)
                        <option 
                        <?php if($clothing->id_size == $sz->id){echo "selected"; }else{echo  ""; } ?> 
                        value={{ $sz->id }}>{{ $sz->name }}</option>
                    @endforeach

                </select>
                <a href="{{ route('sizes.create') }}"><button type="button">+</button></a>

                <select name="id_style">
                    <option selected value="">Estilo</option>

                    @foreach ($stylesAll as $st)
                    <option 
                    <?php if($clothing->id_style == $st->id){echo "selected"; }else{echo  ""; } ?> 
                    value={{ $st->id }}>{{ $st->name }}</option>
                    @endforeach

                </select>
                <a href="{{ route('styles.create') }}"><button type="button">+</button></a>

                <label for="amount">Quantidade</label>
                <input type="number" name="amount" value="{{ $clothing->amount }}">

                <button type="submit">Atualizar</button>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


            </form>
        </div>
    </div>
@endsection

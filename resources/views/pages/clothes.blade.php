    @extends('layouts.main')
    @section('title', 'Criar Produto')

    @section('content')

        <div class="container-form">


            <div class="box-form">

                <form action="{{ route('clothes.store') }}" method="POST">
                    @csrf

                    <h1>{{ session('error') }}</h1>
                    <h1>{{ session('success') }}</h1>


                    <label for="description">Descrição</label>
                    <input type="text" name="description">

                    <label for="price">Valor</label>
                    <input type="number" step="0.01" oninput="formatarNumero(this)"
                        onblur="fixarNumero(this)" name="price">

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
                        <option selected value="">Tamanho</option>

                        @foreach ($sizes as $size)
                            <option value={{ $size->id }}>{{ $size->name }}</option>
                        @endforeach

                    </select>
                    <a href="{{ route('sizes.create') }}"><button type="button">+</button></a>

                    <select name="id_style">
                        <option selected value="">Estilo</option>

                        @foreach ($styles as $style)
                            <option value={{ $style->id }}>{{ $style->name }}</option>
                        @endforeach

                    </select>
                    <a href="{{ route('styles.create') }}"><button type="button">+</button></a>

                    <label for="amount">Quantidade</label>
                    <input type="number" name="amount">

                    <button type="submit">Enviar</button>

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

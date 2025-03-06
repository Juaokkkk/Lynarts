
<div class="nav-top">
    <div class="search">
        <input type="search" name="search" id="search" placeholder="Pesquisa..."> 
        <i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i>
    </div>

    <div class="logo">
        <h1>Lyna'rts</h1>
        <h2>Brechó & Boutique</h2>
    </div>
    
    <div class="account">
        @guest
        <div class="login">
           <a href="login">
            <i class="fa-regular fa-user" style="color: #ffffff;"></i>
            Login
           </a>
           
        </div>
        <div class="create-account">
            
            <a href="register">
                <img src="\assets/img/userpluss.png">
                Criar Conta
             </a>
        </div>
        @endguest
            
        @auth
            <div class="login">
                
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>
                    sair
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>                
            </div>
        @endauth
    </div>
</div>

<nav>
    <div class="links">
        <ul>
            @guest
                <li><a href="/">Home</a></li>
                <li><a href="">Catalogo</a></li>
                <li><a href="{{route('suporte')}}">Suporte</a></li>
            @endguest
            @auth
                <li><a href="/">Home</a></li>
                <li><a href="#">Consultar</a></li>
                <li><a href="{{route('clothes.create')}}">Criar Produto</a></li>
                <li><a href="{{ route('sales.index') }}">Venda</a></li>
                <li><a href="#">Catalogo</a></li>
                <li><a href="{{route('suporte')}}">Suporte</a></li>
            @endauth
        </ul>
    </div>
</nav>


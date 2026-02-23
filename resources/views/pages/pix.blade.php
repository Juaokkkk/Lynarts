@extends('layouts.main')
@section('title', 'Pagamento PIX')

@section('content')

<div class="setor setor-topo">
    <div class="return-button">
        <button onclick="window.location.href='{{ route('sales.index') }}'">
            ⬅ Voltar
        </button>    
    </div>
    <h2>PAGAMENTO PIX</h2>
</div>

<div class="container-sale">
    
    <div class="setor setor-esquerdo text-center">
        <div class="logo-sale">
            <img id="product-image" src="{{ asset('assets/img/Lynarts.png') }}" alt="Pagamento">
        </div>
        
        <div class="valor-total mt-3">
            <p style="color: #666; margin-bottom: 5px;">Valor Total da Compra:</p>
            <h2 id="total">R$ {{ number_format($sale->totalValue, 2, ',', '.') }}</h2>
        </div>
    </div>

    <div class="setor setor-central text-center" id="area-pagamento">
        <form id="pix-form">
            <label>Escaneie o QR Code no seu App Bancário</label>
            
            <div class="qrcode-wrapper" style="background: white; padding: 15px; border-radius: 8px; display: inline-block; margin-bottom: 20px; border: 1px solid #ddd;">
                <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code PIX" style="width: 220px; height: 220px;">
            </div>

            <label for="pix-payload">Código PIX Copia e Cola:</label>
            <textarea id="pix-payload" class="form-control" rows="4" readonly 
                style="width: 100%; resize: none; font-size: 11px; font-family: monospace; background: #fdfdfd; border: 1px dashed #00bfa5; padding: 10px;">{{ $payload }}</textarea>
            
            <button type="button" class="btn-finalizar mt-3" onclick="copyPixCode()" style="background-color: #00bfa5; color: white; width: 100%;">
                <i class="fa-regular fa-copy"></i> Copiar Código PIX
            </button>
        </form>
    </div>

    <div class="setor setor-direito">
        <div class="historico">
            <h3>Resumo da Venda #{{ $sale->id }}</h3>
            
            <ul class="list-group" style="list-style: none; padding: 0; font-size: 0.9rem;">
                <li style="padding: 12px 0; border-bottom: 1px solid #eee;">
                    <strong>Cliente:</strong> {{ $sale->Customer->name }}
                </li>
                <li style="padding: 12px 0; border-bottom: 1px solid #eee;">
                    <strong>Vendedor:</strong> {{ $sale->User->name }}
                </li>
                <li style="padding: 12px 0;">
                    <strong>Status:</strong> 
                    <span id="status-badge" class="badge bg-warning text-dark" style="transition: all 0.5s ease; padding: 8px 12px;">
                        <span id="status-text">{{ ucfirst($sale->situation) }}</span>
                    </span>
                </li>
            </ul>
        </div>
        
        <div id="info-box" class="mt-4 p-4 text-center" style="background: #e3f2fd; border-radius: 8px; border: 1px solid #bbdefb;">
            <p id="info-text" style="font-size: 0.85rem; margin: 0; color: #0d47a1;">
                <i class="fa-solid fa-sync fa-spin"></i> Aguardando pagamento...
            </p>
            <div id="countdown-display" style="display:none; margin-top: 10px;">
                <span id="timer" style="font-size: 3rem; font-weight: bold; color: #155724; display: block; line-height: 1;">5</span>
                <small style="color: #155724; font-weight: bold;">fechando em segundos</small>
            </div>
        </div>

        <div class="mt-3" style="width: 100%; display: flex; justify-content: center;">
            <button type="button" id="btn-confirmar-manual" class="btn-finalizar" 
                style="background-color: #28a745; color: white; width: 100%; border: none; padding: 15px; border-radius: 5px; cursor: pointer; font-weight: bold; text-align: center;">
                <i class="fa-solid fa-check-double"></i> CONFIRMAR RECEBIMENTO
            </button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function copyPixCode() {
        var copyText = document.getElementById("pix-payload");
        copyText.select();
        navigator.clipboard.writeText(copyText.value).then(() => {
            alert("✅ Código copiado!");
        });
    }

    $(document).ready(function() {
        $('#btn-confirmar-manual').on('click', function(e){
            e.preventDefault();
            
            if(confirm("Deseja confirmar o pagamento agora?")){
                let btn = $(this);
                btn.prop('disabled', true).text('Processando...');

                $.ajax({
                    url: "{{ route('sales.confirmPayment', $sale->id) }}",
                    type: "POST",
                    data: { _token: "{{ csrf_token() }}" },
                    success: function(response){
                        // Atualiza Status para Verde
                        $('#status-badge').removeClass('bg-warning text-dark').addClass('bg-success text-white');
                        $('#status-text').text('CONFIRMADO').css('font-weight', 'bold');
                        
                        // Atualiza Caixa de Info para Verde
                        $('#info-box').css({'background': '#d4edda', 'border-color': '#28a745'});
                        $('#info-text').css({'color': '#155724', 'font-weight': 'bold', 'font-size': '1.1rem'})
                                      .html('<i class="fa-solid fa-circle-check"></i> PAGO COM SUCESSO!');
                        
                        // Mostra o Contador
                        $('#countdown-display').fadeIn();
                        
                        // Remove o botão
                        btn.fadeOut();

                        let timeLeft = 5;
                        let timerLoop = setInterval(function(){
                            timeLeft--;
                            $('#timer').text(timeLeft);
                            
                            if(timeLeft <= 0){
                                clearInterval(timerLoop);
                                window.location.href = "{{ route('sales.index') }}";
                            }
                        }, 1000);
                    },
                    error: function(){
                        btn.prop('disabled', false).text('CONFIRMAR RECEBIMENTO');
                        alert("Erro ao salvar no banco.");
                    }
                });
            }
        });
    });
</script>

<link rel="stylesheet" href="{{ asset('assets/css/sale.css') }}">

@endsection
<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales\Sale;
use App\Models\Products\Clothes;
use App\Models\Entities\User;
use App\Models\Entities\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// Bibliotecas para o QR Code
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class SaleController extends Controller
{
    public function index()
    {
        $User = Auth::user();
        $Users = User::all();
        $Clothes = Clothes::all();
        $Customers = Customer::all();

        return view("pages.sale", compact('User', 'Users', 'Clothes', 'Customers'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'id_user'     => $request->id_user,
                'id_customer' => $request->id_customer,
                'totalValue'  => $request->total,
                'situation'   => 'Pendente',
                'active'      => 1
            ]);

            if ($request->has('products') && is_array($request->products)) {
                foreach ($request->products as $productId) {
                    DB::table('salesclothes')->insert([
                        'id_sale'     => $sale->id,
                        'id_clothing' => $productId,
                        'amount'      => 1,
                        'created_at'  => now(),
                        'updated_at'  => now()
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'id' => $sale->id,
                'message' => 'Venda realizada com sucesso!'
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Erro ao salvar: ' . $e->getMessage()
            ], 500);
        }
    }

    public function pix($id)
    {
        // Carregamos a venda com os relacionamentos para evitar erro na View
        $sale = Sale::with(['Customer', 'User'])->findOrFail($id);

        $valor = number_format($sale->totalValue, 2, '.', '');

        $chavePix = "+5565992617456"; 
        $nome = "kaua";
        $cidade = "CUIABA";

        $payload = $this->gerarPayloadPix($chavePix, $nome, $cidade, $valor);

        $renderer = new ImageRenderer(
            new RendererStyle(300),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);
        $qrCode = base64_encode($writer->writeString($payload));

        return view('pages.pix', compact('sale', 'qrCode', 'payload'));
    }

    // Método para confirmar manualmente via AJAX
    public function confirmPayment($id)
    {
        try {
            $sale = Sale::findOrFail($id);
            $sale->update(['situation' => 'Pago']); 

            return response()->json([
                'status' => 'success',
                'message' => 'Pagamento confirmado com sucesso!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => 'Erro ao confirmar: ' . $e->getMessage()
            ], 500);
        }
    }

    private function gerarPayloadPix($chave, $nome, $cidade, $valor)
    {
        $payload  = "000201";
        $payload .= "26360014BR.GOV.BCB.PIX01";
        $payload .= str_pad(strlen($chave), 2, '0', STR_PAD_LEFT) . $chave;
        $payload .= "52040000";
        $payload .= "5303986";
        $payload .= "54" . str_pad(strlen($valor), 2, '0', STR_PAD_LEFT) . $valor;
        $payload .= "5802BR";
        $payload .= "59" . str_pad(strlen($nome), 2, '0', STR_PAD_LEFT) . $nome;
        $payload .= "60" . str_pad(strlen($cidade), 2, '0', STR_PAD_LEFT) . $cidade;
        $payload .= "62070503***";
        $payload .= "6304";

        return $payload . $this->crc16($payload);
    }

    private function crc16($payload)
    {
        $polinomio = 0x1021;
        $resultado = 0xFFFF;
        for ($offset = 0; $offset < strlen($payload); $offset++) {
            $resultado ^= (ord($payload[$offset]) << 8);
            for ($bitwise = 0; $bitwise < 8; $bitwise++) {
                if (($resultado <<= 1) & 0x10000) {
                    $resultado ^= $polinomio;
                }
                $resultado &= 0xFFFF;
            }
        }
        return strtoupper(str_pad(dechex($resultado), 4, '0', STR_PAD_LEFT));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $products = Clothes::where('description', 'LIKE', "%{$query}%")->get();
        return response()->json($products);
    }

    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Customer;
use App\Models\Clothing;
use App\Models\Sale;
use App\Models\SaleItem;

class Pos extends Component
{
    public $id_user;
    public $id_customer;
    public $search;
    public $cart = [];
    public $total = 0;

    public function mount()
    {
        $this->id_user = auth()->id(); //Id do user Autenticado tipo (Joao)
    }

    public function addProduct()
    {
        if (!$this->search) return;

        $id = explode(' - ', $this->search)[0] ?? null; //divide o search e a stringm, se a string for 0 ele vira null
        $product = Clothing::find($id);

        if ($product) {
            // Verifica se já existe no pdv e retorna ele no cart na vdd ele cria o cart e faz um foreach dos item
            //Se o cart não estiver aparecendo nada ou não dando certo, provavlmente o erro é aqui pq não está achando na DB essas rows
            foreach ($this->cart as &$item) {
                if ($item['id'] == $product->id) {
                    $item['qty']++;
                    $item['subtotal'] = $item['qty'] * $item['price'];
                    $this->calculateTotal();
                    $this->search = '';
                    return;
                }
            }

            // dentro do cart adiciona as infos
            //Mesma coisa do de cima aqui, se der erro, problema no nome
            $this->cart[] = [
                'id' => $product->id,
                'description' => $product->description,
                'price' => $product->price,
                'qty' => 1,
                'subtotal' => $product->price,
            ];
            $this->calculateTotal(); //chama afunção pra calcular tudinho ai
        }

        $this->search = ''; //Eu não sei se vai ter search, ou se é um label para produtos fixos, tipo ele clica e aparece os produtos
                            //Se for assim, muda aqui
    }

    public function removeProduct($id)
    {
        $this->cart = array_filter($this->cart, fn($item) => $item['id'] != $id); //Remove o produto por Id e tira o CalculateTotal
        $this->calculateTotal(); //Se ao deletar o produto e continuar o preço, provavel erro aqui!
    }

    public function calculateTotal() 
    {
        $this->total = collect($this->cart)->sum('subtotal'); //aqui ele pega o cart que definimos em cima e faz um sum no 'subtotal'
    }

    public function saveSale()
    {
        if (!$this->id_user || !$this->id_customer || empty($this->cart)) {
            session()->flash('error', 'Preencha vendedor, cliente e adicione produtos.');
            return;  //se nao estiver nenhum ele retorna o flash
        }
            //cria a nossa sale
        $sale = Sale::create([
            'user_id' => $this->id_user,
            'customer_id' => $this->id_customer,
            'total' => $this->total,
        ]); //Aqui ele cria a Sale com cada Customer_ID, e faz o total, repito, se não tiver dando certo, provavelmente nao tem o customer_id
          

        foreach ($this->cart as $item) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'clothing_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal'],
            ]);  // Cria um registro em SaleItem para cada produto do carrinho
                  // armazenando a quantidade, o preço unitário e o subtotal (price * qty)
        }  
//Apos o sale Create e o cart ficarem vazios ele da um flash e retorna esse success
        $this->cart = [];
        $this->total = 0;
        session()->flash('success', 'Venda registrada com sucesso!');
    }
       //faz o Render do sale.blade.php (que ta utilizando o pos.blade.php como extends, olhe la no Livewire/pos.blade.php)
    public function render()
    {
        return view('livewire.pos', [
            'Users' => User::all(),
            'Customers' => Customer::all(),
            'Clothes' => Clothing::all(),
        ]);
    }
}

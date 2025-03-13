<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products\Clothes;
use App\Models\Products\Size;
use App\Models\Products\Style;

class ClothesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Busca os tamanhos e estilos já existentes no banco
        $sizes = Size::all();
        $styles = Style::all();

        // Verifica se existem tamanhos e estilos antes de criar roupas
        if ($sizes->isEmpty() || $styles->isEmpty()) {
            throw new \Exception('Certifique-se de rodar os seeders de Size e Style antes de ClothesSeeder.
                                    php artisan db:seed --class=SizeSeeder
                                    php artisan db:seed --class=StyleSeeder
                                    php artisan db:seed --class=ClothesSeeder');
        }

        // Cria roupas associadas a tamanhos e estilos aleatórios
        Clothes::factory()
            ->count(10)
            ->make() // Usa make() para não salvar ainda, pois precisamos associar manualmente
            ->each(function ($clothes) use ($sizes, $styles) {
                $clothes->id_size = $sizes->random()->id;
                $clothes->id_style = $styles->random()->id;
                $clothes->save();
            });
    }
}

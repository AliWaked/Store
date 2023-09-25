<?php

namespace Database\Seeders;

use App\Enums\Colors;
use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Colors::cases() as $color) {
            $data[] = [
                'color_name' => $color->value
            ];
        }
        Color::insert($data);
    }
}

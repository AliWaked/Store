<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface CartRepository
{
    public function get(): Collection;
    public function add($id, $options, $quantity): void;
    public function update($id, $options, $quantity): void;
    public function delete($id,$options): void;
    public function empty(): void;
    public function total(): float;
}

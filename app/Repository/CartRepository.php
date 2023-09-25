<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface CartRepository
{
    public function get(): Collection;
    public function addOrUpdate(int $id, int $color_id, int $quantity): void;
    public function delete(int $id, int $color_id, string $size): void;
    public function empty(): void;
    public function total(): float;
}

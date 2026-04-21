<?php

namespace App\Observers;

use App\Models\Combinacion;
use App\Models\Products;

class CombinacionObserver
{
    private function updateProductStock($productId)
    {
        if (!$productId) return;

        // 1. Sumamos el stock de todas las combinaciones de este producto
        $totalStock = Combinacion::where('product_id', $productId)->sum('stock');

        // 2. Actualizamos la tabla products
        Products::where('id', $productId)->update([
            'stock' => $totalStock
        ]);
    }

    public function created(Combinacion $combinacion)
    {
        $this->updateProductStock($combinacion->product_id);
    }

    public function updated(Combinacion $combinacion)
    {
        // Si cambió el stock o el product_id, actualizamos
        $this->updateProductStock($combinacion->product_id);

        // Si se cambió de producto padre, actualizamos también el stock del anterior
        if ($combinacion->wasChanged('product_id')) {
            $this->updateProductStock($combinacion->getOriginal('product_id'));
        }
    }

    public function deleted(Combinacion $combinacion)
    {
        $this->updateProductStock($combinacion->product_id);
    }

    public function restored(Combinacion $combinacion)
    {
        $this->updateProductStock($combinacion->product_id);
    }
}

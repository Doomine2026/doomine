<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    use HasFactory;
    protected $fillable = [
        'producto_id',
        'cantidad',
        'orden_id',
        'precio',
        'combinacion_id'
    ];

    public function ordenes()
    {
        return $this->belongsTo(Ordenes::class, 'orden_id');
    }

    public function producto()
    {
        return $this->belongsTo(Products::class, 'producto_id');
    }

    public function imagenProducto()
    {
        return $this->hasOne(ImagenProducto::class, 'product_id', 'producto_id')->where('caratula', 1);
    }

    public function combinacion()
    {
        return $this->belongsTo(Combinacion::class, 'combinacion_id');
    }

    public function color()
    {
        // Esto es una relación "Has One Through" o manual a través de la combinación
        return $this->hasOneThrough(
            AttributesValues::class,
            Combinacion::class,
            'id',        // FK en combinaciones (combinaciones.id)
            'id',        // FK en attributes_values (attributes_values.id)
            'combinacion_id', // Local key en detalle_ordens
            'color_id'   // Local key en combinaciones
        );
    }

    // Acceso directo a la talla a través de la combinación
    public function talla()
    {
        return $this->hasOneThrough(
            AttributesValues::class,
            Combinacion::class,
            'id',
            'id',
            'combinacion_id',
            'talla_id'
        );
    }
}

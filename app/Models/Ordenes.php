<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordenes extends Model
{
    use HasFactory;
    protected $fillable = [

        'codigo_orden',
        'monto',
        'precio_envio',
        'status_id',
        'usuario_id',
        'address_id',
        'payment_date',
        'transaction_id',
    ];

    public function DetalleOrden()
    {
        return $this->hasMany(DetalleOrden::class, 'orden_id');
    }
    public function statusOrdenes()
    {
        return $this->belongsTo(StatusOrden::class, 'status_id');
    }

    public function usuarioPedido()
    {
        return $this->belongsTo(UserDetails::class, 'usuario_id');
    }
}

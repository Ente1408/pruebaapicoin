<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla
     */
    protected $table = 'cryptos';

    /**
     * Atributos que se pueden asignar en masa
     */
    protected $fillable = [
        'symbol',
        'name',
        'price',
        'percent_change_24h',
        'volume_24h',
    ];

    /**
     * Cast de atributos a tipos nativos de PHP
     */
    protected $casts = [
        'price' => 'decimal:8',
        'percent_change_24h' => 'decimal:4',
        'volume_24h' => 'decimal:4',
    ];
}

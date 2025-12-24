<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class ShipmentUpdate extends Model
{
    use HasUlids;

    protected $table = 'shipment_updates';

    protected $fillable = [
        'title',
        'text',
    ];

    public function shipment() {
        return $this->belongsTo(Shipment::class, 'shipment_id', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasUlids;

    protected $table = 'shipment';

    protected $fillable = [
        'sender_name',
        'sender_city',
        'sender_country',

        'receiver_name',
        'receiver_city',
        'receiver_country',
        'delivered',
    ];

    public function statuses() {
        return $this->hasMany(ShipmentUpdate::class, 'shipment_id', 'id');
    }
}

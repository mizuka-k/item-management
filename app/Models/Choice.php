<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'location_id',
        'item_id',
    ];

    public function location() {
        return $this->hasMany(Location::class);
    }
    public function item() {
        return $this->hasMany(Item::class);
    }
}

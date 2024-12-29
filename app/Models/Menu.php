<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'detail',
        'image',
        'item_id',
    ];

    public function item() {
        return $this->belongsTo(Item::class);
    }
}

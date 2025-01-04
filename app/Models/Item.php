<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function menu() {
        return $this->hasMany(Menu::class);
    }

     // s3 署名付きURLを取得するメソッド
    public function getFileUrl($filePath)
    {
        if ($filePath) {
            return Storage::disk('s3')->temporaryUrl(
                $filePath, now()->addMinutes(15)
            );
        }
        return null;
    }
    // public function choice() {
    //     return $this->hasMany(Choice::class);
    // }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'image',
        'detail',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];
}

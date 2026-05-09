<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;
    protected $fillable = ['text','done','user_id','deadline'];



    protected function casts(): array
    {
        return [
            'done' => 'boolean',
        ];
    }
    protected function user(){
        return $this->belongsTo(User::class);
    }
}

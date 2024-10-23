<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class chat extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'chat';
    protected $fillable = [
            'usuario_id1',
            'usuario_id2',
            'chat_id',
            'contenido',
            'visto'
    ];

    public function chat(){
        return $this->belongsTo(chat::class);
    }
}

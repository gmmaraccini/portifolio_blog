<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Campos liberados para edição
    protected $fillable = ['user_id', 'title', 'slug', 'body', 'is_published'];

    // Relacionamento: Um post tem muitos comentários
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relacionamento: Um post pertence a um usuário (autor)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

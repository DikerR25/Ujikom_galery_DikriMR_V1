<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    protected $table = 'posts';
    protected $fillable = ['user_id','image', 'title', 'caption', 'category'];
}

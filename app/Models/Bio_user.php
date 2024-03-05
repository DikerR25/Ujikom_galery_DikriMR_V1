<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bio_user extends Model
{
    protected $table = 'bio_users';
    protected $fillable = ['user_id','description'];
}

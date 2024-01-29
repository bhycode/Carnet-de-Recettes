<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    protected $table = 'Recette';
    protected $fillable = ['title', 'content', 'image_path'];
    public $timestamps = false;
}

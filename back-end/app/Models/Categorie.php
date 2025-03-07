<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    /** @use HasFactory<\Database\Factories\CategorieFactory> */
    use HasFactory;

    protected $fillable=[
        'name',
    ];
    protected $with=['article'];
    public function article(){
        return $this->hasMany(Article::class);
    }
}

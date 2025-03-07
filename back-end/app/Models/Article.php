<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    protected  $fillable=[
        'title',
        'content',
        'user_id',
        'category_id',
    ];

    // pour achaque requete qui retourner la lsite de article
    // charger aussi la liste de user associer de  les articles 
    protected $with=['category','user','comment'];


    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }
}

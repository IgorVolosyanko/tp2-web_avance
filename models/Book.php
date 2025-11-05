<?php
namespace App\Models;
use App\Models\CRUD;

class Book extends CRUD{
    protected $table = 'livre';
    protected $primaryKey = 'id';
    protected $fillable = ['titre', 'description', 'pages', 'image', 'auteur_id', 'categorie_id', 'editeur_id'];

}
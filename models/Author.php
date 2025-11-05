<?php
namespace App\Models;
use App\Models\CRUD;

class Author extends CRUD{
    protected $table = 'auteur';
    protected $primaryKey = 'id';
    protected $fillable = ['nom'];
}
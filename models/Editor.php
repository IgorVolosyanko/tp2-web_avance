<?php
namespace App\Models;
use App\Models\CRUD;

class Editor extends CRUD{
    protected $table = 'editeur';
    protected $primaryKey = 'id';
    protected $fillable = ['nom'];
}
<?php
namespace App\Models;
use App\Models\CRUD;

class RentHasBook extends CRUD{
    protected $table = 'pret_has_livre';
    protected $primaryKey = 'livre_id';
    protected $primaryKeyBook = 'pret_id';
    protected $fillable = ['pret_id', 'livre_id'];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    public $timestamps = true;

    use SoftDeletes, HasFactory;

    protected $dates = ['deleted_at'];
    protected $fillable = array('nombre',
                                'creadopor',
                                'actualizadopor');
    
}

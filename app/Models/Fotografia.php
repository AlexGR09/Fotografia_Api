<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fotografia extends Model
{
    protected $table = 'fotografias';
    public $timestamps = true;
    
    use SoftDeletes, HasFactory;

    protected $dates = ['deleted_at'];
    protected $fillable = array('fotografo_id',
                                'imagen',
                                'fecha',
                                'descripcion',
                                'categoria_id',
                                'tecnica',
                                'camara',
                                'objetivo',
                                'iso',
                                'balance',
                                'velocidad',
                                'diafragma',
                                'creadopor',
                                'actualizadopor');

    public function fotografo()
    {
        return $this->belongsTo('App\Models\Fotografo');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }

    public function creadopor()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function actualizadopor()
    {
        return $this->belongsTo('App\Models\User');
    }
}

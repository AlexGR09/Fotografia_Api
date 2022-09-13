<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fotografo extends Model
{
    protected $table = 'fotografos';
    public $timestamps = true;

    use SoftDeletes, HasFactory;

    protected $dates = ['deleted_at'];
    protected $fillable = array('experiencia',
                                'marca',
                                'logo',
                                'user_id',
                                'creadopor',
                                'actualizadopor');

    public function user()
    {
        return $this->belongsTo('App\Models\user');
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

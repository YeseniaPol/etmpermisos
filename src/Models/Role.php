<?php

namespace etm\etm_permisos\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

   //es: desde aqui empiza el codigo
   //en:from here

    protected $fillable = [
        'name',
        'slug',
        'description',
        'full-access',
    ];

   //es: desde aqui empiza el codigo
   //en:from here

    //funcion de muchos a muchos

    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimesTamps();
    }

    public function permissions()
    {
        return $this->belongsToMany('etm\etm_permisos\Models\Permission')->withTimesTamps();
    }
}





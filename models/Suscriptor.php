<?php
namespace models;

use Illuminate\Database\Eloquent\Model;

class Suscriptor extends Model
{
    protected $table = 'suscriptores';
    protected $fillable = ['nombre','rut','direccion','email','bloqueado','comuna_id','nacionalidad_id'];

    public function comuna()
    {
        return $this->belongsTo(Comuna::class);
    }

    public function nacionalidad()
    {
        return $this->belongsTo(Nacionalidad::class);
    }
}

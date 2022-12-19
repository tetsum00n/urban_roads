<?php
namespace models;

use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    protected $table = 'nacionalidades';
    protected $fillable = ['nombre'];

    public function suscriptores()
    {
        return $this->hasMany(Suscriptor::class);
    }
}
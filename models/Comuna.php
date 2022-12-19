<?php
namespace models;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    protected $table = 'comunas';
    protected $fillable = ['nombre'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function suscriptores()
    {
        return $this->hasMany(Suscriptor::class);
    }
}

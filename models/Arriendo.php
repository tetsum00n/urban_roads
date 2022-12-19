<?php
namespace models;

use Illuminate\Database\Eloquent\Model;

class Arriendo extends Model
{
    protected $table = 'arriendos';
    protected $fillable = ['nombre','created_at'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

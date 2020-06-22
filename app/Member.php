<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'nama', 'alamat', 'telp'
    ];
    public function debt() {
        return $this->hasMany(Debt::class);
    }
}

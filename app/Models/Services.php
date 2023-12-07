<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $fillable = ['service_name', 'price'];
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}

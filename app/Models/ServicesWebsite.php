<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesWebsite extends Model
{
    use HasFactory;
    protected $fillable =[
        'services_name', 'price', 'desc', 'services_image'
    ];
}

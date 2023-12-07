<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'prod_name',
        'serial_num',
        'manufacturer',
        'price',
        'qty',
        'purchased_date',
        'note',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

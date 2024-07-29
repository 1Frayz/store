<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'external_code',
        'name',
        'description',
        'price',
        'discount',
    ];

    public function additionalField()
    {
        return $this->hasOne(AdditionalField::class, 'external_code', 'external_code');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'external_code', 'external_code');
    }
}

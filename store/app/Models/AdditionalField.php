<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalField extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_code',
        'name',
        'size',
        'color',
        'brand',
        'composition',
        'quantity_per_pack',
        'packaging_link',
        'seo_title',
        'seo_h1',
        'seo_description',
        'weight',
        'width',
        'height',
        'length',
        'packaging_weight',
        'packaging_width',
        'packaging_height',
        'packaging_length',
        'category',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'external_code', 'external_code');
    }
}

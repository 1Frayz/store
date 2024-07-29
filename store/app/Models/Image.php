<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'external_code',
        'link',
        'path',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'external_code', 'external_code');
    }
}

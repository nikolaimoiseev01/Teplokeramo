<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'brand_id',
        'collection_id',
        'price',
        'old_price',
        'packaged',
        'article',
        'type',
        'weight',
        'thickness',
        'color',
        'country_name',
        'country_code',
        'area_of_use',
        'slug',
        'source',
        'size',
        'other_attributes',
        'packaged_cnt'
    ];

    protected $casts = [
        'area_of_use' => 'array',
        'other_attributes' => 'array'
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }


}

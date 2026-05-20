<?php

namespace App\Models;

use Database\Factories\ItemImageFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['item_id', 'image_url', 'alt_text'])]
class ItemImage extends Model
{
    /** @use HasFactory<ItemImageFactory> */
    use HasFactory;

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}

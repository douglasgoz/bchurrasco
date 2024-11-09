<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category',
        'measure',
    ];

    protected $appears = [
        'stock'
    ];

    protected function stock(): Attribute
    {
        $stocks = $this->hasMany(Stock::class, 'product_id')->get(['quantity']);
        $total = 0;

        foreach ($stocks as $stock) {
            $total += $stock->quantity;
        }

        return Attribute::make(
            get: fn () => $total,
        );
    }
}

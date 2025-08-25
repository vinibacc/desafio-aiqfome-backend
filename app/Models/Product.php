<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     title="Product",
 *     description="Product model",
 *     required={"product_api_id", "title", "image", "price", "review"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="product_api_id", type="string", example="1"),
 *     @OA\Property(property="title", type="string", example="Smartphone XYZ"),
 *     @OA\Property(property="image", type="string", format="url", example="https://example.com/images/product.jpg"),
 *     @OA\Property(property="price", type="number", format="float", example=1299.99),
 *     @OA\Property(property="review", type="string", example="Excellent performance and battery life."),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-25T14:56:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-25T15:00:00Z")
 * )
 */
class Product extends Model
{
    protected $fillable = ['product_api_id', 'title', 'image', 'price', 'review'];

    public function clientes(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'client_product')->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @OA\Schema(
 *     schema="Client",
 *     type="object",
 *     title="Client",
 *     required={"id","name","email"},
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="email", type="string")
 * )
 */
class Client extends Model
{
    protected $fillable = ['name', 'email'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'client_product')->withTimestamps();
    }

}

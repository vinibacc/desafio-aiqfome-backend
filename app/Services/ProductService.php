<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ProductService
{

    public function getProduct($productId): ?array
    {
        $product = $this->fetchProduct($productId);
        if (!$product) {
            return null;
        }

        return [
            'id'    => $product['id'] ?? null,
            'title' => $product['title'] ?? null,
            'image' => $product['image'] ?? null,
            'price' => $product['price'] ?? null,
            'review'=> $product['rating']['rate'] ?? null,
        ];
    }

    protected function fetchProduct($productId): ?array
    {
        $response = Http::get("https://fakestoreapi.com/products/{$productId}");

        if ($response->failed()) {
            return null;
        }

        return $response->json();
    }


}

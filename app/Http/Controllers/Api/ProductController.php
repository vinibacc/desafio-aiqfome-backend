<?php

namespace App\Http\Controllers\Api;

use App\Services\ProductService;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @OA\Get(
     *     path="/api/clients/{client}/favorites",
     *     summary="Get client's favorite products",
     *     description="Returns a list of products favorited by the specified client.",
     *     tags={"Products"},
     *     security={{"bearer_token": {}}},
     *     @OA\Parameter(
     *         name="client",
     *         in="path",
     *         required=true,
     *         description="Client ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of client's favorite products",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Favorites retrieved successfully."),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Product")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Client not found"
     *     )
     * )
     */
    public function index(Client $client): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Favorites retrieved successfully.',
            'data' => $client->products(),
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/clients/{client}/favorites/{product_api_id}",
     *     summary="Add product to client's favorites",
     *     tags={"Products"},
     *     security={{"bearer_token": {}}},
     *     @OA\Parameter(
     *         name="client",
     *         in="path",
     *         required=true,
     *         description="Client ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="product_api_id",
     *         in="path",
     *         required=true,
     *         description="External product ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Product added to favorites",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found in external API"
     *     )
     * )
     */
    public function favoriteProduct(Client $client, int $product_api_id): JsonResponse
    {
        $product = Product::where('product_api_id', $product_api_id)->first();
        if (!$product) {
            $data = $this->productService->getProduct($product_api_id);

            if (!$data) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product not found in external API.'
                ], 404);
            }

            $product = Product::create([
                'product_api_id' => $data['id'],
                'title' => $data['title'],
                'image' => $data['image'],
                'price' => $data['price'],
                'review' => $data['review'],
            ]);
        }

        if (!$client->products()->where('product_id', $product->id)->exists()) {
            $client->products()->attach($product->id);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to favorites successfully.',
            'data' => [
                'client_id' => $client->id,
                'product' => $product
            ]
        ], 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/clients/{client}/favorites/{product_api_id}",
     *     summary="Remove product from client's favorites",
     *     tags={"Products"},
     *     security={{"bearer_token": {}}},
     *     @OA\Parameter(
     *         name="client",
     *         in="path",
     *         required=true,
     *         description="Client ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="product_api_id",
     *         in="path",
     *         required=true,
     *         description="External product ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product removed from favorites",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Product is not in client's favorites"
     *     )
     * )
     */
    public function unfavoriteProduct(Client $client, int $product_api_id): JsonResponse
    {
        $product = Product::where('product_api_id', $product_api_id)->first();

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found in local database.'
            ], 404);
        }

        if (!$client->products()->where('product_id', $product->id)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product is not in client\'s favorites.'
            ], 400);
        }

        $client->products()->detach($product->id);

        return response()->json([
            'status' => 'success',
            'message' => 'Product removed from favorites successfully.',
            'data' => [
                'client_id' => $client->id,
                'product' => $product
            ]
        ]);
    }
}

<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Product_variant;

class ProductService
{
    /**
     * Get a list of products with eager-loaded relationships to prevent N+1 queries.
     */
    public function getProductsWithVariants($limit = null, $orderBy = 'desc')
    {
        $query = Product::with(['variant.photos', 'variant.colors'])->orderBy('id', $orderBy);
        
        if ($limit) {
            $query->take($limit);
        }

        return $query->get();
    }

    /**
     * Get product details along with its variants, photos, colors, and reviews.
     */
    public function getProductDetails($id, $requestedColorId = null)
    {
        // Eager load everything needed for the product details page
        $product = Product::with([
            'cate', 
            'variant.photos', 
            'variant.colors',
            'reviews.account'
        ])->findOrFail($id);

        // Calculate average rating
        $averageRating = $product->reviews->whereNotNull('rating')->avg('rating');

        // Extract all colors available for this product from its variants
        $colors = $product->variant->map->colors->unique('id')->filter();

        // Extract all photos from its variants
        $photos = $product->variant->flatMap->photos;

        // Determine the selected color
        $selectedColorId = $requestedColorId;
        if (!$selectedColorId && $product->variant->isNotEmpty()) {
            $selectedColorId = $product->variant->first()->colors_id;
        }

        return [
            'product' => $product,
            'reviews' => $product->reviews,
            'photos' => $photos,
            'colors' => $colors,
            'selectedColorId' => $selectedColorId,
            'averageRating' => $averageRating,
            'product_variant' => $product->variant,
        ];
    }
}

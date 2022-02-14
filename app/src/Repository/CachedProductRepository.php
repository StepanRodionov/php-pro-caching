<?php

declare(strict_types=1);

namespace App\Repository;

use App\Cache\Cache;
use App\Contract\ProductRepositoryInterface;
use App\Model\Product;

class CachedProductRepository implements ProductRepositoryInterface
{
    private ProductRepositoryInterface $productRepository;

    private const PRODUCTS_KEY = "products:popular";
    private const PRODUCTS_TTL = 100;

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function findProductById(int $id): ?Product
    {
        return $this->productRepository->findProductById($id);
    }

    public function updateProduct(Product $product): void
    {
        $this->productRepository->updateProduct($product);
        Cache::delete(self::PRODUCTS_KEY);
    }

    public function getPopularProducts(): array
    {
        $cachedProducts = Cache::get(self::PRODUCTS_KEY);
        if ($cachedProducts !== false) {
            return $cachedProducts;
        }

        $popularProducts = $this->productRepository->getPopularProducts();

        Cache::set(self::PRODUCTS_KEY, $popularProducts, self::PRODUCTS_TTL);

        return $popularProducts;

    }
}
<?php

declare(strict_types=1);

namespace App\Repository;

use App\Cache\Cache;
use App\Contract\ProductRepositoryInterface;
use App\Database\ProductDatabase;
use App\Model\Product;

class ProductRepository implements ProductRepositoryInterface
{
    private ProductDatabase $productDatabase;

    /**
     * @param ProductDatabase $productDatabase
     */
    public function __construct(ProductDatabase $productDatabase)
    {
        $this->productDatabase = $productDatabase;
    }

    /**
     * @inheritDoc
     */
    public function findProductById(int $id): ?Product
    {
        $product = $this->productDatabase->findById($id);
        return ($product instanceof Product) ? $product : null;
    }

    /**
     * @inheritDoc
     */
    public function updateProduct(Product $product): void
    {
        $this->productDatabase->update($product);
    }

    /**
     * @inheritDoc
     */
    public function getPopularProducts(): array
    {
        $popularProducts = $this->productDatabase->executeQuery("SELECT * ...");
        return $popularProducts;
    }
}
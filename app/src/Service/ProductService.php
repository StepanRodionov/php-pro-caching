<?php

declare(strict_types=1);

namespace App\Service;

use App\Contract\ProductRepositoryInterface;
use App\Contract\ProductServiceInterface;
use App\Contract\ReviewRepositoryInterface;
use App\Model\Product;

class ProductService implements ProductServiceInterface
{
    /** @var ProductRepositoryInterface */
    private ProductRepositoryInterface $productRepository;

    /** @var ReviewRepositoryInterface */
    private ReviewRepositoryInterface $reviewRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param ReviewRepositoryInterface $reviewRepository
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        ReviewRepositoryInterface  $reviewRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * @inheritDoc
     */
    public function findProductById(int $id): ?Product
    {
        return $this->productRepository->findProductById($id);
    }

    /**
     * @inheritDoc
     */
    public function sellProduct(Product $product): void
    {
        $currentStock = $product->getStock();
        if ($currentStock === 0) {
            // todo Обработка ошибки
        }
        $product->setStock($currentStock - 1);
        $this->productRepository->updateProduct($product);
    }

    /**
     * @inheritDoc
     */
    public function getPopularProducts(): array
    {
        return $this->productRepository->getPopularProducts();
    }

    /**
     * @inheritDoc
     */
    public function getProductReviews(Product $product): array
    {
        return $this->reviewRepository->findReviewsByProduct($product);
    }
}
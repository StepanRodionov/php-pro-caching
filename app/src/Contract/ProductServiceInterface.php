<?php

declare(strict_types=1);

namespace App\Contract;

use App\Model\Product;
use App\Model\Review;

interface ProductServiceInterface
{
    /**
     * Ищет товар по его идентификатору.
     *
     * @param int $id
     * @return Product|null
     */
    public function findProductById(int $id): ?Product;

    /**
     * Выполняет продажу товара.
     *
     * @param Product $product
     * @return mixed
     */
    public function sellProduct(Product $product): void;

    /**
     * Возвращает список популярных товаров.
     *
     * @return Product[]
     */
    public function getPopularProducts(): array;

    /**
     * Возвращает список отзывов для товара.
     *
     * @param Product $product
     * @return Review[]
     */
    public function getProductReviews(Product $product): array;
}
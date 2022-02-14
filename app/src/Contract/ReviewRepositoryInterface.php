<?php

declare(strict_types=1);

namespace App\Contract;

use App\Model\Product;
use App\Model\Review;

interface ReviewRepositoryInterface
{
    /**
     * Возвращает список отзывов для товара.
     *
     * @param Product $product
     * @return Review[]
     */
    public function findReviewsByProduct(Product $product): array;
}
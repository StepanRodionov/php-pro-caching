<?php

declare(strict_types=1);

namespace App\Repository;

use App\Api\ReviewApi;
use App\Cache\Cache;
use App\Contract\ReviewRepositoryInterface;
use App\Model\Product;
use App\Model\Review;

class ReviewRepository implements ReviewRepositoryInterface
{
    private ReviewApi $reviewApi;

    /**
     * @param ReviewApi $reviewApi
     */
    public function __construct(ReviewApi $reviewApi)
    {
        $this->reviewApi = $reviewApi;
    }

    /**
     * @inheritDoc
     */
    public function findReviewsByProduct(Product $product): array
    {
        $api = $this->reviewApi;
        $reviews = $api->getReviewsBySku(
            $product->getSku()
        );
        $list = [];
        foreach ($reviews as $review) {
            $list[] = new Review($product, $review);
        }
        return $list;
    }
}
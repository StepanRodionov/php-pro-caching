<?php

use App\Api\ReviewApi;
use App\Database\ProductDatabase;
use App\Repository\ProductRepository;
use App\Repository\ReviewRepository;
use App\Service\ProductService;

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Имитация IoC-фреймворка (не использовать в реальных проектах!)

new \App\Cache\Cache();

$productDatabase = new ProductDatabase();
$reviewApi = new ReviewApi();
$productRepository = new ProductRepository($productDatabase);
$reviewRepository = new ReviewRepository($reviewApi);
$productService = new ProductService($productRepository, $reviewRepository);

// Имитация http-контроллера (не использовать в реальных проектах!)

$data = null;
switch ($_REQUEST['action']) {
    case 'list':
    {
        $list = $productService->getPopularProducts();
        $data = [
            'list' => array_map(
                static fn($item) => [
                    'id' => $item->getId(),
                    'title' => $item->getTitle(),
                ],
                $list
            ),
        ];
        break;
    }
    case 'show':
    {
        $product = $productService->findProductById($_REQUEST['id']);
        $reviews = ($product !== null) ? $productService->getProductReviews($product) : [];
        $data = [
            'product' => [
                'id' => $product->getId(),
                'title' => $product->getTitle(),
                'price' => $product->getPrice(),
            ],
            'reviews' => array_map(
                static fn ($review) => $review->getText(),
                $reviews
            ),
        ];
        break;
    }
    case 'sell':
    {
        $product = $productService->findProductById($_REQUEST['id']);
        if ($product !== null) {
            $productService->sellProduct($product);
        }
        $data = [
            'success' => ($product !== null),
        ];
        break;
    }
    case 'flush':
    {
        $memcached = new \Memcached();
        $memcached->addServer("memcached", 11211);
        $memcached->flush();
        $data = [
            'success' => true,
        ];
        break;
    }
}

echo json_encode($data);
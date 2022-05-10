<?php

namespace App\Service;

class ProductHandler
{

    /**
     *  商品總金額
     * @param array $products
     * @return int
     */
    public function getTotalPrice(array $products): int
    {
        $totalPrice = 0;
        foreach ($products as $product) {
            $price = $product['price'] ?: 0;
            $totalPrice += $price;
        }

        return $totalPrice;
    }

    public function searchAndSortByPrice(array $products, string $type): array
    {
        $result = [];
        foreach ($products as $product) {
            if (isset($product['type']) && $product['type'] === $type) {
                $result[] = $product;
            }
        }
        $priceArr = array_column($result, 'price');
        array_multisort($priceArr, SORT_DESC, $result);
        return $result;
    }


    /**
     * 創建日期轉換為 unix timestamp
     * @param array $products
     * @return array
     */
    public function createTransformUnix(array $products): array
    {
        foreach ($products as &$product) {
            if (is_string($product['create_at'])) {
                $product['create_at'] = strtotime($product['create_at']);
            }
        }
        return $products;
    }
}
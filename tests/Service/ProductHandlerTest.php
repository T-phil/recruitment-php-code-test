<?php

namespace Test\Service;

use PHPUnit\Framework\TestCase;
use App\Service\ProductHandler;

/**
 * Class ProductHandlerTest
 */
class ProductHandlerTest extends TestCase
{
    private $products = [
        [
            'id' => 1,
            'name' => 'Coca-cola',
            'type' => 'Drinks',
            'price' => 10,
            'create_at' => '2021-04-20 10:00:00',
        ],
        [
            'id' => 2,
            'name' => 'Persi',
            'type' => 'Drinks',
            'price' => 5,
            'create_at' => '2021-04-21 09:00:00',
        ],
        [
            'id' => 3,
            'name' => 'Ham Sandwich',
            'type' => 'Sandwich',
            'price' => 45,
            'create_at' => '2021-04-20 19:00:00',
        ],
        [
            'id' => 4,
            'name' => 'Cup cake',
            'type' => 'Dessert',
            'price' => 35,
            'create_at' => '2021-04-18 08:45:00',
        ],
        [
            'id' => 5,
            'name' => 'New York Cheese Cake',
            'type' => 'Dessert',
            'price' => 40,
            'create_at' => '2021-04-19 14:38:00',
        ],
        [
            'id' => 6,
            'name' => 'Lemon Tea',
            'type' => 'Drinks',
            'price' => 8,
            'create_at' => '2021-04-04 19:23:00',
        ],
    ];

    /**
     * ./vendor/bin/phpunit  tests/Service/ProductHandlerTest.php --filter=testGetTotalPrice
     *  商品總金額
     */
    public function testGetTotalPrice()
    {
        $product = new ProductHandler();
        $totalPrice = $product->getTotalPrice($this->products);

        $this->assertEquals(143, $totalPrice);
    }

    /**
     * ./vendor/bin/phpunit  tests/Service/ProductHandlerTest.php --filter=testSearchAndSortByPrice
     * 搜索以及金額倒序
     */
    public function testSearchAndSortByPrice()
    {
        $product = new ProductHandler();
        $type = 'Dessert';
        $products = $product->searchAndSortByPrice($this->products, $type);

        $this->assertEquals($type, $products[0]['type']);

        $this->assertTrue($products[0]['price'] > $products[1]['price']);
    }

    /**
     * ./vendor/bin/phpunit  tests/Service/ProductHandlerTest.php --filter=testCreateTransformUnix
     *  創建日期轉換為 unix timestamp
     */
    public function testCreateTransformUnix()
    {
        $product = new ProductHandler();
        $products = $product->createTransformUnix($this->products);

        $this->assertEquals(strtotime($this->products[0]['create_at']), $products[0]['create_at']);
    }
}
<?php

/**
 * @group controller
 */

class Product_test extends TestCase
{
    public function test_WhenAccessProductThenSeeAllProduct()
    {
        $result_array = [
            [
                "id" => "1",
                "name" => "Pensil",
                "price" => 200,
                "image" => "default.jpg",
                "description" => "Untuk menulis"
            ],
            [
                "id" => "2",
                "name" => "Pulpen",
                "price" => 1000,
                "image" => "default.jpg",
                "description" => "Untuk menggambar"
            ],
        ];

        $this->request->setCallable(
            function($CI) use ($result_array) {
                $product_model = $this->getDouble(
                    'Product_model', ['getAll' => $result_array]
                );
                $CI->product_model = $product_model;
            }
        );

        $output = $this->request('GET', '/product');
        $this->assertContains('Pensil', $output);
        $this->assertContains('<h3>Pulpen</h3>', $output);
    }

    public function test_WhenAccessNotExistingProductThenYouGet404()
    {
        $product_id = 10;
        $this->request->setCallable(
            function ($CI) {
                $product_model = $this->getDouble(
                    'Product_model', ['getAll' => null]
                );
                $CI->product_model = $product_model;
            }
        );

        $output = $this->request('GET', "/product/$product_id");
        $this->assertResponseCode(404);
    }

    public function test_WhenSuccessAddProductThenRedirectedToProductIndex()
    {
        $this->request->setCallable(
            function ($CI) {
                $product_model = $this->getDouble(
                    'Product_model', ['save' => true]
                );
                $CI->product_model = $product_model;
            }
        );

        $output = $this->request(
            'POST',
            '/product/store',
            [
                'name' => 'Botol',
                'price' => 2000,
                'image' => 'default.jpg',
                'description' => 'botol minum'
            ]
        );

        $this->assertRedirect('/product', 302);
    }

    public function test_WhenFailedAddProductThenRedirectedToProductCreate()
    {
        $this->request->setCallable(
            function ($CI) {
                $product_model = $this->getDouble(
                    'Product_model', ['save' => true]
                );
                $CI->product_model = $product_model;
            }
        );

        $output = $this->request(
            'POST',
            '/product/store',
            [
                'name' => 'Botol',
                'image' => 'default.jpg',
                'description' => 'botol minum'
            ]
        );

        $this->assertRedirect('/product/create', 302);
    }

    public function test_WhenSuccessUpdateProductThenRedirectedToProductIndex()
    {
        $this->request->setCallable(
            function ($CI) {
                $product_model = $this->getDouble(
                    'Product_model', ['update' => true]
                );
                $CI->product_model = $product_model;
            }
        );

        $output = $this->request(
            'POST',
            '/product/update',
            [
                'id' => 1,
                'name' => 'Botol',
                'price' => 3000,
                'image' => 'default.jpg',
                'description' => 'Botol air'
            ]
        );

        $this->assertRedirect('/product', 302);
    }

    public function test_WhenFailedUpdateProductThenRedirectedToProductUpdate()
    {
        $this->request->setCallable(
            function ($CI) {
                $product_model = $this->getDouble(
                    'Product_model', ['update' => true]
                );
                $CI->product_model = $product_model;
            }
        );

        $product_id = 1;
        $output = $this->request(
            'POST',
            '/product/update',
            [
                'id' => $product_id,
                'name' => 'Botol',
                'image' => 'default.jpg',
                'description' => 'Botol air'
            ]
        );

        $this->assertRedirect("/product/edit/$product_id", 302);
    }

    public function test_WhenSuccessDeleteProductThenRedirectedToProductIndex()
    {
        $product_id = 100;

        $this->request->setCallable(
            function ($CI) {
                $product_model = $this->getDouble(
                    'Product_model', ['delete' => true]
                );
                $CI->product_model = $product_model;
            }
        );

        $this->request(
            'GET',
            "/product/delete/$product_id"
        );

        $this->assertRedirect('/product', 302);
    }

    public function test_WhenFailedDeleteProductThenShow404()
    {
        $product_id = 100;

        $this->request->setCallable(
            function ($CI) {
                $product_model = $this->getDouble(
                    'Product_model', ['delete' => false]
                );
                $CI->product_model = $product_model;
            }
        );

        $this->request(
            'GET',
            "/product/delete/$product_id"
        );

        $this->assertResponseCode(404);
    }
}
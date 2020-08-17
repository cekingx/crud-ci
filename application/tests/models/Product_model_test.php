<?php

/**
 * @group model
 */

class Product_model_test extends TestCase
{
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $CI =& get_instance();
        $CI->load->library('Seeder');
        $CI->seeder->call('ProductSeeder');
    }

    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('product_model');
        $this->obj = $this->CI->product_model;
    }
    
    public function test_WhenYouGetAllProductThenYouGetOneProduct()
    {
        $result = $this->obj->getAll();
        $this->assertCount(1, $result);
    }

    public function test_WhenYouSetProductThenYouGetTwoProducts()
    {
        $_POST = [
            'name' => 'Product 2',
            'price' => 2000,
            'description' => 'Product 2 is amazing'
        ];

        $result = $this->obj->save();
        $this->assertTrue($result);
        $this->assertCount(2, $this->obj->getAll());
    }

    public function test_WhenYouGetProductByIdThenYouGetProduct()
    {
        $result = $this->obj->getById(2);
        $this->assertEquals('Product 2', $result['name']);
    }

    public function test_WhenYouUpdateAProductThenTheProductChanged()
    {
        $product = $this->obj->getById(2);
        $product['name'] = 'Product 3';

        $_POST = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'image' => $product['image'],
            'description' => $product['description']
        ];

        $status = $this->obj->update();
        $result = $this->obj->getById(2);
        $this->assertTrue($status);
        $this->assertEquals('Product 3', $result['name']);
    }

    public function test_WhenYouDeleteAProductThenYouGetOtherProduct()
    {
        $result = $this->obj->delete(2);
        $this->assertTrue($result);
    }
}
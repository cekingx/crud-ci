<?php

class ProductSeeder extends Seeder
{
    private $table = 'products';

    public function run()
    {
        $this->db->truncate($this->table);
        $data = [
            'name' => 'Product1',
            'price' => 1000,
            'image' => 'default.jpg',
            'description' => 'Product 1 description'
        ];

        return $this->db->insert($this->table, $data);
    }
}
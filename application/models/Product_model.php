<?php

class Product_model extends CI_Model
{
    private $table = 'products';

    public $id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    public function rules()
    {
        return [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            ],
            [
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'required'
            ],
            [
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required'
            ]
            ];
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->name = $post['name'];
        $this->price = $post['price'];
        $this->description = $post['description'];

        return $this->db->insert($this->table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id = $post['id'];
        $this->name = $post['name'];
        $this->price = $post['price'];
        $this->description = $post['description'];

        $this->db->where('id', $this->id);
        return $this->db->update($this->table, $this);
        
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id' => $id));
    }
}
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
        $this->image = $this->uploadImage();
        $this->description = $post['description'];

        return $this->db->insert($this->table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        $this->id = $id;
        $this->name = $post['name'];
        $this->price = $post['price'];
        $this->description = $post['description'];

        if(!empty($_FILES['image']['name'])) {
            $this->image = $this->uploadImage();
        } else {
            $this->image = $post['old_image'];
        }

        $this->db->where('id', $this->id);
        return $this->db->update($this->table, $this);
        
    }

    public function delete($id)
    {
        $this->deleteImage($id);
        return $this->db->delete($this->table, array('id' => $id));
    }
    
    private function uploadImage()
    {
        $file_name = url_title($this->name, 'dash', true) . "-" . date("Ymd-His");
        $config['upload_path'] = './upload/product/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $file_name;
        $config['overwrite'] = true;
        $config['max_size'] = 1024;

        $this->load->library('upload', $config);
        if($this->upload->do_upload('image')) {
            return $this->upload->data('file_name');
        }

        print_r($this->upload->display_errors());
        // return "default.jpg";
    }

    private function deleteImage($id)
    {
        $product = $this->getById($id);
        if($product['image'] != 'default.jpg') {
            $filename = explode('.', $product['image'])[0];
            return array_map('unlink', glob(FCPATH."upload/product/$filename.*"));
        }
    }
}
<?php
defined('BASEPATH') or exit("No direct script access allowed");

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('product_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }
        $data['title'] = 'Product Index';
        $data['products'] = $this->product_model->getAll();
        $this->load->view('product/index', $data);
    }

    public function show($id)
    {
        $data['product'] = $this->product_model->getById($id);
        if(empty($data['product'])) {
            show_404();
        }
        
        $data['title'] = "Detail " . $data['product']['name'];

        $this->load->view('product/show', $data);
    }

    public function create()
    {
        if(!empty($this->session->flashdata('error'))) {
            $data['error'] = $this->session->flashdata('error');
        }

        $data['title'] = 'Create Product';
        $this->load->view('product/create', $data);
    }

    public function store()
    {
        $product = $this->product_model;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->save();
            $this->session->set_flashdata('message', "Data berhasil dibuat");
            redirect('/product');
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect("/product/create");
        }

    }

    public function edit($id)
    {
        if(!empty($this->session->flashdata('error'))) {
            $data['error'] = $this->session->flashdata('error');
        }

        $data['product'] = $this->product_model->getById($id);
        $data['title'] = $data['product']['name'];

        $this->load->view('product/edit', $data);
    }

    public function update()
    {
        $post = $this->input->post();
        $product_id = $post['id'];
        $product = $this->product_model;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->update($product_id);
            $this->session->set_flashdata('message', "Data berhasil diubah");
            redirect('/product');
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect("/product/edit/$product_id");
        }
    }

    public function delete($id)
    {
        if($this->product_model->delete($id)) {
            $this->session->set_flashdata('message', "Data berhasil dihapus");
            redirect('/product');
        } else {
            show_404();
        }
    }
}
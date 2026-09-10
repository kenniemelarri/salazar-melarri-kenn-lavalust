<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function index()
    {
        $this->load_product_model();

        $products = $this->ProductModel->order_by('id', 'DESC');

        $this->call->view('products', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $this->form('create');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('products/create');
            return;
        }

        $data = $this->validated_product($_POST);

        if ($data === false) {
            $this->form(
                'create',
                $_POST,
                'Product name, price, and a non-negative quantity are required.'
            );
            return;
        }

        $this->load_product_model();

        $this->ProductModel->insert($data);

        redirect('products');
    }

    public function edit($id)
    {
        $this->load_product_model();

        $product = $this->ProductModel->find((int) $id);

        if (!$product) {
            show_404();
            return;
        }

        $this->form(
            'edit',
            $product,
            null,
            $product['id']
        );
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('products/edit/' . (int) $id);
            return;
        }

        $data = $this->validated_product($_POST);

        if ($data === false) {
            $this->form(
                'edit',
                array_merge($_POST, ['id' => $id]),
                'Product name, price, and a non-negative quantity are required.',
                $id
            );
            return;
        }

        $this->load_product_model();

        if (!$this->ProductModel->find((int) $id)) {
            show_404();
            return;
        }

        $this->ProductModel->update((int) $id, $data);

        redirect('products');
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load_product_model();

            $this->ProductModel->delete((int) $id);
        }

        redirect('products');
    }

    private function load_product_model()
    {
        $this->call->database();
        $this->call->model('ProductModel');
    }

    private function validated_product($input)
    {
        $name = trim($input['product_name'] ?? '');
        $description = trim($input['description'] ?? '');
        $price = $input['price'] ?? '';
        $quantity = $input['quantity'] ?? '';

        if (
            $name === '' ||
            !is_numeric($price) ||
            (float) $price < 0 ||
            filter_var($quantity, FILTER_VALIDATE_INT) === false ||
            (int) $quantity < 0
        ) {
            return false;
        }

        return [
            'product_name' => $name,
            'description' => $description,
            'price' => number_format((float) $price, 2, '.', ''),
            'quantity' => (int) $quantity,
        ];
    }

    private function form($mode, $product = [], $error = null, $id = null)
    {
        $this->call->view('product_form', [
            'mode' => $mode,
            'product' => $product,
            'error' => $error,
            'id' => $id,
        ]);
    }
}
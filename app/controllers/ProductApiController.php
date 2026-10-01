<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductApiController extends Controller
{
    private function setup()
    {
        $this->call->library('api');
        $this->call->database();
        $this->call->model('ProductModel');
    }

    private function authenticate()
    {
        return $this->api->require_jwt();
    }

    public function index()
    {
        $this->setup();
        $this->authenticate();

        $products = $this->ProductModel->order_by('id', 'DESC');

        $this->api->respond([
            'success' => true,
            'data' => $products
        ]);
    }

    public function store()
    {
        $this->setup();
        $this->authenticate();
        $this->api->require_method('POST');

        $data = $this->api->body();

        $product_name = trim($data['product_name'] ?? '');
        $description = trim($data['description'] ?? '');
        $price = $data['price'] ?? '';
        $quantity = $data['quantity'] ?? '';

        if (
            $product_name === '' ||
            !is_numeric($price) ||
            (float) $price < 0 ||
            filter_var($quantity, FILTER_VALIDATE_INT) === false ||
            (int) $quantity < 0
        ) {
            $this->api->respond_error(
                'Product name, valid price, and non-negative quantity are required.',
                422
            );
        }

        $product = [
            'product_name' => $product_name,
            'description' => $description,
            'price' => number_format((float) $price, 2, '.', ''),
            'quantity' => (int) $quantity
        ];

        $this->ProductModel->insert($product);

        $this->api->respond([
            'success' => true,
            'message' => 'Product created successfully.',
            'data' => $product
        ], 201);
    }

    public function update($id)
    {
        $this->setup();
        $this->authenticate();
        $this->api->require_method('PUT');

        $id = (int) $id;

        $existing = $this->ProductModel->find($id);

        if (!$existing) {
            $this->api->respond_error('Product not found.', 404);
        }

        $data = $this->api->body();

        $product_name = trim($data['product_name'] ?? '');
        $description = trim($data['description'] ?? '');
        $price = $data['price'] ?? '';
        $quantity = $data['quantity'] ?? '';

        if (
            $product_name === '' ||
            !is_numeric($price) ||
            (float) $price < 0 ||
            filter_var($quantity, FILTER_VALIDATE_INT) === false ||
            (int) $quantity < 0
        ) {
            $this->api->respond_error(
                'Product name, valid price, and non-negative quantity are required.',
                422
            );
        }

        $product = [
            'product_name' => $product_name,
            'description' => $description,
            'price' => number_format((float) $price, 2, '.', ''),
            'quantity' => (int) $quantity
        ];

        $this->ProductModel->update($id, $product);

        $this->api->respond([
            'success' => true,
            'message' => 'Product updated successfully.',
            'data' => $product
        ]);
    }

    public function delete($id)
    {
        $this->setup();
        $this->authenticate();
        $this->api->require_method('DELETE');

        $id = (int) $id;

        $existing = $this->ProductModel->find($id);

        if (!$existing) {
            $this->api->respond_error('Product not found.', 404);
        }

        $this->ProductModel->delete($id);

        $this->api->respond([
            'success' => true,
            'message' => 'Product deleted successfully.'
        ]);
    }
}

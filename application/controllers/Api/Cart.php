<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cart_model');
        $this->output->set_content_type('application/json');
    }

    public function add()
    {
        $input = $this->input->post();
        // echo '<pre>'; print_r($input); die;
        if (empty($input)) {
            $raw = json_decode($this->input->raw_input_stream, true);
            $input = is_array($raw) ? $raw : [];
        }

        $data = [
            'user_id'    => 1,
            'product_id' => $input['product_id'] ?? null,
            'quantity'   => $input['quantity'] ?? 1,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if (!$data['product_id']) {
            echo json_encode(['status' => false, 'message' => 'Product ID is required']);
            return;
        }

        $this->Cart_model->insert($data);
        echo json_encode(['status' => true, 'message' => 'Product added to cart']);
    }
    public function index()
    {
        $items = $this->Cart_model->get_all(1);
        echo json_encode(['status' => true, 'data' => $items]);
    }


    public function update()
    {
        $input = $this->input->post();
        if (empty($input)) {
            $raw = json_decode($this->input->raw_input_stream, true);
            $input = is_array($raw) ? $raw : [];
        }

        $cart_id = $input['id'] ?? null;
        $quantity = $input['quantity'] ?? null;

        if (!$cart_id || !$quantity) {
            echo json_encode(['status' => false, 'message' => 'Cart ID and Quantity are required']);
            return;
        }
        $updated = $this->Cart_model->update_item($cart_id, ['quantity' => $quantity, 'updated_at' => date('Y-m-d H:i:s')]);

        if ($updated) {
            echo json_encode(['status' => true, 'message' => 'Cart item updated successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to update cart item']);
        }
    }

    public function delete($cart_id = null)
{
    if (!$cart_id) {
        echo json_encode(['status' => false, 'message' => 'Cart ID is required']);
        return;
    }

    $deleted = $this->Cart_model->delete_item($cart_id);

    if ($deleted) {
        echo json_encode(['status' => true, 'message' => 'Cart item deleted successfully']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to delete cart item']);
    }
}


public function list()
{
    $user_id = 1;
    $items = $this->Cart_model->get_all_cart_items($user_id);

    $cart_total = 0;
    $cart_items = [];

    foreach ($items as $item) {
        $subtotal = $item['quantity'] * $item['price'];
        $cart_total += $subtotal;

        $cart_items[] = [
            'cart_id'    => $item['id'],
            'product_id' => $item['product_id'],
            'product_name' => $item['product_name'],
            'price'      => (float)$item['price'],
            'quantity'   => (int)$item['quantity'],
            'subtotal'   => $subtotal
        ];
    }

    echo json_encode([
        'status' => true,
        'data' => [
            'items' => $cart_items,
            'total' => $cart_total
        ]
    ]);
}


public function checkout()
{
    $user_id = 1;
    $items = $this->Cart_model->get_all_cart_items($user_id);

    if (!$items) {
        echo json_encode(['status' => false, 'message' => 'Cart is empty']);
        return;
    }

    $cart_total = 0;
    foreach ($items as $item) {
        $cart_total += $item['quantity'] * $item['price'];
    }

    $order_id = time();

    foreach ($items as $item) {
        $this->Cart_model->create_order([
            'user_id' => $user_id,
            'order_id'   => $order_id,
            'product_id' => $item['product_id'],
            'quantity'   => $item['quantity'],
            'price'      => $item['price'],
            'subtotal'   => $item['quantity'] * $item['price']
        ]);
    }

    $this->Cart_model->clear_cart($user_id);

    echo json_encode([
        'status' => true,
        'message' => 'Order created successfully',
        'order_id' => $order_id,
        'total_amount' => $cart_total
    ]);
}

 public function order()
    {
        $items = $this->Cart_model->get_all_orders();
        echo json_encode(['status' => true, 'data' => $items]);
    }


}

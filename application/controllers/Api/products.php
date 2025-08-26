<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model', 'product');
        $this->load->library('upload');
        header('Content-Type: application/json');
    }
   
    public function index()
    {
        $products = $this->product->get_all();
        foreach ($products as &$p) {
            $p->images = !empty($p->images) ? json_decode($p->images, true) : [];
        }
        echo json_encode(['status' => true, 'data' => $products]);
    }
    public function show($id)
    {
        $product = $this->product->get($id);
        if (!$product) {
            echo json_encode(['status' => false, 'message' => 'Product not found']);
            return;
        }
        $product->images = !empty($product->images) ? json_decode($product->images, true) : [];
        echo json_encode(['status' => true, 'data' => $product]);
    }


    public function create() {
    if ($this->input->method() == 'post') {

        $post = $this->input->post();

        $prod_id = $this->product->insert([
            'product_name' => $post['product_name'] ?? '',
            'price'        => $post['price'] ?? 0,
            'description'  => $post['description'] ?? '',
            'status'       => isset($post['status']) ? 1 : 0
        ]);

        $images = $this->_handle_multiple_upload();
        if (!empty($images)) {
            $this->product->update($prod_id, ['images' => json_encode($images)]);
        }
        $product = $this->product->get($prod_id);
        $product->images = !empty($product->images) ? json_decode($product->images, true) : [];
        
        echo json_encode([
            'status'  => true,
            'message' => 'Product created successfully',
            'data'    => $product
        ]);
        return;
    }
    $this->load->view('Backend/product_create');
}
    public function delete($id)
    {
        $product = $this->product->get($id);
        if (!$product) {
            echo json_encode(['status' => false, 'message' => 'Product not found']);
            return;
        }
        $this->product->delete($id);
        echo json_encode(['status' => true, 'message' => 'Product deleted']);
    }
    private function _handle_multiple_upload() {
    if (empty($_FILES['images']['name'][0])) return [];

    $files = $_FILES['images'];
    $count = count($files['name']);
    $upload_path = 'assets/uploads/products/';
    if (!is_dir($upload_path)) mkdir($upload_path, 0755, true);

    $uploaded_images = [];
    $config = [
        'upload_path'   => $upload_path,
        'allowed_types' => 'jpg|jpeg|png|gif',
        'max_size'      => 20480,
        'encrypt_name'  => true
    ];

    $this->load->library('upload');

    for ($i = 0; $i < $count; $i++) {
        if ($files['name'][$i] == '') continue;

        $_FILES['single_image']['name']     = $files['name'][$i];
        $_FILES['single_image']['type']     = $files['type'][$i];
        $_FILES['single_image']['tmp_name'] = $files['tmp_name'][$i];
        $_FILES['single_image']['error']    = $files['error'][$i];
        $_FILES['single_image']['size']     = $files['size'][$i];

        $this->upload->initialize($config);

        if ($this->upload->do_upload('single_image')) {
            $data = $this->upload->data();
            $uploaded_images[] = $upload_path . $data['file_name'];
        } 
    }

    return $uploaded_images;
}

public function update($id)
    {
        $product = $this->product->get($id);
        if (!$product) {
            echo json_encode(['status' => false, 'message' => 'Product not found']);
            return;
        }

        $post = $_POST;

        // Handle PUT JSON input
        if (empty($post)) {
            $raw_input = file_get_contents("php://input");
            $post = json_decode($raw_input, true);
        }

        // Handle uploaded images
        $new_images = [];
        if (!empty($_FILES['images']['name'][0])) {
            $new_images = $this->_handle_multiple_upload();
        }

        $old_images = !empty($product->images) ? json_decode($product->images, true) : [];
        $all_images = array_merge($old_images, $new_images);

        $update = [
            'product_name' => $post['product_name'] ?? $product->product_name,
            'price'        => $post['price'] ?? $product->price,
            'description'  => $post['description'] ?? $product->description,
            'status'       => isset($post['status']) ? (int)$post['status'] : $product->status,
            'images'       => !empty($all_images) ? json_encode($all_images) : $product->images
        ];

        $this->product->update($id, $update);

        $updated = $this->product->get($id);
        $updated->images = !empty($updated->images) ? json_decode($updated->images, true) : [];

        echo json_encode([
            'status'  => true,
            'message' => 'Product updated',
            'data'    => $updated
        ]);
    }

    


}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function catalogue($page = 1)
	{
		$limit = 8;
		$start = ($page - 1) * $limit;
		$products = $this->Product->get_all_products($start, $limit);
		$total_products = $this->Product->count_all_products();
		$data = array(
			'products' => $products,
			'total_products' => $total_products,
			'total_pages' => ceil( $total_products / $limit), // total page of products
			'current_page' => $page // current selected page
		);
		$this->load->view('partials/products_container', $data);
	}

	public function filter_by_category($page = 1)
	{
		$limit = 8;
		$start = ($page - 1) * $limit;
		$category = strtolower($this->input->post('category', TRUE));
		$filtered_products = $this->Product->products_by_category($category, $start, $limit);
		$total_products = $this->Product->count_all_products_by_category($category);
		$data = array(
			'products' => $filtered_products,
			'category' => $category,
			'total_products' => $total_products,
			'total_pages' => ceil( $total_products / $limit), // total page of products
			'current_page' => $page // current selected page
		);
		$this->load->view('partials/products_container', $data);
	}

	public function search_products($page = 1) 
	{
		$limit = 8;
		$start = ($page - 1) * $limit;
		$product_search = $this->input->post('search', TRUE);
		$search_product = $this->Product->products_by_name($product_search, $start, $limit);
		$total_products = count($search_product);
		$data = array(
			'products' => $search_product,
			'total_products' => $total_products,
			'total_pages' => ceil( $total_products / $limit), // total page of products
			'current_page' => $page // current selected page
		);
		$this->load->view('partials/products_container', $data);
	}

	public function product_view($category, $id)
	{
		$start = 0;
		$limit = 4;
		$view_data = array(
			'product' => $this->Product->get_product($category, $id),
			'similar_products' => $this->Product->products_by_category($category, $start, $limit),
			'user' => $this->session->userdata('user_id'),
		);
		$this->load->view('product_view', $view_data);
	}

    public function admin_orders()
    {
		$this->is_login();
        $this->load->view('admin_orders');
    }

    public function admin_products()
    {
		$this->is_login();
        $this->load->view('admin_products');
    }

	public function add_product()
	{
		var_dump($this->input->post());

		$imageFiles = $_FILES['image'];
		foreach ($imageFiles['name'] as $index => $name) {
			// Check if the file was uploaded successfully
			if ($imageFiles['error'][$index] == UPLOAD_ERR_OK) {
				// Get the temporary file name
				$tmpName = $imageFiles['tmp_name'][$index];
		
				// Move the uploaded file to a permanent location
				$destinationPath = '../assets/images/products/' . $name;
				move_uploaded_file($tmpName, $destinationPath);
		
				// Process the uploaded image file (e.g., resize, crop, save to database, etc.)
				processImage($destinationPath);
			}
		}
		
		$this->load->view('partials/image_preview_list', array( 'images' => $imageFiles ));
		// $validation = $this->Product->add_product_validation();

		// if ($validation != NULL) {
        //     $this->session->set_flashdata('input_errors', $validation);
		// 	echo $validation;
        // } else {
        //     echo "voila"; 
        // }
	}

	public function get_cart()
    {
		if($this->session->userdata('user_id')){
			$cart['cart'] = $this->Cart->count_cart_products($this->session->userdata('user_id'));
		}
        else{
			$cart['cart'] = 0;
		}
        $this->load->view('partials/show_cart', $cart);
    }

	public function islogin()
	{
		if(!$this->session->userdata('user_id')){
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			"categories" => $this->Product->group_by_category(),
			"total" => $this->Product->count_all_products(),
			"user" => $this->session->userdata('user_id')
		);
		$this->load->view('catalogue', $data);
	}

	public function dashboard()
	{
		$data = array(
			"categories" => $this->Product->group_by_category(),
			"total" => $this->Product->count_all_products(),
			"user" => $this->session->userdata('user_id')
		);
		$this->load->view('catalogue', $data);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function index()
	{
		$this->load->view('catalogue');
	}

	public function catalogue()
	{
		$this->load->view('catalogue');
	}

	public function cart()
	{
		$this->is_login();
		$this->load->view('cart');
	}

	public function product_view()
	{
		$this->load->view('product_view');
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

	public function is_login()
    {
        $is_login = $this->session->userdata('user_id');

        if (!$is_login) {
			redirect("users");
		}
    }
}

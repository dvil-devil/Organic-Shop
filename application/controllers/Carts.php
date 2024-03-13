<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carts extends CI_Controller 
{
    public function show_cart_items()
    {
        $data = array(
            'cart_items' => $this->Cart->get_cart_products()
        );
        $this->load->view('partials/cart-items', $data);
    }

    public function index()
    {
		$this->islogin();
        $this->load->view('cart');
    }

    public function cart()
	{
		$this->islogin();
		$this->load->view('cart');
	}

    public function add_to_cart()
    {
        $user = $this->session->userdata("user_id");
        $cart = $this->input->post();
        $this->Cart->add_to_cart($user, $cart);
    }

    public function islogin()
	{
		if(!$this->session->userdata('user_id')){
			redirect('login');
		}
	}
}
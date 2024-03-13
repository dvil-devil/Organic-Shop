<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Model
{
    public function add_to_cart($user_id, $cart)
    {
        $query = "INSERT INTO carts(user_id, product_id, quantity) VALUES (?, ?, ?)";
        return $this->db->query($query, array(
                                    $user_id, 
                                    $this->security->xss_clean($cart['product_id']),
                                    $this->security->xss_clean($cart['quantity'])));
    }

    function get_cart_products()
    {
        return $this->db->query("SELECT product_id, SUM(quantity) as quantity, product_name, price, pictures FROM carts
                                    LEFT JOIN users ON carts.user_id = users.id
                                    LEFT JOIN products ON carts.product_id = products.id
                                    GROUP BY product_id")->result_array();
    }

    function count_cart_products($user_id)
    {
        return $this->db->query("SELECT * FROM carts
                                    LEFT JOIN users ON carts.user_id = users.id
                                    LEFT JOIN products ON carts.product_id = products.id
                                    WHERE user_id = ?
                                    GROUP BY product_id", $user_id)->num_rows();
    }
}

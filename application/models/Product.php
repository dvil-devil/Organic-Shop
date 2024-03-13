<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Model
{
    public function get_all_products($start, $limit)
    {
        $query = "SELECT * from products LIMIT ?, ?";
        return $this->db->query($query, array($start, $limit))->result_array();
    }

    public function products_by_name($product_name, $start, $limit)
    {
        $query = "SELECT * from products WHERE product_name LIKE ? LIMIT ?, ?";
        return $this->db->query($query, 
                        array(
                            $this->security->xss_clean('%' . $product_name . '%'),
                            $start,
                            $limit
                        ))->result_array();
    }

    public function products_by_category($category, $start, $limit)
    {
        if (empty($category)) {
            return $this->get_all_products($start, $limit);
        }
        $query = "SELECT * from products WHERE category = ?";
        return $this->db->query($query, $this->security->xss_clean($category))->result_array();
    }

    public function get_product($category, $id)
    {
        $query = "SELECT * from products WHERE category = ? AND id = ?";
        return $this->db->query($query,
                            array(
                                $this->security->xss_clean($category),
                                $this->security->xss_clean($id)
                            ))->row_array();
    }

    public function group_by_category()
    {
        $query = "SELECT category, COUNT(category) as count_category, 
                    COUNT(*) as count_all 
                    FROM products 
                    GROUP BY category";
        return $this->db->query($query)->result_array();
    }

    public function count_all_products()
    {
        return $this->db->query("SELECT * FROM products")->num_rows();
    }

    public function count_all_products_by_category($category)
    {
        if (empty($category)) {
            return $this->count_all_products();
        }
        $query = "SELECT * FROM products WHERE category = ?";
        return $this->db->query($query, $this->security->xss_clean($category))->num_rows();
    }

    public function add_product_validation()
    {
        $this->form_validation->set_rules("product_name", "Name", "required");
        $this->form_validation->set_rules("description", "Description", "required");
        $this->form_validation->set_rules("category", "Category", "required");
        $this->form_validation->set_rules("inventory", "Inventory", "required|numeric");
        $this->form_validation->set_rules("price", "Price", "required|numeric");
        $this->form_validation->set_rules('image1', 'Image', 'required', array('required' => 'At least one image must be uploaded.'));

        if (!$this->form_validation->run()) {
            return validation_errors();
        }
    }
}

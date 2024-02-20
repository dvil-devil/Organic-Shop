<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Model
{
    public function get_all_products()
    {
        return $this->db->query("SELECT * from products")->result_array();
    }

    public function get_product($id, $category)
    {
        return $this->db->query("SELECT * from products WHERE category = ? AND id = ?", 
                    array(
                        $this->security->xss_clean($category), 
                        $this->security->xss_clean($id)))->row_array();
    }

    public function add_product_validation()
    {
        $this->form_validation->set_rules("name","Name","required");
        $this->form_validation->set_rules("description","Description","required");
        $this->form_validation->set_rules("category","Category","required");
        $this->form_validation->set_rules("inventory","Inventory","required|numeric");
        $this->form_validation->set_rules("price","Price","required|numeric");

        if(!$this->form_validation->run()) {
            return validation_errors();
        } 
    }
}

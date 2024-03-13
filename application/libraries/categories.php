<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories
{
    public function category( $category_id ) 
    {
        $categories = array (
            '0' => "",
            '1' => "vegetables",
            '2' => "fruits",
            '3' => "pork",
            '4' => "beef",
            '5' => "chicken",
        );

        if(array_key_exists($category_id, $categories)) {
            return $categories[$category_id];
        } else {
            return "Category not found";
        }
    }
}
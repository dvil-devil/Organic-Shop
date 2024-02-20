<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model
{
    function get_user_by_email($email)
    { 
        $query = "SELECT * FROM users WHERE email=?";
        return $this->db->query($query, $this->security->xss_clean($email))->result_array()[0];
    }

    function signup_completion($user)
    {
        $is_admin = FALSE; // is_admin is set to FALSE by default
        $salt = bin2hex(openssl_random_pseudo_bytes(32));
        $password = md5($user["password"] . $salt);
        $result = $this->db->query("SELECT * FROM users")->result_array();
        if (sizeof($result) == 0) {
            $is_admin = TRUE;
        }
        
        $query = "INSERT INTO Users (first_name, last_name, email, password, salt, is_admin) VALUES (?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($user['first_name']),
            $this->security->xss_clean($user['last_name']),
            $this->security->xss_clean($user['email']),
            $this->security->xss_clean($password),
            $this->security->xss_clean($salt),
            $this->security->xss_clean($is_admin)
        );
        return $this->db->query($query, $values);
    }

    public function signup_validation($email)
    {
        $this->form_validation->set_rules("first_name", "First Name", "required");
        $this->form_validation->set_rules("last_name", "Last Name", "required");
        $this->form_validation->set_rules("email", "Email", "required|valid_email");
        $this->form_validation->set_rules("password", "Password", "required|min_length[8]");
        $this->form_validation->set_rules("confirm_password", "Password", "matches[password]");
        
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else if($this->get_user_by_email($email)) {
            return "Email is already in use.";
        }
    }

    function login_form_validation() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        if(!$this->form_validation->run()) {
            return validation_errors();
        } 
        else {
            return "success";
        }
    }

    function login_authentication($user, $password) 
    {
        // enrcrypt the input password with in the database  so that it can match the password in the database
        $encrypt_password = md5($password . $user['salt']);

        if($user && $user['password'] == $encrypt_password) {
            return "success";
        }
        else {
            return "Incorrect email or password.";
        }
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function index()
    {
        $this->load->view('login');
    }

    public function login()
    {
        $this->is_login();
        $this->load->view('login');
    }

    public function signup()
    {
        $this->is_login();
        $this->load->view('signup');
    }

    public function signup_process()
    {
        $email = $this->input->post('email');
        $validation = $this->User->signup_validation($email);

        if ($validation != null) {
            $this->session->set_flashdata('input_errors', $validation);
            redirect("signup");
        } else {
            $form_data = $this->input->post(NULL, TRUE);
            $complete = $this->User->signup_completion($form_data);

            if ($complete) {
                $new_user = $this->User->get_user_by_email($form_data['email']);
                $this->session->set_userdata(array('user_id' => $new_user["id"], 'first_name' => $new_user['first_name'], 'is_admin' => $new_user['is_admin']));
                redirect("products");
            } else {
                $this->session->set_flashdata('input_errors', "Sorry something went wrong, please try again.");
                redirect("signup");
            }
        }
    }

    public function login_process()
    {
        $result = $this->User->login_form_validation();
        if ($result != 'success') {
            $this->session->set_flashdata('input_errors', $result);
            redirect("login");
        } else {
            $email = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);
            $user = $this->User->get_user_by_email($email);
            $result = $this->User->login_authentication($user, $password);

            if ($result == "success") {
                $this->session->set_userdata(array('user_id' => $user['id'], 'first_name' => $user['first_name']));
                redirect("products");
            } else {
                $this->session->set_flashdata('input_errors', $result);
                redirect("login");
            }
        }
    }

    public function is_login()
    {
        $is_login = $this->session->userdata('user_id');

        if ($is_login) {
            redirect("products");
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect("/");
    }
}

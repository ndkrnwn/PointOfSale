<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login_cust();
        $this->load->model(['m_customer']);
        $this->load->library(['form_validation', 'fungsi']);
    }

    // Function to edit profile customer
    public function edit($id)
    {
        $this->form_validation->set_rules('email', 'Email', 'callback_email_check');
        $this->form_validation->set_rules('phone', 'Phone', 'callback_phone_check');

        if ($this->form_validation->run() == FALSE) {
            $query = $this->m_customer->get($id);
            if ($query->num_rows() > 0) {
                $data['row'] = $query->row();
                $this->load->view('template/header');
                $this->load->view('template/navbar_cust');
                $this->load->view('client/profile', $data);
                $this->load->view('template/footer_cust');
            } else {
                $this->session->set_flashdata('error', 'Data cannot be found');
                echo "<script>window.location='" . site_url('transaction') . "';</script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->m_customer->edit_profile($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', ' Profile updated successfully');
            }
            echo "<script>window.location='" . site_url('transaction') . "';</script>";
        }
    }

    // Function to edit password customer 
    public function edit_password($id)
    {

        $this->form_validation->set_rules('old-password', 'Old Password', 'required|callback_oldpassword_check');
        $this->form_validation->set_rules('password', 'Password', 'min_length[5]');
        $this->form_validation->set_rules('pass-conf', 'Confirmation Password', 'matches[password]');

        $this->form_validation->set_message('min_length', '{field} must be at least 5 characters long!');
        $this->form_validation->set_message('matches', 'The Password and Confirmation Password do not match!');

        if ($this->form_validation->run() == FALSE) {
            $query = $this->m_customer->get($id);
            if ($query->num_rows() > 0) {
                $data['row'] = $query->row();
                $this->load->view('template/header');
                $this->load->view('template/navbar_cust');
                $this->load->view('client/password', $data);
                $this->load->view('template/footer_cust');
            } else {
                $this->session->set_flashdata('error', 'Data cannot be found');
                echo "<script>window.location='" . site_url('transaction') . "';</script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->m_customer->edit_password($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', ' Password updated successfully');
            }
            echo "<script>window.location='" . site_url('transaction') . "';</script>";
        }
    }

    // Callback function to check same email
    function email_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM tb_customer WHERE email ='$post[email]' AND customer_id != '$post[id]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('email_check',  'Sorry, {field} already exists!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // Callback function to check same phone
    function phone_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM tb_customer WHERE phone ='$post[phone]' AND customer_id != '$post[id]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('phone_check',  'Sorry, {field} already exists!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // Callback function to check old password
    public function oldpassword_check($old_password)
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT password FROM tb_customer WHERE customer_id = '$post[id]'");
        if ($query->num_rows() > 0) {
            $customer = $query->row();
            if (md5($old_password) == $customer->password) {
                return TRUE;
            } else {
                $this->form_validation->set_message('oldpassword_check', 'The Old Password is incorrect!');
                return FALSE;
            }
        } else {
            $this->form_validation->set_message('oldpassword_check', 'Data cannot be found');
            return FALSE;
        }
    }
}

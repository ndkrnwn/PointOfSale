<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['m_user', 'm_delete']);
        $this->load->library(['form_validation', 'fungsi']);
    }

    // Index page for user
    public function index()
    {
        check_admin();
        $data['title'] = 'User Account';
        $data['row'] = $this->m_user->get_data();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('User/list', $data);
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // Index page for add user
    public function regist()
    {
        check_admin();
        $this->form_validation->set_rules('username', 'Username', 'min_length[5]|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'min_length[5]');
        $this->form_validation->set_rules(
            'pass-conf',
            'Confirmation Password',
            'matches[password]',
            array('matches' => 'The Password and %s do not match')
        );
        $this->form_validation->set_message('min_length', '{field} must be at least 5 characters long!');
        $this->form_validation->set_message('is_unique', 'Sorry, {field} already exists!');

        if ($this->form_validation->run() == FALSE) {
            $data['gr'] = $this->m_user->get_group();
            $this->load->view('template/header');
            $this->load->view('template/navbar');
            $this->load->view('user/add', $data);
            $this->load->view('template/footer');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->m_user->regist($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'User added successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to add user');
            }
            echo "<script>window.location='" . site_url('admin/user') . "';</script>";
        }
    }

    // Index page for edit user
    public function edit($id)
    {
        check_admin();
        $this->form_validation->set_rules('username', 'Username', 'min_length[5]|callback_username_check');
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[5]');
            $this->form_validation->set_rules(
                'pass-conf',
                'Confirmation Password',
                'matches[password]',
                array('matches' => 'The Password and %s do not match')
            );
        }
        if ($this->input->post('pass-conf')) {
            $this->form_validation->set_rules(
                'pass-conf',
                'Confirmation Password',
                'matches[password]',
                array('matches' => 'The Password and %s do not match')
            );
        }
        $this->form_validation->set_message('min_length', '{field} must be at least 5 characters long!');
        if ($this->form_validation->run() == FALSE) {
            $query = $this->m_user->get($id);
            if ($query->num_rows() > 0) {
                $data['gr'] = $this->m_user->get_group();
                $data['row'] = $query->row();
                $this->load->view('template/header');
                $this->load->view('template/navbar');
                $this->load->view('user/edit', $data);
                $this->load->view('template/footer');
            } else {
                $this->session->set_flashdata('error', 'Data cannot be found');
                echo "<script>window.location='" . site_url('admin/user') . "';</script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->m_user->edit($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'User updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to update user');
            }
            echo "<script>window.location='" . site_url('admin/user') . "';</script>";
        }
    }

    // Index page for edit profile user
    public function edit_password($id)
    {
        $this->form_validation->set_rules('old-password', 'Old Password', 'required|callback_oldpassword_check');
        $this->form_validation->set_rules('password', 'Password', 'min_length[5]');
        $this->form_validation->set_rules('pass-conf', 'Confirmation Password', 'matches[password]');

        $this->form_validation->set_message('min_length', '{field} must be at least 5 characters long!');
        $this->form_validation->set_message('matches', 'The Password and Confirmation Password do not match!');

        if ($this->form_validation->run() == FALSE) {
            $query = $this->m_user->get($id);
            if ($query->num_rows() > 0) {
                $data['row'] = $query->row();
                $this->load->view('template/header');
                $this->load->view('template/navbar');
                $this->load->view('user/edit_password', $data);
                $this->load->view('template/footer');
            } else {
                $this->session->set_flashdata('error', 'Data cannot be found');
                echo "<script>window.location='" . site_url('admin/dashboard') . "';</script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->m_user->edit_password($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', ' Password updated successfully');
            } else {
                $this->session->set_flashdata('error', ' Failed to update password');
            }
            echo "<script>window.location='" . site_url('admin/dashboard') . "';</script>";
        }
    }

    // Function to process delete user
    public function del()
    {
        check_admin();
        $id = $this->input->post('id');
        if ($this->session->userdata('ses_id') == $id) {
            $this->session->set_flashdata('warning', 'Data cannot be deleted because you are logged in with this account.');
            echo "<script>window.location='" . site_url('admin/user') . "';</script>";
        } else {
            $q = $this->m_delete->get_createdby($id);
            if ($q->num_rows() > 0) {
                $this->session->set_flashdata('relation', 'Data cannot be deleted because it is related to other data. Please resolve the relations first.');
                echo "<script>window.location='" . site_url('admin/user') . "';</script>";
            } else {
                $this->m_user->del($id);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('deleted', 'User deleted successfully');
                } else {
                    $this->session->set_flashdata('error', 'Failed to delete user');
                }
                echo "<script>window.location='" . site_url('admin/user') . "';</script>";
            }
        }
    }

    // Callback function to check same username
    function username_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM tb_user WHERE username ='$post[username]' AND user_id != '$post[id]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('username_check',  'Sorry, {field} already exists!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // Callback function to check old password
    public function oldpassword_check($old_password)
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT password FROM tb_user WHERE user_id = '$post[id]'");
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

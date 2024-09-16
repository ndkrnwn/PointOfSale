<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['m_customer']);
        $this->load->library(['form_validation', 'fungsi']);
    }

    // Index page for customer
    public function index()
    {
        $data['row'] = $this->m_customer->get();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('customer/index', $data);
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // Index page for add customer
    public function add()
    {
        $this->form_validation->set_rules('phone', 'phone', 'is_unique[tb_customer.phone]');
        $this->form_validation->set_rules('email', 'email', 'is_unique[tb_customer.email]');
        $this->form_validation->set_message('is_unique', 'Sorry, {field} already exists!');

        if ($this->form_validation->run() == FALSE) {
            $data['category'] = $this->m_customer->get_category();
            $this->load->view('template/header');
            $this->load->view('template/navbar');
            $this->load->view('customer/add', $data);
            $this->load->view('template/footer');
            $this->load->view('datatables/datatable');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->m_customer->add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Customer added successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to add customer');
            }
            echo "<script>window.location='" . site_url('admin/customer') . "';</script>";
        }
    }

    // Index page for edit customer
    public function edit($id)
    {
        $this->form_validation->set_rules('email', 'Email', 'callback_email_check');
        $this->form_validation->set_rules('phone', 'Phone', 'callback_phone_check');
        $this->form_validation->set_rules('password', 'Password', 'min_length[5]');
        $this->form_validation->set_rules(
            'pass-conf',
            'Confirmation Password',
            'matches[password]',
            array('matches' => 'The Password and %s do not match')
        );
        $this->form_validation->set_message('min_length', '{field} must be at least 5 characters long!');
        if ($this->form_validation->run() == FALSE) {
            $query = $this->m_customer->get($id);
            if ($query->num_rows() > 0) {
                $data['row'] = $query->row();
                $data['category'] = $this->m_customer->get_category();
                $this->load->view('template/header');
                $this->load->view('template/navbar');
                $this->load->view('customer/edit', $data);
                $this->load->view('template/footer');
            } else {
                $this->session->set_flashdata('error', 'Data cannot be found');
                echo "<script>window.location='" . site_url('admin/customer') . "';</script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->m_customer->edit($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Customer updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to update customer');
            }
            echo "<script>window.location='" . site_url('admin/customer') . "';</script>";
        }
    }

    // Function to process delete customer
    public function del()
    {
        $id = $this->input->post('id', TRUE);

        if (isset($_POST['delete'])) {
            $q = $this->db->query("SELECT a.* FROM tb_sale a WHERE a.customer_id ='$id' ");
            if ($q->num_rows() > 0) {
                $this->session->set_flashdata('relation', 'Data cannot be deleted because it is related to other data. Please resolve the relations first.');
                echo "<script>window.location='" . site_url('admin/customer') . "';</script>";
            } else {
                $this->m_customer->del($id);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('deleted', 'Customer deleted successfully');
                } else {
                    $this->session->set_flashdata('error', 'Failed to delete customer');
                }
                echo "<script>window.location='" . site_url('admin/customer') . "';</script>";
            }
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
}

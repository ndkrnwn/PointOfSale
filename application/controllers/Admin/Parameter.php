<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parameter extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model('m_parameter');
        $this->load->library(['form_validation', 'fungsi']);
    }

    // Index page for add parameter
    public function add()
    {
        $this->form_validation->set_rules('code', 'code', 'is_unique[tb_parameter.code]');
        $this->form_validation->set_message('is_unique', 'Sorry, {field} already exists!');

        if ($this->form_validation->run() == FALSE) {
            $query = $this->m_parameter->get_class();
            $data = array(
                'cl' => $query
            );
            $this->load->view('template/header');
            $this->load->view('template/navbar');
            $this->load->view('parameter/add', $data);
            $this->load->view('template/footer');
            $this->load->view('datatables/datatable');
        } else {
            $post = $this->input->post(null, True);
            $this->m_parameter->add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Parameter added successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to add parameter');
            }
            redirect('admin/parameter/add');
        }
    }

    // Index page for userelevel parameter
    public function userlevel()
    {
        $class = 'user level';
        $data['row'] = $this->m_parameter->get_data($class);
        $data['title'] = 'User Level';
        $data['fn'] = 'userlevel';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('parameter/list', $data);
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // Index page for customer parameter
    public function customercategory()
    {
        $class = 'customer category';
        $data['row'] = $this->m_parameter->get_data($class);
        $data['title'] = 'Customer Category';
        $data['fn'] = 'customercategory';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('parameter/list', $data);
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // Index page for treatment parameter
    public function servicecategory()
    {
        $class = 'service category';
        $data['row'] = $this->m_parameter->get_data($class);
        $data['title'] = 'Treatment Category';
        $data['fn'] = 'servicecategory';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('parameter/list', $data);
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // Function to process delete parameter
    public function del()
    {

        $id = $this->input->post('id', TRUE);
        $code = $this->input->post('code', TRUE);

        if (isset($_POST['delete'])) {
            $q = $this->db->query("SELECT a.* FROM tb_customer a WHERE a.category ='$code' ");
            $q1 = $this->db->query("SELECT a.* FROM tb_service a WHERE a.category ='$code' ");
            $q2 = $this->db->query("SELECT a.* FROM tb_user a WHERE a.level ='$code' ");
            if ($q->num_rows() > 0) {
                $this->session->set_flashdata('relation', 'Data cannot be deleted because it is related to other data. Please resolve the relations first.');
                echo "<script>window.location='" . site_url('admin/parameter/add') . "';</script>";
            } else if ($q1->num_rows() > 0) {
                $this->session->set_flashdata('relation', 'Data cannot be deleted because it is related to other data. Please resolve the relations first.');
                echo "<script>window.location='" . site_url('admin/parameter/add') . "';</script>";
            } else if ($q2->num_rows() > 0) {
                $this->session->set_flashdata('relation', 'Data cannot be deleted because it is related to other data. Please resolve the relations first.');
                echo "<script>window.location='" . site_url('admin/parameter/add') . "';</script>";
            } else {
                $this->m_parameter->del($id);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('deleted', 'Parameter deleted successfully');
                } else {
                    $this->session->set_flashdata('error', 'Failed to delete parameter');
                }
                echo "<script>window.location='" . site_url('admin/parameter/add') . "';</script>";
            }
        }
    }
}

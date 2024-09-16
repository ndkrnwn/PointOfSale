<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model(['m_service', 'm_delete']);
    }

    // Index page for treatment
    public function index()
    {
        $data['row'] = $this->m_service->get();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('service/index', $data);
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // Index page for add treatment
    public function add()
    {
        $data['category'] = $this->m_service->get_category();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('service/add', $data);
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // Index page for edit treatment
    public function edit($id)
    {

        $query = $this->m_service->get($id);
        if ($query->num_rows() > 0) {
            $data['row'] = $query->row();
            $data['category'] = $this->m_service->get_category();
            $this->load->view('template/header');
            $this->load->view('template/navbar');
            $this->load->view('service/edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->session->set_flashdata('error', 'Data cannot be found');
            echo "<script>window.location='" . site_url('admin/service') . "';</script>";
        }
    }

    // Function to process add or edit treatment
    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->m_service->add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Treatment added successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to add treatment');
            }
        } else if (isset($_POST['edit'])) {
            $this->m_service->edit($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Treatment updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to update treatment');
            }
        }
        echo "<script>window.location='" . site_url('admin/service') . "';</script>";
    }

    // Function to process delete treatment
    public function del()
    {
        $id = $this->input->post('id', TRUE);
        if (isset($_POST['delete'])) {
            $q = $this->m_delete->get_service_id($id);
            if ($q->num_rows() > 0) {
                $this->session->set_flashdata('relation', 'Data cannot be deleted because it is related to other data. Please resolve the relations first.');
                echo "<script>window.location='" . site_url('admin/service') . "';</script>";
            } else {
                $this->m_service->del($id);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('deleted', 'Treatment deleted successfully');
                } else {
                    $this->session->set_flashdata('error', 'Failed to delete treatment');
                }
                echo "<script>window.location='" . site_url('admin/service') . "';</script>";
            }
        }
    }
}

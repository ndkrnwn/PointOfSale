<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model(['m_product', 'm_delete']);
    }

    // Index page for product
    public function product()
    {
        $data['row'] = $this->m_product->get();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('product/index', $data);
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // Index page for add product
    public function add()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('product/add');
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // Index page for edit product
    public function edit($id)
    {

        $query = $this->m_product->get($id);
        if ($query->num_rows() > 0) {
            $data['row'] = $query->row();
            $this->load->view('template/header');
            $this->load->view('template/navbar');
            $this->load->view('product/edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->session->set_flashdata('error', 'Data cannot be found');
            echo "<script>window.location='" . site_url('admin/product/product') . "';</script>";
        }
    }

    // Function to process add or edit product
    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $file_data = $this->upload_file();
            if (isset($file_data['error'])) {
                $this->session->set_flashdata('error', 'Error: ' . $file_data['error']);
            } else {
                if (isset($file_data['file_name'])) {
                    $file_name = $file_data['file_name'];
                    $this->m_product->add($post, $file_name);
                    $this->session->set_flashdata('success', 'Product added successfully');
                } else {
                    $this->m_product->add($post);
                    $this->session->set_flashdata('success', 'Product added successfully without file upload');
                }
            }
        } else if (isset($_POST['edit'])) {
            $file_data = $this->upload_file();
            if (isset($file_data['error'])) {
                $this->session->set_flashdata('error', 'Error: ' . $file_data['error']);
            } else {
                if (isset($file_data['file_name'])) {
                    $file_name = $file_data['file_name'];
                    $this->m_product->edit($post, $file_name);
                    $img_old = $this->input->post('img_old', TRUE);
                    if ($img_old != null) {
                        unlink(FCPATH . 'uploads/product/' . $img_old);
                    }
                    $this->session->set_flashdata('success', 'Product updated successfully');
                } else {
                    $this->m_product->edit($post);
                    $this->session->set_flashdata('success', 'Product updated successfully without file upload');
                }
            }
        }

        echo "<script>window.location='" . site_url('admin/product/product') . "';</script>";
    }

    // Function to upload_file for product
    public function upload_file()
    {
        if (isset($_FILES["attachment"]["name"]) && !empty($_FILES["attachment"]["name"])) {
            $path = APPPATH . '../uploads/product/';
            $file_name = $this->input->post('name', TRUE);
            if (!is_dir($path)) {
                mkdir($path, 0655, true);
            }

            $upload_config = array(
                'upload_path' => $path,
                'allowed_types' => 'jpg|jpeg|png|webp',
                'file_name' => $file_name
            );

            $this->load->library('upload', $upload_config);
            $this->upload->initialize($upload_config);

            if ($this->upload->do_upload('attachment')) {
                return array(
                    'file_name' => $this->upload->data('file_name')
                );
            } else {
                return array('error' => $this->upload->display_errors());
            }
        }
    }

    // Function to process delete product
    public function del()
    {
        $id = $this->input->post('id', TRUE);
        $img = $this->input->post('img', TRUE);
        if (isset($_POST['delete'])) {
            $q = $this->m_delete->get_product_id($id);
            unlink(FCPATH . 'uploads/product/' . $img);
            if ($q->num_rows() > 0) {
                $this->session->set_flashdata('relation', 'Data cannot be deleted because it is related to other data. Please resolve the relations first.');
                echo "<script>window.location='" . site_url('admin/product/product') . "';</script>";
            } else {
                $this->m_product->del($id);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('deleted', 'Product deleted successfully');
                } else {
                    $this->session->set_flashdata('error', 'Failed to delete product');
                }
                echo "<script>window.location='" . site_url('admin/product/product') . "';</script>";
            }
        }
    }

    // Index page for stock in
    public function stock_in()
    {
        $data['row'] = $this->m_product->get_stock_in();
        $data['title'] = 'Stock In';
        $data['fn'] = 'stock_in';
        $data['type'] = 'in';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('product/stock', $data);
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // Index page for stock out
    public function stock_out()
    {

        $data['row'] = $this->m_product->get_stock_out();
        $data['title'] = 'Stock Out';
        $data['fn'] = 'stock_out';
        $data['type'] = 'out';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('product/stock', $data);
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // Index page for add stock in/out
    public function stock_add()
    {
        $data['row'] = $this->m_product->get();
        $data['type'] = $this->uri->segment(4);
        if ($this->uri->segment(4) == 'in') {
            $data['title'] = 'Stock In';
            $data['fn'] = 'stock_in';
        } else {
            $data['title'] = 'Stock Out';
            $data['fn'] = 'stock_out';
        }
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('product/stock_add', $data);
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // Function to process add stock in or out
    public function stock_process()
    {
        $post = $this->input->post(null, TRUE);
        $type = $this->input->post('type');
        if (isset($_POST['add'])) {
            $this->m_product->stock_add($post);
            $this->m_product->add_update($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Stock in/out added successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to add stock in/out');
        }
        echo "<script>window.location='" . site_url('admin/product/stock_') . $type . "';</script>";
    }

    // Function to process delete stock in or out
    public function stock_del()
    {
        $post = $this->input->post(null, TRUE);
        $id = $this->input->post('stock_id', TRUE);
        if (isset($_POST['delete'])) {
            $this->m_product->stock_del($id);
            $this->m_product->delete_update($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('deleted', 'Stock in/out deleted successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete stock in/out');
            }
        }
    }
}

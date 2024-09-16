<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login_cust();
        $this->load->model(['m_customer', 'm_transaction']);
    }

    // Function index page on Transaction / Profile
    public function index()
    {
        $id = $this->session->userdata('ses_id');
        $query = $this->m_customer->get($id);
        if ($query->num_rows() > 0) {
            $data['ttl_transaction'] = $this->m_transaction->count_transaction($id)->row();
            $data['ttl_reviewed'] = $this->m_transaction->count_reviewed($id)->row();
            $data['trx_all'] = $this->m_transaction->get_customer_trx_all($id);
            $data['trx_reviewed'] = $this->m_transaction->get_customer_trx_reviewed($id);
            $data['trx_unreviewed'] = $this->m_transaction->get_customer_trx_unreviewed($id);
            $data['row'] = $query->row();
            $this->load->view('template/header');
            $this->load->view('template/navbar_cust');
            $this->load->view('client/transaction', $data);
            $this->load->view('template/footer_cust');
            $this->load->view('datatables/datatable');
        }
    }

    // Function process of review product
    public function process()
    {
        $id = $this->session->userdata('ses_id');
        $detail_id = $this->input->post('detail_id', TRUE);
        if (isset($_POST['review_process'])) {
            $post = $this->input->post(null, TRUE);
            $this->m_transaction->review($id, $post);
            $this->m_transaction->update_detail($detail_id);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', ' Review has been successfully sent');
            }
            echo json_encode(['status' => 'success']); // Mengembalikan respons JSON
        }
    }
}

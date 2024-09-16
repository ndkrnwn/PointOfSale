<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model(['m_parameter', 'm_dashboard']);

        $date = new DateTime();
        $timezone = new DateTimeZone('Asia/Kuala_Lumpur');
        $date->setTimezone($timezone);
        $this->currentDate = $date->format('Y-m-d');
    }

    // Index page for dashboard
    public function index()
    {
        $data['service'] = $this->m_dashboard->count_service($this->currentDate)->row();
        $data['product'] = $this->m_dashboard->count_product($this->currentDate)->row();
        $data['transaction'] = $this->m_dashboard->count_transaction($this->currentDate)->row();
        $data['member'] = $this->m_dashboard->count_member($this->currentDate)->row();
        $data['income'] = $this->m_dashboard->total_income($this->currentDate)->row();
        $data['income_s'] = $this->m_dashboard->service_income($this->currentDate)->row();
        $data['income_p'] = $this->m_dashboard->product_income($this->currentDate)->row();
        $data['row'] = $this->m_dashboard->top_customer();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('dashboard/index', $data);
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // Function to show top 10 product 
    public function top_product()
    {
        $data = $this->m_dashboard->top_product($this->currentDate);
        echo json_encode($data);
    }

    // Function to show top 10 treatment 
    public function top_service()
    {
        $data = $this->m_dashboard->top_service($this->currentDate);
        echo json_encode($data);
    }

    // Function to show total monthly sales over the course of a year
    public function year_sale()
    {
        $data = $this->m_dashboard->year_sale($this->currentDate);
        echo json_encode($data);
    }

    // Function to show top payment methods for this month
    public function top_payment()
    {
        $data = $this->m_dashboard->top_payment($this->currentDate);
        echo json_encode($data);
    }

    // Function to show 15 products with the lowest stock
    public function data_stock()
    {
        $data = $this->m_dashboard->data_stock();
        echo json_encode($data);
    }
}

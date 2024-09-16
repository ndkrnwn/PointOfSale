<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login_cust();
        $this->load->model(['m_home']);
    }

    // Function index home page for customer
    public function index($filter = 'all', $page = 0)
    {
        // Get search query
        $search_query = $this->input->get('q');

        // Configure pagination
        $config['base_url'] = base_url('home/' . $filter);
        if (!empty($search_query)) {
            $config['suffix'] = '?q=' . urlencode($search_query);
            $config['first_url'] = $config['base_url'] . '/0' . $config['suffix'];
        }
        $config['total_rows'] = $this->m_home->count_all_products($filter, $search_query);
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;

        // Pagination config for Bootstrap
        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        // Get current page number
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // Fetch products
        $products = $this->m_home->view_product($config['per_page'], $page, $filter, $search_query);
        $data['products'] = $products;
        $data['pagination'] = $this->pagination->create_links();
        $data['filter'] = $filter;
        $data['search_query'] = $search_query;

        // Check if products are found
        $data['no_products_message'] = (empty($products)) ? 'No products match your search criteria' : '';

        // Load views
        $this->load->view('template/header');
        $this->load->view('template/navbar_cust');
        $this->load->view('client/home', $data);
        $this->load->view('template/footer_cust');
    }

    // Function to get detail product
    public function detail($product_id)
    {
        $data['product'] = $this->m_home->get_product_by_id($product_id);

        // Get reviews
        $data['reviews'] = $this->m_home->get_reviews_by_product_id($product_id);

        // Calculate total reviews and average rating
        $total_reviews = count($data['reviews']);
        $sum_ratings = array_sum(array_column($data['reviews'], 'grade'));
        $average_rating = $total_reviews ? round($sum_ratings / $total_reviews, 1) : 0;

        // Count reviews by rating
        $rating_counts = array_fill(1, 5, 0);
        foreach ($data['reviews'] as $review) {
            $rating_counts[$review->grade]++;
        }

        $data['total_reviews'] = $total_reviews;
        $data['average_rating'] = $average_rating;
        $data['rating_counts'] = $rating_counts;

        if (!$data['product']) {
            show_404();
        }

        $this->load->view('template/header');
        $this->load->view('template/navbar_cust');
        $this->load->view('client/product', $data);
        $this->load->view('template/footer_cust');
    }

    // Function index survey page for customer
    public function survey()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar_cust');
        $this->load->view('client/survey');
        $this->load->view('template/footer_cust');
    }

    // Function process of submit survey
    public function submit_survey()
    {
        if (isset($_POST['submit_survey'])) {
            $post = $this->input->post(null, TRUE);
            $this->m_home->add_survey($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', ' Survey has been successfully sent');
            }
            echo json_encode(['status' => 'success']); // Mengembalikan respons JSON
        }
    }
}

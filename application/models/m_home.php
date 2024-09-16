<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_home extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function add_survey($post)
    {
        $params['survey_type'] = $post['survey_type'];
        $params['experience'] = $post['experience'];
        $params['improvement'] = $post['improvement'];
        $params['comments'] = $post['comments'];
        $params['customer_id'] = $this->session->userdata('ses_id');
        $params['created_date'] = date('Y-m-d H:i:s');
        $this->db->insert('tb_survey', $params);
    }

    public function view_product($limit, $offset, $filter = 'all', $search_query = '')
    {
        $this->db->select('a.product_id as product_id, a.is_point_exchange as is_point_exchange, a.name as name, a.price as price, a.point as point, a.file_name as filename, b.rating as rating');
        $this->db->from('tb_product a');
        $this->db->join('(SELECT product_id, AVG(grade) as rating FROM tb_review GROUP BY product_id) b', 'a.product_id = b.product_id', 'left');

        if ($filter == 'exchange') {
            $this->db->where('a.is_point_exchange !=', 0);
        }

        if (!empty($search_query)) {
            $this->db->like('a.name', $search_query);
        }
        $this->db->order_by('a.name', 'asc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all_products($filter = 'all', $search_query = null)
    {
        $this->db->from('tb_product a');
        $this->db->join('(SELECT product_id, AVG(grade) as rating FROM tb_review GROUP BY product_id) b', 'a.product_id = b.product_id', 'left');

        if ($filter == 'exchange') {
            $this->db->where('a.is_point_exchange !=', 0);
        }

        if (!empty($search_query)) {
            $this->db->like('a.name', $search_query);
        }

        return $this->db->count_all_results();
    }

    public function get_product_by_id($product_id)
    {
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('tb_product');
        return $query->row();
    }

    public function get_reviews_by_product_id($product_id)
    {
        $this->db->select('a.*, b.name as customer_name');
        $this->db->from('tb_review a');
        $this->db->join('tb_customer b', 'a.customer_id = b.customer_id');
        $this->db->where('a.product_id', $product_id);
        $this->db->order_by('a.review_id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
}

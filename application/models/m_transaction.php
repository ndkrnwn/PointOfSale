<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_transaction extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    public function count_transaction($id)
    {
        $query = "SELECT COUNT(customer_id) as total
                     FROM tb_sale
                     WHERE customer_id = $id ";
        $result = $this->db->query($query);
        return $result;
    }

    public function count_reviewed($id)
    {
        $query = "SELECT COUNT(review_id) as total
                      FROM tb_review
                      WHERE customer_id = $id ";
        $result = $this->db->query($query);
        return $result;
    }

    public function get_customer_trx_all($id)
    {
        $query = "SELECT b.review as review, c.product_id as product_id, c.file_name as file_name, b.sale_id as sale_id, b.detail_id as detail_id, a.invoice as invoice, c.name as name, b.qty as qty, b.sub_price as subprice, b.disc_total as disctotal, b.total_price as totalprice , a.sale_date as date
                    FROM tb_sale a 
                    INNER JOIN tb_sale_detail b on a.sale_id = b.sale_id 
                    INNER JOIN tb_product c on b.product_id = c.product_id 
                    WHERE a.customer_id = $id 
                    ORDER BY a.sale_date DESC
                    ";
        $result = $this->db->query($query);
        return $result;
    }

    public function get_customer_trx_reviewed($id)
    {
        $query = "SELECT c.product_id as product_id, c.file_name as file_name, b.sale_id as sale_id, b.detail_id as detail_id, a.invoice as invoice, c.name as name, b.qty as qty, b.sub_price as subprice, b.disc_total as disctotal, b.total_price as totalprice , a.sale_date as date
                    FROM tb_sale a 
                    INNER JOIN tb_sale_detail b on a.sale_id = b.sale_id 
                    INNER JOIN tb_product c on b.product_id = c.product_id 
                    WHERE a.customer_id = $id AND b.review ='1'
                    ORDER BY a.sale_date DESC
                    ";
        $result = $this->db->query($query);
        return $result;
    }

    public function get_customer_trx_unreviewed($id)
    {
        $query = "SELECT b.review as review, c.product_id as product_id, c.file_name as file_name, b.sale_id as sale_id, b.detail_id as detail_id, a.invoice as invoice, c.name as name, b.qty as qty, b.sub_price as subprice, b.disc_total as disctotal, b.total_price as totalprice , a.sale_date as date
                    FROM tb_sale a 
                    INNER JOIN tb_sale_detail b on a.sale_id = b.sale_id 
                    INNER JOIN tb_product c on b.product_id = c.product_id 
                    WHERE a.customer_id = $id AND b.review ='0'
                    ORDER BY a.sale_date DESC
                    ";
        $result = $this->db->query($query);
        return $result;
    }

    public function review($id, $post)
    {
        $params['customer_id'] = $id;
        $params['sale_id'] = $post['sale_id'];
        $params['detail_id'] = $post['detail_id'];
        $params['product_id'] = $post['product_id'];
        $params['grade'] = $post['rating'];
        $params['comment'] = $post['comment'];
        $params['created_date'] = date('Y-m-d H:i:s');
        $this->db->insert('tb_review', $params);
    }

    public function update_detail($detail_id)
    {
        $query = "UPDATE tb_sale_detail SET review= '1' WHERE detail_id =  '$detail_id' ";
        $this->db->query($query);
    }
}

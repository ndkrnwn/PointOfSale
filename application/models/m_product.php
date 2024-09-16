<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_product extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get($id = null)
    {
        $this->db->select('*');
        $this->db->from('tb_product a');
        if ($id != null) {
            $this->db->where('a.product_id', $id);
        }
        $this->db->order_by('a.name', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function get_stock_in($id = null)
    {
        $this->db->select('a.*, b.name as product_name');
        $this->db->from('tb_stock a');
        if ($id != null) {
            $this->db->where('a.product_id', $id);
        }
        $this->db->join('tb_product b', 'a.product_id = b.product_id');
        $this->db->where('a.type', 'in');
        $this->db->order_by('a.date', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function get_stock_out($id = null)
    {
        $this->db->select('a.*, b.name as product_name');
        $this->db->from('tb_stock a');
        if ($id != null) {
            $this->db->where('a.product_id', $id);
        }
        $this->db->join('tb_product b', 'a.product_id = b.product_id');
        $this->db->where('a.type', 'out');
        $this->db->order_by('a.date', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function add($post, $file_name = null)
    {
        $params['name'] = $post['name'];
        $params['price'] = $post['price'];
        $params['stock'] = 0;
        $params['description'] =  $post['description'] != "" ? $post['description'] : null;
        if (isset($_POST['is_point_exchange'])) {
            $params['is_point_exchange'] = 1;
            $params['point'] = $post['product_point'];
        } else {
            $params['is_point_exchange'] = 0;
        }
        if ($file_name != null) {
            $params['file_name'] = $file_name;
        }
        $params['createdby'] = $this->session->userdata('ses_id');
        $params['createddate'] = date('Y-m-d H:i:s');
        $this->db->insert('tb_product', $params);
    }

    public function edit($post, $file_name = null)
    {
        $params['name'] = $post['name'];
        $params['price'] = $post['price'];
        $params['description'] =  $post['description'] != "" ? $post['description'] : null;

        if (isset($_POST['is_point_exchange'])) {
            $params['is_point_exchange'] = 1;
            $params['point'] = $post['product_point'];
        } else {
            $params['is_point_exchange'] = 0;
            $params['point'] = 0;
        }
        if ($file_name != null) {
            $params['file_name'] = $file_name;
        }
        $params['modifyby'] = $this->session->userdata('ses_id');
        $params['modifydate'] = date('Y-m-d H:i:s');

        $this->db->where('product_id', $post['id']);
        $this->db->update('tb_product', $params);
    }

    public function del($id)
    {
        $this->db->where('product_id', $id);
        $this->db->delete('tb_product');
    }

    public function stock_add($post)
    {
        $params['product_id'] = $post['product_id'];
        $params['type'] = $post['type'];
        $params['detail'] = $post['detail'];
        $params['qty'] = $post['qty'];
        $params['date'] = $post['date'];
        $params['createdby'] = $this->session->userdata('ses_id');
        $params['createddate'] = date('Y-m-d H:i:s');
        $this->db->insert('tb_stock', $params);
    }

    public function add_update($post)
    {
        $qty = $post['qty'];
        $type = $post['type'];
        $id = $post['product_id'];

        if ($type == 'in') {
            $query = "UPDATE tb_product SET stock = stock + '$qty' WHERE product_id = '$id' ";
        } else if ($type == 'out') {
            $query = "UPDATE tb_product SET stock = stock - '$qty' WHERE product_id = '$id' ";
        }
        $this->db->query($query);
    }

    public function delete_update($post)
    {
        $qty = $post['qty'];
        $type = $post['type'];
        $product_id = $post['product_id'];

        if ($type == 'in') {
            $query = "UPDATE tb_product SET stock = stock - '$qty' WHERE product_id = '$product_id' ";
        } else if ($type == 'out') {
            $query = "UPDATE tb_product SET stock = stock + '$qty' WHERE product_id = '$product_id' ";
        }
        $this->db->query($query);
    }

    public function stock_del($id)
    {
        $this->db->where('stock_id', $id);
        $this->db->delete('tb_stock');
    }
}

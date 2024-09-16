<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_customer extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('tb_customer');
        $this->db->where('email', $post['username']);
        $this->db->where('password', md5($post['password']));
        $query = $this->db->get();

        // Cek jika tidak ada hasil dengan email, ganti ke pencarian berdasarkan phone
        if ($query->num_rows() == 0) {
            $this->db->reset_query(); // Reset query builder
            $this->db->select('*');
            $this->db->from('tb_customer');
            $this->db->where('phone', $post['username']);
            $this->db->where('password', md5($post['password']));
            $query = $this->db->get();
        }

        return $query;
    }

    public function get_category()
    {
        $query = "SELECT * FROM tb_parameter WHERE class = 'customer category' ORDER BY EXPLANATION ASC ";
        $result = $this->db->query($query);
        return $result->result();
    }

    // 
    public function get_email()
    {
        // Menggunakan query builder untuk keamanan dan kejelasan
        $this->db->select('email');
        $this->db->from('tb_customer');
        $this->db->where('category', 'cc002');
        $query = $this->db->get();

        // Memeriksa apakah query berhasil
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            // Jika tidak ada hasil, mengembalikan array kosong atau null sesuai kebutuhan
            return [];
        }
    }

    public function get($id = null)
    {
        $this->db->select('a.*, b.explanation as categoryname, c.name as createdname, d.name as modifyname');
        $this->db->from('tb_customer a');
        $this->db->join('tb_parameter b', 'a.category = b.code');
        $this->db->join('tb_user c', 'a.createdby = c.user_id');
        $this->db->join('tb_user d', 'a.modifyby = d.user_id', 'left');
        if ($id != null) {
            $this->db->where('a.customer_id', $id);
        }
        $this->db->order_by('a.name', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params['name'] = $post['name'];
        $params['gender'] = $post['gender'];
        $params['email'] = $post['email'];
        $params['phone'] =  $post['phone'] != "" ? $post['phone'] : null;
        $params['password'] = md5('12345');
        $params['address'] =  $post['address'] != "" ? $post['address'] : null;
        $params['category'] = $post['category'];
        $params['createdby'] = $this->session->userdata('ses_id');
        $params['createddate'] = date('Y-m-d H:i:s');
        $this->db->insert('tb_customer', $params);
    }

    public function edit($post)
    {
        $params['name'] = $post['name'];
        $params['gender'] = $post['gender'];
        $params['email'] = $post['email'];
        $params['phone'] =  $post['phone'] != "" ? $post['phone'] : null;
        $params['address'] =  $post['address'] != "" ? $post['address'] : null;
        $params['category'] = $post['category'];
        if (!empty($post['password'])) {
            $params['password'] = md5($post['password']);
        }
        $params['modifyby'] = $this->session->userdata('ses_id');
        $params['modifydate'] = date('Y-m-d H:i:s');

        $this->db->where('customer_id', $post['id']);
        $this->db->update('tb_customer', $params);
    }

    public function del($id)
    {
        $this->db->where('customer_id', $id);
        $this->db->delete('tb_customer');
    }

    public function edit_profile($post)
    {
        $params['name'] = $post['name'];
        $params['gender'] = $post['gender'];
        $params['phone'] =  $post['phone'] != "" ? $post['phone'] : null;
        $params['address'] =  $post['address'] != "" ? $post['address'] : null;
        $params['address'] = $post['address'];
        $params['modifyby'] = $this->session->userdata('ses_id');
        $params['modifydate'] = date('Y-m-d H:i:s');
        $this->db->where('customer_id', $post['id']);
        $this->db->update('tb_customer', $params);
    }

    public function edit_password($post)
    {
        $params['password'] = md5($post['password']);
        $params['modifyby'] = $this->session->userdata('ses_id');
        $params['modifydate'] = date('Y-m-d H:i:s');
        $this->db->where('customer_id', $post['id']);
        $this->db->update('tb_customer', $params);
    }
}

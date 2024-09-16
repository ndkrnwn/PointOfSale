<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_user extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('username', $post['username']);
        $this->db->where('password', md5($post['password']));
        $query = $this->db->get();
        return $query;
    }

    public function get_group()
    {
        $query = "SELECT * FROM tb_parameter WHERE class = 'user level'";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function get_data($id = null)
    {
        $this->db->select('a.*,  b.explanation as group_name');
        $this->db->from('tb_user a');
        if ($id != null) {
            $this->db->where('tb_user.user_id', $id);
        }
        $this->db->join('tb_parameter as b', 'a.level = b.code');
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        if ($id != null) {
            $this->db->where('tb_user.user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function regist($post)
    {
        $params['level'] = $post['group'];
        $params['name'] = $post['fullname'];
        $params['username'] = $post['username'];
        $params['password'] = md5($post['password']);
        $params['createdby'] = $this->session->userdata('ses_id');
        $params['createddate'] = date('Y-m-d H:i:s');
        $this->db->insert('tb_user', $params);
    }

    public function edit($post)
    {
        $params['level'] = $post['group'];
        $params['name'] = $post['fullname'];
        $params['username'] = $post['username'];
        if (!empty($post['password'])) {
            $params['password'] = md5($post['password']);
        }
        $params['modifyby'] = $this->session->userdata('ses_id');
        $params['modifydate'] = date('Y-m-d H:i:s');
        $this->db->where('user_id', $post['id']);
        $this->db->update('tb_user', $params);
    }

    public function edit_password($post)
    {
        $params['password'] = md5($post['password']);
        $params['modifydate'] = date('Y-m-d H:i:s');
        $this->db->where('user_id', $post['id']);
        $this->db->update('tb_user', $params);
    }

    public function del($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('tb_user');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_parameter extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    public function get($id = null)
    {
        $this->db->select('*');
        $this->db->from('tb_parameter');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $this->db->order_by('class', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function get_data($class)
    {
        $this->db->select('*');
        $this->db->from('tb_parameter');
        if ($class != null) {
            $this->db->where('class', $class);
        }
        $this->db->order_by('class', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function get_comp()
    {
        $query = "SELECT * FROM tb_parameter WHERE class = 'PT' ORDER BY EXPLANATION ASC ";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function get_class()
    {
        $query = "SELECT * FROM tb_parameter GROUP BY class";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function add($post)
    {
        $params['class'] = $post['class'];
        $params['code'] = $post['code'];
        $params['explanation'] = $post['explanation'];
        $this->db->insert('tb_parameter', $params);
    }

    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_parameter');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_service extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_category()
    {
        $query = "SELECT * FROM tb_parameter WHERE class = 'service category' ORDER BY EXPLANATION ASC ";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function get($id = null)
    {
        $this->db->select('a.*, b.explanation as categoryname');
        $this->db->from('tb_service a');
        $this->db->join('tb_parameter b', 'a.category = b.code');
        if ($id != null) {
            $this->db->where('a.service_id', $id);
        }
        $this->db->order_by('a.name', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params['name'] = $post['name'];
        $params['category'] = $post['category'];
        $params['modal'] = $post['modal'];
        $params['price'] = $post['price'];
        $params['createdby'] = $this->session->userdata('ses_id');
        $params['createddate'] = date('Y-m-d H:i:s');
        $this->db->insert('tb_service', $params);
    }

    public function edit($post)
    {
        $params['name'] = $post['name'];
        $params['category'] = $post['category'];
        $params['modal'] = $post['modal'];
        $params['price'] = $post['price'];
        $params['modifyby'] = $this->session->userdata('ses_id');
        $params['modifydate'] = date('Y-m-d H:i:s');

        $this->db->where('service_id', $post['id']);
        $this->db->update('tb_service', $params);
    }

    public function del($id)
    {
        $this->db->where('service_id', $id);
        $this->db->delete('tb_service');
    }
}

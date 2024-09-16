<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_delete extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_createdby($id)
    {
        $query = "SELECT createdby as id FROM tb_cart WHERE createdby ='$id' 
                  UNION ALL
                  SELECT createdby as id FROM tb_customer WHERE createdby ='$id'
                  UNION ALL
                  SELECT modifyby as id FROM tb_customer WHERE modifyby ='$id'
                  UNION ALL
                  SELECT createdby as id FROM tb_product WHERE createdby ='$id'
                  UNION ALL
                  SELECT modifyby as id FROM tb_product WHERE modifyby ='$id'
                  UNION ALL
                  SELECT createdby as id FROM tb_service WHERE createdby ='$id'
                  UNION ALL
                  SELECT modifyby as id FROM tb_service WHERE modifyby ='$id'
                  UNION ALL
                  SELECT createdby as id FROM tb_sale WHERE createdby ='$id'
                  UNION ALL
                  SELECT createdby as id FROM tb_stock WHERE createdby ='$id'
                  UNION ALL
                  SELECT createdby as id FROM tb_user WHERE createdby ='$id'
                  UNION ALL
                  SELECT modifyby as id FROM tb_user WHERE modifyby ='$id'
                  GROUP BY id ";
        $result = $this->db->query($query);
        return $result;
    }

    public function get_service_id($id)
    {
        $query = "SELECT service_id as id FROM tb_sale_detail WHERE service_id ='$id' 
                  GROUP BY id ";
        $result = $this->db->query($query);
        return $result;
    }

    public function get_product_id($id)
    {
        $query = "SELECT product_id as id FROM tb_sale_detail WHERE product_id ='$id' 
                   GROUP BY id ";
        $result = $this->db->query($query);
        return $result;
    }
}

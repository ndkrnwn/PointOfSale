<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_sales extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get($id = null)
    {
        $query = "SELECT A.*, B.NAME AS customer_name , C.NAME AS casiher_name FROM TB_SALE A 
                    INNER JOIN TB_CUSTOMER B ON A.CUSTOMER_ID = B.CUSTOMER_ID
                    INNER JOIN TB_USER C ON A.CREATEDBY = C.USER_ID
                    ";

        if ($id !== null) {
            // Jika $id memiliki nilai, tambahkan klausa WHERE untuk mencari berdasarkan ID
            $query .= " WHERE A.SALE_ID = $id";
        }

        $query .= " ORDER BY INVOICE DESC";

        $result = $this->db->query($query);
        return $result;
    }

    public function get_sale_detail($sale_id = null)
    {
        $query = "SELECT A.*, B.PRODUCT_ID AS item_id, B.NAME AS item_name FROM TB_SALE_DETAIL AS A 
                    INNER JOIN TB_PRODUCT B ON A.PRODUCT_ID = B.PRODUCT_ID
                    WHERE A.SALE_ID ='$sale_id'
                    UNION ALL
                SELECT A.*, B.SERVICE_ID AS item_id, B.NAME AS item_name FROM TB_SALE_DETAIL AS A 
                    INNER JOIN TB_SERVICE B ON A.SERVICE_ID = B.SERVICE_ID
                    WHERE A.SALE_ID ='$sale_id'";
        $result = $this->db->query($query);
        return $result;
    }

    public function get_cart()
    {
        $createdby = $this->session->userdata('ses_id');
        $query = "SELECT a.* , null as stock, b.name as item_name FROM tb_cart a 
                    INNER JOIN tb_service b on a.item_id = b.service_id
                    WHERE item_type ='service' AND a.createdby='$createdby'
                    UNION ALL
                    SELECT a.* , b.stock as stock, b.name as item_name FROM tb_cart a
                    INNER JOIN tb_product b on a.item_id = b.product_id
                    WHERE item_type ='product' AND a.createdby='$createdby'
                    ORDER BY item_name ASC ";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function add_cart($post)
    {
        $query = $this->db->query("SELECT MAX(cart_id) AS cart_no FROM tb_cart");
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $car_no = ((int)$row->cart_no) + 1;
        } else {
            $car_no = "1";
        }
        $params = array(
            'cart_id' => $car_no,
            'item_id' => $post['item_id'],
            'item_type' => $post['item_type'],
            'item_price' => $post['item_price'],
            'item_point' => $post['item_point'] !== "" ? $post['item_point'] : null,
            'total_point' => $post['item_point'] !== "" ? $post['item_point'] * $post['qty'] : null,
            'discount_item' => $post['discount_item'],
            'qty' => $post['qty'],
            'sub_price' => ($post['item_price']  * $post['qty']),
            'disc_total' => ($post['item_price'] * $post['discount_item'] / 100) * $post['qty'],
            'total_price' => (($post['item_price']  * $post['qty']) - (($post['item_price'] * $post['discount_item'] / 100) * $post['qty'])),
            'createdby' => $this->session->userdata('ses_id')
        );
        $this->db->insert('tb_cart', $params);
    }

    public function edit_cart($post)
    {
        $params = array(
            'qty' => $post['qty'],
            'discount_item' => $post['discount_item'],
            'sub_price' => $post['sub_price'],
            'disc_total' => $post['disc_total'],
            'total_price' => $post['total_price'],
            'total_point' => $post['total_point']
        );
        $this->db->where('cart_id', $post['cart_id']);
        $this->db->update('tb_cart', $params);
    }

    public function invoice_no()
    {
        $sql = "SELECT MAX(MID(invoice,9,4)) AS invoice_no 
            FROM tb_sale 
            WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->invoice_no) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $invoice = "MP" . date('ymd') . $no;
        return $invoice;
    }

    public function del_cart($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('tb_cart');
    }

    public function add_sale_item($post)
    {
        $params = array(
            'invoice' => $this->invoice_no(),
            'customer_id' => $post['customer_id'],
            'sub_total' => $post['subtotal'],
            'disc_total' => $post['disctotal'],
            'total_price' => $post['totalprice'],
            'cash' => $post['cash'],
            'remaining' => $post['remaining'],
            'point' => $post['point'],
            'payment' => $post['method_payment'],
            'pay_point' => $post['pay_point'],
            'sale_date' => $post['date'],
            'createdby' => $this->session->userdata('ses_id'),
            'createddate' => date('Y-m-d H:i:s')
        );
        $this->db->insert('tb_sale', $params);
        return $this->db->insert_id();
    }

    function add_sale_item_detail($params)
    {
        $this->db->insert_batch('tb_sale_detail', $params);
    }

    public function update_stock($id, $qty)
    {
        $query = "UPDATE tb_product SET stock = stock - '$qty' WHERE product_id = '$id' ";
        $this->db->query($query);
    }

    public function update_point($customer_id, $point)
    {
        // Pastikan point lebih dari 0 sebelum melakukan update
        if ($point > 0) {
            // Gunakan parameter binding untuk mencegah SQL Injection
            $query = "UPDATE tb_customer SET point = point + ? WHERE customer_id = ?";
            $this->db->query($query, array($point, $customer_id));
        }
    }

    public function update_pay_point($customer_id, $pay_point)
    {
        // Pastikan point lebih dari 0 sebelum melakukan update
        if ($pay_point > 0) {
            // Gunakan parameter binding untuk mencegah SQL Injection
            $query = "UPDATE tb_customer SET point = point - ? WHERE customer_id = ?";
            $this->db->query($query, array($pay_point, $customer_id));
        }
    }

    public function get_sale_product($id)
    {
        $query = "SELECT a.product_id as item_id , a.qty as qty, a.* FROM tb_sale_detail a
                    WHERE a.sale_id ='$id'";
        $result = $this->db->query($query);
        return $result;
    }

    public function update_stock_del($id, $qty)
    {
        $query = "UPDATE tb_product SET stock = stock + '$qty' WHERE product_id = '$id' ";
        $this->db->query($query);
    }

    public function update_point_del($point, $customer_id)
    {
        $query = "UPDATE tb_customer SET point = point - '$point' WHERE customer_id = '$customer_id' ";
        $this->db->query($query);
    }

    public function sale_del($id)
    {
        $this->db->where('sale_id', $id);
        $this->db->delete('tb_sale');
    }

    public function sale_detail_del($id)
    {
        $this->db->where('sale_id', $id);
        $this->db->delete('tb_sale_detail');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_dashboard extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function data_stock()
    {
        $query = "SELECT name, stock FROM tb_product
                    ORDER BY stock, name ASC
                    LIMIT 15; ";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function top_product($currentDate)
    {
        $query = "SELECT B.name AS product_name, SUM(A.QTY) AS total
                    FROM tb_sale_detail A
                    INNER JOIN tb_product B ON A.product_id = B.product_id
                    INNER JOIN tb_sale c on a.sale_id = c.sale_id
                    WHERE MONTH(C.sale_date) = MONTH('$currentDate') AND YEAR(C.sale_date) = YEAR('$currentDate')
                    GROUP BY product_name
                    ORDER BY total DESC
                    LIMIT 10; ";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function top_payment($currentDate)
    {
        $query = "SELECT
                    CASE
                        WHEN payment = 'cash' THEN 'Cash'
                        WHEN payment IN ('bca','bri', 'bni', 'mandiri') THEN 'EDC'
                        WHEN payment IN ('ovo', 'qris', 'gopay') THEN 'E-Wallet'
                        ELSE 'Other'
                    END AS payment_category,
                    SUM(total_price) AS total
                    FROM tb_sale
                    WHERE MONTH(sale_date) = MONTH('$currentDate') AND YEAR(sale_date) = YEAR('$currentDate') 
                    GROUP BY payment_category;  ";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function top_service($currentDate)
    {
        $query = "SELECT B.name AS service_name, SUM(A.QTY) AS total
                    FROM tb_sale_detail A
                    INNER JOIN tb_service B ON A.service_id = B.service_id
                    INNER JOIN tb_sale c on a.sale_id = c.sale_id
                    WHERE MONTH(C.sale_date) = MONTH('$currentDate') AND YEAR(C.sale_date) = YEAR('$currentDate')
                    GROUP BY service_name
                    ORDER BY total DESC
                    LIMIT 10; ";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function year_sale($currentDate)
    {
        $query = "SELECT
                        CASE
                        WHEN MONTH(sale_date) = 1 THEN 'JANUARI'
                        WHEN MONTH(sale_date) = 2 THEN 'FEBRUARI'
                        WHEN MONTH(sale_date) = 3 THEN 'MARET'
                        WHEN MONTH(sale_date) = 4 THEN 'APRIL'
                        WHEN MONTH(sale_date) = 5 THEN 'MEI'
                        WHEN MONTH(sale_date) = 6 THEN 'JUNI'
                        WHEN MONTH(sale_date) = 7 THEN 'JULI'
                        WHEN MONTH(sale_date) = 8 THEN 'AGUSTUS'
                        WHEN MONTH(sale_date) = 9 THEN 'SEPTEMBER'
                        WHEN MONTH(sale_date) = 10 THEN 'OKTOBER'
                        WHEN MONTH(sale_date) = 11 THEN 'NOVEMBER'
                        WHEN MONTH(sale_date) = 12 THEN 'DESEMBER'
                    END AS nama_bulan ,SUM(total_price) AS total
                FROM tb_sale
                WHERE YEAR(sale_date) = YEAR('$currentDate')
                GROUP BY NAMA_BULAN
                ORDER BY MONTH(sale_date)";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function count_member($currentDate)
    {
        $query = "SELECT COUNT(customer_id) as total
                    FROM tb_customer
                    WHERE DAY(createddate) = DAY('$currentDate') AND MONTH(createddate) = MONTH('$currentDate') AND YEAR(createddate) = YEAR('$currentDate') 
                    AND category ='CC002' ";
        $result = $this->db->query($query);
        return $result;
    }

    public function count_transaction($currentDate)
    {
        $query = "SELECT COUNT(sale_id) as total
                    FROM tb_sale
                    WHERE DAY(sale_date) = DAY('$currentDate') AND MONTH(sale_date) = MONTH('$currentDate') AND YEAR(sale_date) = YEAR('$currentDate') 
                    ";
        $result = $this->db->query($query);
        return $result;
    }

    public function count_service($currentDate)
    {
        $query = "SELECT IFNULL(SUM(A.QTY), 0) AS total
                    FROM tb_sale_detail A
                    INNER JOIN tb_service B ON A.service_id = B.service_id
                    INNER JOIN tb_sale c on a.sale_id = c.sale_id
                    WHERE DAY(c.sale_date) = DAY('$currentDate') AND MONTH(c.sale_date) = MONTH('$currentDate') AND YEAR(c.sale_date) = YEAR('$currentDate')
                    ";
        $result = $this->db->query($query);
        return $result;
    }

    public function count_product($currentDate)
    {
        $query = "SELECT IFNULL(SUM(A.QTY), 0) AS total
                    FROM tb_sale_detail A
                    INNER JOIN tb_product B ON A.product_id = B.product_id
                    INNER JOIN tb_sale c on a.sale_id = c.sale_id
                    WHERE DAY(c.sale_date) = DAY('$currentDate') AND MONTH(C.sale_date) = MONTH('$currentDate') AND YEAR(C.sale_date) = YEAR('$currentDate')
                    ";
        $result = $this->db->query($query);
        return $result;
    }

    public function top_customer()
    {
        $query = "SELECT * FROM tb_customer WHERE category='CC002' ORDER BY point DESC
                    LIMIT 10; ";
        $result = $this->db->query($query);
        return $result;
    }

    public function total_income($currentDate)
    {
        $query = "SELECT IFNULL(SUM(total_price), 0) AS total
                    FROM tb_sale
                    WHERE MONTH(sale_date) = MONTH('$currentDate') AND YEAR(sale_date) = YEAR('$currentDate')";
        $result = $this->db->query($query);
        return $result;
    }

    public function service_income($currentDate)
    {
        $query = "SELECT IFNULL(SUM(a.total_price), 0) AS total
                    FROM tb_sale_detail a
                    inner join tb_sale b on a.sale_id = b.sale_id
                    WHERE a.service_id is not null AND
                    MONTH(sale_date) = MONTH('$currentDate') AND YEAR(sale_date) = YEAR('$currentDate')";
        $result = $this->db->query($query);
        return $result;
    }

    public function product_income($currentDate)
    {
        $query = "SELECT IFNULL(SUM(a.total_price), 0) AS total
                    FROM tb_sale_detail a
                    inner join tb_sale b on a.sale_id = b.sale_id
                    WHERE a.product_id is not null AND
                    MONTH(sale_date) = MONTH('$currentDate') AND YEAR(sale_date) = YEAR('$currentDate')";
        $result = $this->db->query($query);
        return $result;
    }
}

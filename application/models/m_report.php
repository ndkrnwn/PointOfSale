<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_report extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_customer()
    {
        $query = "SELECT a.*, b.explanation as categoryname, c.name as createdname, d.name as modifyname FROM tb_customer a 
                    INNER JOIN tb_parameter b on a.category = b.code
                    INNER JOIN tb_user c on a.createdby = c.user_id
                    LEFT JOIN tb_user d on a.modifyby = d.user_id 
                    ORDER BY a.name ASC";
        $result = $this->db->query($query);
        return $result;
    }

    public function get_product()
    {
        $query = "SELECT a.*, b.name as createdname, c.name as modifyname FROM tb_product a 
                    INNER JOIN tb_user b on a.createdby = b.user_id
                    LEFT JOIN tb_user c on a.modifyby = c.user_id 
                    ORDER BY a.name ASC";
        $result = $this->db->query($query);
        return $result;
    }

    public function get_treatment()
    {
        $query = "SELECT a.*, b.explanation as categoryname, c.name as createdname, d.name as modifyname FROM tb_service a 
                    INNER JOIN tb_parameter b on a.category = b.code
                    INNER JOIN tb_user c on a.createdby = c.user_id
                    LEFT JOIN tb_user d on a.modifyby = d.user_id 
                    ORDER BY a.name ASC";
        $result = $this->db->query($query);
        return $result;
    }

    public function get_stock_in($month = null, $year = null)
    {
        // Menyusun kondisi WHERE berdasarkan parameter yang diberikan
        $whereConditions = ["type = 'in'"];

        if ($month !== null) {
            $whereConditions[] = "MONTH(a.date) = '$month'";
        }

        if ($year !== null) {
            $whereConditions[] = "YEAR(a.date) = '$year'";
        }

        // Menggabungkan kondisi WHERE
        $whereClause = implode(' AND ', $whereConditions);

        // Menyusun kueri
        $query = "SELECT a.*, b.name as productname, c.name as createdname 
              FROM tb_stock a 
              INNER JOIN tb_product b ON a.product_id = b.product_id
              INNER JOIN tb_user c ON a.createdby = c.user_id
              WHERE $whereClause
              ORDER BY productname ASC";

        // Menjalankan kueri
        $result = $this->db->query($query);
        return $result;
    }

    public function get_stock_out($month = null, $year = null)
    {
        // Menyusun kondisi WHERE berdasarkan parameter yang diberikan
        $whereConditions = ["type = 'out'"];

        if ($month !== null) {
            $whereConditions[] = "MONTH(a.date) = '$month'";
        }

        if ($year !== null) {
            $whereConditions[] = "YEAR(a.date) = '$year'";
        }

        // Menggabungkan kondisi WHERE
        $whereClause = implode(' AND ', $whereConditions);

        // Menyusun kueri
        $query = "SELECT a.*, b.name as productname, c.name as createdname 
              FROM tb_stock a 
              INNER JOIN tb_product b ON a.product_id = b.product_id
              INNER JOIN tb_user c ON a.createdby = c.user_id
              WHERE $whereClause
              ORDER BY productname ASC";

        // Menjalankan kueri
        $result = $this->db->query($query);
        return $result;
    }

    public function get_transaction($month = null, $year = null)
    {
        // Menyusun kondisi WHERE berdasarkan parameter yang diberikan
        if ($month !== null) {
            $whereConditions[] = "MONTH(a.sale_date) = '$month'";
        }

        if ($year !== null) {
            $whereConditions[] = "YEAR(a.sale_date) = '$year'";
        }

        // Menggabungkan kondisi WHERE
        $whereClause = implode(' AND ', $whereConditions);

        // Menyusun kueri

        $query = "SELECT a.*, b.name as customername, c.name as createdname FROM tb_sale a 
                    INNER JOIN tb_customer b on a.customer_id = b.customer_id
                    INNER JOIN tb_user c on a.createdby = c.user_id
                    WHERE $whereClause
                    ORDER BY invoice ASC";
        $result = $this->db->query($query);
        return $result;
    }

    public function get_detail_transaction($month = null, $year = null)
    {

        // Menyusun kondisi WHERE berdasarkan parameter yang diberikan
        if ($month !== null) {
            $whereConditions[] = "MONTH(c.sale_date) = '$month'";
        }

        if ($year !== null) {
            $whereConditions[] = "YEAR(c.sale_date) = '$year'";
        }

        // Menggabungkan kondisi WHERE
        $whereClause = implode(' AND ', $whereConditions);

        // Menyusun kueri

        $query = "SELECT c.sale_date as sale_date, C.invoice AS invoice,  C.payment as payment, D.name as customername, A.*, B.PRODUCT_ID AS item_id, B.NAME AS item_name, 'Product' AS type FROM TB_SALE_DETAIL AS A 
                        INNER JOIN TB_PRODUCT B ON A.PRODUCT_ID = B.PRODUCT_ID
                        INNER JOIN TB_SALE C ON A.sale_id = C.sale_id
                        INNER JOIN tb_customer D ON C.customer_id = D.customer_id
                        WHERE $whereClause
                UNION ALL
                  SELECT c.sale_date as sale_date, C.invoice AS invoice,  C.payment as payment, D.name as customername,  A.*, B.SERVICE_ID AS item_id, B.NAME AS item_name, 'Treatment' AS type FROM TB_SALE_DETAIL AS A 
                        INNER JOIN TB_SERVICE B ON A.SERVICE_ID = B.SERVICE_ID
                        INNER JOIN TB_SALE C ON A.sale_id = C.sale_id
                        INNER JOIN tb_customer D ON C.customer_id = D.customer_id
                        WHERE $whereClause
                ORDER BY invoice ASC";
        $result = $this->db->query($query);
        return $result;
    }

    public function get_reviews($month = null, $year = null)
    {
        // Menyusun kondisi WHERE berdasarkan parameter yang diberikan
        if ($month !== null) {
            $whereConditions[] = "MONTH(a.created_date) = '$month'";
        }

        if ($year !== null) {
            $whereConditions[] = "YEAR(a.created_date) = '$year'";
        }

        // Menggabungkan kondisi WHERE
        $whereClause = implode(' AND ', $whereConditions);

        // Menyusun kueri

        $query = "SELECT b.name as customername, c.name as productname, a.comment as comment, a.grade as grade, a.created_date as created_date FROM tb_review a 
                    INNER JOIN tb_customer b on a.customer_id = b.customer_id
                    INNER JOIN tb_product c on a.product_id = c.product_id
                    WHERE $whereClause
                    ORDER BY created_date ASC";
        $result = $this->db->query($query);
        return $result;
    }

    public function get_surveys($month = null, $year = null)
    {
        // Menyusun kondisi WHERE berdasarkan parameter yang diberikan
        if ($month !== null) {
            $whereConditions[] = "MONTH(a.created_date) = '$month'";
        }

        if ($year !== null) {
            $whereConditions[] = "YEAR(a.created_date) = '$year'";
        }

        // Menggabungkan kondisi WHERE
        $whereClause = implode(' AND ', $whereConditions);

        // Menyusun kueri

        $query = "SELECT b.name as customername, a.* FROM tb_survey a 
                    INNER JOIN tb_customer b on a.customer_id = b.customer_id
                    WHERE $whereClause
                    ORDER BY created_date ASC";
        $result = $this->db->query($query);
        return $result;
    }

    public function get_month_year_sale($year)
    {
        $query = "SELECT
                                MONTH(saledate2) AS bulan_angka,
                                CASE
                                    WHEN MONTH(saledate2) = 1 THEN 'Januari'
                                    WHEN MONTH(saledate2) = 2 THEN 'Februari'
                                    WHEN MONTH(saledate2) = 3 THEN 'Maret'
                                    WHEN MONTH(saledate2) = 4 THEN 'April'
                                    WHEN MONTH(saledate2) = 5 THEN 'Mei'
                                    WHEN MONTH(saledate2) = 6 THEN 'Juni'
                                    WHEN MONTH(saledate2) = 7 THEN 'Juli'
                                    WHEN MONTH(saledate2) = 8 THEN 'Agustus'
                                    WHEN MONTH(saledate2) = 9 THEN 'September'
                                    WHEN MONTH(saledate2) = 10 THEN 'Oktober'
                                    WHEN MONTH(saledate2) = 11 THEN 'November'
                                    WHEN MONTH(saledate2) = 12 THEN 'Desember'
                                END AS bulan,
                                type,
                                COALESCE(SUM(grandtotal), '-') AS total_harga
                            FROM (
                                SELECT 
                                    C.invoice, 
                                    C.payment, 
                                    c.sale_date AS saledate2, 
                                    D.name AS customername, 
                                    A.*, 
                                    B.PRODUCT_ID AS item_id, 
                                    B.NAME AS item_name, 
                                    'Product' AS type, 
                                    a.total_price AS grandtotal
                                FROM TB_SALE_DETAIL AS A
                                INNER JOIN TB_PRODUCT B ON A.PRODUCT_ID = B.PRODUCT_ID
                                INNER JOIN TB_SALE C ON A.sale_id = C.sale_id
                                INNER JOIN tb_customer D ON C.customer_id = D.customer_id
                                WHERE 'Product' = 'Product'
                                
                                UNION ALL
                                
                                SELECT 
                                    C.invoice, 
                                    C.payment, 
                                    c.sale_date AS saledate2, 
                                    D.name AS customername, 
                                    A.*, 
                                    B.SERVICE_ID AS item_id, 
                                    B.NAME AS item_name, 
                                    'Treatment' AS type, 
                                    a.total_price AS grandtotal
                                FROM TB_SALE_DETAIL AS A
                                INNER JOIN TB_SERVICE B ON A.SERVICE_ID = B.SERVICE_ID
                                INNER JOIN TB_SALE C ON A.sale_id = C.sale_id
                                INNER JOIN tb_customer D ON C.customer_id = D.customer_id
                                WHERE 'Treatment' = 'Treatment'
                            ) AS merged_data
                            GROUP BY bulan_angka, type
                            ORDER BY bulan_angka ASC, type ASC;";
        $result = $this->db->query($query);
        return $result;
    }
}

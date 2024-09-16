<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['m_product', 'm_service', 'm_sales', 'm_customer']);
    }

    // Index page for transaction
    public function transaction()
    {

        $date = new DateTime();
        $timezone = new DateTimeZone('Asia/Kuala_Lumpur');
        $date->setTimezone($timezone);

        $currentDateTime = $date->format('Y-m-d H:i:s');

        $data['customer'] = $this->m_customer->get();
        $data['invoice'] = $this->m_sales->invoice_no();
        $data['cart'] = $this->m_sales->get_cart();
        $data['product'] = $this->m_product->get();
        $data['service'] = $this->m_service->get();
        $data['date'] = $currentDateTime;
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/index', $data);
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // Index page for list transaction
    public function report_sales()
    {
        $data['row'] = $this->m_sales->get()->result();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/report', $data);
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // Function to show detail sale on list transaction
    public function detail_report($sale_id = null)
    {
        $detail = $this->m_sales->get_sale_detail($sale_id);
        if ($detail->num_rows() > 0) {
            $item = $detail->result_array();
            array_walk_recursive($item, function (&$item) {
                $item = strval($item);
            });
            echo json_encode($item);
        }
    }

    // Function to print receipt 
    public function print($id)
    {
        $sale = $this->m_sales->get($id)->row();
        $data = array(
            'sale' => $sale,
            'sale_detail' => $this->m_sales->get_sale_detail($id)->result(),
        );
        $this->load->view('sales/receipt', $data);
    }

    // Function to show cart data
    function cart_data()
    {
        $data['cart'] = $this->m_sales->get_cart();
        $this->load->view('sales/cart_data', $data);
    }

    // Function to process add / edit cart / process payment
    public function process()
    {
        $post = $this->input->post(null, TRUE);

        if (isset($_POST['add_cart'])) {
            $this->m_sales->add_cart($post);
            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        } else if (isset($_POST['edit_cart'])) {
            $this->m_sales->edit_cart($post);
            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        } else if (isset($_POST['process_transaction'])) {
            $sale_id = $this->m_sales->add_sale_item($post);

            $cart = $this->m_sales->get_cart();

            $serviceItems = [];
            $productItems = [];

            $method_payment = isset($post['method_payment']) ? $post['method_payment'] : '';

            foreach ($cart as $c => $value) {
                $itemType = $value->item_type;

                if ($itemType == 'service') {
                    $serviceItems[] = array(
                        'sale_id' => $sale_id,
                        'service_id' => $value->item_id,
                        'detail_price' => $value->item_price,
                        'qty' => $value->qty,
                        'discount_item' => $value->discount_item,
                        'sub_price' => $value->sub_price,
                        'disc_total' => $value->disc_total,
                        'total_price' => $value->total_price,
                    );
                } elseif ($itemType == 'product') {
                    // Set values to 0 if payment method is POINT
                    if ($method_payment === 'POINT') {
                        $price = 0;
                        $discount = 0;
                        $sub_price = 0;
                        $total = 0;
                    } else {
                        $price = $value->item_price;
                        $discount = $value->discount_item;
                        $sub_price = $value->sub_price;
                        $total = $value->total_price;
                    }

                    $productItems[] = array(
                        'sale_id' => $sale_id,
                        'product_id' => $value->item_id,
                        'detail_price' => $price,
                        'qty' => $value->qty,
                        'discount_item' => $discount,
                        'sub_price' => $sub_price,
                        'disc_total' => $value->disc_total,
                        'total_price' => $total,
                    );
                    $this->m_sales->update_stock($value->item_id, $value->qty);
                }
            }

            // Masukkan serviceItems ke database
            if (!empty($serviceItems)) {
                $this->m_sales->add_sale_item_detail($serviceItems);
            }

            // Masukkan productItems ke database
            if (!empty($productItems)) {
                $this->m_sales->add_sale_item_detail($productItems);
            }

            $this->m_sales->del_cart(['createdby' => $this->session->userdata('ses_id')]);
            $this->m_sales->update_point($post['customer_id'], $post['point']);
            $this->m_sales->update_pay_point($post['customer_id'], $post['pay_point']);
            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true, "sale_id" => $sale_id);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }
    }

    // Function to process delete cart or cancel payment
    public function cart_del()
    {
        if (isset($_POST['cancel_payment'])) {
            $this->m_sales->del_cart(['createdby' => $this->session->userdata('ses_id')]);
        } else if (isset($_POST['del_cart'])) {
            $id = $this->input->post('id');
            $this->m_sales->del_cart(['cart_id' => $id]);
        }
        if ($this->db->affected_rows() > 0) {
            $params = array("success" => true);
        } else {
            $params = array("success" => false);
        }
        echo json_encode($params);
    }

    // Function to process delete sale record
    public function del_sales()
    {
        $id = $this->input->post('sale_id', TRUE);

        if (isset($_POST['delete'])) {
            $sale_detail = $this->m_sales->get_sale_product($id)->result();
            foreach ($sale_detail as $s => $value) {
                $item_id = $value->item_id;
                $qty = $value->qty;
                $this->m_sales->update_stock_del($item_id, $qty);
            }

            $sale = $this->m_sales->get($id)->row();
            $point = $sale->point;
            $customer_id = $sale->customer_id;

            $this->m_sales->update_point_del($point, $customer_id);
            $this->m_sales->sale_detail_del($id);
            $this->m_sales->sale_del($id);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('deleted', 'Sale record has been deleted successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete sale record');
            }
        }
    }
}

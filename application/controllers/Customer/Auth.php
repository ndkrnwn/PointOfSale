<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    // Function index for login page
    public function login()
    {
        check_already_login_cust();
        $data['title'] = 'Login Page';
        $this->load->view('login/customer', $data);
    }

    // Function process for login
    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($post['login'])) {
            $this->load->model('m_customer');
            $query = $this->m_customer->login($post);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $params = array(
                    'ses_id' => $row->customer_id,
                    'ses_name' => $row->name,
                );
                $this->session->set_userdata($params);
                $this->session->set_flashdata('login', 'Signed in successfully');
                echo "<script>
                            window.location='" . site_url('home') . "';
                        </script>";
            } else {
                $this->session->set_flashdata('login_failed', 'Sorry, your username or password are incorrect!');
                echo "<script>window.location='" . site_url('login') . "';</script>";
            }
        }
    }

    // Function process for logout
    public function logout()
    {
        $params = array(
            'ses_id',
            'ses_name',
        );
        $this->session->unset_userdata($params);
        echo "<script>
		window.location='" . site_url('login') . "';
		</script>";
    }
}

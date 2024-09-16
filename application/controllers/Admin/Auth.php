<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    // Index page for login
    public function login()
    {
        check_already_login();
        $data['title'] = 'Login Page';
        $this->load->view('login/admin', $data);
    }

    // Function to process login admin
    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($post['login'])) {
            $this->load->model('m_user');
            $query = $this->m_user->login($post);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $params = array(
                    'ses_id' => $row->user_id,
                    'ses_level' => $row->level,
                    'ses_name' => $row->name,
                    'ses_uname' => $row->username,
                );
                $this->session->set_userdata($params);
                $this->session->set_flashdata('login', 'Signed in successfully');
                echo "<script>
                            window.location='" . site_url('admin/dashboard') . "';
                        </script>";
            } else {
                $this->session->set_flashdata('login_failed', 'Sorry, your username or password are incorrect!');
                echo "<script>window.location='" . site_url('admin') . "';</script>";
            }
        }
    }

    // Function to process logout admin
    public function logout()
    {
        $params = array('ses_id', 'ses_level', 'ses_name', 'ses_uname');
        $this->session->unset_userdata($params);
        echo "<script>
		window.location='" . site_url('admin') . "';
		</script>";
    }
}

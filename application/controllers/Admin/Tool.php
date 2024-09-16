<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tool extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model(['m_customer']);
        $this->load->library('email');
    }

    // Index page for broadcast
    public function broadcast()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('tool/broadcast');
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    //Function to process sending an email
    public function kirim()
    {
        if (isset($_POST['send_message'])) {

            // Ambil data email customer
            $emails = $this->m_customer->get_email();

            $subject = $this->input->post('subject', TRUE);
            $message = $this->input->post('message', TRUE);
            $file_data = $this->upload_file();

            if (isset($file_data['error'])) {
                $this->session->set_flashdata('error', 'Error: ' . $file_data['error']);
                redirect('admin/tool/broadcast');
                return;
            }

            if (isset($file_data['full_path'])) {
                $email_success_message = 'Email has been sent successfully with attachment';
            } else {
                $email_success_message = 'Email has been sent successfully without attachment';
            }

            if (!empty($emails)) {
                $batch_size = 50; // Set the batch size
                $batches = array_chunk($emails, $batch_size); // Split emails into batches

                foreach ($batches as $batch) {
                    foreach ($batch as $mail) {
                        if (isset($mail->email)) {
                            $this->email->clear();
                            $this->email->from('info-promo@notification.com', 'POINT OF SALE');
                            $this->email->subject($subject);
                            $this->email->message($message);
                            $this->email->to($mail->email);
                            if (isset($file_data['full_path'])) {
                                $this->email->attach($file_data['full_path']);
                            }

                            if (!$this->email->send()) {
                                $this->session->set_flashdata('error', 'Email could not be sent: ' . $this->email->print_debugger());
                                redirect('admin/tool/broadcast');
                                return;
                            }
                        } else {
                            $this->session->set_flashdata('error', 'Error: Email property is undefined for a record.');
                            redirect('admin/tool/broadcast');
                            return;
                        }
                    }

                    // Small delay to prevent server overload
                    sleep(1);
                }

                // Delete the file after all emails have been sent
                if (isset($file_data['file_path'])) {
                    delete_files($file_data['file_path']);
                }

                $this->session->set_flashdata('success', $email_success_message);
            } else {
                // Logika jika tidak ada email yang ditemukan
                $this->session->set_flashdata('error', 'No email addresses found in database.');
            }

            redirect('admin/tool/broadcast');
        }
    }

    //Function to process upload file / attachment email
    public function upload_file()
    {
        if (isset($_FILES["attachment"]["name"]) && !empty($_FILES["attachment"]["name"])) {
            $path = APPPATH . '../uploads/email/';
            if (!is_dir($path)) {
                mkdir($path, 0655, true);
            }

            $upload_config = array(
                'upload_path' => $path,
                'allowed_types' => 'jpg|jpeg|pdf|xls|xlsx|png',
            );

            $this->load->library('upload', $upload_config);
            $this->upload->initialize($upload_config);

            if ($this->upload->do_upload('attachment')) {
                return array(
                    'full_path' => $this->upload->data('full_path'),
                    'file_path' => $this->upload->data('file_path')
                );
            } else {
                return array('error' => $this->upload->display_errors());
            }
        }
    }
}

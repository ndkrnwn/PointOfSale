<?php

function check_already_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('ses_id');
    if ($user_session) {
        redirect('admin/dashboard');
    }
}

function check_already_login_cust()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('ses_id');
    if ($user_session) {
        redirect('home');
    }
}

function check_not_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('ses_id');
    if (!$user_session) {
        redirect('admin');
    }
}

function check_not_login_cust()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('ses_id');
    if (!$user_session) {
        redirect('login');
    }
}

function check_admin()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level != 'UL001') {
        redirect('admin/sales/transaction');
    }
}

function indo_date($date)
{
    $d = substr($date, 8, 2);
    $m = substr($date, 5, 2);
    $y = substr($date, 0, 4);
    return $d . '/' . $m . '/' . $y;
}

function indo_currency($nominal)
{
    $result  = "Rp " . number_format($nominal, 2, ",", ".");
    return $result;
}

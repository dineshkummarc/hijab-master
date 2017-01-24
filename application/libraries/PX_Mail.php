<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PX_Mail 
{
    private $px_instance; // CI Instance

    public function __construct()
    {
        $this->px_instance = &get_instance();
        $this->px_instance->load->library('email');
        $this->px_instance->load->config('px_mail');
        $this->px_instance->email->initialize($this->px_instance->config->item('email'));
        $this->px_instance->email->from('noreply@hijabdept.com', 'Hijab Dept');
    }

    public function send_mail_registration($email_to, $data)
    {
        if($data){
            $this->px_instance->email->to($email_to);
            $message = $this->px_instance->load->view('email/regist_success', $data, TRUE);
            $this->px_instance->email->subject('Registration Success');
            $this->px_instance->email->message($message);

            $this->px_instance->email->send();
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function send_mail_order_success($email_to, $data){
        if($data){
            $this->px_instance->email->to($email_to);
            $message = $this->px_instance->load->view('email/order_success', $data, TRUE);
            $this->px_instance->email->subject('Order Success');
            $this->px_instance->email->message($message);
        
        $this->px_instance->email->send();
            return TRUE;
        } 
        else {
            return FALSE;
        }
    }

    public function send_mail_order_paid($email_to, $data){
        if($data){
            $this->px_instance->email->to($email_to);
            $message = $this->px_instance->load->view('email/order_paid', $data, TRUE);
            $this->px_instance->email->subject('Order Paid');
            $this->px_instance->email->message($message);

            $this->px_instance->email->send();
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function send_mail_order_shipped($email_to, $data){
        if($data){
            $this->px_instance->email->to($email_to);
            $message = $this->px_instance->load->view('email/order_shipped', $data, TRUE);
            $this->px_instance->email->subject('Order Shipped');
            $this->px_instance->email->message($message);

            $this->px_instance->email->send();
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function send_mail_reset_password($email_to, $data){
        if($data){
            $this->px_instance->email->to($email_to);
            $message = $this->px_instance->load->view('email/reset_pass', $data, TRUE);
            $this->px_instance->email->subject('Reset Password');
            $this->px_instance->email->message($message);

            $this->px_instance->email->send();
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
}

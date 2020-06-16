<?php
class Fungsi
{

    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login(){
        $this->ci->load->model('UserModel');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->UserModel->get($user_id)->row();
        return $user_data;
    }
}
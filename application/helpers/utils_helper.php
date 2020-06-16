<?php

function isLogin(){
	$ci = &get_instance();
	if(!$ci->session->userdata('is_login_pwl')){
		redirect("login");
	}
}

function formatRupiah($angka){
	return "Rp.".number_format($angka, 2,",",".").",-";
}

function sendEmail($subject, $data, $view) {
	$CI = &get_instance();
	$config = array(
		'useragent' => 'CodeIgniter',
		'protocol' => 'smtp',
		'mailpath' => '/usr/sbin/sendmail',
		'smtp_host' => 'smtp.gmail.com',
		'smtp_port' => 465,
		'smtp_user' => 'darkinvander1892@gmail.com',
        'smtp_pass' => "yasircahliverpool1892",
		'smtp_keepalive' => TRUE,
		'smtp_crypto' => 'ssl',
		'wordwrap' => TRUE,
		'wrapchars' => 76,
		'mailtype' => 'html',
		'charset' => 'utf-8',
		'validate' => TRUE,
		'crlf' => "\r\n",
		'newline' => "\r\n",
	);
	$body = $CI->load->view("mail/" . $view, $data, TRUE);
	$CI->email->initialize($config);
	$CI->email->from('darkinvander1892@gmail.com', 'PWL Aplikasi Kasir');
	$CI->email->to($data["email_user"]);
	$CI->email->subject($subject);
	$CI->email->message($body);
	if ($CI->email->send()) {
		return "1";
	} else {
		echo $CI->email->print_debugger();
		return "0";
	}
}

function randomPassword() {
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < 8; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}

if (!function_exists('bulan')) {
	function bulan($bln) {
		switch ($bln) {
		case 1:
			return "Januari";
			break;
		case 2:
			return "Februari";
			break;
		case 3:
			return "Maret";
			break;
		case 4:
			return "April";
			break;
		case 5:
			return "Mei";
			break;
		case 6:
			return "Juni";
			break;
		case 7:
			return "Juli";
			break;
		case 8:
			return "Agustus";
			break;
		case 9:
			return "September";
			break;
		case 10:
			return "Oktober";
			break;
		case 11:
			return "November";
			break;
		case 12:
			return "Desember";
			break;
		}
	}
}

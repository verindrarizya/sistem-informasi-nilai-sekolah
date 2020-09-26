<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->model('Login_model');
		$this->load->model('Admin_model');
	}

	public function index(){
		$this->load->view('login_view');
	}

	function login(){
        $username = $this->input->post('username');
		$password =	md5($this->input->post('password'));
		$cek = $this->Login_model->cek($username,$password);
		if($cek->num_rows()==1){
			foreach($cek->result() as $data){
				$sess_data['username'] = $data->username;
                $sess_data['password'] = $data->password;
				$sess_data['level'] = $data->level;
				$sess_data['nama'] = $data->nama;
				$this->session->set_userdata($sess_data);
			}
			echo "<script>alert('Login Berhasil'); window.location = '".base_url('index.php/login/dashboard')."'</script>";
		}else{
			echo "<script>alert('Username/Password Salah'); window.location = '".base_url('index.php/login/')."'</script>";
		}
	}

	function logout(){
		$array_items = array('username', 'passowrd', 'level', 'nama');
		$this->session->unset_userdata($array_items);
		echo "<script>alert('Berhasil Logout dari Sistem!'); window.location = '".base_url('index.php/login/')."'</script>";
	}

    function dashboard(){
        if($this->session->userdata('username')==null){
			echo "<script>alert('Anda Belum Login!'); window.location = '".base_url('index.php/login/')."'</script>";
		}else{
            if($this->session->userdata('level')=='admin'){
				$data['jumsis'] = $this->Admin_model->hitung_siswa();
				$data['jumpel'] = $this->Admin_model->hitung_mapel();
				$this->load->view('dashboard_admin',$data);
			}else{
				$data['siswa'] = $this->Login_model->detail($this->session->userdata('username'));
				$this->load->view('dashboard_siswa', $data);
			}
		}
    }
}


?>
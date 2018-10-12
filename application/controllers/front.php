<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends CI_Controller {

	public function index()
	{
		$this->front_model->getFront();
		if($this->session->userdata('logged_in')=="")
		{	
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('front');
			}
			else
			{
				$dt['username'] = $this->input->post('username');
				$dt['password'] = $this->input->post('password');
				$this->app_login_model->getLoginData($dt);
			}
		}
		else if($this->session->userdata('logged_in')!="")
		{
			header('location:'.base_url().'dashboard');
		}
	}
	
	public function pengumuman(){
		$this->front_model->getFront();
		$this->session->set_userdata('periode',$this->input->post('periode'));
		$this->load->view('pengumuman');
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		header('location:'.base_url().'');
	}
}

/* End of file front.php */
/* Location: ./application/controllers/front.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Psb_Login_Model extends CI_Model {

	public function getLoginData($data)
	{
		$login['email'] = $data['username'];
		$login['password'] = md5($data['password'].'@adDunyaa2$MataaAdDunyaa%4#AlMarAtus91Sholihah');
		//echo $login['email']." - ".$login['password'];
		$cek = $this->db->get_where('pendaftar', $login);
		if($cek->num_rows()>0)
		{
			foreach($cek->result() as $qad)
			{
				$sess_data['logged_in'] = 'yesGetMeLoginBaby';
				$sess_data['id_user'] = $qad->id_pendaftar;
				$sess_data['username'] = $qad->nama_calon_santri;
				$sess_data['password'] = $qad->password;
				$sess_data['option'] = '';
				$this->session->set_userdata($sess_data);
			}
			header('location:'.base_url().'psb/dashboard');
		}
		else
		{
			$this->session->set_flashdata('result_login', "Maaf, kombinasi username dan password yang anda masukkan tidak valid dengan database kami.");
			header('location:'.base_url().'psb');
		}
	}
}

/* End of file psb_login_model.php */
/* Location: ./application/models/psb_login_model.php */
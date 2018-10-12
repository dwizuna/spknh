<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front_Model extends CI_Model {

	public function getFront()
	{
		$cek = $this->db->query('select s.creator, s.judul, s.desc, s.nav, s.logo, t.tema from setting s, tema t where s.tema = t.id_tema');
		if($cek->num_rows()>0)
		{
			foreach($cek->result() as $qad)
			{
				$sess_data['creator'] = $qad->creator;
				$sess_data['judul'] = $qad->judul;
				$sess_data['desc'] = $qad->desc;
				$sess_data['nav'] = $qad->nav;
				$sess_data['logo'] = $qad->logo;
				$sess_data['tema'] = $qad->tema;
				$sess_data['version'] = 'Version 0.1.a';
				$this->session->set_userdata($sess_data);
			}
		}
	}
	
	public function getStats()
	{
		$query = $this->db->query('SELECT * FROM user');
		$sess_data['jml_user'] = $query->num_rows();
		$query = $this->db->query('SELECT * FROM guru');
		$sess_data['jml_guru'] = $query->num_rows();
		$this->session->set_userdata($sess_data);
	}
}

/* End of file front_model.php */
/* Location: ./application/models/front_model.php */
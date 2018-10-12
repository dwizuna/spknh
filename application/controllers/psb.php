<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Psb extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}
	
	public function index()
	{
		$this->psb_model->getFront();
		if($this->session->userdata('logged_in')=="")
		{	
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('psb_front');
			}
			else
			{
				$dt['username'] = $this->input->post('username');
				$dt['password'] = $this->input->post('password');
				$this->psb_login_model->getLoginData($dt);
			}
		}
		else if($this->session->userdata('logged_in')!="")
		{
			header('location:'.base_url().'psb/dashboard');
		}
		/*else if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="user")
		{
			header('location:'.base_url().'dashboard_operator');
		}*/
	}
	
	public function dashboard()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!="" && $this->session->userdata('logged_in') == 'yesGetMeLoginBaby'){
			$this->psb_model->getStats();
			$this->session->set_userdata('option','dashboard');
			$this->load->view('psb_dashboard.php');
		}
		else
			header('location:'.base_url().'psb');
	}
	
	public function data(){
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!=""){
			$this->session->set_userdata('option','calon santri');
			$crud = new grocery_CRUD();
			$crud->set_table('pendaftar');
			$crud->set_subject('Pendaftar');
			$crud->where('nama_calon_santri',$this->session->userdata('username'));
			$crud->columns('PID','email','password','nama_calon_santri','tempat_lahir','tanggal_lahir','jenis_kelamin');
			$crud->fields('email','nama_calon_santri','tempat_lahir','tanggal_lahir','jenis_kelamin','pendidikan_formal_terakhir','pernah_masuk_pesantren','nama_ayah','pekerjaan_ayah','agama_ayah','nama_ibu','pekerjaan_ibu','agama_ibu','alamat','no_telepon','nama_wali','pekerjaan_wali','alamat_wali');
			$crud->field_type('jenis_kelamin','dropdown', array('laki-laki' => 'laki-laki', 'perempuan' => 'perempuan'));
			$crud->field_type('pendidikan_formal_terakhir','dropdown', array('SD' => 'SD', 'MI' => 'MI', 'SMP' => 'SMP', 'MTS' => 'MTS', 'SMA' => 'SMA', 'MA' => 'MA', 'SMK' => 'SMK'));
			$crud->field_type('pernah_masuk_pesantren','dropdown', array('pernah' => 'pernah', 'tidak pernah' => 'tidak pernah'));
			$crud->field_type('agama_ayah','dropdown', array('Islam' => 'Islam', 'Kristen' => 'Kristen', 'Hindu' => 'Hindu', 'Budha' => 'Budha', 'Lainnya' => 'Lainnya'));
			$crud->field_type('agama_ibu','dropdown', array('Islam' => 'Islam', 'Kristen' => 'Kristen', 'Hindu' => 'Hindu', 'Budha' => 'Budha', 'Lainnya' => 'Lainnya'));
			$crud->required_fields('email','password','nama_calon_santri','tempat_lahir','tanggal_lahir','jenis_kelamin','pendidikan_formal_terakhir','pernah_masuk_pesantren','alamat','no_telepon');
			$crud->unset_add()
				 ->unset_delete()
				 ->unset_print()
				 ->unset_export()
				 ->unset_read();
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'psb');
	}
	
	public function formulir(){
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!=""){
			//fetch all data from pendaftar
			$query = $this->db->query('select * from pendaftar
										where id_pendaftar = '.$this->session->userdata('id_user').';');

			foreach ($query->result() as $row)
			{
					//echo $row->PID;
					//echo $row->nama_calon_santri;
					//echo $row->email;
			}
			
			$this->load->library('Pdf');
			
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
			$pdf->SetTitle('Formulir Radior Dirgantara');
			$pdf->SetAutoPageBreak(true);
			$pdf->SetAuthor('Ipang Dwi for PPDI');
			$pdf->SetDisplayMode('real', 'default');
			// set default header data
			//$pdf->SetHeaderData('logo-header.png', '100', '', 'C', array(0,64,255), array(0,64,128));
			$pdf->setFooterData(array(0,64,0), array(0,64,128));

			// set header and footer fonts
			//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));	
			
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			// remove default header/footer
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(true);
			
			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, 5, PDF_MARGIN_RIGHT);
			//$pdf->SetHeaderMargin('5');
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, 0);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set default font subsetting mode
			$pdf->setFontSubsetting(true);

			// Set font
			// dejavusans is a UTF-8 Unicode font, if you only need to
			// print standard ASCII chars, you can use core fonts like
			// helvetica or times to reduce file size.
			$pdf->SetFont('times', '', 12, '', true);
			
			$pdf->AddPage();
			
			// -- set new background ---

			// get the current page break margin
			$bMargin = $pdf->getBreakMargin();
			// get current auto-page-break mode
			$auto_page_break = $pdf->getAutoPageBreak();
			// disable auto-page-break
			$pdf->SetAutoPageBreak(false, 0);
			// set bacground image
			$img_file = base_url().'assets/dist/img/watermark.jpg';
			$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
			// restore auto-page-break status
			$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
			// set the starting point for the page content
			$pdf->setPageMark();
			
			//hari by ipang - www.firstplato.com
			$hari = date('l');
			if($hari=='Sunday') $hari = 'Minggu';
			if($hari=='Monday') $hari = 'Senin';
			if($hari=='Tuesday') $hari = 'Selasa';
			if($hari=='Wednesday') $hari = 'Rabu';
			if($hari=='Thursday') $hari = 'Kamis';
			if($hari=='Friday') $hari = "Jum'at";
			if($hari=='Saturday') $hari = 'Sabtu';
			
			//bulan by ipang - www.firstplato.com
			function bulan($bulan){
				if($bulan==1) return $bulan = 'Januari';
				if($bulan==2) return $bulan = 'Februari';
				if($bulan==3) return $bulan = 'Maret';
				if($bulan==4) return $bulan = 'April';
				if($bulan==5) return $bulan = 'Mei';
				if($bulan==6) return $bulan = 'Juni';
				if($bulan==7) return $bulan = 'Juli';
				if($bulan==8) return $bulan = 'Agustus';
				if($bulan==9) return $bulan = 'September';
				if($bulan==10) return $bulan = 'Oktober';
				if($bulan==11) return $bulan = 'November';
				if($bulan==12) return $bulan = 'Desember';
			}
			
			//ctw by ipang - www.firstplato.com
			function ctw($cur,$f){
				$l = strlen($cur);
				$c = str_split($cur);
				$w = '';
				$counter = 1;
				$no = 1;
				$non = 1;
				$nonj = 1;
				$nonm = 1;
				$nont = 1;
				$nonb = 1;
				for($i=0;$i<$l;$i++){
					$dec = $l-$i;
					if($c[$i]==1) $v = "satu ";
					if($c[$i]==2) $v = "dua ";
					if($c[$i]==3) $v = "tiga ";
					if($c[$i]==4) $v = "empat ";
					if($c[$i]==5) $v = "lima ";
					if($c[$i]==6) $v = "enam ";
					if($c[$i]==7) $v = "tujuh ";
					if($c[$i]==8) $v = "delapan ";
					if($c[$i]==9) $v = "sembilan ";
					if($c[$i]==0) $v = "";
					if($dec==17){					// puluhan bilyar
						if($v=="satu "){				
							if($c[$i+1]==0) $w = $w."sepuluh ";
							if($c[$i+1]==1) $w = $w."sebelas ";
							if($c[$i+1]==2) $w = $w."dua belas ";
							if($c[$i+1]==3) $w = $w."tiga belas ";
							if($c[$i+1]==4) $w = $w."empat belas ";
							if($c[$i+1]==5) $w = $w."lima belas ";
							if($c[$i+1]==6) $w = $w."enam belas ";
							if($c[$i+1]==7) $w = $w."tujuh belas ";
							if($c[$i+1]==8) $w = $w."delapan belas ";
							if($c[$i+1]==9) $w = $w."sembilan belas ";
							$nonb = 0;
						}
						else if($v=="") $w = $w."";
						else
							$w = $w."".$v." puluh ";
					}
					if($dec==16){					// bilyar
						if($nonb==1){ 
							if($v==""&&$c[$i-1]==0&&$c[$i-2]==0) $w = $w."";
							else $w = $w."".$v." bilyar ";
						}  
						else $w = $w."bilyar ";
					}
					if($dec==14){					// puluhan trilyun
						if($v=="satu "){				
							if($c[$i+1]==0) $w = $w."sepuluh ";
							if($c[$i+1]==1) $w = $w."sebelas ";
							if($c[$i+1]==2) $w = $w."dua belas ";
							if($c[$i+1]==3) $w = $w."tiga belas ";
							if($c[$i+1]==4) $w = $w."empat belas ";
							if($c[$i+1]==5) $w = $w."lima belas ";
							if($c[$i+1]==6) $w = $w."enam belas ";
							if($c[$i+1]==7) $w = $w."tujuh belas ";
							if($c[$i+1]==8) $w = $w."delapan belas ";
							if($c[$i+1]==9) $w = $w."sembilan belas ";
							$nont = 0;
						}
						else if($v=="") $w = $w."";
						else
							$w = $w."".$v." puluh ";
					}
					if($dec==13){					// trilyun
						if($nont==1){ 
							if($v==""&&$c[$i-1]==0&&$c[$i-2]==0) $w = $w."";
							else $w = $w."".$v." trilyun ";
						}  
						else $w = $w."trilyun ";
					}
					if($dec==11){					// puluhan milyar
						if($v=="satu "){				
							if($c[$i+1]==0) $w = $w."sepuluh ";
							if($c[$i+1]==1) $w = $w."sebelas ";
							if($c[$i+1]==2) $w = $w."dua belas ";
							if($c[$i+1]==3) $w = $w."tiga belas ";
							if($c[$i+1]==4) $w = $w."empat belas ";
							if($c[$i+1]==5) $w = $w."lima belas ";
							if($c[$i+1]==6) $w = $w."enam belas ";
							if($c[$i+1]==7) $w = $w."tujuh belas ";
							if($c[$i+1]==8) $w = $w."delapan belas ";
							if($c[$i+1]==9) $w = $w."sembilan belas ";
							$nonm = 0;
						}
						else if($v=="") $w = $w."";
						else
							$w = $w."".$v." puluh ";
					}
					if($dec==10){					// milyar
						if($nonm==1){ 
							if($v==""&&$c[$i-1]==0&&$c[$i-2]==0) $w = $w."";
							else $w = $w."".$v." milyar ";
						} 
						else $w = $w."milyar ";
					}
					if($dec==8){					// puluhan juta
						if($v=="satu "){				
							if($c[$i+1]==0) $w = $w."sepuluh ";
							if($c[$i+1]==1) $w = $w."sebelas ";
							if($c[$i+1]==2) $w = $w."dua belas ";
							if($c[$i+1]==3) $w = $w."tiga belas ";
							if($c[$i+1]==4) $w = $w."empat belas ";
							if($c[$i+1]==5) $w = $w."lima belas ";
							if($c[$i+1]==6) $w = $w."enam belas ";
							if($c[$i+1]==7) $w = $w."tujuh belas ";
							if($c[$i+1]==8) $w = $w."delapan belas ";
							if($c[$i+1]==9) $w = $w."sembilan belas ";
							$nonj = 0;
						}
						else if($v=="") $w = $w."";
						else
							$w = $w."".$v." puluh ";
					}
					if($dec==7){					// jutaan
						if($nonj==1){ 
							if($v==""&&$c[$i-1]==0&&$c[$i-2]==0) $w = $w."";
							else $w = $w."".$v." juta ";
						}
						else $w = $w."juta ";
					}
					if($dec==5){					// puluhan ribu
						if($v=="satu "){
							if($c[$i+1]==0) $w = $w."sepuluh ";
							if($c[$i+1]==1) $w = $w."sebelas ";
							if($c[$i+1]==2) $w = $w."dua belas ";
							if($c[$i+1]==3) $w = $w."tiga belas ";
							if($c[$i+1]==4) $w = $w."empat belas ";
							if($c[$i+1]==5) $w = $w."lima belas ";
							if($c[$i+1]==6) $w = $w."enam belas ";
							if($c[$i+1]==7) $w = $w."tujuh belas ";
							if($c[$i+1]==8) $w = $w."delapan belas ";
							if($c[$i+1]==9) $w = $w."sembilan belas ";
							$non = 0;
						}
						else if($v=="") $w = $w."";
						else
							$w = $w."".$v." puluh ";
					}
					if($dec==4){					// ribuan
						if($non==1){
							if($v=="satu "&&$l==4) $w = $w."seribu ";
							else if($v==""&&$c[$i-1]==0&&$c[$i-2]==0) $w = $w."";
							else $w = $w."".$v." ribu ";
						} 
						else $w = $w."ribu ";
					} 
					// ratusan, ratusan ribu, ratusan juta, ratusan milyar, ratusan trilyun, ratusan bilyar >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
					if($dec==3||$dec==6||$dec==9||$dec==12||$dec==15||$dec==18){	
						if($v=="satu ") $w = $w."seratus ";
						else if($v=="") $w = $w."";
						else $w = $w."".$v." ratus ";
					} 
					if($dec==2){					// puluhan
						if($v=="satu "){
							if($c[$i+1]==0) $w = $w."sepuluh ";
							if($c[$i+1]==1) $w = $w."sebelas ";
							if($c[$i+1]==2) $w = $w."dua belas ";
							if($c[$i+1]==3) $w = $w."tiga belas ";
							if($c[$i+1]==4) $w = $w."empat belas ";
							if($c[$i+1]==5) $w = $w."lima belas ";
							if($c[$i+1]==6) $w = $w."enam belas ";
							if($c[$i+1]==7) $w = $w."tujuh belas ";
							if($c[$i+1]==8) $w = $w."delapan belas ";
							if($c[$i+1]==9) $w = $w."sembilan belas ";
							$no = 0;
						}
						else if($v=="") $w = $w."";
						else $w = $w."".$v." puluh ";
					} 
					if($dec==1){					// satuan
						if($no==0) $w = $w."";
						else $w = $w."".$v;
					}
					
				}
				if($f==3) return ucwords($w);
				//$w = $w." rupiah";
				if($f==0) return $w;
				else if($f==1) return ucfirst($w);
				else if($f==2) return ucwords($w);
			}
			
			// Set some content to print
			$html = '<p align="center"><img src="'.base_url().'assets/dist/img/logo-header.jpg"><br><br><b>Formulir pendaftaran santri / santriwati baru</b><br><small>ID : '.strtoupper($row->PID).'</small></p>
			<p align="justify">A. Biodata santri / santriwati baru :<br>
			<table cellspacing="0" cellpadding="1" border="0">
				<tr>
					<td width="30">1.</td>
					<td width="175">Nama Calon Santri</td>
					<td width="10">:</td>
					<td width="445">'.ucwords($row->nama_calon_santri).'</td>
				</tr>
				<tr>
					<td>2.</td>
					<td>Tempat / Tgl Lahir</td>
					<td width="10">:</td>
					<td>'.ucwords($row->tempat_lahir).', '.ucwords(date('d',strtotime($row->tanggal_lahir))).' '.ucwords(bulan(date('m',strtotime($row->tanggal_lahir)))).' '.ucwords(date('Y',strtotime($row->tanggal_lahir))).'</td>
				</tr>
				<tr>
					<td width="30">3.</td>
					<td width="175">Jenis Kelamin</td>
					<td width="10">:</td>
					<td width="445">'.ucwords($row->jenis_kelamin).'</td>
				</tr>
				<tr>
					<td width="30">4.</td>
					<td width="175">Pendidikan Formal Terakhir</td>
					<td width="10">:</td>
					<td width="445">'.ucwords($row->pendidikan_formal_terakhir).'</td>
				</tr>
				<tr>
					<td width="30">5.</td>
					<td width="175">Pernah Masuk Pesantren</td>
					<td width="10">:</td>
					<td width="445">'.ucwords($row->pernah_masuk_pesantren).'</td>
				</tr>
				<tr>
					<td width="30">6.</td>
					<td width="175">Nama Ayah</td>
					<td width="10">:</td>
					<td width="445">'.ucwords($row->nama_ayah).'</td>
				</tr>
				<tr>
					<td width="30">7.</td>
					<td width="175">Pekerjaan Ayah</td>
					<td width="10">:</td>
					<td width="445">'.ucwords($row->pekerjaan_ayah).'</td>
				</tr>
				<tr>
					<td width="30">8.</td>
					<td width="175">Agama Ayah</td>
					<td width="10">:</td>
					<td width="445">'.ucwords($row->agama_ayah).'</td>
				</tr>
				<tr>
					<td width="30">6.</td>
					<td width="175">Nama Ibu</td>
					<td width="10">:</td>
					<td width="445">'.ucwords($row->nama_ibu).'</td>
				</tr>
				<tr>
					<td width="30">7.</td>
					<td width="175">Pekerjaan Ibu</td>
					<td width="10">:</td>
					<td width="445">'.ucwords($row->pekerjaan_ibu).'</td>
				</tr>
				<tr>
					<td width="30">8.</td>
					<td width="175">Agama Ibu</td>
					<td width="10">:</td>
					<td width="445">'.ucwords($row->agama_ibu).'</td>
				</tr>
				<tr>
					<td width="30">9.</td>
					<td width="175">Alamat</td>
					<td width="10">:</td>
					<td width="445">'.ucwords($row->alamat).'</td>
				</tr>
				<tr>
					<td width="30">10.</td>
					<td width="175">No. Telepon</td>
					<td width="10">:</td>
					<td width="445">'.ucwords($row->no_telepon).'</td>
				</tr>
				<tr>
					<td width="30">11.</td>
					<td width="175">Nama Wali</td>
					<td width="10">:</td>
					<td width="445">'.ucwords($row->nama_wali).'</td>
				</tr>
				<tr>
					<td width="30">12.</td>
					<td width="175">Pekerjaan Wali</td>
					<td width="10">:</td>
					<td width="445">'.ucwords($row->pekerjaan_wali).'</td>
				</tr>
				<tr>
					<td width="30">13.</td>
					<td width="175">Alamat Wali</td>
					<td width="10">:</td>
					<td width="445">'.ucwords($row->alamat_wali).'</td>
				</tr>
			</table>
			<br><br>
			B. Keuangan :<br>
			<table cellspacing="0" cellpadding="1" border="1">
				<tr>
					<td width="30">No.</td>
					<td width="175" align="center">Jenis Keuangan</td>
					<td width="100" align="center">Besarnya</td>
					<td width="100" align="center">Keterangan</td>
				</tr>
				<tr>
					<td width="30">1.</td>
					<td width="175">Pendaftaran</td>
					<td width="100" align="right">Rp. 75.000,-</td>
					<td width="100" align="center">'.ucwords($row->status_pembayaran).'</td>
				</tr>
				<tr>
					<td width="30">2.</td>
					<td width="175">Infaq Bangunan</td>
					<td width="100" align="right">Rp. 350.000,-</td>
					<td width="100" align="center">'.ucwords($row->status_pembayaran).'</td>
				</tr>
				<tr>
					<td width="30">3.</td>
					<td width="175">Infaq Bulanan</td>
					<td width="100" align="right">Rp. 50.000,-</td>
					<td width="100" align="center">'.ucwords($row->status_pembayaran).'</td>
				</tr>
				<tr>
					<td width="30">4.</td>
					<td width="175">Uang Makan</td>
					<td width="100" align="right">Rp. 270.000,-</td>
					<td width="100" align="center">'.ucwords($row->status_pembayaran).'</td>
				</tr>
				<tr>
					<td colspan="2" align="center">Jumlah</td>
					<td width="100" align="right">Rp. 745.000,-</td>
					<td width="100" align="center">'.ucwords($row->status_pembayaran).'</td>
				</tr>
							
			</table>
			<br><br>
			</p>
			<p><table cellspacing="0" cellpadding="1" border="0">
				<tr>
					<td align="center">Mengetahui<br><br><br><b>'.ucwords($row->nama_ayah).'</b><br>Orang Tua / Wali Calon Santri</td>
					<td align="center"></td>
					<td align="center">Yang Menyatakan<br><br><br><b>'.ucwords($row->nama_calon_santri).'</b><br>Calon Santri</td>
				</tr>
			</table>
			<br><br>
			NB : Formulir ini digenerate secara otomatis oleh sistem PSB online www.ppdi.web.id, pembayaran Anda tervalidasi bila tertulis LUNAS pada keterangan.</p>';

			// Print text using writeHTMLCell()
			$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
			
			$pdf->Output('Berkas Pendaftaran.'.$row->PID.'.pdf', 'I');
		}
		else
			header('location:'.base_url().'');
	}
	
	public function _example_output($output = null)
	{
		$this->load->view('psb_lte.php',$output);
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		header('location:'.base_url().'psb');
	}
}

/* End of file psb.php */
/* Location: ./application/controllers/psb.php */
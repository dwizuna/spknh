<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}
	
	public function index()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!="" && $this->session->userdata('logged_in') == 'yesGetMeLoginHoney'){
			$this->front_model->getStats();
			$this->session->set_userdata('option','dashboard');
			$this->load->view('dashboard.php');
		}
		else
			header('location:'.base_url().'front/logout');
	}
	
	public function guru(){
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!="" && $this->session->userdata('logged_in') == 'yesGetMeLoginHoney' && $this->session->userdata('jt')=="admin"){
			$this->session->set_userdata('option','guru');
			$crud = new grocery_CRUD();
			$crud->set_table('guru');
			$crud->display_as('nip','NIP');
			$crud->set_subject('Guru');
			$crud->required_fields('nip','nama_guru','tempat_lahir','tanggal_lahir','jenis_kelamin','status','pekerjaan','alamat','kota','kodepos','no_telpon');
			$crud->field_type('jenis_kelamin','dropdown', array('laki-laki' => 'laki-laki', 'perempuan' => 'perempuam'));
			$crud->field_type('status','dropdown', array('belum menikah' => 'belum menikah', 'sudah menikah' => 'sudah menikah'));
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function kriteria(){
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!="" && $this->session->userdata('logged_in') == 'yesGetMeLoginHoney' && $this->session->userdata('jt')=="admin"){
			$this->session->set_userdata('option','kriteria');
			$crud = new grocery_CRUD();
			$crud->set_table('kriteria');
			$crud->set_subject('Kriteria');
			$crud->required_fields('kriteria','bobot_kriteria');
			$crud->unset_add()
				 ->unset_delete()
				 ->unset_read();
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function sub_kriteria(){
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!="" && $this->session->userdata('logged_in') == 'yesGetMeLoginHoney' && $this->session->userdata('jt')=="admin"){
			$this->session->set_userdata('option','sub kriteria');
			$crud = new grocery_CRUD();
			$crud->set_table('sub_kriteria');
			$crud->set_subject('Sub Kriteria');
			$crud->required_fields('sub_kriteria','bobot_sub_kriteria');
			$crud->set_relation('id_kriteria','kriteria','kriteria');
			$crud->display_as('id_kriteria','Kriteria');
			$crud->unset_add()
				 ->unset_delete();
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function periode(){
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!="" && $this->session->userdata('logged_in') == 'yesGetMeLoginHoney' && $this->session->userdata('jt')=="admin"){
			$this->session->set_userdata('option','periode');
			$crud = new grocery_CRUD();
			$crud->set_table('periode');
			$crud->set_subject('Periode');
			$crud->required_fields('periode');
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function perhitungan(){
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!="" && $this->session->userdata('logged_in') == 'yesGetMeLoginHoney'){
			$this->front_model->getFront();
			$this->session->set_userdata('periode',$this->input->post('periode'));
			$this->load->view('perhitungan');
		}
		else
			header('location:'.base_url().'');
	}
	
	public function laporan(){
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!="" && $this->session->userdata('logged_in') == 'yesGetMeLoginHoney'){
			
			$this->load->library('Pdf');
			
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
			$pdf->SetTitle('Laporan SPKNH');
			$pdf->SetAutoPageBreak(true);
			$pdf->SetAuthor('Ipang Dwi for SPKNH');
			$pdf->SetDisplayMode('real', 'default');
			// set default header data
			//$pdf->SetHeaderData('logo-header.jpg', '100', '', 'C', array(0,64,255), array(0,64,128));
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

			function jml_kriteria(){	
											$mysqli = new mysqli('localhost','root','1717','spknh');
											if($mysqli->connect_errno){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$kriteria = $mysqli->query("select * from kriteria");
											return $kriteria->num_rows;
										}
										
										function jml_sub_kriteria(){	
											$mysqli = new mysqli('localhost','root','1717','spknh');
											if($mysqli->connect_errno){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$kriteria = $mysqli->query("select * from sub_kriteria");
											return $kriteria->num_rows;
										}
										
										function jml_alternatif($x){	
											$mysqli = new mysqli('localhost','root','1717','spknh');
											if($mysqli->connect_errno){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$alternatif = $mysqli->query("SELECT g.nama_guru from guru g, guru_terpilih gt where g.id_guru = gt.id_guru and id_periode = ".$x."");
											return $alternatif->num_rows;
										}
										
										function jml_periode(){	
											$mysqli = new mysqli('localhost','root','1717','spknh');
											if($mysqli->connect_errno){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$kriteria = $mysqli->query("select * from periode");
											return $kriteria->num_rows;
										}
										
										function get_periode(){
											$mysqli = new mysqli('localhost','root','1717','spknh');
											if($mysqli->connect_errno){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$kriteria = $mysqli->query("select * from periode");
											if(!$kriteria){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $kriteria->fetch_assoc()) {
												@$kri[$i][0] = $row["id_periode"];
												@$kri[$i][1] = $row["periode"];
												$i++;
											}
											return $kri;
										}
										
										function get_kriteria(){
											$mysqli = new mysqli('localhost','root','1717','spknh');
											if($mysqli->connect_errno){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$kriteria = $mysqli->query("select * from kriteria");
											if(!$kriteria){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=1;
											while ($row = $kriteria->fetch_assoc()) {
												@$kri[$i] = $row["kriteria"];
												$i++;
											}
											return $kri;
										}
										
										function get_sub_kriteria(){
											$mysqli = new mysqli('localhost','root','1717','spknh');
											if($mysqli->connect_errno){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$kriteria = $mysqli->query("select * from kriteria");
											if(!$kriteria){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=1;
											while ($row = $kriteria->fetch_assoc()) {
												@$kri[$i] = $row["kriteria"];
												$i++;
											}
											return $kri;
										}
										
										function get_kepentingan(){
											$mysqli = new mysqli('localhost','root','1717','spknh');
											if($mysqli->connect_errno){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$kepentingan = $mysqli->query("select * from kriteria");
											if(!$kepentingan){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $kepentingan->fetch_assoc()) {
												@$kep[$i] = $row["kepentingan"];
												$i++;
											}
											return $kep;
										}
										
										function get_bobot(){
											$mysqli = new mysqli('localhost','root','1717','spknh');
											if($mysqli->connect_errno){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$kepentingan = $mysqli->query("select * from kriteria");
											if(!$kepentingan){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $kepentingan->fetch_assoc()) {
												@$kep[$i] = $row["bobot_kriteria"];
												$i++;
											}
											return $kep;
										}
										
										function get_bobot2(){
											$mysqli = new mysqli('localhost','root','1717','spknh');
											if($mysqli->connect_errno){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$kepentingan = $mysqli->query("select * from sub_kriteria");
											if(!$kepentingan){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $kepentingan->fetch_assoc()) {
												@$kep[$i] = $row["bobot_sub_kriteria"];
												$i++;
											}
											return $kep;
										}
										
										function get_costbenefit(){
											$mysqli = new mysqli('localhost','root','1717','spknh');
											if($mysqli->connect_errno){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$costbenefit = $mysqli->query("select * from kriteria");
											if(!$costbenefit){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $costbenefit->fetch_assoc()) {
												@$cb[$i] = $row["cost_benefit"];
												$i++;
											}
											return $cb;
										}
										
										function get_alt_name($x){
											$mysqli = new mysqli('localhost','root','1717','spknh');
											if($mysqli->connect_errno){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$alternatif = $mysqli->query("SELECT g.nama_guru from guru g, guru_terpilih gt where g.id_guru = gt.id_guru and id_periode = ".$x." order by gt.id_guru");
											if(!$alternatif){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $alternatif->fetch_assoc()) {
												@$alt[$i] = $row["nama_guru"];
												$i++;
											}
											return $alt;
										}
										
										function get_alternatif($x){
											$mysqli = new mysqli('localhost','root','1717','spknh');
											if($mysqli->connect_errno){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$alternatif = $mysqli->query("SELECT id_sub_kriteria, id_nilai FROM penilaian where id_periode = ".$x." order by id_guru, id_sub_kriteria");
											if(!$alternatif){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=1; $j=0;
											while ($row = $alternatif->fetch_assoc()) {
												if($i>14) { $i=1; $j++; }
												@$alt[$j][$row["id_sub_kriteria"]] = $row["id_nilai"];
												$i++;
											}
											return $alt;
										}
										
										function get_kecocokan($a,$altk){
											for($i=0;$i<$a;$i++){
												@$alt[$i][0] = ($altk[$i][1]+$altk[$i][2]+$altk[$i][3]+$altk[$i][4]+$altk[$i][5]+$altk[$i][6]+$altk[$i][7])/7;
												@$alt[$i][1] = ($altk[$i][8]+$altk[$i][9]+$altk[$i][10])/3;
												@$alt[$i][2] = ($altk[$i][11]+$altk[$i][12])/2;
												@$alt[$i][3] = ($altk[$i][13]+$altk[$i][14])/2;
											}
											/*echo "<pre>";
											print_r($alt);
											echo"</pre>";*/
											return $alt;
										}
										
										function cmp($a, $b){
											if ($a == $b) {
												return 0;
											}
											return ($a > $b) ? -1 : 1;
										}
			
			$mysqli = new mysqli('localhost','root','1717','spknh');
					if($mysqli->connect_errno){
						echo $mysqli->connect_errno." - ".$mysqli->connect_error;
						exit();
					}
					
					if($this->session->userdata('periode')=='')
						$x = 1;	// $x sebagai kunci periode
					else
						$x = $this->session->userdata('periode');
					$altk = get_alternatif($x);
					$alt_name = get_alt_name($x);
					//$kep = get_kepentingan(); //iki bobot
					//$cb = get_costbenefit(); //g kanggo
					$kep = get_bobot(); //bobot kriteria
					$kep2 = get_bobot2(); //bobot sub kriteria
					$kri = get_kriteria();
					$p = get_periode();
					$jp = jml_periode();
					$k = jml_kriteria();
					$sk = jml_sub_kriteria();
					$a = jml_alternatif($x);
					$r = 3; //just for round
					
					/*echo "<b>Kriteria</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Kriteria</th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
						echo "</tr>";
					echo "</thead>";
					echo "<thead><tr><th>Bobot Kriteria</th>";
						for($i=0;$i<$k;$i++){
							echo "<th>".ucwords($kep[$i])."</th>";
						}
						echo "</tr>";
					echo "</thead>";
					echo "</table><hr>";*/
					// ========================================================================== //
					/*echo "<b>Sub Kriteria</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Sub Kriteria</th>";
						for($i=1;$i<=$sk;$i++){
							echo "<th>SK".$i."</th>";
						}
						echo "</tr>";
					echo "</thead>";
					echo "<thead><tr><th>Bobot Sub Kriteria</th>";
						for($i=0;$i<$sk;$i++){
							echo "<th>".ucwords($kep2[$i])."</th>";
						}
						echo "</tr>";
					echo "</thead>";
					echo "</table><hr>";*/
					// ========================================================================== //
					/*echo "<b>Penilaian</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif</th>";
						for($i=1;$i<=$sk;$i++){
							echo "<th>SK".$i."</th>";
						}
					echo "</thead>";
					for($i=0;$i<$a;$i++){
						echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
						for($j=1;$j<=$sk;$j++){
							echo "<td>".$altk[$i][$j]."</td>";
						}
						echo "</tr>";
					}
					echo "</table><hr>";*/
					// ========================================================================== //
					$alt = get_kecocokan($a,$altk);
					/*echo "<b>Rating Kecocokan</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif</th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
						echo "</tr>";
					echo "</thead>";
					for($i=0;$i<$a;$i++){
						echo "<tr><td><b>".$alt_name[$i]."</b></td>";
						for($j=0;$j<$k;$j++){
							echo "<td>".round($alt[$i][$j],$r)."</td>";
						}
						echo "</tr>";
					}
					echo "</table><hr>";*/
					// ======================================================================== //
					/*echo "<b>Matrix Pembagi</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th></th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
					echo "</tr></thead>";
					echo "<tr><td><b>Pembagi</b></td>";*/
						for($i=0;$i<$k;$i++){
							$pembagi[$i] = 0;
							for($j=0;$j<$a;$j++){
								$pembagi[$i] = $pembagi[$i] + pow($alt[$j][$i],2);
							}
							$pembagi[$i] = round(sqrt($pembagi[$i]),4);
							//echo "<td>".round($pembagi[$i],$r)."</td>";
						}
					//echo "</tr>";
					//echo "</table><hr>";
					// ======================================================================== //
					/*echo "<b>Matrix Keputusan Ternormalisasi</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif / Kriteria</th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
					echo "</tr></thead>";*/
					for($i=0;$i<$a;$i++){
						//echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
						for($j=0;$j<$k;$j++){
							$nor[$i][$j] = round(($alt[$i][$j] / $pembagi[$j]),4);
							//echo "<td>".round($nor[$i][$j],$r)."</td>";
						}
						//echo "</tr>";
					}
					//echo "</table><hr>";
					// ======================================================================== //
					/*echo "<b>Matrix Normalisasi Terbobot</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif / Kriteria</th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
					echo "</tr></thead>";*/
					for($i=0;$i<$a;$i++){
						//echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
						for($j=0;$j<$k;$j++){
							$bob[$i][$j] = round(($nor[$i][$j] * $kep[$j]),4);
							//echo "<td>".round($bob[$i][$j],$r)."</td>";
						}
						//echo "</tr>";
					}
					//echo "</table><hr>";
					// ======================================================================== //
					/*echo "<b>Solusi Ideal Positif dan Solusi Ideal Negatif</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th></th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
					echo "</tr></thead>";
					echo "<tr><td><b>A+</b></td>";*/
						for($i=0;$i<$k;$i++){
							for($j=0;$j<$a;$j++){
								$temp[$j] = $bob[$j][$i];
							}
							$aplus[$i] = max($temp);
							//echo "<td>".round($aplus[$i],$r)."</td>";
						}
					//echo "</tr>";
					//echo "<tr><td><b>A-</b></td>";
						for($i=0;$i<$k;$i++){
							for($j=0;$j<$a;$j++){
								$temp[$j] = $bob[$j][$i];
							}
							$amin[$i] = min($temp);
							//echo "<td>".round($amin[$i],$r)."</td>";
						}
					//echo "</tr>";
					//echo "</table><hr>";
					// ======================================================================== //
					/*echo "<b>Jarak Solusi Ideal Positif dan Jarak Solusi Ideal Negatif</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif</th><th>D+</th><th>D-</th></tr></thead>";*/
					for($i=0;$i<$a;$i++){
						//echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
						$dplus[$i] = 0;
						for($j=0;$j<$k;$j++){
							$dplus[$i] = $dplus[$i] + pow(($aplus[$j] - $bob[$i][$j]),2);
						}
						$dplus[$i] = round(sqrt($dplus[$i]),4);
						//echo "<td>".round($dplus[$i],$r)."</td>";
						$dmin[$i] = 0;
						for($j=0;$j<$k;$j++){
							$dmin[$i] = $dmin[$i] + pow(($amin[$j] - $bob[$i][$j]),2);
						}
						$dmin[$i] = round(sqrt($dmin[$i]),4);
						//echo "<td>".round($dmin[$i],$r)."</td>";echo "</tr>";
					}
					//echo "</table><hr>";
					// ======================================================================== //
					/*echo "<b>Nilai Preferensi</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif</th><th>C</th></tr></thead>";*/
					for($i=0;$i<$a;$i++){
						//echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
						$v[$i][0] = round(($dmin[$i] / ($dplus[$i]+$dmin[$i])),4);
						$v[$i][1] = $alt_name[$i];
 						//echo "<td>".round($v[$i][0],$r)."</td>";
					}
					//echo "</table><hr>";
					usort($v, "cmp");
					$i = 0;
					while (list($key, $value) = each($v)) {
						$hsl[$i] = array($value[1],$value[0]); 
						$i++;
					}
					// ======================================================================== //
					//echo "<b>Pengumuman</b></br>";
					
					$tabelku = "";
					for($i=0;$i<$a;$i++){
						$tabelku = $tabelku.'<tr><td align="center">'.($i+1).'.</td><td align="center">'.ucwords(($hsl[$i][0])).'</td><td align="center">'.round($hsl[$i][1],$r).'</td></tr>';
					}
			
			// Set some content to print
			$html = '<p align="center"><img src="'.base_url().'assets/dist/img/logo-header.jpg"></p><br>Berdasarkan hasil perhitungan yang dilakukan untuk pemilihan guru terbaik, dengan mendapatkan suatu penghargaan. Penghargaan berupa kenaikan gaji untuk yang mendapatkan nilai terbaik. <br><br>Guru terbaik periode ini adalah <b>'.ucwords(($hsl[0][0])).'</b> dengan nilai tertinggi <b>'.round($hsl[0][1],$r).'</b><br><br><table border="1">
			<tr><td width="25" align="center">No.</td><td align="center">Nama Guru</td><td align="center">Hasil Akhir Penilaian</td></tr>
			'.$tabelku.'</table><br><br><br><br><br>
			<table><tr><td align="center">Kepala Yayasan</td><td></td><td align="center">Kepala Sekolah</td></tr></table>';

			// Print text using writeHTMLCell()
			$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
			
			$pdf->Output('Laporan.pdf', 'I');
		}
		else
			header('location:'.base_url().'');
	}
	
	public function guru_terpilih(){
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!="" && $this->session->userdata('logged_in') == 'yesGetMeLoginHoney' && $this->session->userdata('jt')=="admin"){
			$this->session->set_userdata('option','guru terpilih');
			$crud = new grocery_CRUD();
			$crud->set_table('guru_terpilih');
			$crud->set_subject('Guru Terpilih');
			$crud->required_fields('id_periode','id_guru');
			$crud->set_relation('id_periode','periode','periode');
			$crud->display_as('id_periode','Periode');
			$crud->set_relation('id_guru','guru','nama_guru');
			$crud->display_as('id_guru','Guru');
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function beri_penilaian(){
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!="" && $this->session->userdata('logged_in') == 'yesGetMeLoginHoney' && $this->session->userdata('jt')=="kepsek"){
			$this->session->set_userdata('option','beri penilaian');
			$crud = new grocery_CRUD();
			$crud->set_table('penilaian');
			$crud->set_subject('Penilaian');
			$crud->required_fields('id_periode','id_guru','id_kriteria','id_sub_kriteria','id_nilai');
			$crud->display_as('id_periode','Periode');
			$crud->set_relation('id_periode','periode','periode');
			$crud->display_as('id_guru','Guru');
			$crud->set_relation('id_guru','guru','nama_guru');
			$crud->display_as('id_kriteria','Kriteria');
			$crud->set_relation('id_kriteria','kriteria','kriteria');
			$crud->display_as('id_sub_kriteria','Sub Kriteria');
			$crud->set_relation('id_sub_kriteria','sub_kriteria','sub_kriteria');
			$crud->display_as('id_nilai','Nilai');
			$crud->set_relation('id_nilai','nilai','nilai');
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function penilaian(){
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!="" && $this->session->userdata('logged_in') == 'yesGetMeLoginHoney' && $this->session->userdata('jt')=="admin"){
			$this->session->set_userdata('option','penilaian');
			$crud = new grocery_CRUD();
			$crud->set_table('penilaian');
			$crud->set_subject('Penilaian');
			$crud->required_fields('id_periode','id_guru','id_kriteria','id_sub_kriteria','id_nilai');
			$crud->display_as('id_periode','Periode');
			$crud->set_relation('id_periode','periode','periode');
			$crud->display_as('id_guru','Guru');
			$crud->set_relation('id_guru','guru','nama_guru');
			$crud->display_as('id_kriteria','Kriteria');
			$crud->set_relation('id_kriteria','kriteria','kriteria');
			$crud->display_as('id_sub_kriteria','Sub Kriteria');
			$crud->set_relation('id_sub_kriteria','sub_kriteria','sub_kriteria');
			$crud->display_as('id_nilai','Nilai');
			$crud->set_relation('id_nilai','nilai','nilai');
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function nilai(){
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!="" && $this->session->userdata('logged_in') == 'yesGetMeLoginHoney' && $this->session->userdata('jt')=="admin"){
			$this->session->set_userdata('option','nilai');
			$crud = new grocery_CRUD();
			$crud->set_table('nilai');
			$crud->set_subject('Nilai');
			$crud->required_fields('nilai');
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function user(){
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!="" && $this->session->userdata('logged_in') == 'yesGetMeLoginHoney' && $this->session->userdata('jt')=="admin"){
			$this->session->set_userdata('option','user');
			$crud = new grocery_CRUD();
			$crud->set_table('user');
			$crud->set_subject('User');
			$crud->required_fields('username','password','level','pic','since');
			$crud->field_type('level','dropdown', array('admin' => 'admin', 'kepsek' => 'kepsek'));
			$crud->set_field_upload('pic','assets/uploads/pics');
			$crud->callback_before_insert(array($this,'encrypt_password'));
			$crud->callback_before_update(array($this,'encrypt_password'));
			if($this->session->userdata('jt')=="operator"){
				$crud->unset_add()
				 ->unset_delete()
				 ->unset_read()
				 ->unset_edit()
				 ->unset_print()
				 ->unset_export();
				$crud->columns('username','job_title','pic','since');
				$crud->fields('username','job_title','pic','since');
			}
			else
				$crud->fields('username','password','level','pic','since');
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function setting(){
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!="" && $this->session->userdata('logged_in') == 'yesGetMeLoginHoney' && $this->session->userdata('jt')=="admin"){
			$this->session->set_userdata('option','setting');
			$crud = new grocery_CRUD();
			$crud->set_table('setting');
		    $crud->set_subject('Setting');
			$crud->columns('creator','judul','desc','nav','logo','tema');
			$crud->fields('creator','judul','desc','nav','logo','tema');
			$crud->unset_add()
				 ->unset_delete()
				 ->unset_print()
				 ->unset_export()
				 ->unset_read();
			$crud->display_as('desc','Deskripsi');
			$crud->display_as('nav','Logo Navigation');
			$crud->display_as('logo','Banner Admin');
			$crud->set_subject('User');
			$crud->set_relation('tema','tema','tema');
			$crud->required_fields('creator','judul','desc','logo','tema');
			$crud->set_field_upload('nav','assets/uploads/logo');
			$crud->set_field_upload('logo','assets/uploads/logo');
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function profile(){
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('username')!="" && $this->session->userdata('password')!="" && $this->session->userdata('logged_in') == 'yesGetMeLoginHoney'){
			$this->session->set_userdata('option','profile');
			$crud = new grocery_CRUD();
			$crud->set_table('user');
			$crud->columns('username','job_title','pic','since');
			$crud->fields('username','pic');
			$crud->unset_add()
				 ->unset_delete()
				 ->unset_print()
				 ->unset_export()
				 ->unset_read();
			$crud->where('username',$this->session->userdata('username'));
			$crud->display_as('job_title','Job Title');
			$crud->set_subject('User');
			$crud->required_fields('username','password','pic');
			$crud->set_field_upload('pic','assets/uploads/pics');
			$crud->callback_before_update(array($this,'encrypt_password'));
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function encrypt_password($post_array, $primary_key = null)
    {
	    $this->load->helper('security');
	    $post_array['password'] = do_hash($post_array['password'].'@adDunyaa2$MataaAdDunyaa%4#AlMarAtus91Sholihah', 'md5');
	    return $post_array;
    }
	
	public function _example_output($output = null)
	{
		$this->load->view('lte.php',$output);
	}
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
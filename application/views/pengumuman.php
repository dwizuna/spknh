<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $this->session->userdata('judul');?> | <?php echo $this->session->userdata('desc');?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/dist/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="<?php echo base_url(); ?>assets/dist/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>assets/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo base_url(); ?>assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
	<!-- growl -->
    <link href="<?php echo base_url(); ?>assets/plugins/growl/jquery.growl.css" rel="stylesheet" type="text/css" />
	<!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
	<!-- growl -->
    <script src="<?php echo base_url(); ?>assets/plugins/growl/jquery.growl.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <link href="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
	<!-- The fav icon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="<?php echo $this->session->userdata('tema');?> layout-top-nav">
    <div class="wrapper">
		<script type="text/javascript">
		  <?php if(validation_errors()) { ?>
			$.growl.warning({ message: "Username and Password must be filled .." });
		  <?php } ?>
		  <?php if($this->session->flashdata('result_login')) { ?>
			$.growl.error({ message: "Username and Password isn't valid .." });
		  <?php } ?>
		</script>
      <header class="main-header">      
		<nav class="navbar navbar-static-top">
            <a href="<?php echo base_url(); ?>" class="logo"><?php if($this->session->userdata('nav')=='') echo $this->session->userdata('judul'); else echo "<img src='".base_url()."assets/uploads/logo/".$this->session->userdata('nav')."' />";?></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
		<div class="container-fluid">
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="navbar-collapse">
            <?php echo form_open('front','class="navbar-form navbar-right"'); ?>
              <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>"/>
				<input type="password" class="form-control" name="password" placeholder="Password" />
				<button type="submit" method ="post" target="" class="btn btn-flat <?php
				if($this->session->userdata('tema')=='skin-yellow') echo "btn-warning";
				if($this->session->userdata('tema')=='skin-red') echo "btn-danger";
				if($this->session->userdata('tema')=='skin-blue') echo "btn-primary";
				if($this->session->userdata('tema')=='skin-green') echo "btn-success";
				if($this->session->userdata('tema')=='skin-purple') echo "btn-purple bg-purple";
				if($this->session->userdata('tema')=='skin-black') echo "bg-black";
			  ?>" id="submit">Login</button>
              </div>
            <?php echo form_close(); ?>
          </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>
      <!-- Full Width Column -->
      <div class="content-wrapper" bgcolor="black">
        <div class="container-fluid">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
             
            </h1>
          </section>
          <!-- Main content -->
          <section class="content">
		  <div class="row">
		  <div class="col-lg-12">
			<div class="box <?php
				if($this->session->userdata('tema')=='skin-yellow') echo "box-warning";
				if($this->session->userdata('tema')=='skin-red') echo "box-danger";
				if($this->session->userdata('tema')=='skin-blue') echo "box-primary";
				if($this->session->userdata('tema')=='skin-green') echo "box-success";
				if($this->session->userdata('tema')=='skin-purple') echo "box-purple";
				if($this->session->userdata('tema')=='skin-black') echo "box-black";
			  ?>">
                <div class="box-header">
					 <i class="fa fa-tags <?php
				if($this->session->userdata('tema')=='skin-yellow') echo "text-yellow";
				if($this->session->userdata('tema')=='skin-red') echo "text-red";
				if($this->session->userdata('tema')=='skin-blue') echo "text-blue";
				if($this->session->userdata('tema')=='skin-green') echo "text-green";
				if($this->session->userdata('tema')=='skin-purple') echo "text-purple";
				if($this->session->userdata('tema')=='skin-black') echo "text-black";
			  ?>"></i>
					 <h3 class="box-title">Pengumuman Guru Terbaik</h3>
                </div>
                <div class="box-body">
				<div class="text-right"><button class="btn btn-primary btn-sm" onclick="myFunction()">Print</button></div>
					<center>
					<?php
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
					//echo "<b>Pengumuman</b></br>";?>
							<div class="col-lg-4">
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<form role="form" method="post" action="<?php echo base_url(); ?>front/pengumuman">
								<select class="form-control" name="periode" id="periode" onchange="this.form.submit()">
									<?php 
										for($i=0;$i<$jp;$i++){
											echo "<option value='".$p[$i][0]."'";
											if($p[$i][0]==$this->session->userdata('periode'))
												echo "selected";
											echo ">Periode Pemilihan - ".date('d-m-Y', strtotime($p[$i][1]))."</option>";
										} 
									?>
								</select>
                            </form>
							</div>
							<div class="col-lg-4">
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?php
					echo "Berikut ini hasil analisa diurutkan berdasarkan hasil nilai tertinggi. </br>Jadi dapat disimpulkan bahwa Guru Terbaik adalah <b>".ucwords(($hsl[0][0]))."</b> dengan nilai <b>".round($hsl[0][1],$r)."</b>.";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>No.</th><th>Nama Guru</th><th>Hasil Akhir Penilaian</th></tr></thead>";
					echo "<tbody>";
					for($i=0;$i<$a;$i++){
						echo "<tr><td>".($i+1).".</td><td>".ucwords(($hsl[$i][0]))."</td><td>".round($hsl[$i][1],$r)."</td></tr>";
					}
					echo "</tbody></table><hr></div>";
					
					
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

										function print_ar(array $x){	//just for print array
											echo "<pre>";
											print_r($x);
											echo "</pre></br>";
										}
					?>
					</center>
                </div>
                <div class="box-footer clearfix text-center">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b><?php echo $this->session->userdata('judul');?> - <?php echo $this->session->userdata('desc');?></b></div>
                </div>
              </div>
		  </div>
		  </div><!-- row -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="container-fluid">
          <div class="pull-right hidden-xs">
            Version 0.1.a
          </div>
          Copyright &copy; <?php echo date('Y')?>, <?php echo $this->session->userdata('creator');?>&trade;. All rights reserved.
        </div><!-- /.container -->
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery UI 1.11.2 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQueryUI/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <!-- Morris.js charts -->
    <script src="<?php echo base_url(); ?>assets/plugins/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url(); ?>assets/plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <!--script src="<?php echo base_url(); ?>assets/dist/js/demo.js" type="text/javascript"></script-->
  </body>
</html>
	<script>
	function myFunction() {
		window.print();
	}
	</script>
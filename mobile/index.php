<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width = device-width, height = device-height, initial-scale=1" >
	<title>Selpy Cell Ciamis</title>
	<link rel="stylesheet" href="jm/jquery.mobile-1.0.1.min.css" />
	<link rel="stylesheet" href="css/mobile-standard.css" />
	<script type="text/javascript" src="jm/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="jm/costum-scripting.js"></script>
	<script type="text/javascript" src="jm/jquery.mobile-1.0.1.min.js"></script>
</head>
<body>
<div data-role="page">
	<div data-role="header">
		<div id="gambar">
		<img src="images/header.jpg" class="gambar">
		</div>
		<div data-role="navbar">
			<ul>
				<li><a href="index.php" data-theme="a">Halaman Awal</a></li>
				<li><a href="index.php?page=carapembelian" data-theme="a">Cara Pembelian</a></li>
			</ul>
			<ul>
				<li><a href="index.php?page=produk" data-theme="a">Produk</a></li>
				<li><a href="index.php?page=tentang" data-theme="a">Tentang</a></li>
			</ul>
    </div><!-- /navbar -->
	</div><!-- /header -->
		
	<div data-role="content" data-theme="d">	
		<?php 
			if (isset($_GET['page']))
			{
				$pagenya = $_GET['page'];
				if ($pagenya == "carapembelian") 
				{	include "cara-pembelian.php";
				}
				if ($pagenya == "produk") 
				{	include "daftar-produk.php";
				}
				else if (($pagenya == "produk-show") && ($_GET['id'] != ""))
				{	include "produk-show.php";
				}
				else if (($pagenya == "detail-produk") && ($_GET['id'] != ""))
				{	include "detail-produk.php";
				}
				if ($pagenya == "simpan") 
				{	include "simpan.php";
				}
				if ($pagenya == "tentang") 
				{	include "tentang.php";
				}
			}
			else
			{	?>
				<p align="justify"><b>Profil Selpy Cell Ciamis</b><br />
Selpy Cell - menjual berbagai jenis, tipe dan merek handphone dengan harga bersaing.
Hubungi kontak kami berikut ini :
<br />Alamat : Jl. Raya Ciamis No. 255
<br />No. Telp : 085223123456 
</p>
			<?php } ?>
	</div><!-- /content -->

	<div data-role="footer" data-theme="a">
		<center><a href="index.php" data-icon="home" data-iconpos="notext" data-direction="reverse">Halaman Awal</a></center>
	</div><!-- /footer -->
</div><!-- /page -->
</body>
</html>

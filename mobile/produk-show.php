<?PHP
	include "../config/koneksi.php";
	$sql=mysql_query("SELECT * FROM produk where id_kategori=$_GET[id]");
?>
<ul data-role="listview">
	<?php while ($r=mysql_fetch_array($sql)){
		echo "<li><a href='index.php?page=detail-produk&id=$r[id_produk]'>$r[nama_produk]</a></li>";
		}
	?>
</ul>
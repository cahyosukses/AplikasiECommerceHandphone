<?PHP
	include "../config/koneksi.php";
	$sql=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
?>
<ul data-role="listview">
	<?php while ($r=mysql_fetch_array($sql)){
		echo "<li><a href='index.php?page=produk-show&id=$r[id_kategori]'>$r[nama_kategori]</a></li>";
		}
	?>
</ul>
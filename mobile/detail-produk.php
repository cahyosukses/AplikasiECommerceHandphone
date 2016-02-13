<?PHP
	include "../config/koneksi.php";
	include "../config/fungsi_rupiah.php";
   $detail=mysql_query("SELECT * FROM produk,kategori    
                      WHERE kategori.id_kategori=produk.id_kategori 
                      AND id_produk='$_GET[id]'");
	$d   = mysql_fetch_array($detail);
  $harga = format_rupiah($d[harga]);

  echo "Kategori: <a href='index.php?page=produk-show&id=$d[id_kategori]'>$d[nama_kategori]</a>
  <center>
    	  <br />
			<b>$d[nama_produk]</b><br />
				 <img src='../foto_produk/$d[gambar]' /><br />
            Rp. $harga<br />
            <p align=center>(stok: $d[stok])</p><br />
	</center>
	$d[deskripsi]
	<br />
  ";

	echo "<center><b>Data Pemesan</b></center>";
    echo "
      <form name=form action=index.php?page=simpan&id=$_GET[id] method=POST onSubmit=\"return validasi(this)\">
      <table>
      <tr><td>Nama</td><td><input type=text name=nama size=30></td></tr>
      <tr><td>Alamat Lengkap</td><td><input type=text name=alamat size=60></td></tr>
      <tr><td>Telpon/HP</td><td><input type=text name=telpon></td></tr>
      <tr><td>Email</td><td><input type=text name=email></td></tr>
      <tr><td valign=top>Kota Tujuan</td><td>
      <select name='kota'>
      <option value=0 selected>- Pilih Kota -</option>";
      $tampil=mysql_query("SELECT * FROM kota ORDER BY nama_kota");
      while($r=mysql_fetch_array($tampil)){
         echo "<option value=$r[id_kota]>$r[nama_kota]</option>";
      }
  echo "</select> <br />*)  Apabila tidak terdapat nama kota tujuan Anda, pilih <b>Lainnya</b>
                  <br />**) Ongkos kirim dihitung berdasarkan kota tujuan</td></tr>
      
      <tr><td colspan=2><input type=submit value=Proses></td></tr>
      </table>";  
?>

	
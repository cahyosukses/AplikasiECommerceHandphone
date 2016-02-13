<script type="text/javascript" src="js/boxOver.js"></script>
<script>
PositionX = 100;
PositionY = 100;


defaultWidth  = 500;
defaultHeight = 500;
var AutoClose = true;

if (parseInt(navigator.appVersion.charAt(0))>=4){
var isNN=(navigator.appName=="Netscape")?1:0;
var isIE=(navigator.appName.indexOf("Microsoft")!=-1)?1:0;}
var optNN='scrollbars=no,width='+defaultWidth+',height='+defaultHeight+',left='+PositionX+',top='+PositionY;
var optIE='scrollbars=no,width=150,height=100,left='+PositionX+',top='+PositionY;
function popImage(imageURL,imageTitle){
if (isNN){imgWin=window.open('about:blank','',optNN);}
if (isIE){imgWin=window.open('about:blank','',optIE);}
with (imgWin.document){
writeln('<html><head><title>Loading...</title><style>body{margin:0px;}</style>');writeln('<sc'+'ript>');
writeln('var isNN,isIE;');writeln('if (parseInt(navigator.appVersion.charAt(0))>=4){');
writeln('isNN=(navigator.appName=="Netscape")?1:0;');writeln('isIE=(navigator.appName.indexOf("Microsoft")!=-1)?1:0;}');
writeln('function reSizeToImage(){');writeln('if (isIE){');writeln('window.resizeTo(300,300);');
writeln('width=300-(document.body.clientWidth-document.images[0].width);');
writeln('height=300-(document.body.clientHeight-document.images[0].height);');
writeln('window.resizeTo(width,height);}');writeln('if (isNN){');       
writeln('window.innerWidth=document.images["George"].width;');writeln('window.innerHeight=document.images["George"].height;}}');
writeln('function doTitle(){document.title="'+imageTitle+'";}');writeln('</sc'+'ript>');
if (!AutoClose) writeln('</head><body bgcolor=ffffff scroll="no" onload="reSizeToImage();doTitle();self.focus()">')
else writeln('</head><body bgcolor=ffffff scroll="no" onload="reSizeToImage();doTitle();self.focus()" onblur="self.close()">');
writeln('<img name="George" src='+imageURL+' style="display:block"></body></html>');
close();		
}}

</script>
<script language="javascript">
function validasi(form){
  if (form.nama.value == ""){
    alert("Anda belum mengisikan Nama.");
    form.nama.focus();
    return (false);
  }    
  if (form.alamat.value == ""){
    alert("Anda belum mengisikan Alamat.");
    form.alamat.focus();
    return (false);
  }
  if (form.telpon.value == ""){
    alert("Anda belum mengisikan Telpon.");
    form.telpon.focus();
    return (false);
  }
  if (form.email.value == ""){
    alert("Anda belum mengisikan Email.");
    form.email.focus();
    return (false);
  }
  if (form.kota.value == 0){
    alert("Anda belum mengisikan Kota.");
    form.kota.focus();
    return (false);
  }
  if (form.kode.value == ""){
    alert("Anda belum mengisikan Kode.");
    form.kode.focus();
    return (false);
  }
  return (true);
}

function harusangka(jumlah){
  var karakter = (jumlah.which) ? jumlah.which : event.keyCode
  if (karakter > 31 && (karakter < 48 || karakter > 57))
    return false;

  return true;
}
</script>

<?php
// Halaman utama (Home)
if ($_GET[module]=='home'){
  echo "<div class='center_title_bar'>Produk Terbaru</div>";
  $sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT 9");
  while ($r=mysql_fetch_array($sql)){
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_buy' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">beli</a>";
    $tombolhabis="<span class='prod_buy'>habis</span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $harga = format_rupiah($r[harga]);
    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></div>
             <div class='product_img'>
               <a href='foto_produk/$r[gambar]' title='$r[nama_produk]' class='lightbox'>
               <img src='foto_produk/$r[gambar]' border='0' height='110' title='klik untuk memperbesar gambar' /></a><br />
              </div>
             <div class='prod_price'><span class='price'>Rp. $harga <br />(stok: $r[stok])</span></div>                        
          </div>
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html' class='prod_details'>selengkapnya</a>            
          </div> 
          </div>";
  }
}


// Modul detail produk
elseif ($_GET[module]=='detailproduk'){
  // Tampilkan detail produk berdasarkan produk yang dipilih
	$detail=mysql_query("SELECT * FROM produk,kategori    
                      WHERE kategori.id_kategori=produk.id_kategori 
                      AND id_produk='$_GET[id]'");
	$d   = mysql_fetch_array($detail);
  $harga = format_rupiah($d[harga]);

  echo "<div class='center_title_bar'>Kategori: <a href='kategori-$d[id_kategori]-$d[kategori_seo].html'>$d[nama_kategori]</a></div>
    	  <div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
                 <div class='product_img_big'>
				 <a href=\"javascript:popImage('foto_produk/$d[gambar]','')\" title=\"header=[Zoom] body=[&nbsp;] fade=[on]\"><img src=\"foto_produk/$d[gambar]\" alt=\"\" title=\"\" border=\"0\" /></a>
            <div class='prod_price_big'><span class='price'>Rp. $harga</span></div>
            <p align=center>(stok: $d[stok])</p>
            <a href='aksi.php?module=keranjang&act=tambah&id=$d[id_produk]' class='prod_buy'>beli</a>
            </div>
          <div class='details_big_box'>
            <div class='product_title_big'>$d[nama_produk]</div>
              <div>$d[deskripsi]</div>
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>";
          
// Produk Lainnya (random)          
  $sql=mysql_query("SELECT * FROM produk ORDER BY rand() LIMIT 3");
      
  echo "<div class='center_title_bar'>Produk Lainnya</div>";
      
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></div>
             <div class='product_img'>
               <a href='produk-$r[id_produk]-$r[produk_seo].html'>
               <img src='foto_produk/$r[gambar]' border='0' height='110'></a>
             </div>
             <div class='prod_price'><span class='price'>Rp. $harga <br />(stok: $r[stok])</span></div>                        
          </div>
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             <a href='aksi.php?module=keranjang&act=tambah&id=$r[id_produk]' class='prod_buy'>beli</a>            
             <a href='produk-$r[id_produk]-$r[produk_seo].html' class='prod_details'>selengkapnya</a>            
          </div> 
          </div>";
  }                                      
}


// Modul produk per kategori
elseif ($_GET[module]=='detailkategori'){
  // Tampilkan nama kategori
  $sq = mysql_query("SELECT nama_kategori from kategori where id_kategori='$_GET[id]'");
  $n = mysql_fetch_array($sq);

  echo "<div class='center_title_bar'>Kategori: $n[nama_kategori]</div>";

  // Tentukan berapa data yang akan ditampilkan per halaman (paging)
  $p      = new Paging3;
  $batas  = 6;
  $posisi = $p->cariPosisi($batas);

  // Tampilkan daftar produk yang sesuai dengan kategori yang dipilih
 	$sql = mysql_query("SELECT * FROM produk WHERE id_kategori='$_GET[id]' 
            ORDER BY id_produk DESC LIMIT $posisi,$batas");		 
	$jumlah = mysql_num_rows($sql);

	// Apabila ditemukan produk dalam kategori
	if ($jumlah > 0){
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></div>
             <div class='product_img'>
               <a href='produk-$r[id_produk]-$r[produk_seo].html'>
               <img src='foto_produk/$r[gambar]' border='0' height='110'></a>
             </div>
             <div class='prod_price'><span class='price'>Rp. $harga <br />(stok: $r[stok])</span></div>                        
          </div>
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             <a href='aksi.php?module=keranjang&act=tambah&id=$r[id_produk]' class='prod_buy'>beli</a>            
             <a href='produk-$r[id_produk]-$r[produk_seo].html' class='prod_details'>selengkapnya</a>            
          </div> 
          </div>";
  }  
  
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE id_kategori='$_GET[id]'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halkategori], $jmlhalaman);

  echo "<div class='center_title_bar'>Halaman : $linkHalaman </div>";
  }
  else{
    echo "<p align=center>Belum ada produk pada kategori ini.</p>";
  }
}

// Menu utama di header

// Modul profil
elseif ($_GET[module]=='profilkami'){
  // Data profil mengacu pada id_modul=43
	$profil = mysql_query("SELECT * FROM modul WHERE id_modul='43'");
	$r      = mysql_fetch_array($profil);

  echo "<div class='center_title_bar'>Profil</div>
    	  <div class='prod_box_big'>

          <div class='details_big_box'>
              <div>$r[static_content]</div>
          </div>    
          </div>";                              
}


// Modul cara pembelian
elseif ($_GET[module]=='carabeli'){

	$profil = mysql_query("SELECT * FROM modul WHERE id_modul='45'");
	$r      = mysql_fetch_array($profil);

  echo "<div class='center_title_bar'>Cara Pembelian</div>
    	  <div class='prod_box_big'>

          <div class='details_big_box'>
            <div class='product_title_big'>Prosedur Pembelian</div>
              <div>$r[static_content]</div>
          </div>    
          </div>

          ";                              
}


// Modul semua produk
elseif ($_GET[module]=='semuaproduk'){
  echo "<div class='center_title_bar'>Semua Produk</div>";

  // Tentukan berapa data yang akan ditampilkan per halaman (paging)
  $p      = new Paging2;
  $batas  = 12;
  $posisi = $p->cariPosisi($batas);

  // Tampilkan semua produk
  $sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT $posisi,$batas");

  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></div>
             <div class='product_img'>
               <a href='produk-$r[id_produk]-$r[produk_seo].html'>
               <img src='foto_produk/$r[gambar]' border='0' height='110'></a>
             </div>
             <div class='prod_price'><span class='price'>Rp. $harga <br />(stok: $r[stok])</span></div>                        
          </div>
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             <a href='aksi.php?module=keranjang&act=tambah&id=$r[id_produk]' class='prod_buy'>beli</a>            
             <a href='produk-$r[id_produk]-$r[produk_seo].html' class='prod_details'>selengkapnya</a>            
          </div> 
          </div>";
  }  
    
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halproduk], $jmlhalaman);

  echo "<div class='center_title_bar'>Halaman : $linkHalaman </div>";
}


// Modul keranjang belanja
elseif ($_GET[module]=='keranjangbelanja'){
  // Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysql_num_rows($sql);
  if($ketemu < 1){
    echo "<script>window.alert('Keranjang Belanjanya Masih Kosong');
        window.location=('index.php')</script>";
    }
  else{  
  
    echo "<div class='center_title_bar'>Keranjang Belanja</div>
          <div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>
          <form method=post action=aksi.php?module=keranjang&act=update>
          <table border=0 cellpadding=3 align=center>
          <tbody>
          <tr bgcolor=#6da6b1><th>No</th><th>Produk</th><th>Nama Produk</th><th>Berat(Kg)</th><th>Qty</th>
          <th>Harga</th><th>Sub Total</th><th>Hapus</th></tr>";  
  
  $no=1;
  while($r=mysql_fetch_array($sql)){
    $subtotal    = $r[harga] * $r[jumlah];
    $total       = $total + $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($r[harga]);
    
    echo "<tr bgcolor=#dad0d0><td>$no</td><input type=hidden name=id[$no] value=$r[id_orders_temp]>
              <td align=center><br><img src=foto_produk/small_$r[gambar]></td>
              <td>$r[nama_produk]</td>
       			  <td align=center>$r[berat]</td>
              <td><input type=text name='jml[$no]' value=$r[jumlah] size=1 onkeypress=\"return harusangka(event)\"></td>
              <td>$harga</td>
              <td>$subtotal_rp</td>
              <td align=center><a href='aksi.php?module=keranjang&act=hapus&id=$r[id_orders_temp]'>
              <img src=images/kali.png border=0 title=Hapus></a></td>
          </tr>";
    $no++; 
  } 
  echo "<tr><td colspan=6 align=right><br><b>Total</b>:</td><td colspan=2><br>Rp. <b>$total_rp</b></td></tr>
        <tr><td colspan=2><br /><a href=javascript:history.go(-1)><img src=images/lanjutkan.jpg border=0></a><br /></td>
        <td colspan=2><br /><input type=image src='images/update.jpg' border=0><br /></td>
        <td colspan=4 align=right><br /><a href=selesai-belanja.html><img src=images/selesai.jpg  border=0></a><br /></td></tr>
        </tbody></table></form></div>
          </div>    <br />
		  Apabila Anda mengubah jumlah (Qty), jangan lupa tekan tombol <b>Update Keranjang</b>.<br />  
        Total harga diatas belum termasuk ongkos kirim yang akan dihitung saat <b>Selesai Belanja</b>
          </div>
            <div class='bottom_prod_box_big'></div>
			
          </div>
        <div class='keterangan'>
        .</div>";
  }

}

// Modul hubungi kami
elseif ($_GET[module]=='hubungikami'){
  echo "<div class='center_title_bar'>Hubungi Kami</div>
    	  <div class='prod_box_big'>


          <div class='details_big_box'>
            <div class='product_title_big'>Hubungi Kami Secara Online:</div>
              <div>
        <table width=100% style='border: 1pt dashed #0000CC;padding: 10px;'>
        <form action=hubungi-aksi.html method=POST>
        <tr><td>Nama</td><td> : <input type=text name=nama size=30></td></tr>
        <tr><td>Email</td><td> : <input type=text name=email size=30></td></tr>
        <tr><td>Subjek</td><td> : <input type=text name=subjek size=40></td></tr>
        <tr><td valign=top>Pesan</td><td> <textarea name=pesan  style='width: 270px; height: 100px;'></textarea></td></tr>
        <tr><td>&nbsp;</td><td><img src='captcha.php'></td></tr>
        <tr><td>&nbsp;</td><td>(masukkan 6 kode di atas)<br /><input type=text name=kode size=6 maxlength=6><br /></td></tr>
        </td><td colspan=2><input type=submit name=submit value=Kirim></td></tr>
        </form></table>

          </div>    
          </div>

          </div>";                              
}

// Modul hubungi aksi
elseif ($_GET[module]=='hubungiaksi'){
$nama=trim($_POST['nama']);
$email=trim($_POST['email']);
$subjek=trim($_POST['subjek']);
$pesan=trim($_POST['pesan']);

if (empty($nama)){
  echo "Anda belum mengisikan NAMA<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($email)){
  echo "Anda belum mengisikan EMAIL<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($subjek)){
  echo "Anda belum mengisikan SUBJEK<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($pesan)){
  echo "Anda belum mengisikan PESAN<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
else{
	if(!empty($_POST['kode'])){
		if($_POST['kode']==$_SESSION['captcha_session']){

  mysql_query("INSERT INTO hubungi(nama,
                                   email,
                                   subjek,
                                   pesan,
                                   tanggal) 
                        VALUES('$_POST[nama]',
                               '$_POST[email]',
                               '$_POST[subjek]',
                               '$_POST[pesan]',
                               '$tgl_sekarang')");

  echo "<div class='center_title_bar'>Hubungi Kami</div>
    	  <div class='prod_box_big'>
        	
          <div class='details_big_box'>
            <div class='product_title_big'>Terimakasih</div>
              <div>
              <br />Terimakasih telah menghubungi kami.<br /><br /> Kami akan segera membalasnya ke email Anda.
              </div>
 
          </div>

          </div>";
		}else{
			echo "Kode yang Anda masukkan tidak cocok<br />
			      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
		}
	}else{
		echo "Anda belum memasukkan kode<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
	}
}                              
}


// Modul hasil pencarian produk 
elseif ($_GET['module']=='hasilcari'){
  // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST['kata']);
  // mencegah XSS
  $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);

  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  $cari = "SELECT * FROM produk WHERE nama_produk LIKE '%$kata%'" ;
 //   for ($i=0; $i<=$jml_kata; $i++){
 //     $cari .= "deskripsi LIKE '%$pisah_kata[$i]%' OR nama_produk LIKE '%$pisah_kata[$i]%'";
 //     if ($i < $jml_kata ){
 //       $cari .= " OR ";
 //     }
 //   }
  $cari .= " ORDER BY id_produk DESC LIMIT 7";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  echo "<div class='center_title_bar'>Hasil Pencarian</div>";

  if ($ketemu > 0){
  echo "<div class='prod_details_cari'>Ditemukan <b>$ketemu</b> produk dengan kata <font style='background-color:#00FFFF'><b>$kata</b></font> : </div>";
    while($t=mysql_fetch_array($hasil)){
      // Tampilkan hanya sebagian isi produk
      $isi_produk = htmlentities(strip_tags($t['deskripsi'])); // mengabaikan tag html
      $isi = substr($isi_produk,0,250); // ambil sebanyak 250 karakter
      $isi = substr($isi_produk,0,strrpos($isi," ")); // potong per spasi kalimat
    	  echo "<div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
            <div class='product_title_big'><a href=produk-$t[id_produk]-$t[produk_seo].html>$t[nama_produk]</a></div>
              <div>
              <br />$isi ... <a href=produk-$t[id_produk]-$t[produk_seo].html>selengkapnya</a>
              </div>
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>";                      
      }        
    }                                                          
  else{
    echo "<p>Tidak ditemukan produk dengan kata <b>$kata</b></p>";
  }
}


// Modul selesai belanja
elseif ($_GET[module]=='selesaibelanja'){
  $sid = session_id();
  $sql = mysql_query("SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysql_num_rows($sql);
  if($ketemu < 1){
   echo "<script> alert('Keranjang belanja masih kosong');window.location='index.php'</script>\n";
   	 exit(0);
	}
	else{

  echo "<div class='center_title_bar'>Data Pembeli</div>";

    	  echo "<div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
                   
          <div class='details_big_cari'>
              <div>
      <form name=form action=simpan-transaksi.html method=POST onSubmit=\"return validasi(this)\">
      <table>
      <tr><td>Nama</td><td> : <input type=text name=nama size=30></td></tr>
      <tr><td>Alamat Lengkap</td><td> : <input type=text name=alamat size=60></td></tr>
      <tr><td>Telpon/HP</td><td> : <input type=text name=telpon></td></tr>
      <tr><td>Email</td><td> : <input type=text name=email></td></tr>
      <tr><td valign=top>Kota Tujuan</td><td> :  
      <select name='kota'>
      <option value=0 selected>- Pilih Kota -</option>";
      $tampil=mysql_query("SELECT * FROM kota ORDER BY nama_kota");
      while($r=mysql_fetch_array($tampil)){
         echo "<option value=$r[id_kota]>$r[nama_kota]</option>";
      }
  echo "</select> <br /><br />*)  Apabila tidak terdapat nama kota tujuan Anda, pilih <b>Lainnya</b>
                  <br />**) Ongkos kirim dihitung berdasarkan kota tujuan</td></tr>
        <tr><td>&nbsp;</td><td><img src='captcha.php'></td></tr>
        <tr><td>&nbsp;</td><td>(Masukkan 6 kode diatas)<br /><input type=text name=kode size=6 maxlength=6><br /></td></tr>
      <tr><td colspan=2><input type=submit value=Proses></td></tr>
      </table>
              </div>
             
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>";                      
  }
}      


// Modul simpan transaksi
elseif ($_GET[module]=='simpantransaksi'){
$kar1=strstr($_POST[email], "@");
$kar2=strstr($_POST[email], ".");

if (empty($_POST[nama]) || empty($_POST[alamat]) || empty($_POST[telpon]) || empty($_POST[email]) || empty($_POST[kota]) || empty($_POST[kode])){
  echo "Data yang Anda isikan belum lengkap<br />
  	    <a href='selesai-belanja.html'><b>Ulangi Lagi</b>";
}
elseif (!ereg("[a-z|A-Z]","$_POST[nama]")){
  echo "Nama tidak boleh diisi dengan angka atau simbol.<br />
 	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
}
elseif (strlen($kar1)==0 OR strlen($kar2)==0){
  echo "Alamat email Anda tidak valid, mungkin kurang tanda titik (.) atau tanda @.<br />
 	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
}
else{

// fungsi untuk mendapatkan isi keranjang belanja
function isi_keranjang(){
	$isikeranjang = array();
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp WHERE id_session='$sid'");
	
	while ($r=mysql_fetch_array($sql)) {
		$isikeranjang[] = $r;
	}
	return $isikeranjang;
}

$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");

if(!empty($_POST['kode'])){
  if($_POST['kode']==$_SESSION['captcha_session']){

function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}

$nama   = antiinjection($_POST['nama']);
$alamat = antiinjection($_POST['alamat']);
$telpon = antiinjection($_POST['telpon']);

// simpan data pemesanan 
mysql_query("INSERT INTO orders(nama_kustomer, alamat, telpon, email, tgl_order, jam_order, id_kota) 
             VALUES('$nama','$alamat','$telpon','$_POST[email]','$tgl_skrg','$jam_skrg','$_POST[kota]')");
  
// mendapatkan nomor orders
$id_orders=mysql_insert_id();

// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
$isikeranjang = isi_keranjang();
$jml          = count($isikeranjang);

// simpan data detail pemesanan  
for ($i = 0; $i < $jml; $i++){
  mysql_query("INSERT INTO orders_detail(id_orders, id_produk, jumlah) 
               VALUES('$id_orders',{$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['jumlah']})");
}
  
// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
for ($i = 0; $i < $jml; $i++) {
  mysql_query("DELETE FROM orders_temp
	  	         WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
}

  echo "<div class='center_title_bar'>Proses Transaksi Selesai</div>";

    	  echo "<div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
                 
          <div class='details_big_cari'>
              <div>
      Data pemesan beserta ordernya adalah sebagai berikut: <br />
      <table>
      <tr><td>Nama           </td><td> : <b>$nama</b> </td></tr>
      <tr><td>Alamat Lengkap </td><td> : $alamat </td></tr>
      <tr><td>Telpon         </td><td> : $telpon </td></tr>
      <tr><td>E-mail         </td><td> : $_POST[email] </td></tr></table><hr /><br />
      
      Nomor Order: <b>$id_orders</b><br /><br />";

      $daftarproduk=mysql_query("SELECT * FROM orders_detail,produk 
                                 WHERE orders_detail.id_produk=produk.id_produk 
                                 AND id_orders='$id_orders'");

echo "<table cellpadding=10>
      <tr bgcolor=#6da6b1><th>No</th><th>Nama Produk</th><th>Berat(Kg)</th><th>Qty</th><th>Harga</th><th>Sub Total</th></tr>";
      
$pesan="Terimakasih telah melakukan pemesanan online di Selpy Cell <br /><br />  
        Nama: $nama <br />
        Alamat: $alamat <br/>
        Telpon: $telpon <br /><hr />
        
        Nomor Order: $id_orders <br />
        Data order Anda adalah sebagai berikut: <br /><br />";
        
$no=1;
while ($d=mysql_fetch_array($daftarproduk)){
   $subtotalberat = $d[berat] * $d[jumlah]; // total berat per item produk 
   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli

   $subtotal    = $d[harga] * $d[jumlah];
   $total       = $total + $subtotal;
   $subtotal_rp = format_rupiah($subtotal);    
   $total_rp    = format_rupiah($total);    
   $harga       = format_rupiah($d[harga]);

   echo "<tr bgcolor=#dad0d0><td>$no</td><td>$d[nama_produk]</td><td align=center>$d[berat]</td><td align=center>$d[jumlah]</td><td>Rp. $harga</td><td>Rp. $subtotal_rp</td></tr>";

   $pesan.="$d[jumlah] $d[nama_produk] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
   $no++;
}

$ongkos=mysql_fetch_array(mysql_query("SELECT ongkos_kirim FROM kota WHERE id_kota='$_POST[kota]'"));
$ongkoskirim1=$ongkos[ongkos_kirim];
$ongkoskirim = $ongkoskirim1 * $totalberat;

$grandtotal    = $total + $ongkoskirim; 

$ongkoskirim_rp = format_rupiah($ongkoskirim);
$ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
$grandtotal_rp  = format_rupiah($grandtotal);  

$pesan.="<br /><br />Total : Rp. $total_rp 
         <br />Ongkos Kirim untuk Tujuan Kota Anda : Rp. $ongkoskirim1_rp/Kg 
         <br />Total Berat : $totalberat Kg
         <br />Total Ongkos Kirim  : Rp. $ongkoskirim_rp		 
         <br />Grand Total : Rp. $grandtotal_rp 
         <br /><br />Silahkan lakukan pembayaran ke Rekening Selpy Cell";

$subjek="Pemesanan Online Selpy Cell";

// Kirim email dalam format HTML
$dari = "From: admin@selpycell.com\r\n";
$dari .= "Content-type: text/html\r\n";

// Kirim email ke kustomer
mail($_POST[email],$subjek,$pesan,$dari);

// Kirim email ke pengelola toko online
mail("admin@selpycell.com",$subjek,$pesan,$dari);

echo "<tr><td colspan=5 align=right>Total : Rp. </td><td align=right><b>$total_rp</b></td></tr>
      <tr><td colspan=5 align=right>Ongkos Kirim untuk Tujuan Kota Anda: Rp. </td><td align=right><b>$ongkoskirim1_rp</b>/Kg</td></tr>      
	    <tr><td colspan=5 align=right>Total Berat : </td><td align=right><b>$totalberat Kg</b></td></tr>
      <tr><td colspan=5 align=right>Total Ongkos Kirim : Rp. </td><td align=right><b>$ongkoskirim_rp</b></td></tr>      
      <tr><td colspan=5 align=right>Grand Total : Rp. </td><td align=right><b>$grandtotal_rp</b></td></tr>
      </table>";
echo "<hr /><br />      
              </div>
          </div>    
          
            <div class='bottom_prod_box_big'></div>
          </div>";                      
}
else{
echo "Kode yang Anda masukkan tidak cocok<br />
<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
}
}else{
echo "Anda belum memasukkan kode<br />
<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
}

}
}
?>

<?php
	$sid = session_id();
	$sql = mysql_query("SELECT SUM(jumlah*harga) as total,SUM(jumlah) as totaljumlah FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
			                
	while($r=mysql_fetch_array($sql)){

  if ($r[totaljumlah] != ""){
    $total_rp    = format_rupiah($r[total]);

    echo "<i><a href='keranjang-belanja.html'>$r[totaljumlah] item</a></i><br />
          <span class='border_cart'></span>
          Total: <span class='price'>Rp. $total_rp</span>";
  }
  else{
    echo "<i>0 item</i><br />
          <span class='border_cart'></span>
          Total: <span class='price'>Rp. 0</span>";
  }
  }
?>

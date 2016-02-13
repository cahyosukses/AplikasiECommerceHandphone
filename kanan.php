      <div class="title_box">Cari Produk</div>  
     <div class="border_box">
		<form method="POST" action="hasil-pencarian.html">
            <input class="search_input" name="kata" type="text">
            <input src="images/search.gif" class="search_bt" type="image">
          </form>
     </div>  
     

     <div class="shopping_cart">
        <div class="title_box">Keranjang Belanja</div>
        <div class="cart_details">
           <?php require_once "item.php";?>
        </div>    
        <div class="cart_icon"><img src="images/shoppingcart.png" alt="" title="" width="35" border="0" height="35">
        </div>        
      </div>	
   
     <div class="title_box">Produk Pilihan</div>  
     <div class="border_box">
        <?php
      $best=mysql_query("SELECT * FROM produk ORDER BY RAND() LIMIT 2");
      while($a=mysql_fetch_array($best)){
        $harga = format_rupiah($a[harga]);
		    echo "<div class='product_title'><a href='produk-$a[id_produk]-$a[produk_seo].html'>$a[nama_produk]</a></div>
         <div class='product_img'>
             <a href='produk-$a[id_produk]-$a[produk_seo].html'>
                <img src='foto_produk/$a[gambar]' border='0' height='110'>
             </a>
         </div>
         <div class='prod_price'><span class='price'>Rp. $harga</span></div>";
      }

        ?>
     </div>  
     
     
     <div class="banner_adds">
     
     <a href="#"><img src="images/bann1.jpg" alt="" title="" border="0" /></a>
     </div>        
     
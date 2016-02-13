    <div class="title_box">Kategori</div>
    
        <ul class="left_menu">
        <?php
            $kategori=mysql_query("select nama_kategori, kategori.id_kategori, kategori_seo,  
                                  count(produk.id_produk) as jml 
                                  from kategori left join produk 
                                  on produk.id_kategori=kategori.id_kategori 
                                  group by nama_kategori");
            $no=1;
            while($k=mysql_fetch_array($kategori)){
              if(($no % 2)==0){
                echo "<li class='odd'><a href='kategori-$k[id_kategori]-$k[kategori_seo].html'> $k[nama_kategori] ($k[jml])</a></li>";
              }
              else{
                echo "<li class='even'><a href='kategori-$k[id_kategori]-$k[kategori_seo].html'> $k[nama_kategori] ($k[jml])</a></li>";              
              }
              $no++;
            }
            ?>
        </ul> 
        
        
     <div class="title_box">Produk Laris</div>  
     <div class="border_box">
        <?php
      $best=mysql_query("SELECT * FROM produk ORDER BY dibeli DESC LIMIT 2");
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
     
     
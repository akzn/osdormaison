<!-- get produk -->
<?php
		
	$id_kategori = $_GET['kat'];
	$qry = "SELECT * from tb_kategori where id_kategori=$id_kategori";
	$sql = mysql_query($qry); 
	if($sql === FALSE) { 
	    die(mysql_error()); // TODO: better error handling
	}
	$kat = mysql_fetch_array($sql);
	//pagination
	$qry = "SELECT * from tb_produk where id_kategori=$id_kategori ORDER BY id_produk DESC";
	$sql = mysql_query($qry); 
	if($sql === FALSE) { 
	    die(mysql_error()); // TODO: better error handling
	}
	$total = mysql_num_rows($sql);
	// How many items to list per page
    $limit = 12;

    // How many pages will there be
    $pages = ceil($total / $limit);

    // What page are we currently on?
    $page = $_GET['page'];
    if (!$page) {
    	$page = 1;
    }

    // Calculate the offset for the query
    $offset = ($page - 1)  * $limit;

    // Some information to display to the user
    $start = $offset + 1;
    $end = min(($offset + $limit), $total);

    // The "back" link
    $prevlink = ($page > 1) ? '<li><a href="?hal=kategori&kat='.$id_kategori.'&page=1" title="First page">&laquo;</a> <a href="?hal=kategori&kat='.$id_kategori.'&page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a></li>' : '<li class="disabled"><span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span></li>';

    // The "forward" link
    $nextlink = ($page < $pages) ? '<li><a href="?hal=kategori&kat='.$id_kategori.'&page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?hal=kategori&kat='.$id_kategori.'&page=' . $pages . '" title="Last page">&raquo;</a></li>' : '<li class="disabled"><span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span></li>';

    // Display the paging information
    $pagination =  '<div id="paging"><p>'. $prevlink. ' Page '. $page. ' of '. $pages. ' pages, displaying '. $start. '-'. $end. ' of '. $total. ' results '. $nextlink. ' </p></div>';

    for ($i=1; $i < $pages; $i++) { 
    	$htmlpages .= '<li><a href="?hal=kategori&kat='.$id_kategori.'&page=' . $i . '">'.$i.'</a></li>';
    }
	$pagination = '<ul class="pagination pagination-sm pull-right">'.$prevlink.$htmlpages.'<li>'.$nextlink.'</li></ul>';


    // Prepare the paged query
    $qrypage = $qry.' LIMIT '.$limit.' OFFSET '.$offset;
    $sqlpage = mysql_query($qrypage); 
	if($sqlpage === FALSE) { 
	    die(mysql_error()); // TODO: better error handling
	}
?>
<!-- ./get produk -->
<div class="row">
	<div class="col-md-12 text-center">
		<h3 class="">Kategori Produk</h3>
	</div>
</div>
<div class="row header-kategori">
	<div class="col-md-6">
		<h4 class=""><?=$kat['nama_kategori']?></h4>
	</div>
</div>
 <div class="row product-list">
                	<?php while($row = mysql_fetch_array($sqlpage)): ?>
                	<div class="col-sm-3 col-lg-3 col-md-3">
                        <div class="thumbnail">
                            <div class="div-img-thumbnail-big">
                                <img src="<?=BASE?>admin/img/produk/<?=$row['gambar']?>.jpg" alt="">
                            </div>
                            <div class="caption">
                                <h4 class="text-center"><?=uang($row['harga'])?></h4>
                                <h4 class="text-center"><a href="?hal=produk&id=<?=$row['id_produk']?>"><?=$row['nama_produk']?></a></h4>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-primary add-to-cart" data-id='<?=$row['id_produk']?>' data-price='<?=$row['harga']?>'>Tambahkan ke keranjang</a>
                            </div>
                        </div>
                    </div>
                	<?php endwhile; ?>
                </div>
<div class="row pagination">
                	<div class="col-md-12">
                		<?=$pagination?>
                	</div>
                </div>
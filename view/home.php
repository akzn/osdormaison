<!-- get produk -->
<?php

	//pagination
	$qry = "SELECT * from tb_produk ORDER BY id_produk DESC";
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
    $prevlink = ($page > 1) ? '<li><a href="?hal=home&page=1" title="First page">&laquo;</a> <a href="?hal=home&page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a></li>' : '<li class="disabled"><span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span></li>';

    // The "forward" link
    $nextlink = ($page < $pages) ? '<li><a href="?hal=home&page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?hal=home&page=' . $pages . '" title="Last page">&raquo;</a></li>' : '<li class="disabled"><span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span></li>';

    // Display the paging information
    $pagination =  '<div id="paging"><p>'. $prevlink. ' Page '. $page. ' of '. $pages. ' pages, displaying '. $start. '-'. $end. ' of '. $total. ' results '. $nextlink. ' </p></div>';

    for ($i=1; $i < $pages; $i++) { 
        $active = '';
        if ($i == $page ) {
            $active = 'class="active"';
        }
    	$htmlpages .= '<li '.$active.'><a href="?hal=home&page=' . $i . '">'.$i.'</a></li>';
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

            <div class="col-md-3 hidden">
                <p class="lead">Shop Name</p>
                <div class="list-group">
                    <a href="#" class="list-group-item">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                </div>
            </div>

            <div class="col-md-12">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="<?=BASE?>admin/img/slider/slide1.png" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="<?=BASE?>admin/img/slider/slide2.png" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="<?=BASE?>admin/img/slider/slide3.png" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-9">
                        
                <div class="row header-kategori">
                    <div class="col-md-6">
                        <h4 class="">Our Product</h4>
                    </div>
                </div>
                <div class="row product-list">
                    <?php while($row = mysql_fetch_array($sqlpage)): ?>
                    <div class="col-sm-3 col-lg-3 col-md-3">
                        <div class="thumbnail">
                            <div class="div-img-thumbnail">
                                <a class="product-name" href="?hal=produk&id=<?=$row['id_produk']?>"><img class="img-responsive" src="<?=BASE?>admin/img/produk/<?=$row['gambar']?>.jpg" alt="" ></a>
                            </div>
                            <div class="caption">
                                <h5 class="text-center" style="height: 30px;"><a class="product-name" href="?hal=produk&id=<?=$row['id_produk']?>"><?=$row['nama_produk']?></a></h5>
                                
                            </div>
                            <div class="text-center">
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-6 text-center">
                                        <h4 class="text-center" style="color:#222222;padding-left: 10px"><?=uang($row['harga'])?></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="" class="btn btn-primary add-to-cart" data-id='<?=$row['id_produk']?>' data-price='<?=$row['harga']?>'>Beli</a>
                                    </div>
                                </div>
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


                    </div>
                    <div class="col-md-3">
                        <div class="row header-kategori">
                            <div class="col-md-6">
                                <h4 class="">Kategori</h4>
                            </div>
                        </div>
                        <div class="row product-list row-berita sidebar-category">

                            <ul class="nav nav-pills nav-stacked">     
                            <?php 
                                $get_kategori=mysql_query("SELECT * from tb_kategori order by id_kategori desc");
                                while($kategori = mysql_fetch_array($get_kategori)): ?>

                                <li class="active"><a href="?hal=kategori&kat=<?=$kategori['id_kategori']?>"><!-- <span class="glyphicon glyphicon-briefcase"></span> --> <?=ucwords($kategori['nama_kategori'])?></a></li> 

                            <?php endwhile; ?>
                            </ul>

                            <?php /*
                            $get_berita=mysql_query("SELECT * from tb_berita order by id_berita desc limit 4");
                            while($berita = mysql_fetch_array($get_berita)): ?>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="<?=BASE?>admin/img/berita/<?=$berita['gambar']?>.jpg" class="img img-responsive img-thumbnail" width="50">
                                        </div>
                                        <div class="col-md-9">
                                            <p style="text-align:justify"><?=substr($berita['deskripsi'], 0, 200);?>...</p>
                                            <a href="?hal=berita&id=<?=$berita['id_berita']?>">Baca Selengkapnya...</a><br><br>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; */ ?>
                        </div>
                    </div>
                </div>


            </div>

        </div>
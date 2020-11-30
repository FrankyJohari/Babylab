<?php
include 'support/isset.php';

session_start();
if(!isset($_SESSION['login']))
{
	header ("Location: login.php");
} 

?>

<!DOCTYPE html>
<html>
<head>
	<!-- Link CSS Bootstrap online -->
		<!-- <link rel="stylesheet" href="support/bootstrap-4.3.1-dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<!-- End  -->
	<title>Menu</title>
	<script src="support/jquery.js"></script>
	<script src="support/jquery.mask.js"></script>
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.css">
	<script type="text/javascript" charset="utf8" src="DataTables/datatables.js"></script>
	<style> 
	.dropdown:hover .dropdown-menu {
    display: block;
    margin-top: 0; // remove the gap so it doesn't close
 	}
	html, body {
	margin:0;
	padding:0;
	height:100%;
	background: #456;

	}

 	</style>
	

	<!-- <script>
	$(document).ready(function() {
	    setInterval(timestamp, 1000);
	});

	function timestamp() {
	    $.ajax({
	        url: 'support/timestamp.php',
	        success: function(data) {
	            $('#timestamp').html(data);
	        },
	    });
	}

</script> -->

</head>
<body>
<div class="container" style="position:relative; max-width:none; padding: 0px 0px 0px 0px; min-height:100%; position:relative;">
<!-- Navbar -->
	<nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark">
	  <a class="navbar-brand" href="index.php">BabyLab</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse border border-dark" id="navbarNavDropdown">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Master
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
	          <a class="dropdown-item" href="?page=list_barang">Master Barang</a>
	          <a class="dropdown-item" href="?page=list_sup">Master Supplier</a>
	          <a class="dropdown-item" href="?page=coa">Master COA</a>
	        </div>

	      	<li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Transaksi
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
	          <a class="dropdown-item" href="?page=pembelian">Pembelian</a>
	          <a class="dropdown-item" href="?page=penjualan">Penjualan</a>
	        </div>

	      <li class="nav-item">
	        <a class="nav-link" href="?page=in_stock">Barang Masuk</a>
	      </li>

	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Kas
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
	          <a class="dropdown-item" href="?page=penerimaan">Penerimaan Kas</a>
	          <a class="dropdown-item" href="?page=pengeluaran">Pengeluaran Kas</a>
	        </div>
	      </li>
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Report
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
	          <a class="dropdown-item" href="?page=jurnal">Laporan Jurnal Umum</a>
	          <a class="dropdown-item" href="?page=laba">Laporan Laba Rugi</a>
	          <a class="dropdown-item" href="?page=neraca">Laporan Posisi Keuangan</a>
	          <a class="dropdown-item" href="?page=laporan_penjualan">Laporan Penjualan</a>
	          <a class="dropdown-item" href="?page=laporan_pembelian">Laporan Pembelian</a>
	        </div>

	      </li>
	    </ul>
		
		<div class="form-inline my-2 my-lg-0" >
			<a class="nav-link" href="?page=changepw">Change Password</a>
     		<a href="logout.php" class="btn btn-outline-light mr-sm-2" style="color:#ffa600;" type="submit">Sign Out</a>
    	</div>
	  </div>

	</nav>
<!-- End -->


<!-- Isi Body -->
<div class="container" style="padding-bottom: 8rem; padding-top: 3rem;	background: #456;" >
  
  
  
    <?php
    include "support/koneksi.php";
    $p=isset($_GET['page'])?$_GET['page']:null;
    switch($p){
    	default:
        include "home.php";
        // echo "WELCOME ADMIN";
        // echo "<div id='timestamp'></div>";
        break;
    	case "list_barang":
        include "list_barang.php";
        break;
        case "list_sup":
        include "list_supplier.php";
        break;
    	case "pembelian":
        include "pembelian.php";
        break;
        case "list_pembelian":
        include "list_pembelian.php";
        break;
        case "view_pembelian":
        include "pembelian_view.php";
        break;
    	case "edit_pembelian":
        include "pembelian_edit.php";
        break;
    	case "penerimaan":
        include "penerimaan.php";
        break;
    	case "pengeluaran":
        include "pengeluaran.php";
        break;
    	case "neraca":
        include "neraca.php";
        break;
        case "in_stock":
        include "list_stok_masuk.php";
        break;
        case "in_stock_detail":
        include "stok_masuk.php";
        break;
        case "in_stock_view":
        include "stok_view.php";
        break;
        case "penjualan":
        include "penjualan.php";
        break;
        case "list_penjualan":
        include "list_penjualan.php";
        break;
        case "view_penjualan":
        include "penjualan_view.php";
        break;
        case "coa":
        include "coa.php";
        break;
        case "jurnal":
        include "jurnal_umum.php";
        break;
        case "laba":
        include "laba_rugi.php";
        break;
        case "laporan_penjualan":
        include "laporan_penjualan.php";
        break;
        case "laporan_pembelian":
        include "laporan_pembelian.php";
        break;
        case "laporan_keuangan":
        include "laporan_posisi_keuangan.php";
		break;
		case "changepw":
		include "changepw.php";
		break;
    }
    ?>

</div>

<div class="container bg-dark py-3 text-light" style="margin: 0px 0px 0px 0px; width: 100%; max-width: none;bottom: 0; position: absolute;">
<p>© Copyright 2020 Babylab </p>
</div>

</div>


<!-- End -->
<!-- <script src="support/bootstrap-4.3.1-dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script>
// $('.dropdown').hover(function(){ 
//   $('.dropdown-toggle', this).trigger('click'); 
// });
//--------------------------
$('.dropdown').mouseenter(function(){
    if(!$('.navbar-toggle').is(':visible')) { // disable for mobile view
        if(!$(this).hasClass('open')) { // Keeps it open when hover it again
            $('.dropdown-toggle', this).trigger('click');
        }
    }
});
//------------------------------


</script>


</body>
</html>
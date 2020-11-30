
<?php
include "support/koneksi.php";
$tanggal = date('d-m-Y');
$idauto = mysqli_query($connect,"select * from master");
$noid= mysqli_fetch_array($idauto);
$id = $noid['id_pembelian'];

$finalid = $_GET['trxid'];
$master=mysqli_fetch_array(mysqli_query($connect,"select s.nama_sup as nama, p.tglpem as tgl, pd.instockdate as tglmsk from pembelian as p inner join master_supplier as s on p.supplier=s.id inner join pembelian_detail as pd on p.pemid=pd.trxid where pemid='$finalid'"));


?>


    <div class="card">
<!-- <form> -->
	<legend class="card-header text-white bg-secondary">Barang Masuk</legend>
    
    <br>
    <div class="container">
        <table class="table-borderless" style="border-collapse: collapse; width: 100%"> 
              <tr>
                <td>
                <label>No Nota</label>
            </td>
            <td colspan="4">
              <label><?php echo $finalid?> </label>  
              </td>
        </tr>
            <tr>
                <td>
                <label>Supplier</label>
            </td>
            <td colspan="4">
              <label><?php echo $master['nama']?> </label>  
              </td>
        </tr>
          <tr>
                <td>
                <label>Tanggal Pembelian</label>
            </td>
            <td colspan="4">
              <label><?php echo $master['tgl']?> </label>  
              </td>
        </tr>
          <tr>
                <td>
                <label>Tanggal Stok Masuk</label>
            </td>
            <td colspan="4">
              <label><?php echo $master['tglmsk']?> </label>  
              </td>
        </tr>
        
        </div>
    </table>
   
    <br>
    
    <!-- <div class="table-responsive"> -->

        <table class="table table-bordered table-hover">
      <thead>
            <tr>
                <td width=15%>Kode Barang</td>
                <td>Nama</td>
                <td width=15%>Quantity Order</td>
                <td width=15%>Quantity In</td>
            </tr>
        </thead>
          <?php
          $brg=mysqli_query($connect,"select * from pembelian_detail where trxid='$finalid' ");
          $total=mysqli_fetch_array(mysqli_query($connect,"select sum(subtotal) as total from pembelian_detail where trxid='$finalid'"));
          $nomor=0;
          while($r=mysqli_fetch_array($brg)){
          $findnama = mysqli_fetch_array(mysqli_query($connect,"select * from master_barang where kode=$r[kode]"));
          $nama = $findnama['nama_barang'];
          echo "<tr>
                <td><input type='hidden' name='hidden_id[$nomor]' value=$r[id] >$r[kode]</td>
                <td>$nama</td>
                <td>$r[jumlah]</td>
                <td>$r[stock_in]</td>
                
            </tr>";
            $nomor++;
    }
          ?>
          
      </table>

    </div>

<br>
</div>
  <div class="card-footer">

	<a href="index.php?page=in_stock"><button type="button" class="btn btn-secondary btn-lg ">Back</button></a>
	
</div>

<script src="support/jquery.js"></script>
<script src="support/jquery.mask.js"></script>
<script src="support/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="support/jquery-ui/jquery-ui.css">




<script>
    
    $(document).ready(function($){
    // Format mata uang.
    $( '.harga' ).mask('0.000.000.000', {reverse: true});
  
    });

    $( function() {
    $( "#trxdate" ).datepicker({dateFormat : 'dd-mm-yy'});

    });

</script>

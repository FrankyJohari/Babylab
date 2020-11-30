<!DOCTYPE html>
<html>
<head>
<?php
include "support/koneksi.php";
$tanggal = date('d-m-Y');

$finalid = $_GET['trxid'];
$master_data = mysqli_fetch_array(mysqli_query($connect,"select s.nama_sup as nama,DATE_FORMAT(p.tglpem,'%d-%m-%Y') AS tglpem from pembelian as p inner join master_supplier as s on p.supplier=s.id where pemid='$finalid'"));

?>

</head>
<body>
    <div class="card">
<!-- <form> -->
    <div class="card-header">
	<label>ID Transaksi</label>
	<input type="text" name="trxid" id="trxid" value="<?php echo $finalid; ?>" readonly>
	<label>Tanggal Tranksaksi</label>
	<input type="text" name="trxdate" id="trxdate" value="<?php echo $master_data['tglpem']; ?>" readonly>
    <!-- <span class="navbar-text">
    <button class="rounded btn-success" style="width:100%;" id="call" ><?php echo $nama_sup?></button>
    </span> -->
	</div>

	<legend class="card-header text-white bg-secondary">Barang Masuk</legend>
    
    <br>
    <div class="container">
        <table class="table-borderless" style="border-collapse: collapse; width: 100%"> 
            <tr>
                <td>
                <label>Supplier</label>
            </td>
            <td colspan="4">
                <input type="text" name="supplier" id="supplier" style="width:100%;" autocomplete="off" value="<?php echo $master_data['nama']; ?>" readonly>
            </td>
        </tr>
        
        </div>
    </table>
   
    <br>
    <form method="POST">
    <div class="table-responsive">

        <table class="table table-bordered table-hover" id="barang"></table>
    </div>
    </div>
<div class="form-actions">
<button type="submit" class="btn btn-warning btn-lg btn-block" name="update_form" id="simpan">Simpan</button>
</div>
</form>
<br>
</div>

<script src="support/jquery.js"></script>
<script src="support/jquery.mask.js"></script>
<script src="support/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="support/jquery-ui/jquery-ui.css">
<script>
    //mendeksripsikan variabel yang akan digunakan
    $(function(){
        //meload file pk dengan operator ambil barang dimana nantinya
        //isinya akan masuk di combo box
        trxid=$("#trxid").val();
        $("#kode").load("support/pemb_func.php","op=ambilbarang");
        
        // //meload isi tabel
        $("#barang").load("support/pemb_func.php","op=loadinbarang&trxid="+trxid);

        

             
// ketika call di tekan
        $("#call").click(function(){
        trxid=$("#trxid").val();
        
        $.ajax({
            url:"support/pemb_func.php",
            data:"op=edit&trxid="+trxid,
            cache:false,
            success:function(msg){
                    
                    $("#status").html('Transaksi Pembelian berhasil');
                    $("#kode").load("support/pemb_func.php","op=ambilbarang");
                    $("#barang").load("support/pemb_func.php","op=loadinbarang&trxid="+trxid);
                    $("#loading").hide();

                    data=msg.split("|");

                    $("#supplier").val(data[0]);
                    $("#trxdate").val(data[1]);
                    document.getElementById("trxid").disabled= true;
                    document.getElementById("simpan").disabled= false;
            }
        })
    })



        
    });
</script>



<script>
    
    $(document).ready(function($){
    // Format mata uang.
    $( '.harga' ).mask('0.000.000.000', {reverse: true});
  
    });

    $( function() {
    $( "#trxdate" ).datepicker({dateFormat : 'dd-mm-yy'});

    });

</script>
</body>
</html>
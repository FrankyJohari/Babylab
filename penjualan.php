<!DOCTYPE html>
<html>
<head>
	<title>Form Penjualan</title>
<?php
include "support/koneksi.php";
$tanggal = date('d-m-Y');

$idauto = mysqli_query($connect,"select * from master");
$noid= mysqli_fetch_array($idauto);
$id = $noid['id_penjualan']+1;

$finalid = "PEN/".date('y')."/".strtoupper(date('M'))."/".$id;

?>

</head>
<body>
    <div class="card">
<!-- <form> -->
    <div class="card-header">
	<label>ID Transaksi</label>
	<input type="text" name="trxid" id="trxid" value="No Nota" readonly>
	<label>Tanggal Tranksaksi</label>
	<input type="text" name="trxdate" id="trxdate" value="<?php echo $tanggal;?>" readonly>
	</div>

	<legend class="card-header text-white bg-secondary">Transaksi Penjualan</legend>
    
    <br>
    <div class="container">
        <table class="table-borderless" style="border-collapse: collapse; width: 100%"> 
            <tr>
                <td>
                <label>Customer</label>
            </td>
            <td colspan="4">
                <input type="text" name="customer" id="customer" style="width:100%;" autocomplete="off" autofocus="" required>
            </td>
        </tr>
        <tr>
    	<!-- Load data barang ke combo box -->
        <td width="10%">
    	   <label>Nama Barang</label>
        </td>
        <td width="58%">
           <select id="kode" style="width: 100%" required></select>
        </td>
    	<!-- end -->
        <td width="10%">
    	   <input type="text" name="harga" id="harga" class="harga" placeholder="Harga Barang" autocomplete="off" style="width:100%;">
        </td>
        <td width="7%">
        <input type="text" class="harga" name="quantity" id="quantity" placeholder="Quantity" style="width:100%;">
        </td>
        <td width="5%">
        <input type="text" name="stok" id="stok" placeholder="Stok" style="width:100%;" disabled>
        </td>
        <!-- <td width="10%">
        <input type="text" name="total" class="harga" placeholder="Total" readonly style="width:100%;">
        </td> -->
        <td width="10%">
        <button class="rounded btn-primary" style="width:100%;" id="tambah" >Tambah</button>
        </td>
        </tr>
        </div>
    </table>
   
    <br>
    <div class="table-responsive">
        <table id="barang" class="table table-bordered table-hover"></table>
    </div>
    </div>
<div class="form-actions">
<button id="simpan" class="btn btn-warning btn-lg btn-block">Simpan</button>
</div>
<!-- </form> -->
<br>
</div>

<script src="support/jquery.js"></script>
<script src="support/jquery.mask.js"></script>
<script src="support/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="support/jquery-ui/jquery-ui.css">
<link href="support/dist/css/select2.min.css" rel="stylesheet" />
<script src="support/dist/js/select2.min.js"></script>
<script>
    //mendeksripsikan variabel yang akan digunakan
    $(function(){
        //meload file pk dengan operator ambil barang dimana nantinya
        //isinya akan masuk di combo box

        $("#kode").load("support/pemb_func.php","op=ambilbarang");
        
        // //meload isi tabel
        $("#barang").load("support/pemb_func.php","op=barang&view=temp&act=penjualan");

        $("#nama").val("");
        $("#harga").val("");
        $("#quantity").val("");
        $("#stok").val("");

                //jika tombol tambah di klik
        $("#tambah").click(function(){
            String.prototype.replaceAll = function(search, replacement) {
            var target = this;
            return target.split(search).join(replacement);
             };
            console.log("sebelum if");
            kode=$("#kode").val();
            harga=$("#harga").val().replaceAll(".","");
            quantity1=$("#quantity").val().replaceAll(".","");
            quantity=0;
            quantity+=quantity1;
            stok=$("#stok").val();
            console.log("stok: "+stok);
            console.log("quantity: "+quantity);
            if(kode=="Kode Barang"){
                alert("Kode Barang Harus diisi");
                exit();
            }else if(quantity < 1){
                alert("Jumlah beli tidak boleh 0");
                $("#jumlah").focus();
                exit();
            }else if(kode == ""){
                alert("Nama barang masih kosong");
                $("#nama").focus();
                exit();

            }else if(quantity1 > stok){
                alert("Stok tidak mencukupi untuk dijual "+stok);
                $("#quantity").focus();
                console.log("gagal");
                exit();
            }
            kode=$("#kode").val();
            

            harga=$("#harga").val().replaceAll(".","");

            

            quantity=$("#quantity").val();
            
                                    
            $("#status").html("sedang diproses. . .");
            $("#loading").show();
            
            $.ajax({
                url:"support/pemb_func.php",
                data:"op=tambah&kode="+kode+"&harga="+harga+"&quantity="+quantity+"&option=add_item_penjualan",
                cache:false,
                success:function(msg){
                    if(msg=="sukses"){
                        $("#status").html("Berhasil disimpan. . .");
                    }else{
                        $("#status").html("ERROR. . .");
                    }
                    $("#loading").hide();
                    $("#nama").val("");
                    $("#harga").val("");
                    $("#quantity").val("");
                    $("#kode").load("support/pemb_func.php","op=ambilbarang");

                    $("#barang").load("support/pemb_func.php","op=barang&view=temp&act=penjualan");
                }
            });
        });
        
                //jika tombol simpan diklik
        $("#simpan").click(function(){
        trxdate=$("#trxdate").val();
        customer=$("#customer").val();

        if(customer==""){
                alert("Nama Customer Harus diisi");
                exit();
        }
        
        $.ajax({
            url:"support/pemb_func.php",
            data:"op=proses&tanggal="+trxdate+"&costumer="+customer+"&option=penjualan",
            cache:false,
            success:function(msg){
                data=msg.split("|");

                if(data[0]=='sukses'){
                    $("#status").html('Transaksi Pembelian berhasil');
                    alert('Transaksi Berhasil dengan Nomor Nota \n'+data[1]);
                    $("#kode").load("support/pemb_func.php","op=ambilbarang");
                    $("#barang").load("support/pemb_func.php","op=barang&view=temp&act=penjualan");
                    $("#loading").hide();
                    $("#nama").val("");
                    $("#harga").val("");
                    $("#quantity").val("");
                    $("#customer").val("");
                    $("#trxid").val(data[1]);
                    console.log(msg);
                }else{
                    $("#status").html('Transaksi Gagal');
                    alert('Transaksi Gagal');
                    console.log(msg);
                }
                
            }
        })
    })

    $("#kode").change(function(){
        var value= $(this).val();

            $.ajax({
            url:"support/pemb_func.php",
            data:"op=cek&kode="+value,
            cache:false,
            success:function(msg){
                data=msg.split("|");        
                    $("#status").html('Transaksi Pembelian berhasil');
                    $("#loading").hide();
                    $("#harga").val(data[0]);
                    $("#stok").val(data[1]);
                
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

    $(document).ready(function() {
    $('#kode').select2();
    });



</script>

</body>
</html>

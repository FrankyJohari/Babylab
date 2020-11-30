<!DOCTYPE html>
<html>
<head>
	<title>Form Pembelian</title>
<?php
include "support/koneksi.php";
$tanggal = date('d-m-Y');
$idauto = mysqli_query($connect,"select * from master");
$noid= mysqli_fetch_array($idauto);
$id = $noid['id_pembelian'];

$finalid = "PEM/".date('y')."/".strtoupper(date('M'))."/".$id;


?>

</head>
<body>
    <div class="card">
<!-- <form> -->
    <div class="card-header">
	<label>ID Transaksi</label>
	<input type="text" name="trxid" id="trxid" value="<?php echo $finalid; ?>" >
	<label>Tanggal Tranksaksi</label>
	<input type="text" name="trxdate" id="trxdate" value="<?php echo $tanggal;?>" readonly>
    <span class="navbar-text">
    <button class="rounded btn-primary" style="width:100%;" id="new" >New</button>
    
    </span>
    <span class="navbar-text">
    <button class="rounded btn-success" style="width:100%;" id="edit" >Edit</button>
    </span>

    </span>
	</div>

	<legend class="card-header text-white bg-secondary">Transaksi Pembelian</legend>
    
    <br>
    <div class="container">
        <table class="table-borderless" style="border-collapse: collapse; width: 100%"> 
            <tr>
                <td>
                <label>Supplier</label>
            </td>
            <td colspan="4">
                <input type="text" name="supplier" id="supplier" style="width:100%;" autocomplete="off" required>
            </td>
        </tr>
        <tr>
    	<!-- Load data barang ke combo box -->
        <td width="10%">
    	   <label>Nama Barang</label>
        </td>
        <td width="60%">
           <select id="kode" style="width: 100%" required></select>
        </td>
    	<!-- end -->
        <td width="10%">
    	   <input type="text" name="harga" id="harga" class="harga" placeholder="Harga Barang" autocomplete="off" style="width:100%;">
        </td>
        <td width="10%">
        <input type="number" name="quantity" id="quantity" placeholder="Quantity" style="width:100%;">
        </td>
        <!-- <td width="10%">
        <input type="text" name="total" class="harga" placeholder="Total" readonly style="width:100%;">
        </td> -->
        <td width="10%">
        	<input type="hidden" id="id_barang" value="">
        <button class="rounded btn-primary" style="width:100%;" id="edit_item" disabled >Update</button>
        </td>
        </tr>
        </div>
    </table>
   
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="barang"></table>

    </div>

<!-- </form> -->
<br>
</div>

<script src="support/jquery.js"></script>
<script src="support/jquery.mask.js"></script>
<script src="support/jquery-ui/jquery-ui.js"></script>
<link href="support/dist/css/select2.min.css" rel="stylesheet" />
<script src="support/dist/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="support/jquery-ui/jquery-ui.css">
<script>
    //mendeksripsikan variabel yang akan digunakan
    $(function(){
        //meload file pk dengan operator ambil barang dimana nantinya
        //isinya akan masuk di combo box

        // $("#kode").load("support/pemb_func.php","op=ambilbarang");
        
        // //meload isi tabel
        $("#barang").load("support/pemb_func.php","op=barang&view=edit");

        $("#nama").val("");
        $("#harga").val("");
        $("#quantity").val("");
        $("#stok").val("");
        $("#id_barang").val("");
        $("#supplier").val("");

                //jika tombol update di klik
        $("#edit_item").click(function(){
            kode=$("#kode").val();
            
            String.prototype.replaceAll = function(search, replacement) {
            var target = this;
            return target.split(search).join(replacement);
             };
            harga=$("#harga").val().replaceAll(".","");

            quantity=$("#quantity").val();

            if(kode=="Kode Barang"){
                alert("Kode Barang Harus diisi");
                exit();
            }else if(kode == ""){
                alert("Nama barang masih kosong");
                $("#nama").focus();
                exit();
            }
            kode=$("#kode").val();
            harga=$("#harga").val().replaceAll(".","");
            quantity=$("#quantity").val();
            id=$("#id_barang").val();
            trxid=$("#trxid").val();
            supplier=$("#supplier").val();

            $("#status").html("sedang diproses. . .");
            $("#loading").show();
            
            $.ajax({
                url:"support/pemb_func.php",
                data:"op=tambah&kode="+kode+"&harga="+harga+"&quantity="+quantity+"&id="+id+"&sup="+supplier+"&trxid="+trxid+"&option=up_item",
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

                    $("#barang").load("support/pemb_func.php","op=loadbarangmasuk&trxid="+trxid);
                }
            });
        });
        
// ketika edit di tekan
        $("#edit").click(function(){
        trxid=$("#trxid").val();
        
        $.ajax({
            url:"support/pemb_func.php",
            data:"op=edit&trxid="+trxid,
            cache:false,
            success:function(msg){
                    
                    $("#status").html('Transaksi Pembelian berhasil');
                    $("#kode").load("support/pemb_func.php","op=ambilbarang");
                    $("#barang").load("support/pemb_func.php","op=loadbarangmasuk&trxid="+trxid);
                    $("#loading").hide();

                    data=msg.split("|");

                    $("#nama").val("");
                    $("#harga").val("");
                    $("#quantity").val("");
                    $("#supplier").val(data[0]);
                    $("#trxdate").val(data[1]);
                    document.getElementById("edit_item").disabled= false;
                    document.getElementById("trxid").disabled= true;
            }
        })
    })

         $("#new").click(function(){
        document.getElementById("edit_item").disabled= true;
        document.getElementById("trxid").disabled= false;
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


    $(document).on('click','.button',function(){
        trxid=$("#trxid").val();
        if(this.click){
            $("#quantity").val($(this).data('jumlah'));
            $("#harga").val($(this).data('harga'));
            $("#id_barang").val($(this).attr('id'));
            document.getElementById('kode').value=$(this).data('kode');

            // $('#kode').select2().select2('val',$(this).data('kode'));
            $("#barang").load("support/pemb_func.php","op=loadbarangmasuk&trxid="+trxid);
        }else{
        	$("#barang").load("support/pemb_func.php","op=loadbarangmasuk&trxid="+trxid);
        }
            
    });

    // $(document).ready(function() {
    // $('#kode').select2();
    // });

</script>
</body>
</html>
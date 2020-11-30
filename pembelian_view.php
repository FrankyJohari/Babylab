
<?php
include "support/koneksi.php";
$tanggal = date('d-m-Y');

$finalid = $_GET['id'];
$brg=mysqli_query($connect,"select * from pembelian_detail where trxid='$finalid' ");
  
$master=mysqli_fetch_array(mysqli_query($connect,"select s.nama_sup as nama, p.tglpem as tgl from pembelian as p inner join master_supplier as s on p.supplier=s.id where pemid='$finalid'"));


?>


    <div class="card">
<!-- <form> -->

	<legend class="card-header text-white bg-secondary">Transaksi Pembelian</legend>
    
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
                <label>Tanggal</label>
            </td>
            <td colspan="4">
              <label><?php echo $master['tgl']?> </label>  
              </td>
        </tr>
        </div>
    </table>
   
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
      <thead>
            <tr>
                <td>Kode Barang</td>
                <td>Nama</td>
                <td>Harga</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>
        </thead>
          <?php
          $total=mysqli_fetch_array(mysqli_query($connect,"select sum(subtotal) as total from pembelian_detail where trxid='$finalid'"));
    while($r=mysqli_fetch_array($brg)){
        $findnama = mysqli_fetch_array(mysqli_query($connect,"select * from master_barang where kode=$r[kode]"));
        $nama = $findnama['nama_barang'];
        echo "<tr>
                <td>$r[kode]</td>
                <td>$nama</td>
                <td class='harga'>$r[harga]</td>
                <td>$r[jumlah]</td>
                <td class='harga'>$r[subtotal]</td>
            </tr>";
    }
    echo "<tr>
    <td></td>
        <td colspan='3'>Total</td>
        <td colspan='2' class='harga'>$total[total]</td>
    </tr>";

          ?>
          
      </table>

    </div>
      <br>
</div>

<div class="card-footer">

	<a href="index.php?page=list_pembelian"><button type="button" class="btn btn-secondary btn-lg ">Back</button></a>
	
</div>
</div>

<!-- </form> -->


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

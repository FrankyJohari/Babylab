<?php
$tanggal = date('d-m-Y');
$idauto = mysqli_query($connect,"select * from master");
$noid= mysqli_fetch_array($idauto);
$id = $noid['id_pengeluaran']+1;
$finalid = "OUT/".date('y')."/".strtoupper(date('M'))."/".$id;
?>

<div class="card">
  <h5 class="card-header">Pengeluaran Kas</h5>
  <div class="card-body">
   	<form method="POST">
   	<input type="hidden" name="idx" value="<?php echo $id;?>">
   	<div class="form-row">
	<div class="col">
   	<label>ID Transaksi</label>
	<input type="text" name="trxid" value="<?php echo $finalid; ?>" class="form-control" readonly>
	</div>
	<div class="col">
	<label>Tanggal Tranksaksi</label>
	<input type="text" name="trxdate" value="<?php echo $tanggal;?>" class="form-control" readonly>
	<br>
	</div>
  </div>
  	<div class="form-row">
  		<div class="col">
		<label>Akun</label>
		<select name="akun" class="form-control" required>
		<?php
    $data = mysqli_query($connect,"select * from account where main_acc='200' OR main_acc='300' OR main_acc='600' ");
      echo "<option value=''> Akun </option>";
    while($r= mysqli_fetch_array($data)){
    echo "<option value='$r[sub_acc]'>$r[sub_desc]</option>";
    }
    ?>
		</select>
		<br>
  		</div>
  	</div>
  
	<div class="form-row">
  		<div class="col">
		<label>Keterangan</label>
		<input type="text" name="keterangan" placeholder="Keterangan" id="keterangan" class="form-control" autocomplete="off" required>
		<br>
  		</div>
  	</div>
	<div class="form-row">
  		<div class="col">
		<label>Jumlah</label>
		<input type="text" name="total" placeholder="Jumlah" id="harga" class="form-control" autocomplete="off" required>
		<br>
  		</div>
  	</div>
	<button type="submit" name="simpan_pengeluaran" class="btn btn-warning btn-lg btn-block">Save</button>
   	</form>
  </div>
</div>
<script src="support/jquery.mask.js"></script>
<script>
    
    $(document).ready(function($){

    // Format mata uang.
  $( '#harga' ).mask('0.000.000.000', {reverse: true});
  

});

</script>

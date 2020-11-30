<?php
include "support/koneksi.php";

$listbarangquery= mysqli_query($connect,"SELECT * FROM master_barang ORDER BY kode");

?>

<!-- 	<script src="support/jquery.js"></script> -->
	<!-- <script src="support/jquery.mask.js"></script>
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.css">
	<script type="text/javascript" charset="utf8" src="DataTables/datatables.js"></script>
	 -->
	


	<div class="card">
	<h5 class="card-header">Master Barang</h5>
	<div class="card-body">
	<div class="table-responsive">
	<table class="table table-hover" id="example1" role="grid" aria-describedby="stock_data_info">
		<thead>
		<tr role="row">
		
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">No</th>
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">Nama Barang</th>
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">Harga Jual</th>
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">Jumlah</th>
			<th>Tools</th>
		
		</tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;

			while($fetchdata= mysqli_fetch_array($listbarangquery)){
				// $defaultstock =0;
				// $total=mysqli_fetch_array(mysqli_query($connect,"select sum(stock) as total from pembelian_detail where kode='$fetchdata[kode]'"));
				// $defaultstock += $total['total'];

			?>
			<tr role='row' class='odd'>
			<td> <?php echo $no;?></td>
			<td> <?php echo $fetchdata["nama_barang"];?></td>
			<td class="hargabarang"><?php echo $fetchdata["hargajual"];?></td>
			<td> <?php echo $fetchdata["jumlah"];?></td>
			<td> <button type="button" id="<?php echo $fetchdata['kode'];?>" class="btn btn-link btn-sm view_data" > Edit</a> </td>
			</tr>
			<?php
			$no++;
			}
			?>
		</tbody>
	</table>
	</div>
</div>
<div class="card-footer">

	<a href="index.php"><button type="button" class="btn btn-secondary btn-lg ">Menu</button></a>
	
	<button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target=".Modal_item">
  Add
	</button>
</div>
</div>


<!-- Modal -->
<div class="modal fade Modal_item" id="Modal_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
      <div class="modal-body">
      	<div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama Barang</label>
        <div class="col-sm-10">
		<input type="text" name="namabarang" id="namabarang" class="form-control" autocomplete="off" placeholder="Nama Barang" required>
		</div>
		</div>
		<div class="form-group row">
		<label class="col-sm-2 col-form-label">Harga</label>
		<div class="col-sm-10">
		<input type="text" name="hargabarang" id="hargabarang" class="hargabarang form-control" autocomplete="off" placeholder="Harga Jual" required>
		</div>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="simpan_barang" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade Modal_edit" id="Modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
      <div class="modal-body">
      	<div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama Barang</label>
        <div class="col-sm-10">
		<input type="text" name="namabarangedit" id="namabarangedit" class="form-control" autocomplete="off" placeholder="Nama Barang" required>
		</div>
		</div>
		<div class="form-group row">
		<label class="col-sm-2 col-form-label">Harga</label>
		<div class="col-sm-10">
		<input type="text" name="hargabarangedit" id="hargabarangedit" class="hargabarang form-control" autocomplete="off" placeholder="Harga Jual" required>
		<input type="hidden" name="hidden_id_edit" id="hidden_id_edit">
		</div>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="simpan_edit_barang" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
	
	
<script>
	
	$(document).ready(function($){

    // Format mata uang.
  $('.hargabarang').mask('0.000.000.000', {reverse: true});
	});


	$('.Modal_item').on('shown.bs.modal', function (e) {
 	$("#namabarang").focus();
});

$(document).ready(function($){
	$('.view_data').click(function(){
		var id = $(this).attr("id");

		$.ajax({
		url:"support/pemb_func.php",
            data:"op=edit_item&id="+id,
            cache:false,
            success:function(msg){
                	
                    
                    $("#loading").hide();

                    data=msg.split("|");
                    $("#namabarangedit").val(data[0]);
                    $("#hargabarangedit").val(data[1]);        
                	$("#hidden_id_edit").val(id);
            }	

		});
		$('.Modal_edit').modal("show");
		$('.Modal_edit').on('shown.bs.modal', function (e) {
 		$("#namabarangedit").focus();
		 	
		});
	});

});


</script>

<script>
  $(function () {
   $('').DataTable();
    $('#tableitem').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

<script>
  $(function () {
     $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        
      });
    });

  

  </script>


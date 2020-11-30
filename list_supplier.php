<?php
include "support/koneksi.php";

$listsupquery= mysqli_query($connect,"SELECT * FROM master_supplier ORDER BY id");

?>

<html>

<head>
	<title>Master Supplier</title>
<!-- 	<script src="support/jquery.js"></script> -->
	<!-- <script src="support/jquery.mask.js"></script>
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.css">
	<script type="text/javascript" charset="utf8" src="DataTables/datatables.js"></script>
	 -->
	

</head>

<body>
	<div class="card">
	<h5 class="card-header">Master Supplier</h5>
	<div class="card-body">
	<table class="table table-hover" id="example1" role="grid" aria-describedby="stock_data_info">
		<thead>
		<tr role="row">
		
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">No</th>
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">Nama Supplier</th>
			<th>Tools</th>
		
		</tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;

			while($fetchdata= mysqli_fetch_array($listsupquery)){
				// $defaultstock =0;
				// $total=mysqli_fetch_array(mysqli_query($connect,"select sum(stock) as total from pembelian_detail where kode='$fetchdata[kode]'"));
				// $defaultstock += $total['total'];

			?>
			<tr role='row' class='odd'>
			<td> <?php echo $no;?></td>
			<td> <?php echo $fetchdata["nama_sup"];?></td>
			<td> <button type="button" id="<?php echo $fetchdata['id'];?>" class="btn btn-link btn-sm view_data" > Edit</a> </td>
			</tr>
			<?php
			$no++;
			}
			?>
		</tbody>
	</table>
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
        <h5 class="modal-title" id="exampleModalLabel">New Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
      <div class="modal-body">
      	<div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama Supplier</label>
        <div class="col-sm-10">
		<input type="text" name="namasup" id="namasup" class="form-control" autocomplete="off" placeholder="Nama Supplier" required>
		</div>
		</div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="simpan_sup" class="btn btn-primary">Save changes</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form method="POST">
      <div class="modal-body">
      	<div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama Supplier</label>
        <div class="col-sm-10">
		<input type="text" name="namasupedit" id="namasupedit" class="form-control" autocomplete="off" placeholder="Nama Supplier" required>
    <input type="hidden" name="hidden_id_edit" id="hidden_id_edit">
          
		</div>
		</div>
		

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="simpan_edit_sup" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
	
	
<script>


	$('.Modal_item').on('shown.bs.modal', function (e) {
 	$("#namasup").focus();
});

$(document).ready(function($){
	$('.view_data').click(function(){
		var id = $(this).attr("id");

		$.ajax({
		url:"support/pemb_func.php",
            data:"op=edit_sup&id="+id,
            cache:false,
            success:function(msg){
                	
                    $("#loading").hide();

                    data=msg.split("|");
                    $("#namasupedit").val(data[0]);        
                	$("#hidden_id_edit").val(id);
            }	

		});
		$('.Modal_edit').modal("show");
		$('.Modal_edit').on('shown.bs.modal', function (e) {
 		$("#namasupedit").focus();
		 	
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

</body>



</html>
<?php
include "support/koneksi.php";

$listbarangquery= mysqli_query($connect,"SELECT * FROM account ORDER BY sub_acc");

?>

<html>

<head>
	<!-- <link rel="stylesheet" type="text/css" href="DataTables/datatables.css">
	<script type="text/javascript" charset="utf8" src="DataTables/datatables.js"></script>
	 -->
	

</head>

<body>
	<div class="card">
	<h5 class="card-header">Chart of Account</h5>
	<div class="card-body">
	<table class="table table-hover" id="example1" role="grid" aria-describedby="stock_data_info">
		<thead>
		<tr role="row">
		
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">No</th>
			
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">Number of Account</th>
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">Main Account</th>
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">Name of Account</th>
			<th>Tools</th>
		
		</tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;

			while($fetchdata= mysqli_fetch_array($listbarangquery)){
				$main_acc= mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM group_account where main_acc=$fetchdata[main_acc]"));

			?>
			<tr role='row' class='odd'>
			<td> <?php echo $no;?></td>
			<td> <?php echo $fetchdata["sub_acc"];?></td>
			<td> <?php echo $fetchdata["main_acc"];?> - <?php echo $main_acc["main_desc"];?></td>
			<td> <?php echo $fetchdata["sub_desc"];?></td>
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
        <h5 class="modal-title" id="exampleModalLabel">New Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
      <div class="modal-body">
      	<div class="form-group row">
      	<label class="col-sm-2 col-form-label">Nomor Account</label>
        <div class="col-sm-10">
		<input type="Number" name="nomorakun" id="nomorakun" class="form-control" autocomplete="off" placeholder="Nomor Akun" required>
		</div>
		</div>
		<div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama Account</label>
        <div class="col-sm-10">
		<input type="text" name="namaakun" id="namaakun" class="form-control" autocomplete="off" placeholder="Nama Akun" required>
		</div>
		</div>
		<div class="form-group row">
		<label class="col-sm-2 col-form-label">Type Account</label>
		<div class="col-sm-10">
		<select class="form-control" name="main_acc" id="main_acc">
			<?php 
			$query= mysqli_query($connect,"select * from group_account");
			while($fetchdata= mysqli_fetch_array($query)){
				echo "<option value='$fetchdata[main_acc]'>".$fetchdata[main_acc]." - ".$fetchdata[main_desc] ."</option>";
			}
		?>
		</select>
		</div>
    	</div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="simpan_akun" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal edit -->
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
      	<label class="col-sm-2 col-form-label">Nomor Account</label>
        <div class="col-sm-10">
		<input type="Number" name="nomorakunedit" id="nomorakunedit" class="form-control" autocomplete="off" placeholder="Nomor Akun" required>
		</div>
		</div>
      	<div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama Account</label>
        <div class="col-sm-10">
		<input type="text" name="namaakunedit" id="namaakunedit" class="form-control" autocomplete="off" placeholder="Nama Akun" required>
		</div>
		</div>
		<div class="form-group row">
		<label class="col-sm-2 col-form-label">Type Account</label>
		<div class="col-sm-10">
		<select class="form-control" name="main_acc_edit" id="main_acc_edit">
			<?php 
			$query= mysqli_query($connect,"select * from group_account");
			while($fetchdata= mysqli_fetch_array($query)){
				echo "<option value='$fetchdata[main_acc]'>".$fetchdata[main_acc]." - ".$fetchdata[main_desc] ."</option>";
			}
		?>
		</select>
		<input type="hidden" name="hidden_id_edit" id="hidden_id_edit">
		</div>
    	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="simpan_edit_akun" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
	
	
<script>

	$('.Modal_item').on('shown.bs.modal', function (e) {
 	$("#nomorakun").focus();
});

$(document).ready(function($){
	$('.view_data').click(function(){
		var id = $(this).attr("id");

		$.ajax({
		url:"support/pemb_func.php",
            data:"op=edit_akun&id="+id,
            cache:false,
            success:function(msg){
                	
                    
                    $("#loading").hide();

                    data=msg.split("|");

                    $("#nomorakunedit").val(data[0]);
                    $("#namaakunedit").val(data[1]);        
                	$("#hidden_id_edit").val(id);
                	document.getElementById('main_acc_edit').value=data[2];
                	
            }	

		});
		$('.Modal_edit').modal("show");
		$('.Modal_edit').on('shown.bs.modal', function (e) {
 		$("#nomorakunedit").focus();
		 	
		});
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
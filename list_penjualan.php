<!-- <script src="support/jquery.mask.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.css">
<script type="text/javascript" charset="utf8" src="DataTables/datatables.js"></script> -->

<div class="card">
	<h5 class="card-header">Daftar Penjualan</h5>
	<div class="card-body">
	<table class="table table-hover" id="example1" role="grid" aria-describedby="stock_data_info">
		<thead>
		<tr role="row">
		
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">No</th>
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">No Nota</th>
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">Customer</th>
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">Tanggal</th>
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">Total</th>
			<th>Tools</th>
		
		</tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			include "support/koneksi.php";
			$listpenj= mysqli_query($connect,"SELECT * FROM penjualan ORDER BY id desc");
			while($fetchdata= mysqli_fetch_array($listpenj)){
			?>
			<tr role='row' class='odd'>
			<td> <?php echo $no;?></td>
			<td> <?php echo $fetchdata["penid"];?></td>
			<td> <?php echo $fetchdata["customer"];?></td>
			<td> <?php echo $fetchdata["tglpen"];?></td>
			<td class="harga"><?php echo $fetchdata["totalsales"];?></td>
			<td><a href="?page=view_penjualan&id=<?php echo $fetchdata["penid"]; ?>" ><button class="btn btn-primary" >View</button></a></td>
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
	
</div>
</div>

<script>
	$(document).ready(function($){

    // Format mata uang.
  $('.harga').mask('0.000.000.000', {reverse: true});
  
});

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
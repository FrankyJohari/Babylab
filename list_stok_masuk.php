<!-- <link rel="stylesheet" type="text/css" href="DataTables/datatables.css">
<script type="text/javascript" charset="utf8" src="DataTables/datatables.js"></script> -->

<div class="card">
	<h5 class="card-header">Daftar Barang Masuk</h5>
	<div class="card-body">
	<table class="table table-hover" id="example1" role="grid" aria-describedby="stock_data_info">
		<thead>
		<tr role="row">
		
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">No</th>
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">No Nota</th>
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">Supplier</th>
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">Tanggal</th>
			<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">Status</th>
			<th>Tools</th>
		
		</tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			include "support/koneksi.php";
			$listpemb= mysqli_query($connect,"SELECT pembelian.pemid as pemid, master_supplier.nama_sup as supplier, pembelian.tglpem as tglpem, pembelian.status FROM pembelian INNER JOIN master_supplier ON pembelian.supplier = master_supplier.id ORDER BY pembelian.pemid desc");
			while($fetchdata= mysqli_fetch_array($listpemb)){
			?>
			<tr role='row' class='odd'>
			<td> <?php echo $no;?></td>
			<td> <?php echo $fetchdata["pemid"];?></td>
			<td> <?php echo $fetchdata["supplier"];?></td>
			<td> <?php echo $fetchdata["tglpem"];?></td>
			<td> <?php 
			if($fetchdata["status"]=="Delivered"){
				echo "<font color=green>".$fetchdata["status"]."</font>";
			}else{
				echo "<font color=red>".$fetchdata["status"]."</font>";
			};?></td>
			<td><a href="?page=in_stock_detail&trxid=<?php echo $fetchdata["pemid"]; ?>" ><button class="btn btn-primary" <?php if($fetchdata["status"]=="Delivered"){echo "disabled";} ?> >Form</button></a>
        <a href="?page=in_stock_view&trxid=<?php echo $fetchdata["pemid"]; ?>" ><button class="btn btn-secondary">View</button></a>
        </td>
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
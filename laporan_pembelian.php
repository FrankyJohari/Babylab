<?php
include "support/koneksi.php";
$curyear=date('Y');
$curmonth=date('F');
?>
	<div class="card">
	<div class="card-header">
		<div class="d-flex justify-content-center align-self-center">
		<h5>LAPORAN PEMBELIAN</h5>
		</div>
		<div class="d-flex justify-content-center">
			<h5>PERIODE</h5>	
		</div>
		<div class="d-flex justify-content-center">
			<h5 id="label_bulan"><?php echo $curmonth ?> </h5> 
			<h5> &nbsp; </h5>
			<h5 id="label_tahun"><?php echo $curyear ?></h5>	
		</div>
		
		<div class="d-flex justify-content-center align-self-center">
		<select class="form-control" id="bulan">
		<?php
		for($i=1; $i<=12; $i++){ 
    	$month = date('F', mktime(0, 0, 0, $i, 10));
    	$option="";
    	if($curmonth==$month){$option= "selected";} 
    	echo "<option value=".$i." ".$option.">".$month ."</option>"; 
    	// It will print: January,February,.............December,
		}
		?>
		</select>

		<select class="form-control" id="tahun">
			<?php
			$option="";
			$listtahun= mysqli_query($connect,"SELECT Year(tglpem) as tahun FROM pembelian GROUP BY tahun");
			while($fetchtahun= mysqli_fetch_array($listtahun)){
				if($curyear==$fetchtahun[tahun]){
					$option="selected";
				}else{
					$option="";
				}
				echo "<option value=".$fetchtahun[tahun]." ".$option.">".$fetchtahun[tahun]."</option>";
			}
			?>
		</select>
		</div>		

	</div>
	<div class="card-body">

	<div class="table-responsive">
	<table class="table table-hover table-sm" id="laporan_pembelian">
		
	</table>
	</div>

</div>
<div class="card-footer">

	
</div>
</div>


	
	
<script>
	


$(function(){


$("#laporan_pembelian").load("support/laporan_func.php","op=pembelian");


$("#bulan").change(function(){
        var bulan= $(this).val();
        var tahun= $("#tahun").val();
            $.ajax({
            url:"support/laporan_func.php",
            data:"op=check&bulan="+bulan,
            cache:false,
            success:function(msg){
                $("#laporan_pembelian").load("support/laporan_func.php","op=pembelian_history&bulan="+bulan+"&tahun="+tahun);
                document.getElementById('label_bulan').innerHTML=msg;
          		document.getElementById('label_tahun').innerHTML=tahun;
            }
        })
    });

$("#tahun").change(function(){
        var bulan= $("#bulan").val();
        var tahun= $("#tahun").val();
            $.ajax({
            url:"support/laporan_func.php",
            data:"op=check&bulan="+bulan,
            cache:false,
            success:function(msg){
                $("#laporan_pembelian").load("support/laporan_func.php","op=pembelian_history&bulan="+bulan+"&tahun="+tahun);
                document.getElementById('label_bulan').innerHTML=msg;
          		document.getElementById('label_tahun').innerHTML=tahun;
            }
        })
    });

});


</script>



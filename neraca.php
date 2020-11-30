<?php
include "support/koneksi.php";
$curyear=date('Y');
?>
<script src="support/jquery.mask.js"></script>
<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-center align-self-center">
        <h5>NERACA</h5>
    </div>
    <div class="d-flex justify-content-center">
        <h5>PERIODE</h5>    
    </div>
    <div class="d-flex justify-content-center">
        <h5 id="label_tahun"><?php echo "Per 31 Desember ".$curyear ?></h5>    
    </div>
    <div class="d-flex justify-content-center align-self-center">
    <select class="form-control-sm" id="tahun">
        <?php
        $option="";
        $listtahun= mysqli_query($connect,"SELECT Year(tanggal) as tahun FROM jurnal GROUP BY tahun");
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
        <table class="table table-bordered table-hover table-sm" id="laporan_neraca">
        </table>
    </div>
   	
  </div>
</div>


<script>
$(function(){


$("#laporan_neraca").load("support/laporan_func.php","op=neraca");


$("#tahun").change(function(){
        var tahun= $("#tahun").val();
            $.ajax({
            url:"support/laporan_func.php",
            data:"",
            cache:false,
            success:function(){
                $("#laporan_neraca").load("support/laporan_func.php","op=neraca_history&tahun="+tahun);
                document.getElementById('label_tahun').innerHTML='Per 31 Desember '+tahun;
            }
        })
    });

});


</script>
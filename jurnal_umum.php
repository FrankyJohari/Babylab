<?php
$tanggal = date('Y-m-d');
?>
<div class="card">
  <div class="card-header">

  <div class="d-flex justify-content-center align-self-center">
        <h5>Jurnal Umum</h5>
    </div>
    <div class="d-flex justify-content-center">
        <h5>PERIODE</h5>    
    </div>

    <div class="d-flex justify-content-center">
        <input type="text" name="trxdate" id="trxdate" value="<?php echo $tanggal;?>">    
    </div>

    </div>
  <div class="card-body">
   	
        <table class="table table-bordered table-hover table-sm table-responsive" id="jurnal">

        </table>
   	
  </div>
</div>



<script src="support/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="support/jquery-ui/jquery-ui.css">

<script>

$( function() {
$( "#trxdate" ).datepicker({dateFormat : 'dd-mm-yy'});

});


$(function(){
  

$("#jurnal").load("support/laporan_func.php","op=jurnal");


$("#trxdate").change(function(){
        var trxdate= $(this).val();
            $.ajax({
            url:"support/laporan_func.php",
            data:"op=jurnal_history&tanggal="+trxdate,
            cache:false,
            success:function(msg){
                $("#jurnal").html(msg);
                
            }
        });
    });


});


</script>
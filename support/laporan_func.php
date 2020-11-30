<?php
include "koneksi.php";

function numformat($num){
  if($num < 0){
    $num= $num * (-1);
    $negative = number_format($num);
    $result='('.$negative.')';
  }else{
    $result = number_format($num);
  }
  return $result;
}

$op=isset($_GET['op'])?$_GET['op']:null;
if($op=='penjualan'){
	$curmonth=date('m');
	$curyear=date('Y');
	$listpenjualanquery= mysqli_query($connect,"SELECT * FROM penjualan WHERE MONTH(tglpen)='$curmonth' AND YEAR(tglpen)='$curyear' ORDER BY penid ASC");
	$no = 1;
	$grandtotal = 0;
	echo "<thead>
		<tr>
			<th>No</th>
			<th>Nomor Nota</th>
			<th>Customer</th>
			<th>Tanggal</th>
			<th>Total Sales</th>
		</tr>
		</thead>";
	echo "<tbody>";

	while($fetchdata= mysqli_fetch_array($listpenjualanquery)){
		echo "<tr class='odd'>";
		echo "<td>".$no."</td>";
		echo "<td>".$fetchdata['penid']."</td>";
		echo "<td>".$fetchdata['customer']."</td>";
		echo "<td>".$fetchdata['tglpen']."</td>";
		echo "<td class='hargabarang'>".$fetchdata['totalsales']."</td>";
		echo "</tr>";
		$no++;
		$grandtotal += $fetchdata["totalsales"];

	}

	echo "<tr class='odd table-active'>";
	echo "<td colspan='3'></td>";
	echo "<td><b>TOTAL</b></td>";
	echo "<td class='hargabarang'>".$grandtotal."</td>";
	echo "</tr>";
	echo "</tbody>";

	echo "<script>
	
	$(document).ready(function($){

    // Format mata uang.
  $('.hargabarang').mask('0.000.000.000', {reverse: true});
	  
	});
	</script>";


}elseif($op=='penjualan_history'){
	$bulan=$_GET['bulan'];
	$tahun=$_GET['tahun'];

	$listpenjualanquery= mysqli_query($connect,"SELECT * FROM penjualan WHERE MONTH(tglpen)='$bulan' AND YEAR(tglpen)='$tahun' ORDER BY penid ASC");
	$no = 1;
	$grandtotal = 0;
	echo "<thead>
		<tr>
			<th>No</th>
			<th>Nomor Nota</th>
			<th>Customer</th>
			<th>Tanggal</th>
			<th>Total Sales</th>
		</tr>
		</thead>";
	echo "<tbody>";

	while($fetchdata= mysqli_fetch_array($listpenjualanquery)){
		echo "<tr class='odd'>";
		echo "<td>".$no."</td>";
		echo "<td>".$fetchdata['penid']."</td>";
		echo "<td>".$fetchdata['customer']."</td>";
		echo "<td>".$fetchdata['tglpen']."</td>";
		echo "<td class='hargabarang'>".$fetchdata['totalsales']."</td>";
		echo "</tr>";
		$no++;
		$grandtotal += $fetchdata["totalsales"];

	}

	echo "<tr class='odd table-active'>";
	echo "<td colspan='3'> </td>";
	echo "<td><b>TOTAL</b></td>";
	echo "<td class='hargabarang'>".$grandtotal."</td>";
	echo "</tr>";
	echo "</tbody>";

	echo "<script>
	
	$(document).ready(function($){

    // Format mata uang.
  $('.hargabarang').mask('0.000.000.000', {reverse: true});
	  
	});
	</script>";


}elseif($op=="check"){

	$bulan=$_GET['bulan'];
	for($i=1; $i<=12; $i++){ 
	$month = date('F', mktime(0, 0, 0, $i, 10));
	$option="";
	if($bulan==$i){echo $month;} 
	}
	
}elseif($op=='pembelian'){
	$curmonth=date('m');
	$curyear=date('Y');
	$listpenjualanquery= mysqli_query($connect,"SELECT master_supplier.nama_sup as supplier , pembelian.tglpem as tglpem, pembelian.pemid, pembelian.totalsales FROM pembelian INNER JOIN master_supplier ON pembelian.supplier = master_supplier.id WHERE MONTH(pembelian.tglpem)='$curmonth' AND YEAR(pembelian.tglpem)='$curyear' ORDER BY pembelian.pemid ASC");
	$no = 1;
	$grandtotal = 0;
	echo "<thead>
		<tr>
			<th>No</th>
			<th>Nomor Nota</th>
			<th>Customer</th>
			<th>Tanggal</th>
			<th>Total Sales</th>
		</tr>
		</thead>";
	echo "<tbody>";

	while($fetchdata= mysqli_fetch_array($listpenjualanquery)){
		echo "<tr class='odd'>";
		echo "<td>".$no."</td>";
		echo "<td>".$fetchdata['pemid']."</td>";
		echo "<td>".$fetchdata['supplier']."</td>";
		echo "<td>".$fetchdata['tglpem']."</td>";
		echo "<td class='hargabarang'>".$fetchdata['totalsales']."</td>";
		echo "</tr>";
		$no++;
		$grandtotal += $fetchdata["totalsales"];

	}

	echo "<tr class='odd table-active'>";
	echo "<td colspan='3'></td>";
	echo "<td><b>TOTAL</b></td>";
	echo "<td class='hargabarang'>".$grandtotal."</td>";
	echo "</tr>";
	echo "</tbody>";

	echo "<script>
	
	$(document).ready(function($){

    // Format mata uang.
  $('.hargabarang').mask('0.000.000.000', {reverse: true});
	  
	});
	</script>";


}elseif($op=='pembelian_history'){
	$bulan=$_GET['bulan'];
	$tahun=$_GET['tahun'];

	$listpenjualanquery= mysqli_query($connect,"SELECT master_supplier.nama_sup as supplier , pembelian.tglpem as tglpem, pembelian.pemid, pembelian.totalsales FROM pembelian INNER JOIN master_supplier ON pembelian.supplier = master_supplier.id WHERE MONTH(pembelian.tglpem)='$bulan' AND YEAR(pembelian.tglpem)='$tahun' ORDER BY pemid ASC");
	$no = 1;
	$grandtotal = 0;
	echo "<thead>
		<tr>
			<th>No</th>
			<th>Nomor Nota</th>
			<th>Customer</th>
			<th>Tanggal</th>
			<th>Total Sales</th>
		</tr>
		</thead>";
	echo "<tbody>";

	while($fetchdata= mysqli_fetch_array($listpenjualanquery)){
		echo "<tr class='odd'>";
		echo "<td>".$no."</td>";
		echo "<td>".$fetchdata['pemid']."</td>";
		echo "<td>".$fetchdata['supplier']."</td>";
		echo "<td>".$fetchdata['tglpem']."</td>";
		echo "<td class='hargabarang'>".$fetchdata['totalsales']."</td>";
		echo "</tr>";
		$no++;
		$grandtotal += $fetchdata["totalsales"];

	}

	echo "<tr class='odd table-active'>";
	echo "<td colspan='3'> </td>";
	echo "<td><b>TOTAL</b></td>";
	echo "<td class='hargabarang'>".$grandtotal."</td>";
	echo "</tr>";
	echo "</tbody>";

	echo "<script>
	
	$(document).ready(function($){

    // Format mata uang.
  $('.hargabarang').mask('0.000.000.000', {reverse: true});
	  
	});
	</script>";


}elseif($op=='neraca'){
	$curyear=date('Y');
	$listneracaquery= mysqli_query($connect,"SELECT account.sub_desc AS jurnal, SUM(jurnal.debit)-SUM(jurnal.kredit) AS Balance
    FROM jurnal
    INNER JOIN account ON jurnal.jurnal=account.sub_acc
    WHERE YEAR(jurnal.tanggal)<='$curyear'
    GROUP BY jurnal.jurnal ORDER BY jurnal.jurnal ASC");
	$no = 1;
  $totallancar=0;
  $totaltetap=0;
	$totalaktivalancar= 0;
  $totalaktivatetap= 0;
  $totalpasiva=0;
	echo "<thead>
		<tr>
			<td width='50%'>Aktiva</td>
      <td width='50%'>Pasiva</td>
		</tr>
		</thead>";
	echo "<tbody>
  <tr>
  <td width='50%'>";
  
  echo"<table class='table table-borderless'>
  <tr>
  <td colspan='2'>Aktiva Lancar</td>
  </tr>";
	$listaktivalancarquery= mysqli_query($connect,"SELECT account.sub_desc AS jurnal, SUM(jurnal.debit)-SUM(jurnal.kredit) AS Balance
    FROM jurnal
    INNER JOIN account ON jurnal.jurnal=account.sub_acc
    WHERE YEAR(jurnal.tanggal)<='$curyear' AND account.main_acc='100' AND account.sub_acc != '106'
    GROUP BY jurnal.jurnal ORDER BY jurnal.jurnal ASC");
  
  
	while($r= mysqli_fetch_array($listaktivalancarquery)){
		$balance ="";
    $value = 0;
    
		if(strpos($r['Balance'],'-') !== false){
            $value = str_replace("-", "",$r['Balance']);
			      $balance = numformat($value);
		}else{
			$balance = numformat($r['Balance']);
		}
		echo "<tr>
                <td>$r[jurnal]</td>
                <td align='right'>$balance</td>
            </tr>";
        $totalaktivalancar+= $r['Balance'];

	}
  $totallancar=$totalaktivalancar;
  $totalaktivalancar=numformat($totalaktivalancar);
	echo "<tr class='table-active'>
            <td>Total Aktiva Lancar</td>
            <td align='right'>$totalaktivalancar</td>
        	</tr>";
  echo"
  <tr><td colspan='2'> </td></tr>
  <tr>
  <td colspan='2'>Aktiva Tetap</td>
  </tr>";
  
	$listaktivatetapquery= mysqli_query($connect,"
  SELECT account.sub_desc AS jurnal, SUM(jurnal.debit)-SUM(jurnal.kredit) AS Balance
    FROM jurnal
    INNER JOIN account ON jurnal.jurnal=account.sub_acc
    WHERE YEAR(jurnal.tanggal)<='$curyear' AND jurnal.jurnal='106'
    GROUP BY jurnal.jurnal ORDER BY jurnal.jurnal ASC");
  
	while($r= mysqli_fetch_array($listaktivatetapquery)){
		$balance ="";
    $value = 0;
    
		if(strpos($r['Balance'],'-') !== false){
            $value = str_replace("-", "",$r['Balance']);
			      $balance = numformat($value);
		}else{
			$balance = numformat($r['Balance']);
		}
		echo "<tr>
                <td>$r[jurnal]</td>
                <td align='right'>$balance</td>
            </tr>";
        $totalaktivatetap+= $r['Balance'];

	}
  $totaltetap=$totalaktivatetap;
  $totalaktivatetap=numformat($totalaktivatetap);
	echo "<tr class='table-active'>
            <td>Total Aktiva Tetap</td>
            <td align='right'>$totalaktivatetap</td>
        	</tr>";
  
  $subtotalaktiva= $totallancar+$totaltetap;
  $subtotalaktiva = numformat($subtotalaktiva);
  echo "<tr class='table-active'>
            <td>Total Aktiva</td>
            <td align='right'>$subtotalaktiva</td>
        	</tr>
          </table>
          </td>";
  
  //Pasiva
  echo "<td width='50%'>";
  
  //labarugi atau perubahan modal 
  $total_beban = 0;
  $total_pendapatan = 0;
  		$labarugiquery=mysqli_query($connect,"SELECT account.main_acc, SUM(jurnal.debit)-SUM(jurnal.kredit) AS Balance FROM jurnal INNER JOIN account ON jurnal.jurnal=account.sub_acc WHERE (YEAR(jurnal.tanggal)<='$curyear') AND (account.main_acc ='400' OR account.main_acc='500' OR account.main_acc='600' OR account.main_acc='300') AND (jurnal.jurnal != '301') GROUP BY account.main_acc ORDER BY account.main_acc ASC");
		while($a=mysqli_fetch_array($labarugiquery)){
		$total_temp=0;
        $jumlah=0;
     
		if(strpos($a['Balance'],'-') !== false){
        $jumlah = str_replace("-", "",$a['Balance']);
		}else{
			$jumlah = $a['Balance'];
		}
		$total_temp+=$jumlah;
		if($a['main_acc']=="400"){
            $total_pendapatan=$total_temp;
  
        }elseif($a['main_acc']=="500" OR $a['main_acc']=="600" OR $a['main_acc']=="300"){
            $total_beban+=$total_temp;
      
        }

			}
		$total_keseluruhan = $total_pendapatan - $total_beban;
  
  
  echo"<table class='table table-borderless'>
  <tr>
  <td colspan='2'>Pasiva</td>
  </tr>";
	$listpasivaquery= mysqli_query($connect,"
  SELECT account.sub_desc AS jurnal, SUM(jurnal.kredit)-SUM(jurnal.debit) AS Balance
    FROM jurnal
    INNER JOIN account ON jurnal.jurnal=account.sub_acc
    WHERE YEAR(jurnal.tanggal)<='$curyear' AND jurnal.jurnal='301'
    GROUP BY jurnal.jurnal ORDER BY jurnal.jurnal ASC");
  
  $finallabarugi=0;
  $totalpasiva=0;
  $subtotalpasiva=0;
  
	while($r= mysqli_fetch_array($listpasivaquery)){
		$balance ="";
    $value = 0;
    
		if(strpos($r['Balance'],'-') !== false){
       $value = str_replace("-", "",$r['Balance']);
            if(strpos($total_keseluruhan,'-') !== false){
            $finallabarugi = str_replace("-", "",$total_keseluruhan);
		        $value = $value+$finallabarugi;
            $balance = numformat($value);  
              echo "<script>alert('Total Rugi balance - ' +$balance)</script>";
            }else{
              $value = $value - $total_keseluruhan;
              $balance = numformat($value);
            }
			      
		}else{
      $value= $r['Balance'];
			if(strpos($total_keseluruhan,'-') !== false){
            $finallabarugi = str_replace("-", "",$total_keseluruhan);
		        $value = $value-$finallabarugi;
            $balance = numformat($value);  
            }else{
              
              $value += $total_keseluruhan;
              $balance = numformat($value);
            }
			      
		}
    
		echo "<tr>
                <td>$r[jurnal]</td>
                <td align='right'>$balance</td>
            </tr>";
        $totalpasiva+= $r['Balance'];

	}
  $subtotalpasiva=$totalpasiva;
  $subtotalpasiva=numformat($subtotalpasiva);
  
  echo "<tr class='table-active'>
            <td>Total Pasiva</td>
            <td align='right'>$balance</td>
        	</tr>
          </table>
          </td>";

  
  
  
	echo "</tbody>";

	echo "<script>
            $(document).ready(function($){
            $( '.harga' ).mask('0.000.000.000', {reverse: true});
            });
            </script>";

}elseif($op=='neraca_history'){
	$curyear=$_GET['tahun'];
	$listneracaquery= mysqli_query($connect,"SELECT jurnal.jurnal AS nomorakun,  account.sub_desc AS jurnal, SUM(jurnal.debit)-SUM(jurnal.kredit) AS Balance
    FROM jurnal
    INNER JOIN account ON jurnal.jurnal=account.sub_acc
    WHERE (YEAR(jurnal.tanggal)<='$curyear') AND (account.main_acc ='100' OR account.main_acc='200' OR jurnal.jurnal='301') 
    GROUP BY jurnal.jurnal ORDER BY jurnal.jurnal ASC");
    $listneracanolquery= mysqli_query($connect,"SELECT account.sub_desc AS jurnal, SUM(jurnal.debit)-SUM(jurnal.kredit) AS Balance
    FROM jurnal
    INNER JOIN account ON jurnal.jurnal=account.sub_acc
    WHERE (YEAR(jurnal.tanggal)='$curyear') AND (account.main_acc ='400' OR account.main_acc='500' OR account.main_acc='600' OR account.main_acc='300') AND (jurnal.jurnal != '301') 
    GROUP BY jurnal.jurnal ORDER BY jurnal.jurnal ASC");
	$no = 1;
	$totalkredit= 0;
   	$totaldebit= 0;
	echo "<thead>
		<tr>
			<td width='60%''>Nama Detail Akun</td>
            <td width='20%'>Debit</td>
            <td width='20%''>Kredit</td>
		</tr>
		</thead>";
	echo "<tbody>";
	$total_keseluruhan = 0;
	$total_pendapatan = 0;
	$total_beban = 0;
	while($r= mysqli_fetch_array($listneracaquery)){
		$kredit = 0;
		$debit = 0;
		if(strpos($r['Balance'],'-') !== false){
            $kredit = str_replace("-", "",$r['Balance']);
			// $kredit = $r['Balance'];
		}else{
			$debit = $r['Balance'];
		}
		if($r['nomorakun']=='301'){
			
			$labarugiquery=mysqli_query($connect,"SELECT account.main_acc, SUM(jurnal.debit)-SUM(jurnal.kredit) AS Balance FROM jurnal INNER JOIN account ON jurnal.jurnal=account.sub_acc WHERE (YEAR(jurnal.tanggal)<'$curyear') AND (account.main_acc ='400' OR account.main_acc='500' OR account.main_acc='600' OR account.main_acc='300') AND (jurnal.jurnal != '301') GROUP BY account.main_acc ORDER BY account.main_acc ASC");
		while($a=mysqli_fetch_array($labarugiquery)){
		$total_temp=0;
		if(strpos($a['Balance'],'-') !== false){
        $jumlah = str_replace("-", "",$a['Balance']);
		}else{
			$jumlah = $a['Balance'];
		}
		$total_temp+=$jumlah;
		if($a['main_acc']=="400"){
            $total_pendapatan=$total_temp;
        }elseif($a['main_acc']=="500" OR $a['main_acc']=="600" OR $a['main_acc']=="300"){
            $total_beban+=$total_temp;
        }

			}
		$total_keseluruhan = $total_pendapatan - $total_beban;
    	if(strpos($total_keseluruhan,'-') !== false){
            $grand_total = str_replace("-", "",$total_keseluruhan);
            $kredit=$kredit-$grand_total;
            }else{
                $grand_total+=$total_keseluruhan;
                $kredit=$kredit+$grand_total;
            }


		}
		echo "<tr>
                <td>$r[jurnal]</td>
                <td class='harga'>$debit</td>
                <td class='harga'>$kredit</td>
            </tr>";
        $totalkredit+= $kredit;
   		$totaldebit+= $debit;
		$no++;

	}
	while($r= mysqli_fetch_array($listneracanolquery)){
	$kredit = 0;
	$debit = 0;
	if(strpos($r['Balance'],'-') !== false){
        $kredit = str_replace("-", "",$r['Balance']);
		// $kredit = $r['Balance'];
	}else{
		$debit = $r['Balance'];
	}
	echo "<tr>
            <td>$r[jurnal]</td>
            <td class='harga'>$debit</td>
            <td class='harga'>$kredit</td>
        </tr>";
    $totalkredit+= $kredit;
		$totaldebit+= $debit;
	$no++;

	}

	echo "<tr class='table-active'>
            <td>TOTAL</td>
            <td class='harga'>$totaldebit</td>
            <td class='harga'>$totalkredit</td>
        	</tr>";
	echo "</tbody>";

	echo "<script>
            $(document).ready(function($){
            $( '.harga' ).mask('0.000.000.000', {reverse: true});
            });
            </script>";

}elseif($op=='keuangan'){
	$bulan=date('m');
	$tahun=date('Y');
  
  $jumlah=0;
  $total_pendapatan=0;
  $total_beban=0;
  $total_keseluruhan=0;
  $grand_total=0;
		
			
			$labarugiquery=mysqli_query($connect,"SELECT account.main_acc, SUM(jurnal.debit)-SUM(jurnal.kredit) AS Balance FROM jurnal INNER JOIN account ON jurnal.jurnal=account.sub_acc WHERE (YEAR(jurnal.tanggal)<='$tahun') AND (MONTH(jurnal.tanggal)<='$bulan') AND (account.main_acc ='400' OR account.main_acc='500' OR account.main_acc='600' OR account.main_acc='300') AND (jurnal.jurnal != '301') GROUP BY account.main_acc ORDER BY account.main_acc ASC");
		while($a=mysqli_fetch_array($labarugiquery)){
		$total_temp=0;
		if(strpos($a['Balance'],'-') !== false){
        $jumlah = str_replace("-", "",$a['Balance']);
		}else{
			$jumlah = $a['Balance'];
		}
		$total_temp+=$jumlah;
		if($a['main_acc']=="400"){
            $total_pendapatan=$total_temp;
        }elseif($a['main_acc']=="500" OR $a['main_acc']=="600" OR $a['main_acc']=="300"){
            $total_beban+=$total_temp;
        }

			}
		$total_keseluruhan = $total_pendapatan - $total_beban;
    	
  
	echo "<thead>
            <tr>
                <td width='15%''>No Akun Indek</td>
                <td width='25%'>Nama Akun Indek</td>
                <td width='10%'>No Akun</td>
                <td width='30%'>Nama Akun Detail</td>
                <td width='20%'>Jumlah</td>
            </tr>
        </thead>";

    $total_aset = 0;
    $total_ekuitas = 0;
    $brg=mysqli_query($connect,"
    SELECT * FROM group_account WHERE main_acc='100' OR main_acc='300'");
	while($r=mysqli_fetch_array($brg)){
        $total_temp=0;
	    echo "<tr>
                <td>$r[main_acc]</td>
                <td>$r[main_desc]</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>";

	     
	    $jurnal=mysqli_query($connect,"
        SELECT jurnal.jurnal AS nomorakun, account.sub_desc AS jurnal, SUM(jurnal.debit)-SUM(jurnal.kredit) AS Balance, jurnal.tanggal AS tanggal, account.main_acc as main
        FROM jurnal
        INNER JOIN account ON jurnal.jurnal=account.sub_acc
        WHERE account.main_acc = '$r[main_acc]'
        AND MONTH(jurnal.tanggal)<='$bulan' AND YEAR(jurnal.tanggal)<='$tahun'
        GROUP BY jurnal.jurnal
        ORDER BY jurnal.jurnal ASC");
        

	    while($a=mysqli_fetch_array($jurnal)){
	    	
            if(strpos($a['Balance'],'-') !== false){
            $jumlah = str_replace("-", "",$a['Balance']);
            }else{
                $jumlah=$a['Balance'];
            }
        
        if($a['nomorakun']=='301'){
          
          if(strpos($total_keseluruhan,'-') !== false){
            $grand_total = str_replace("-", "",$total_keseluruhan);
            $jumlah=$jumlah-$grand_total;
            }else{
                $grand_total+=$total_keseluruhan;
                $jumlah=$jumlah+$grand_total;
            }
		
        }
            echo "<tr>
                    <td></td>
                    <td></td>
                    <td>$a[nomorakun]</td>
                    <td>$a[jurnal]</td>
                    <td class='harga'>$jumlah</td>
                </tr>";
                $total_temp+=$jumlah;
    
        }
        if($r['main_acc']=="100"){
            $total_aset=$total_temp;
        }elseif($r['main_acc']=="300"){
            $total_ekuitas+=$total_temp;
        }

	    echo "<tr class='table-secondary'>
                <td colspan='3'></td>
                <td>Total</td>
                <td class='harga'>$total_temp</td>
                
            </tr>";
        

    }
    
    
    echo "<script src='support/jquery.mask.js'></script>";
    echo "<script>
            $(document).ready(function($){
            $( '.harga' ).mask('0.000.000.000', {reverse: true});
            });
            </script>";


}elseif($op=='keuangan_history'){
	$bulan=$_GET['bulan'];
	$tahun=$_GET['tahun'];
  
  $jumlah=0;
  $total_pendapatan=0;
  $total_beban=0;
  $total_keseluruhan=0;
  $grand_total=0;
		
			
			$labarugiquery=mysqli_query($connect,"SELECT account.main_acc, SUM(jurnal.debit)-SUM(jurnal.kredit) AS Balance FROM jurnal INNER JOIN account ON jurnal.jurnal=account.sub_acc WHERE (YEAR(jurnal.tanggal)<='$tahun') AND (MONTH(jurnal.tanggal)<='$bulan') AND (account.main_acc ='400' OR account.main_acc='500' OR account.main_acc='600' OR account.main_acc='300') AND (jurnal.jurnal != '301') GROUP BY account.main_acc ORDER BY account.main_acc ASC");
		while($a=mysqli_fetch_array($labarugiquery)){
		$total_temp=0;
		if(strpos($a['Balance'],'-') !== false){
        $jumlah = str_replace("-", "",$a['Balance']);
		}else{
			$jumlah = $a['Balance'];
		}
		$total_temp+=$jumlah;
		if($a['main_acc']=="400"){
            $total_pendapatan=$total_temp;
        }elseif($a['main_acc']=="500" OR $a['main_acc']=="600" OR $a['main_acc']=="300"){
            $total_beban+=$total_temp;
        }

			}
		$total_keseluruhan = $total_pendapatan - $total_beban;
  
	echo "<thead>
            <tr>
                <td width='15%''>No Akun Indek</td>
                <td width='25%'>Nama Akun Indek</td>
                <td width='10%'>No Akun</td>
                <td width='30%'>Nama Akun Detail</td>
                <td width='20%'>Jumlah</td>
            </tr>
        </thead>";

    $total_aset = 0;
    $total_ekuitas = 0;
    $brg=mysqli_query($connect,"
    SELECT * FROM group_account WHERE main_acc='100' OR main_acc='300'");
	while($r=mysqli_fetch_array($brg)){
        $total_temp=0;
	    echo "<tr>
                <td>$r[main_acc]</td>
                <td>$r[main_desc]</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>";

	     
	    $jurnal=mysqli_query($connect,"
        SELECT jurnal.jurnal AS nomorakun, account.sub_desc AS jurnal, SUM(jurnal.debit)-SUM(jurnal.kredit) AS Balance, jurnal.tanggal AS tanggal, account.main_acc as main
        FROM jurnal
        INNER JOIN account ON jurnal.jurnal=account.sub_acc
        WHERE account.main_acc = '$r[main_acc]'
        AND MONTH(jurnal.tanggal)<='$bulan' AND YEAR(jurnal.tanggal)<='$tahun'
        GROUP BY jurnal.jurnal
        ORDER BY jurnal.jurnal ASC");
        

	    while($a=mysqli_fetch_array($jurnal)){
	    	
            if(strpos($a['Balance'],'-') !== false){
            $jumlah = str_replace("-", "",$a['Balance']);
            }else{
                $jumlah=$a['Balance'];
            }
        
        if($a['nomorakun']=='301'){
          
          if(strpos($total_keseluruhan,'-') !== false){
            $grand_total = str_replace("-", "",$total_keseluruhan);
            $jumlah=$jumlah-$grand_total;
            }else{
                $grand_total+=$total_keseluruhan;
                $jumlah=$jumlah+$grand_total;
            }
		
        }
            echo "<tr>
                    <td></td>
                    <td></td>
                    <td>$a[nomorakun]</td>
                    <td>$a[jurnal]</td>
                    <td class='harga'>$jumlah</td>
                </tr>";
                $total_temp+=$jumlah;
    
        }
        if($r['main_acc']=="100"){
            $total_aset=$total_temp;
        }elseif($r['main_acc']=="300"){
            $total_ekuitas+=$total_temp;
        }

	    echo "<tr class='table-secondary'>
                <td colspan='3'></td>
                <td>Total</td>
                <td class='harga'>$total_temp</td>
                
            </tr>";
        

    }
    
    
    echo "<script src='support/jquery.mask.js'></script>";
    echo "<script>
            $(document).ready(function($){
            $( '.harga' ).mask('0.000.000.000', {reverse: true});
            });
            </script>";



}elseif($op=='jurnal'){
  $tgl = date('d-m-Y');
  $tanggal = date('Y-m-d',strtotime($tgl));
	
  echo "<thead>
            <tr>
                <td width='5%''>No</td>
                <td width='10%'>Tanggal</td>
                <td width='30%'>Nama Detail Akun</td>
                <td width='15%'>Debit</td>
                <td width='15%'>Kredit</td>
                <td width='25%'>Reference</td>
            </tr>
        </thead>";

	$totalkredit= 0;
   	$totaldebit= 0;
    $no=1;
	$brg=mysqli_query($connect,"
    SELECT jurnal.jurnal AS nomorakun, account.sub_desc AS jurnal, jurnal.debit AS debit, jurnal.kredit AS kredit, jurnal.tanggal AS tanggal, jurnal.ref AS ref
    FROM jurnal
    INNER JOIN account ON jurnal.jurnal=account.sub_acc
    WHERE jurnal.tanggal = '$tanggal'
    ORDER BY jurnal.id ASC");
 
	while($r=mysqli_fetch_array($brg)){
        echo "<tr>
                <td>$no</td>
                <td>$r[tanggal]</td>
                <td>$r[nomorakun] - $r[jurnal]</td>
                <td class='harga'>$r[debit]</td>
                <td class='harga'>$r[kredit]</td>
                <td>$r[ref]</td>
            </tr>";
        $totalkredit+= $r['kredit'];
   		$totaldebit+= $r['debit'];
        $no++;
    }
    echo "<tr class='table-active'>
                <td colspan='3'>TOTAL</td>
                <td class='harga'>$totaldebit</td>
                <td class='harga'>$totalkredit</td>
                <td> </td>
            </tr>";
    echo "<script src='support/jquery.mask.js'></script>";
    echo "<script>
            $(document).ready(function($){
            $( '.harga' ).mask('0.000.000.000', {reverse: true});
            });
            </script>";


}elseif($op=='jurnal_history'){
  $tgl = $_GET['tanggal'];
  $tanggal = date('Y-m-d',strtotime($tgl));
	
  echo "<thead>
            <tr>
                <td width='5%''>No</td>
                <td width='10%'>Tanggal</td>
                <td width='30%'>Nama Detail Akun</td>
                <td width='15%'>Debit</td>
                <td width='15%'>Kredit</td>
                <td width='25%'>Reference</td>
            </tr>
        </thead>";

	$totalkredit= 0;
   	$totaldebit= 0;
    $no=1;
	$brg=mysqli_query($connect,"
    SELECT jurnal.jurnal AS nomorakun, account.sub_desc AS jurnal, jurnal.debit AS debit, jurnal.kredit AS kredit, jurnal.tanggal AS tanggal, jurnal.ref AS ref
    FROM jurnal
    INNER JOIN account ON jurnal.jurnal=account.sub_acc
    WHERE jurnal.tanggal = '$tanggal'
    ORDER BY jurnal.id ASC");
	while($r=mysqli_fetch_array($brg)){
        echo "<tr>
                <td>$no</td>
                <td>$r[tanggal]</td>
                <td>$r[nomorakun] - $r[jurnal]</td>
                <td class='harga'>$r[debit]</td>
                <td class='harga'>$r[kredit]</td>
                <td>$r[ref]</td>
            </tr>";
        $totalkredit+= $r['kredit'];
   		$totaldebit+= $r['debit'];
        $no++;
    }
    echo "<tr class='table-active'>
                <td colspan='3'>TOTAL</td>
                <td class='harga'>$totaldebit</td>
                <td class='harga'>$totalkredit</td>
                <td> </td>
            </tr>";
    echo "<script src='support/jquery.mask.js'></script>";
    echo "<script>
            $(document).ready(function($){
            $( '.harga' ).mask('0.000.000.000', {reverse: true});
            });
            </script>";


}elseif($op=='labarugi'){
	$bulan=date('m');
	$tahun=date('Y');
  
  echo "<thead>
            <tr>
                <td width='15%'>No Akun Indek</td>
                <td width='25%'>Nama Akun Indek</td>
                <td width='10%'>No Akun</td>
                <td width='30%'>Nama Akun Detail</td>
                <td width='20%'>Jumlah</td>
            </tr>
        </thead>";
  
   
	$total_keseluruhan = 0;
    $total_pendapatan = 0;
    $total_beban = 0;

	$brg=mysqli_query($connect,"
    SELECT * FROM group_account WHERE main_acc='400' OR main_acc='500' OR main_acc='600'");
	while($r=mysqli_fetch_array($brg)){
        $total_temp=0;
	    echo "<tr>
                <td>$r[main_acc]</td>
                <td>$r[main_desc]</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>";

	    
	    $jurnal=mysqli_query($connect,"
        SELECT jurnal.jurnal AS nomorakun, account.sub_desc AS jurnal, SUM(jurnal.debit)-SUM(jurnal.kredit) AS Balance, jurnal.tanggal AS tanggal, account.main_acc as main
        FROM jurnal
        INNER JOIN account ON jurnal.jurnal=account.sub_acc
        WHERE account.main_acc = '$r[main_acc]' AND (YEAR(jurnal.tanggal)='$tahun') AND (MONTH(jurnal.tanggal)='$bulan')
        GROUP BY jurnal.jurnal
        ORDER BY jurnal.jurnal ASC");
	    while($a=mysqli_fetch_array($jurnal)){
            if(strpos($a['Balance'],'-') !== false){
            $jumlah = str_replace("-", "",$a['Balance']);
            }else{
                $jumlah=$a['Balance'];
            }
            echo "<tr>
                    <td></td>
                    <td></td>
                    <td>$a[nomorakun]</td>
                    <td>$a[jurnal]</td>
                    <td class='harga'>$jumlah</td>
                </tr>";
                $total_temp+=$jumlah;
    
        }
        if($r['main_acc']=="400"){
            $total_pendapatan=$total_temp;
        }elseif($r['main_acc']=="500" OR $r['main_acc']=="600"){
            $total_beban+=$total_temp;
        }

	    echo "<tr class='table-secondary'>
                <td colspan='3'></td>
                <td>Total</td>
                <td class='harga'>$total_temp</td>
                
            </tr>";
        

    }
    
    $total_keseluruhan = $total_pendapatan - $total_beban;
    if(strpos($total_keseluruhan,'-') !== false){
            $grand_total = str_replace("-", "",$total_keseluruhan);
            $laporan="Rugi";
            $color="table-danger";
            }else{
                $grand_total=$total_keseluruhan;
                $laporan="Laba";
                $color="table-success";
            }
    
    
    echo "<tr class=$color>
                <td colspan='3'></td>
                <td>$laporan</td>
                <td class='harga'>$grand_total</td>
                
            </tr>";
    echo "<script src='support/jquery.mask.js'></script>";
    echo "<script>
            $(document).ready(function($){
            $( '.harga' ).mask('0.000.000.000', {reverse: true});
            });
            </script>";

  
}elseif($op=='labarugi_history'){
  $bulan=$_GET['bulan'];
	$tahun=$_GET['tahun'];
  
  
  echo "<thead>
            <tr>
                <td width='15%'>No Akun Indek</td>
                <td width='25%'>Nama Akun Indek</td>
                <td width='10%'>No Akun</td>
                <td width='30%'>Nama Akun Detail</td>
                <td width='20%'>Jumlah</td>
            </tr>
        </thead>";
  
   
	$total_keseluruhan = 0;
    $total_pendapatan = 0;
    $total_beban = 0;

	$brg=mysqli_query($connect,"
    SELECT * FROM group_account WHERE main_acc='400' OR main_acc='500' OR main_acc='600'");
	while($r=mysqli_fetch_array($brg)){
        $total_temp=0;
	    echo "<tr>
                <td>$r[main_acc]</td>
                <td>$r[main_desc]</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>";

	    
	    $jurnal=mysqli_query($connect,"
        SELECT jurnal.jurnal AS nomorakun, account.sub_desc AS jurnal, SUM(jurnal.debit)-SUM(jurnal.kredit) AS Balance, jurnal.tanggal AS tanggal, account.main_acc as main
        FROM jurnal
        INNER JOIN account ON jurnal.jurnal=account.sub_acc
        WHERE account.main_acc = '$r[main_acc]' AND (YEAR(jurnal.tanggal)='$tahun') AND (MONTH(jurnal.tanggal)='$bulan')
        GROUP BY jurnal.jurnal
        ORDER BY jurnal.jurnal ASC");
	    while($a=mysqli_fetch_array($jurnal)){
            if(strpos($a['Balance'],'-') !== false){
            $jumlah = str_replace("-", "",$a['Balance']);
            }else{
                $jumlah=$a['Balance'];
            }
            echo "<tr>
                    <td></td>
                    <td></td>
                    <td>$a[nomorakun]</td>
                    <td>$a[jurnal]</td>
                    <td class='harga'>$jumlah</td>
                </tr>";
                $total_temp+=$jumlah;
    
        }
        if($r['main_acc']=="400"){
            $total_pendapatan=$total_temp;
        }elseif($r['main_acc']=="500" OR $r['main_acc']=="600"){
            $total_beban+=$total_temp;
        }

	    echo "<tr class='table-secondary'>
                <td colspan='3'></td>
                <td>Total</td>
                <td class='harga'>$total_temp</td>
                
            </tr>";
        

    }
    
    $total_keseluruhan = $total_pendapatan - $total_beban;
    if(strpos($total_keseluruhan,'-') !== false){
            $grand_total = str_replace("-", "",$total_keseluruhan);
            $laporan="Rugi";
            $color="table-danger";
            }else{
                $grand_total=$total_keseluruhan;
                $laporan="Laba";
                $color="table-success";
            }
    
    
    echo "<tr class=$color>
                <td colspan='3'></td>
                <td>$laporan</td>
                <td class='harga'>$grand_total</td>
                
            </tr>";
    echo "<script src='support/jquery.mask.js'></script>";
    echo "<script>
            $(document).ready(function($){
            $( '.harga' ).mask('0.000.000.000', {reverse: true});
            });
            </script>";

  
}




?>
<?php
include "koneksi.php";
$op=isset($_GET['op'])?$_GET['op']:null;
if($op=='ambilbarang'){
	$data = mysqli_query($connect,"select * from master_barang");
    echo "<option value=''> Nama Barang </option>";
	while($r= mysqli_fetch_array($data)){
	echo "<option value='$r[kode]'>$r[nama_barang]</option>";
	}
}elseif($op=='barang'){
    $opview=$_GET['view'];
    if($opview == "stock"){
        echo "<thead>
            <tr>
                <td width=15%>Kode Barang</td>
                <td>Nama</td>
                <td width=15%>Quantity Order</td>
                <td width=15%>Quantity In</td>
            </tr>
        </thead>";

    }elseif($opview == "edit"){
       echo "<thead>
            <tr>
                <td width=10%></td>
                <td>Kode Barang</td>
                <td>Nama</td>
                <td>Harga</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>
        </thead>";

    }elseif($opview=="temp"){
        $act=$_GET['act'];
        if($act=="penjualan"){
            $table = "penjualan_temp";
        }elseif($act=="pembelian"){
            $table = "pembelian_temp";
        }

    $brg=mysqli_query($connect,"select * from $table");
    echo "<thead>
            <tr>
                <td>Kode Barang</td>
                <td>Nama</td>
                <td>Harga</td>
                <td>Quantity</td>
                <td>Subtotal</td>
                <td>Tools</td>
            </tr>
        </thead>";
    $total=mysqli_fetch_array(mysqli_query($connect,"select sum(subtotal) as total from $table"));
    while($r=mysqli_fetch_array($brg)){
        echo "<tr>
                <td>$r[kode]</td>
                <td>$r[nama]</td>
                <td class='harga'>$r[harga]</td>
                <td>$r[jumlah]</td>
                <td class='harga'>$r[subtotal]</td>
                <td><a href='support/pemb_func.php?op=hapus&kode=$r[id]&act=$table' id='hapus'>Hapus</a></td>
            </tr>";
    }
    echo "<tr>
        <td colspan='3'>Total</td>
        <td colspan='4' class='harga'>$total[total]</td>
    </tr>";
    echo "<script src='support/jquery.mask.js'></script>";
    echo "<script>
            $(document).ready(function($){
            $( '.harga' ).mask('0.000.000.000', {reverse: true});
            });
            </script>";
        }
}elseif($op=='tambah'){
    $kode=$_GET['kode'];
    $option=$_GET['option'];
    $findnama = mysqli_query($connect,"select * from master_barang where kode=$kode");
    $catchnama= mysqli_fetch_array($findnama);
    $nama = $catchnama['nama_barang'];

    $harga=$_GET['harga'];
    $quantity=$_GET['quantity'];


    $subtotal=floatval($harga)*floatval($quantity);
    
    if($option == "add_item"){
    $tambah=mysqli_query($connect,"INSERT into pembelian_temp (kode,nama,harga,jumlah,subtotal)
                        values ('$kode','$nama','$harga','$quantity','$subtotal')");
        if($tambah){
            echo "sukses";
        }else{
            echo "ERROR";
        }
    }elseif($option == "up_item"){
        $id=$_GET['id'];
        $sup=$_GET['sup'];
        $trxid=$_GET['trxid'];
        $tambah=mysqli_query($connect,"UPDATE pembelian_detail SET kode='$kode',harga='$harga',jumlah='$quantity',subtotal='$subtotal' WHERE pembelian_detail.id ='$id'");

        $totalsemua=mysqli_fetch_array(mysqli_query($connect,"select sum(subtotal) as total from pembelian_detail where trxid='$trxid'"));
        $total = $totalsemua['total'];

        $pembelian=mysqli_query($connect,"UPDATE pembelian SET supplier='$sup',totalsales='$total' WHERE pemid ='$trxid'");



        if($tambah){
            echo "sukses";
        }else{
            echo "ERROR";
        }
    }elseif($option == "add_item_penjualan"){
        $tambah=mysqli_query($connect,"INSERT into penjualan_temp (kode,nama,harga,jumlah,subtotal)
                        values ('$kode','$nama','$harga','$quantity','$subtotal')");
        if($tambah){
            echo "sukses";
        }else{
            echo "ERROR";
        }
    }

}elseif($op=='hapus'){
    $kode=$_GET['kode'];
    $table=$_GET['act'];
    $del=mysqli_query($connect,"delete from $table where id='$kode'");
    if($table=="pembelian_temp"){
        $page="pembelian";
    }elseif($table=="penjualan_temp"){
        $page="penjualan";
    }
    if($del){
        echo "<script>window.location='../index.php?page=".$page."';</script>";
    }else{
        echo "<script>alert('Hapus Data Berhasil');
            window.location='../index.php?page=".$page."';</script>";
    }
}elseif($op=='proses'){
    $option=$_GET['option'];

    if($option=="penjualan"){

    $tanggal=$_GET['tanggal'];
    $tanggal=date("Y-m-d",strtotime($tanggal));
    $costumer=$_GET['costumer'];
    $idauto = mysqli_fetch_array(mysqli_query($connect,"select * from master"));
    $id = $idauto['id_penjualan']+1;
    $finalid = "PEN/".date('y')."/".strtoupper(date('M'))."/".$id;
    $trxid=$finalid;
    $to=mysqli_fetch_array(mysqli_query($connect,"select sum(subtotal) as total from penjualan_temp"));
    $tot=$to['total'];

    $simpan=mysqli_query($connect,"insert into penjualan(customer,penid,tglpen,totalsales)
                        values ('$costumer','$trxid','$tanggal','$tot')");
    if($simpan){
        $query=mysqli_query($connect,"select * from penjualan_temp");
        while($r=mysqli_fetch_row($query)){
            mysqli_query($connect,"INSERT INTO penjualan_detail(trxid,kode,harga,jumlah,subtotal)
                        values('$trxid','$r[1]','$r[3]','$r[4]','$r[5]')"); 
            $stok=mysqli_fetch_array(mysqli_query($connect,"select * from pembelian_detail where kode=$r[1] ORDER BY instockdate ASC limit 1"));
            $tot=$to['total'];  

            $barang = $r[1];
            $qty    = $r[4];
            $modal_update = 0;
            $sql_stok      = "SELECT SUM(stock) AS total FROM pembelian_detail WHERE kode = $barang";
            $result_stok   = mysqli_query($connect, $sql_stok);
            $data     = mysqli_fetch_assoc($result_stok);
              
              $stok_all = $data['total'];
              $sql    = "SELECT * FROM pembelian_detail WHERE kode = $barang AND stock > 0 ORDER by instockdate ASC";
              $result = mysqli_query($connect, $sql);
              if($qty <= $stok_all) {

                  while($row = mysqli_fetch_assoc($result)) {
                  
                      $id_item  = $row['id'];
                      $stok_item = $row['stock'];
                      $modal = $row['harga'];
                      $stock_control = 0;

                      if($qty > 0) { 
                          $temp = $qty;
                          $qty = $qty - $stok_item;
                          if($qty > 0) {      
                              $stok_update = 0;
                              $modal_update += ($stok_item * $modal);
                              $stock_control += $stok_item;
                          }else{
                              $stok_update = $stok_item - $temp;
                              $modal_update += ($temp*$modal);
                              $stock_control += $temp;
                          }
                          $sql = "UPDATE pembelian_detail SET stock = $stok_update WHERE kode = '$barang' AND id = $id_item";
                          mysqli_query($connect, $sql);

                        $catch_stock = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_barang where kode = '$barang' "));
                        $stock_master = $catch_stock['jumlah'];
                        $stock_master = $stock_master - $stock_control;
                        $update_stock_master = mysqli_query($connect,"UPDATE master_barang SET jumlah = '$stock_master' WHERE kode ='$barang'");
                      }
                  }
              }else{
                  echo "Stok Barang Tidak Cukup, Stok = $stok_all <br><br>";
              }    
        }
        mysqli_query($connect,"INSERT INTO jurnal (tanggal,jurnal,debit,kredit,ref) Values ('$tanggal','102','$tot','0','$trxid')");
        mysqli_query($connect,"INSERT INTO jurnal (tanggal,jurnal,debit,kredit,ref) Values ('$tanggal','401','0','$tot','$trxid')");
        mysqli_query($connect,"INSERT INTO jurnal (tanggal,jurnal,debit,kredit,ref) Values ('$tanggal','501','$modal_update','0','$trxid')");
        mysqli_query($connect,"INSERT INTO jurnal (tanggal,jurnal,debit,kredit,ref) Values ('$tanggal','103','0','$modal_update','$trxid')");
        mysqli_query($connect,"UPDATE master SET id_penjualan = '$id' WHERE master.id = 1");
        //hapus seluruh isi tabel sementara
        mysqli_query($connect,"truncate table penjualan_temp");
        echo "sukses"."|".$trxid;
    }else{
        echo "ERROR";
    }

    }elseif($option=="pembelian"){
    
    $tanggal=$_GET['tanggal'];
    $tanggal=date("Y-m-d",strtotime($tanggal));
    $supplier=$_GET['sup'];
    $idauto = mysqli_fetch_array(mysqli_query($connect,"select * from master"));
    $id = $idauto['id_pembelian']+1;
    $finalid = "PEM/".date('y')."/".strtoupper(date('M'))."/".$id;
    $trxid=$finalid;
    $to=mysqli_fetch_array(mysqli_query($connect,"select sum(subtotal) as total from pembelian_temp"));
    $tot=$to['total'];

    $simpan=mysqli_query($connect,"insert into pembelian(supplier,pemid,tglpem,totalsales,status)
                        values ('$supplier','$trxid','$tanggal','$tot','Waiting')");
    if($simpan){
        $query=mysqli_query($connect,"select * from pembelian_temp");
        while($r=mysqli_fetch_row($query)){
            mysqli_query($connect,"INSERT INTO pembelian_detail(trxid,kode,harga,jumlah,subtotal)
                        values('$trxid','$r[1]','$r[3]','$r[4]','$r[5]')");    
        }
        mysqli_query($connect,"INSERT INTO jurnal (tanggal,jurnal,debit,kredit,ref) Values ('$tanggal','103','$tot','0','$trxid')");
        mysqli_query($connect,"INSERT INTO jurnal (tanggal,jurnal,debit,kredit,ref) Values ('$tanggal','101','0','$tot','$trxid')");
        mysqli_query($connect,"UPDATE master SET id_pembelian = '$id' WHERE master.id = 1");
        //hapus seluruh isi tabel sementara
        mysqli_query($connect,"truncate table pembelian_temp");
        echo "sukses"."|".$trxid;
    }else{
        echo "ERROR";
    }
}
}elseif($op=='loadbarangmasuk'){
    $trxid=$_GET['trxid'];
    $brg=mysqli_query($connect,"select * from pembelian_detail where trxid='$trxid' ");

    echo "<thead>
            <tr>
                <td width=10%></td>
                <td>Kode Barang</td>
                <td>Nama</td>
                <td>Harga</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>
        </thead>";
    $total=mysqli_fetch_array(mysqli_query($connect,"select sum(subtotal) as total from pembelian_detail where trxid='$trxid'"));
    while($r=mysqli_fetch_array($brg)){
        $findnama = mysqli_fetch_array(mysqli_query($connect,"select * from master_barang where kode=$r[kode]"));
        $nama = $findnama['nama_barang'];
        echo "<tr>
                <td><button type='submit' id='$r[id]' data-kode='$r[kode]' data-harga='$r[harga]' data-jumlah='$r[jumlah]' data-subtotal='$r[subtotal]' data-nama='$nama' class='button' style='width:100%;height:100%;'>Edit</button></td>
                <td>$r[kode]</td>
                <td>$nama</td>
                <td class='harga'>$r[harga]</td>
                <td>$r[jumlah]</td>
                <td class='harga'>$r[subtotal]</td>
            </tr>";
    }
    echo "<tr>
    <td></td>
        <td colspan='3'>Total</td>
        <td colspan='2' class='harga'>$total[total]</td>
    </tr>";
    echo "<script src='support/jquery.mask.js'></script>";
    echo "<script>
            $(document).ready(function($){
            $( '.harga' ).mask('0.000.000.000', {reverse: true});
            });
            </script>";
}elseif($op=='edit'){
    $trxid=$_GET['trxid'];
    $trx = mysqli_fetch_array(mysqli_query($connect,"select s.nama_sup as nama,DATE_FORMAT(p.tglpem,'%d-%m-%Y') AS tglpem from pembelian as p inner join master_supplier as s on p.supplier=s.id where pemid='$trxid'"));

    echo $trx['nama']."|".$trx['tglpem'];
}elseif($op=='loadinbarang'){
    $trxid=$_GET['trxid'];
    $brg=mysqli_query($connect,"select * from pembelian_detail where trxid='$trxid' ");

    echo "<thead>
            <tr>
                <td width=15%>Kode Barang</td>
                <td>Nama</td>
                <td width=15%>Quantity Order</td>
                <td width=15%>Quantity In</td>
            </tr>
        </thead>";
    $total=mysqli_fetch_array(mysqli_query($connect,"select sum(subtotal) as total from pembelian_detail where trxid='$trxid'"));
    $nomor=0;
    while($r=mysqli_fetch_array($brg)){
        $findnama = mysqli_fetch_array(mysqli_query($connect,"select * from master_barang where kode=$r[kode]"));
        $nama = $findnama['nama_barang'];
        echo "<tr>
                <td><input type='hidden' name='hidden_id[$nomor]' value=$r[id] >$r[kode]</td>
                <td>$nama</td>
                <td>$r[jumlah]</td>
                <td><input name='stock[$nomor]' type='number'></td>
                
            </tr>";
            $nomor++;
    }
    
}elseif($op=='edit_item'){
    $id=$_GET['id'];
    $data = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_barang WHERE kode = $id"));
    echo $data['nama_barang']."|".$data['hargajual'];

}elseif($op=='edit_sup'){
    $id=$_GET['id'];
    $data = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_supplier WHERE id = $id"));
    echo $data['nama_sup'];

}elseif($op=='edit_akun'){
$id=$_GET['id'];
$data = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account WHERE id = $id"));
echo $data['sub_acc']."|".$data['sub_desc']."|".$data['main_acc'];
}elseif($op=='cek'){
$id=$_GET['kode'];
$data = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_barang WHERE kode = $id"));
echo $data['hargajual']."|".$data['jumlah'];
}


?>
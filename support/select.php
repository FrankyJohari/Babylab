 <?php  
include('koneksi.php');
$op=$_GET['op'];
if($op=='test'){
 $query = "Select * from pembelian_detail";
    $statement = $koneksi->prepare($query);
    if($statement->execute())
    {
        while($row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $data[]=$row;
        }
        echo json_encode($data);
    }
}

?>
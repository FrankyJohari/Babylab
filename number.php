<?php 
$a = '-20000';

if($a < 0):
$d = number_format($a);
$c = '('.$d.')';

else:
$c = number_format($a);
endif;
?>
<?= $c ?>
<?php

$url="https://1lqhv91l8k.execute-api.eu-west-1.amazonaws.com/vechileinfo/kalles";
$ch = curl_init();

// Return Page contents.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//grab URL and pass it to the variable.
curl_setopt($ch, CURLOPT_URL, $url);

$result = curl_exec($ch);



$jsondata=json_decode($result,true);
$body=$jsondata['body'];

$bodyres=json_decode($body,true);


?>
<table class="table" >

<tr>
<th>Name</th>
<th>VIN</th>
<th>RgNo</th>
<th>Address</th>
<th>Status</th>
</tr>
<?php
if($bodyres!= "")
{
foreach($bodyres as $bodyr)
{
$address=$bodyr['Address'];
$status=$bodyr['Status'];
$vin=$bodyr['VIN'];
$company=$bodyr['Company'];
$rgno=$bodyr['Reg.no'];
?>

<tr>
<td><?php echo $company;?></td>
<td><?php echo $vin;?></td>
<td><?php echo $rgno;?></td>
<td><?php echo $address;?></td>
<td><?php echo $status;?></td>
</tr>

<?php }
}
?>
</table>

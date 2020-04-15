<?php

$url="https://1lqhv91l8k.execute-api.eu-west-1.amazonaws.com/Test/vin";

//$url = "https://1lqhv91l8k.execute-api.eu-west-1.amazonaws.com/vechileinfo/kalles";

// Initialize a CURL session.
$ch = curl_init();

// Return Page contents.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//grab URL and pass it to the variable.
curl_setopt($ch, CURLOPT_URL, $url);

$result = curl_exec($ch);



$jsondata=json_decode($result,true);


?>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>


<style>
#custom-search-input {
margin:0;
margin-top: 10px;
padding: 0;
}

#custom-search-input .search-query {
padding-right: 3px;
padding-right: 4px \9;
padding-left: 3px;
padding-left: 4px \9;
/ IE7-8 doesn't have border-radius, so don't indent the padding /

margin-bottom: 0;
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
}

#custom-search-input button {
border: 0;
background: none;
/* belows styles are working good /
padding: 2px 5px;
margin-top: 2px;
position: relative;
left: -28px;
/ IE7-8 doesn't have border-radius, so don't indent the padding /
margin-bottom: 0;
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
color:#D9230F;
}

.search-query:focus + button {
z-index: 3;
}

</style>
</head>
<body>


<div class="container">
	<h2 style="text-align:center">Live Vechicle Tracking</h2>
<div class="row">
<div class="col-md-3">
<div class="form-group">
      <label for="sel1">Select list (select one):</label>
      <select class="form-control" id="sel1">
        <option value="">Status</option>
        <option value="https://1lqhv91l8k.execute-api.eu-west-1.amazonaws.com/statusAction/status">Active</option>
        <option value="https://1lqhv91l8k.execute-api.eu-west-1.amazonaws.com/statusAction/warning">Warning</option>
        <option value="https://1lqhv91l8k.execute-api.eu-west-1.amazonaws.com/statusAction/danger">Danger</option>
      </select>

</div>
</div>
<div class="col-md-6" style="top:15px;">
<div id="custom-search-input">

<input type="text" class="search-query form-control" id="search" placeholder="Search" />

</div>
</div>
<div class="col-md-3" style="top:21px;">
	<button type="button" class="btn btn-primary btn-lg form-control" id="applysearch">Search</button>
</div>
</div><br/>
<div id="output">
<table class="table" >

<tr>
<th>Name</th>
<th>VIN</th>
<th>RgNo</th>
<th>Address</th>
<th>Status</th>
</tr>
<?php
if($jsondata!= "")
{
foreach($jsondata as $bodyr)
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

</div>

</div>

</body>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('change','#sel1',function(){
			var url=$(this).val();
			if(url!='')
			{
				$.ajax({
					type:'POST',
					url:'getdata.php',
					data:'url='+url,
					success:function(data)
					{
						$('#output').html(data);
					}
				})
			}

		})
	});

	$(document).ready(function(){
		$(document).on('click','#applysearch',function(){
			var name=$('#search').val();

			if(name!='')
			{
				$.ajax({
					type:'POST',
					url:'getname.php',
					data:'name='+name,
					success:function(data)
					{
						$('#output').html(data);
					}
				})
			}

		})
	})

</script>
</html>
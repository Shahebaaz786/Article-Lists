<!DOCTYPE html>
<html>
<head>
	<title>Get User Information of PC or LapTop</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<a style="margin-left: 30px; margin-top: 40px;" class="navbar-brand btn btn-warning" href="<?=  base_url('users/index'); ?>">Home</a> 
	<div class="container">
		</br>
		<h1 align="center">
			<font color='red'>
			How to Get User IP, Browser & OS Details in CodeIgniter
			</font>
		</h1>
	</br>
</br>
	<div class="table-responsive">
<center>
		<table border="1px;" class="table table-brdered table-striped">
			<tr>
				<td><b>IP Address</b></td>
				<td><?php echo $ip_address;  ?></td>
			</tr>
			<tr>
				<td><b>Operating System</b></td>
				<td><?php echo $os;  ?></td>
			</tr>
			<tr>
				<td><b>Browser Details</b></td>
				<td><?php echo $browser.' - '.$browser_version;  ?></td>
			</tr>
			<tr>
				<td><b>Language</b></td>
				<td><?php echo $en;  ?></td>
			</tr>
		</table>
	</center>
	</div>
	</div>
</body>
</html>
<?php
include 'header.php';
include 'navigation.php';
$success = 0;
if (isset($_POST['content']) && strlen($_POST['content']) > 0)
{	
		
		$result	=		push_notification($_POST['content']);
		if($result['true'])
		{
			$success = 100;	
		}
		else
		{
			$success = 101;	
		}
}


?>
<script>
var success = <?php echo $success; ?>;
if (success == 100) alert("Successfully updated!");
else if (success == 101) alert("Error, please try again!");

</script>	

<div id="content">
<center><h2>Send push notification</h2></center>
<form method = 'post' action = ''>
<div align="center">
<textarea name = 'content' style = 'width:75%; height:300px; ' placeholder = 'Enter push notification content here'>
</textarea>
</div>
<div align="center">
<input type = submit value = 'Send Push Notification Now'>
</div>
</form>
	
</div>	
<?php include 'footer.php'; ?>

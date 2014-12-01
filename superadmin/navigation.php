<div class="navbar hidden-print main" role="navigation">
	<div class="user-action user-action-btn-navbar pull-left border-right">
		<a href="index.php"><button class="btn btn-sm btn-navbar btn-inverse btn-stroke"><i class="fa fa-bars fa-2x"></i></button></a>
	</div>
    
	<ul class="main pull-left hidden-xs">
		<?php if ($_SESSION['userRole'] == 0) { ?>
		<li class="dropdown">
			<a data-toggle="dropdown" class="dropdown-toggle" href="" id="dropdown-toggle1">System Administrator<span class="caret"></span></a>
			<ul class="dropdown-menu" id="dropdown-menu1">
            	<li><a href="resetsuperadminpassword.php">Change System Admin Password&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
				<li><a href="createstoreadmin.php">Create Store Admin</a></li>
				<li><a href="resetstoreadminpassword.php">Reset Store Admin Password</a></li>
                <li><a href="createstoreuser.php">Create Customer</a></li>
				<li><a href="resetstoreuserpassword.php">Reset User Password</a></li>
			</ul>
		</li>
		<?php }
		if ($_SESSION['userRole'] == 1) { ?>
		<li class="dropdown">
			<a data-toggle="dropdown" class="dropdown-toggle" href="" id="dropdown-toggle1">Store Admin<span class="caret"></span></a>
			<ul class="dropdown-menu" id="dropdown-menu1">	
            	<li><a href="resetstoreadminpassword.php">Reset Store Admin Password&nbsp;&nbsp;&nbsp;&nbsp;</a></li>			
				<li><a href="createstoreuser.php">Create Store User</a></li>				
				<li><a href="resetstoreuserpassword.php">Reset User Password</a></li>
			</ul>
		</li>
		<?php }
		if ($_SESSION['userRole'] == 2) { ?>
		<li class="dropdown">
			<a data-toggle="dropdown" class="dropdown-toggle" href="" id="dropdown-toggle1">Store User<span class="caret"></span></a>
			<ul class="dropdown-menu" id="dropdown-menu1">				
				<li><a href="resetstoreuserpassword.php">Reset User Password&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
			</ul>
		</li>
		<?php } ?>
		<li class="dropdown">
			<a data-toggle="dropdown" class="dropdown-toggle" href="" id="dropdown-toggle2">Features<span class="caret"></span></a>
			<ul class="dropdown-menu" id="dropdown-menu2">				
				<?php if ($_SESSION['userRole'] == 0) { ?>
                <li><a href="vieweditcustomercontactinfo1.php">Customer Contact Information&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li><a href="vieweditstoradmincontactinfo.php">Store Admin Contact Information&nbsp;&nbsp;&nbsp;&nbsp;</a></li>	
				<li><a href="viewremovepaymentinfo.php?id=0">Add/Remove Payment Information&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li><a href="viewordersbycustomer.php">Customer Orders&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
				<li><a href="setpickupdeliverytime.php?id=0">Pickup/Delivery times&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
				<li><a href="createuniquecodefordriver.php?id=0">Unique code for Driver&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
				<li><a href="pickupdeliverycounttime.php?id=0">Driver Statistics&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li><a href="push.php">Send push notification&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li><a href="createpromocode.php?id=0">Promotions&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li><a href="setorderminimum.php?id=0">Order Minimums&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li><a href="addedititemlist.php?id=0">Cloth Item Information&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
				<?php } ?>
				
				<?php if ($_SESSION['userRole'] == 1 ) { ?>
                <li><a href="vieweditcustomercontactinfo1.php">Customer Contact Information&nbsp;&nbsp;&nbsp;&nbsp;</a></li>	
				<li><a href="viewremovepaymentinfo.php">Add/Remove Payment Information&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li><a href="viewordersbycustomer.php">Customer Orders&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
				<li><a href="setpickupdeliverytime.php?id=0">Pickup/Delivery times&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
				<li><a href="createuniquecodefordriver.php?id=0">Unique code for Driver&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
				<li><a href="pickupdeliverycounttime.php?id=0">Driver Statistics&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
				<li><a href="createpromocode.php?id=0">Promotions&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li><a href="setorderminimum.php?id=0">Order Minimums&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                 <li><a href="addedititemlist.php?id=0">Cloth Item Information&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
				<?php } ?>
				<?php if ($_SESSION['userRole'] ==2) { ?>
				<li><a href="vieweditcustomercontactinfo1.php">Customer Contact Information&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li><a href="addcraditcard.php">Add Payment Information&nbsp;&nbsp;&nbsp;&nbsp;</a></li>	
                <li><a href="viewordersbycustomer.php">Customer Orders&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
			<li><a href="setpickupdeliverytime.php?id=0">Pickup/Delivery times&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
            <li><a href="createuniquecodefordriver.php?id=0">Unique code for Driver&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
				<li><a href="pickupdeliverycounttime.php?id=0">Driver Statistics&nbsp;&nbsp;&nbsp;&nbsp;</a></li>	
				<?php } ?>
			</ul>
		</li>
	</ul>
		

	
	<ul class="main pull-right">
		
		<li class="dropdown username">
			<a href="" class="dropdown-toggle" data-toggle="dropdown" id="dropdown-toggle3"><?php echo $_SESSION['emailaddress'];?> <span class="caret"></span></a>

			<ul class="dropdown-menu pull-right" id="dropdown-menu3">				
				<li><a href="login.php?logout=true" class="glyphicons lock no-ajaxify"><i></i>Logout</a></li>
		    </ul>
		</li>
	</ul>
</div>
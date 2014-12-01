<!DOCTYPE html>
<head>
	<title>The Dhobi - Admin Panel</title>
	
	<!-- Meta -->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	
	
	<!-- 
	**********************************************************
	In development, use the LESS files and the less.js compiler
	instead of the minified CSS loaded by default.
	**********************************************************
	<link rel="stylesheet/less" href="../assets/less/admin/module.admin.stylesheet-complete.less" />
	-->

		<!--[if lt IE 9]><link rel="stylesheet" href="../assets/components/library/bootstrap/css/bootstrap.min.css" /><![endif]-->
	<link rel="stylesheet" href="../assets/css/admin/module.admin.stylesheet-complete.min1.css" />
    <link rel="stylesheet" href="../assets/components/library/bootstrap/css/bootstrap.min1.css" />
    <link rel="stylesheet" href="../assets/components/library/icons/fontawesome/assets/css/font-awesome.min.css" />
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


<script>if (/*@cc_on!@*/false && document.documentMode === 10) { document.documentElement.className+=' ie ie10'; }</script>
<?php if($_REQUEST['msg']=='0')
{
?>
	<script>
	
	alert("Invalid Username and Password!");	
	
	</script>
    <?php } ?>
</head>
<body class=" loginWrapper">
	
	



<!-- row-app -->
<div  align = 'center' style = 'width:100%; height:100%; background: none repeat scroll 0 0 #EAEAEA;'>
<div class="row row-app" style = 'min-width:800px; width:70%'>

	<!-- col -->
		<!-- col-separator.box -->
		<div class="col-separator col-unscrollable box">
			
			<!-- col-table -->
			<div class="col-table">
				
				<h4 class="innerAll margin-none border-bottom text-center"><i class="fa fa-lock"></i>The Dhobi Admin Panel</h4>

				<!-- col-table-row -->
				<div class="col-table-row">

					<!-- col-app -->
					<div class="col-app col-unscrollable">

						<!-- col-app -->
						<div class="col-app">
							<div class="login">
								<div class="placeholder text-center"><i class="fa fa-lock"></i></div>
								<div class="panel panel-default col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-4">

								  <div class="panel-body">
								  	<form action="login_action.php" method ='post'>

								  	  <div class="form-group">
									    <label for="exampleInputEmail1">Email address</label>
									    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name = 'emailaddress'>
									  </div>
									  <div class="form-group">
									    <label for="exampleInputPassword1">Password</label>
									    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name = 'password'>
									  </div>

									  <button type="submit" class="btn btn-primary btn-block">Login</button>

									  <div class="checkbox">
									    <label>
									      <input type="checkbox"> Remember my details
									    </label>
									  </div>
									</form>
								   
								  </div>
								
								</div>
								<div class="col-sm-4 col-sm-offset-4 text-center" style = 'display:none'>
									<div class="innerAll">
										<a href="signup.html?lang=en" class="btn btn-info">Create a new account? <i class="fa fa-pencil"></i> </a>
										<div class="separator"></div>
									</div>
								</div>
								<div class="clearfix"></div>
							
							</div>


						</div>
						<!-- // END col-app -->

					</div>
					<!-- // END col-app.col-unscrollable -->

				</div>
				<!-- // END col-table-row -->
			
			</div>
			<!-- // END col-table -->
			
		</div>
		<!-- // END col-separator.box -->


</div>
</div>
<!-- // END row-app -->

	

	
	
	
</body>

<?php  ?>
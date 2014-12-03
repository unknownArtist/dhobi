<?php 
ob_start();
/*error_reporting(0);*/

include("header.php");
require_once('curl.php');




if (isset($_SESSION['logined']))
{
    if(isset($_SESSION['sessionToken']))
    {
        //header('location:index.php');
    }
    $user = json_decode(getUsers($_SESSION['objectId']));

}

$password = sha1($_POST['password']);

$userInfo = json_decode(getObjectByIdInClass('_User', $_SESSION['objectId']));



if($_SESSION['if_facebook_user']) {
    
    header('location:who_am_i.php');
}
 if(!($password == $userInfo->password2))
    {
        header('location:conform_identity.php');
    }
?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <h1>Who Am I ?</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>

               
                <section class="content">

                    <div class="box box-primary">
                                <div id = 'slide' class="box-header" style="background:#3C8DBC; color: white; text-align: center" >
                                    <span id="display_who_am_i_form_errors"></span>
                                </div><!-- /.box-header -->

                                <div class="box-header">
                                    <!--<h3 class="box-title">Who Am I ?</h3>-->
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" id = 'who_am_i_form' method="POST" action="whoAmI_action.php">
                                    <div class="box-body">
                                        <div class="form-group">
										<p><label>Email:</label>
                                            <input name="username" class="form-control input-lg" placeholder = 'Email' id="exampleInputEmail1" value=<?php echo $user->email; ?> > </p>
                                        </div>
                                        <div class="form-group">
										<p><label>Password:</label>
                                            <input name="password" type="password" class="form-control input-lg" id="exampleInputPassword1"  placeholder="Password"></p>
                                        </div>
                                        <div class="form-group">
										<p><label>First Name:</label>
                                            <input name="firstName" type="text" class="form-control input-lg" id="exampleInputFirstName" value=<?php echo $user->firstName; ?> ></p>
                                        </div>
                                        <div class="form-group">
										<p><label>Last Name:</label>
                                            <input name="lastName" type="text" class="form-control input-lg" id="exampleInputLastName"  value=<?php echo $user->lastName; ?> ></p>
                                        </div>
                                        <div class="form-group">
										<p><label>Phone #:</label>
                                            <input name="phoneNumber" type="text" class="form-control input-lg" id="exampleInputPhone" value=<?php echo $user->phoneNumber; ?> ></p>
                                        </div>
                                        
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                    <p>
                                        <button id= 'who_am_i_submit' type="submit" class="btn btn-primary">Save</button>
                                        </p>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<?php
include("footer.php");
?>
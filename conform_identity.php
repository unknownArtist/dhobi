<?php 

include("header.php");

if (isset($_SESSION['logined']))
{
    if(isset($_SESSION['sessionToken']))
    {
        //header('location:index.php');
    }
    $user = json_decode(getUsers($_SESSION['objectId']));

}
/*var_dump($_SESSION['facebookID']); die();*/

if($_SESSION['facebookID']) {

    $facebookUser = getObjectsInClass('_User', json_encode(array('facebookID'=>$_SESSION['facebookID'])));

    $facebookUser = json_decode($facebookUser);

    $facebookUserEmail = $facebookUser->results[0]->email;

    $_SESSION['if_facebook_user'] = $facebookUserEmail;
    
    if($facebookUserEmail != null) {
        header('location:who_am_i.php');
        die();
    }
}


?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <h1>Please confirm your identity ?</h1>
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
                                <form role="form" id = 'who_am_i_form' method="POST" action="who_am_i.php">
                                    <div class="box-body">
                                        
                                        <div class="form-group">
										<p><label>Password:</label>
                                            <input name="password" type="password" class="form-control input-lg" id="exampleInputPassword1"  placeholder="Password"></p>
                                        </div>
                                        
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                    <p>
                                        <button type="submit" class="btn btn-primary">Conform</button>
                                        </p>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<?php
include("footer.php");
?>
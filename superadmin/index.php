<?php 
include 'header.php';
include 'navigation.php';
if($_SESSION['userRole']==0)
{

	$orders = json_decode(getObjectsInClass('Order', '{}'), true);
}
if($_SESSION['userRole']==1)
{
	$orders = json_decode(getObjectsInClass('Order', '{"storeCode":"'.$_SESSION['storeID'].'"}'), true);
}

$today	=	strtotime(date('Y-m-d'));
$j = 1;
$k = 1;
$l = 1;
for($i=0;$i<count($orders['results']);$i++)
{
	if(strtotime($orders['results'][$i]['createdAt']) < $today)
	{/*
		$promo	=	$orders['results'][$i]['promoMatched'];
		if($promo=='NO')
		{
			$discount	=	0;	
		}
		else
		{
			$promoCode	=	json_decode(getObjectsInClass('PromoCode', '{"code":"'.$promo.'"}'), true);
			$discount	=	$promoCode['results'][0]['discount'];		
		}
		$discount1	+=	$discount;
		$orderid	=	$orders['results'][$i]['objectId'];
		$cloth	=	json_decode(getObjectsInClass('AddedCloth', '{"orderIndex":"'.$orderid.'"}'), true);
		$userid	=	$orders['results'][$i]['userID'];
		$zipCode	=	json_decode(getObjectsInClass('Address', '{"userID":"'.$userid.'"}'), true);
		$zip 	=	$zipCode['results'][0]['zipCode'];
		
		$tax	=	json_decode(getObjectsInClass('ZipCode', '{"zipcode":"'.$zip.'"}'), true);
		$taxvalue	=	$tax['results'][0]['tax'];
		for($x=0; $x<count($cloth['results']); $x++)
		{
			$clothname	=	$cloth['results'][$x]['clothIndex'];
			$clothvalue	=	json_decode(getObjectsInClass('Cloth', '{"objectId":"'.$clothname.'"}'), true);
			 $price	=	$clothvalue['results'][0]['price'];
			 $count	=	$cloth['results'][$x]['count'];
			  $totalprice	=	$price*$count;
			$amount	+=	$totalprice;
			$amount1	=	$taxvalue*$amount/100.0;
		}
				
		 
		
				$placed	= $j;
				$j++;
		
		if($orders['results'][$i]['progress']!=5)
		{
			$progress	=	$k;
			$k++;
		}
		if($orders['results'][$i]['progress']==5)
		{
			$deliverd	=	$l;
			$l++;
		}
		
	*/
	$placed	= $j;
				$j++;
		
		if($orders['results'][$i]['progress']!=5)
		{
			$progress	=	$k;
			$k++;
		}
		if($orders['results'][$i]['progress']==5)
		{
			$deliverd	=	$l;
			$l++;
		}
		
	
		
	}
	$aaa += str_replace('$ ','',$orders['results'][$i]['totalcost']);
}



  ?>

		<!-- Content -->
		
		<div id="content" style="width:100%">
          <?php if($_SESSION['userRole']!=2){ ?>
          <div  align="center" style="width:66%; margin-left: 16%;">
              <h2 class="margin-none" align="center">Analytics &nbsp;<i class="fa fa-fw fa-pencil text-muted"></i></h2>

	<div class="separator-h"></div>
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="widget innerAll text-center">
                                      <h3 class="innerT">Number of Picked Up Orders in the Last Day</h3>
                                      <p class="innerB margin-none text-xlarge text-condensed strong text-primary">
                                      <?php
									  if($placed=='')
									  {
										  echo "0";
									  }
									  else
									  {
										echo $placed;
									  }
									  ?>
                                      
                                      
                                      </p>
                                      <div class="innerTB">
                                          <div class="sparkline" sparkHeight="57"></div>
                                      </div>
                                  </div>
                              </div>
              
                              <div class="col-md-6">
                                  <div class="widget innerAll text-center">
                                      <h3 class="innerT">Number of In Progress Orders in the Last Day</h3>
                                      <p class="innerB margin-none text-xlarge text-condensed strong text-primary">
                                      <?php
									  if($progress=='')
									  {
										  	echo "0";
									  }
									  else
									  {
										echo $progress;
									  }
									  ?>
                                      </p>
                                      <div class="innerTB">
                                          <div class="sparkline" sparkHeight="57"></div>
                                      </div>
                                  </div>
                              </div>
                              <!-- //Col -->
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="widget innerAll text-center">
                                      <h3 class="innerT">Number of Delievered Orders in the Last Day</h3>
                                      <p class="innerB margin-none text-xlarge text-condensed strong text-primary">
                                      <?php
									  if($deliverd=='')
									  {
										  echo "0";
										  
									  }
									  else
									  {
										echo $deliverd;
									  }
									  ?>
                                      </p>
                                      <div class="innerTB">
                                          <div class="sparkline" sparkHeight="57"></div>
                                      </div>
                                  </div>
                              </div>
              
                              <div class="col-md-6">
                                  <div class="widget innerAll text-center">
                                      <h3 class="innerT">  Dollar amount of the Total orders placed</h3>
                                      <p class="innerB margin-none text-xlarge text-condensed strong text-primary">$<?php if($aaa==''){ echo "0"; }else{ echo $aaa; } //echo round(($amount)+($amount1)-($discount1),2); ?></p>
                                      <div class="innerTB">
                                          <div class="sparkline" sparkHeight="57"></div>
                                      </div>
                                  </div>
                              </div>
                              <!-- //Col -->
                          </div>
                          <!-- //Row -->
              
                          <!-- Widget -->
                          
                          <!-- //Widget -->
              
                      
                      
                  </div>
                  <?php } ?>

		</div>
        
		<!-- // Content END -->
	
<?php include 'footer.php'; ?>		
		
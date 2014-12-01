
<head>
<title>BUSINESS Template (v1.0.2)</title>
	
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
	<link rel="stylesheet" href="../assets/css/admin/module.admin.stylesheet-complete.min.css" />
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


	<script src="../assets/components/plugins/ajaxify/script.min.js?v=v1.0.2&sv=v0.0.1"></script>

<script>var App = {};</script>

<script data-id="App.Scripts">
App.Scripts = {

	/* CORE scripts always load first; */
	core: [
		'../assets/components/library/jquery/jquery.min.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/library/modernizr/modernizr.js?v=v1.0.2&sv=v0.0.1'
	],

	/* PLUGINS_DEPENDENCY always load after CORE but before PLUGINS; */
	plugins_dependency: [
		'../assets/components/library/bootstrap/js/bootstrap.min.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/library/jquery/jquery-migrate.min.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/modules/admin/maps/vector/assets/lib/jquery-jvectormap-1.2.2.min.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/modules/admin/charts/flot/assets/lib/jquery.flot.js?v=v1.0.2&sv=v0.0.1'
	],

	/* PLUGINS always load after CORE and PLUGINS_DEPENDENCY, but before the BUNDLE / initialization scripts; */
	plugins: [
		'../assets/components/plugins/nicescroll/jquery.nicescroll.min.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/plugins/breakpoints/breakpoints.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/plugins/ajaxify/davis.min.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/plugins/ajaxify/jquery.lazyjaxdavis.min.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/plugins/preload/pace/pace.min.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/modules/admin/charts/flot/assets/lib/jquery.flot.resize.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/modules/admin/charts/flot/assets/lib/plugins/jquery.flot.tooltip.min.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/modules/admin/charts/flot/assets/custom/js/flotcharts.common.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/modules/admin/charts/easy-pie/assets/lib/js/jquery.easy-pie-chart.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/modules/admin/charts/sparkline/jquery.sparkline.min.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/modules/admin/maps/vector/assets/lib/maps/jquery-jvectormap-world-mill-en.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/plugins/less-js/less.min.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/modules/admin/charts/flot/assets/lib/excanvas.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/plugins/browser/ie/ie.prototype.polyfill.js?v=v1.0.2&sv=v0.0.1'
	],

	/* The initialization scripts always load last and are automatically and dynamically loaded when AJAX navigation is enabled; */
	bundle: [
		'../assets/components/plugins/ajaxify/ajaxify.init.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/plugins/preload/pace/preload.pace.init.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/core/js/animations.init.js?v=v1.0.2', 
		'../assets/components/modules/admin/charts/flot/assets/custom/js/flotchart-line-2.init.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/modules/admin/charts/flot/assets/custom/js/flotchart-mixed-1.init.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/modules/admin/charts/flot/assets/custom/js/flotchart-bars-horizontal.init.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/modules/admin/charts/easy-pie/assets/custom/easy-pie.init.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/modules/admin/charts/sparkline/sparkline.init.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/modules/admin/maps/vector/assets/custom/maps-vector.world-map-markers.init.js?v=v1.0.2&sv=v0.0.1', 
		'../assets/components/core/js/sidebar.main.init.js?v=v1.0.2', 
		'../assets/components/core/js/sidebar.discover.init.js?v=v1.0.2', 
		'../assets/components/core/js/core.init.js?v=v1.0.2'
	]

};
</script>

<script>

</script>
	<script>if (/*@cc_on!@*/false && document.documentMode === 10) { document.documentElement.className+=' ie ie10'; }</script>
	
	
</head>
<body class="scripts-async">
	

		<div id="content">


<div class="innerLR">

	<h2 class="margin-none">Analytics &nbsp;<i class="fa fa-fw fa-pencil text-muted"></i></h2>

	<div class="separator-h"></div>
				
	<div class="row">
		<div class="col-md-8">

			<div class="row">
				<div class="col-md-6">
					<div class="widget innerAll text-center">
						<h3 class="innerT">Overall Performance</h3>
						<p class="innerB margin-none text-xlarge text-condensed strong text-primary">+281</p>
						<div class="innerTB">
							<div class="sparkline" sparkHeight="57">0:10,7:3,5:5,6:4,3:7,7:3,5:5,6:4,2:8,3:7,7:3,5:5,0:10</div>
						</div>
					</div>
				</div>

				<div class="col-md-6">
				
					<div class="widget widget-tabs widget-tabs-double-2 border-bottom widget-tabs-responsive">

						<div class="widget-body">
							<div class="tab-content">
							
								<!-- Tab content -->
								<div id="tabReports" class="tab-pane active widget-body-regular innerAll inner-2x text-center">
									
									<div data-percent="85" data-size="95" class="easy-pie inline-block primary" data-scale-color="false" data-track-color="#efefef" data-line-width="8">
										<div class="value text-center">
											<span class="strong"><i class="icon-graph-up-1 fa-3x text-primary"></i></span>
										</div>
									</div>

								</div>
								<!-- // Tab content END -->
							
								<!-- Tab content -->
								<div id="tabIncome" class="tab-pane widget-body-regular innerAll inner-2x text-center">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit, omnis minus voluptatibus assumenda sint autem dolorum. Rem, cupiditate, sed, optio est cumque repudiandae quo natus dignissimos praesentium alias nihil aspernatur?
								</div>
								<!-- // Tab content END -->

								<!-- Tab content -->
								<div id="tabAccounts" class="tab-pane widget-body-regular innerAll inner-2x text-center">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic qui natus deserunt atque quae laborum. Porro, eveniet, voluptatem, obcaecati quisquam tempore architecto nostrum quis eius corrupti ea non facilis quidem.
								</div>
								<!-- // Tab content END -->
								
							</div>
						</div>

						<!-- Tabs Heading -->
						<div class="widget-head border-top-none bg-gray">
							<ul>
								<li class="active"><a class="glyphicons notes" href="#tabReports" data-toggle="tab"><i></i><span>Reports</span></a></li>
								<li><a class="glyphicons credit_card" href="#tabIncome" data-toggle="tab"><i></i><span>Income</span></a></li>
								<li><a class="glyphicons user" href="#tabAccounts" data-toggle="tab"><i></i><span>Accounts</span></a></li>
							</ul>
						</div>
						<!-- // Tabs Heading END -->

					</div>
					<!-- //Widget -->
									
				</div>
				<!-- //Col -->
			</div>
			<!-- //Row -->

			<!-- Widget -->
			<div class=" widget widget-body-white ">
				<div class="widget-head height-auto ">
					<div class="row row-merge ">
						<div class="col-md-6">
							<div class="innerAll inner-2x text-center">
								<h5 class="margin-none innerB half">Gross Revenue</h5>
								<h4 class="text-medium strong text-primary margin-none">10,201.00</h4>
							</div>
						</div>
						<div class="col-md-6">
							<div class="innerAll inner-2x text-center">
								<h5 class="margin-none innerB half">Net Revenue</h5>
								<h4 class="text-medium text-primary strong margin-none">8,812.40</h4>
							</div>
						</div>
					</div>
				</div>
				<div class="widget-body innerAll">
					<!-- Chart with lines and fill with no points -->
<div id="chart_lines_fill_nopoints_2" class="flotchart-holder"></div>




				</div>
			</div>
			<!-- //Widget -->

		
		
	</div>
	<!-- // Main Container Fluid END -->
	

	<!-- Global -->
	<script data-id="App.Config">
		var basePath = '',
		commonPath = '../assets/',
		rootPath = '../',
		DEV = false,
		componentsPath = '../assets/components/';
	
	var primaryColor = '#3695d5',
		dangerColor = '#b55151',
		successColor = '#609450',
		infoColor = '#4a8bc2',
		warningColor = '#ab7a4b',
		inverseColor = '#45484d';
	
	var themerPrimaryColor = primaryColor;

		App.Config = {
		ajaxify_menu_selectors: ['#menu'],
		ajaxify_layout_app: false	};
		</script>
	
		
</body>
</html>
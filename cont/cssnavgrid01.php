<!DOCTYPE html>
<html lang="es">  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control</title>
    <link rel="stylesheet" href="../css/cssnavgrid01.css">

    <script type="text/javascript" src="../js/jquery-3.3.1.js"></script> 
    <script>
        function cerrarCuadrito() {
          $("#tablero").fadeOut();
          $('#mantel').fadeOut('slow');
        }

        function mostrarLista(pagina) {
          $("#mesa").css("width", "80%");
          $("#mesa").css("top", "3%");
          $("#mesa").css("height", "auto");
    
          $("#mesa").fadeIn();
          $("#mesa").load(pagina);
        }
    </script>
    
    <style>
    //fonts
@import url('https://fonts.googleapis.com/css?family=Open+Sans|Raleway');
//dominion-responsive.html styles

//global styles
* {font-family: 'Raleway', sans-serif;}

//page styles
header {
	h1 {
		font-size: 5rem;
	}
	h3 {
		font-family: 'Open Sans', sans-serif;
		margin-top:-10px;
	}
}

.wrapper-responsive {
	display: grid;
	grid-gap: 20px;
}

// intro section
.intro {
	background: transparent {
		image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/660925/bosque-del-apache.jpg');
		position: center bottom;
		repeat: no-repeat;
		size: cover;
	}
	min-height:350px;
}

.mainheader-res {
	grid-row: 1;
}

.content-res {
	grid-row: 2;
	p {
		font-family: 'Open Sans', sans-serif;
	}
}

.panel-res {
	grid-row: 3;
}

.mainfooter-res {
	grid-row: 4;
	background-color: #222;
	color: #ffffff;
	padding: 15px;
	text-align: center;
	margin-top:50px;
}

@media (min-width: 550px) {
	.wrapper-responsive {
		width: 100%;
		max-width: 960px;
		margin: 0 auto;
		grid-template-columns: 1fr 3fr;
	}
	.mainheader-res {
		width:100%;
		grid-column: 1 / 3;
		grid-row: 1;
	}
	.panel-res {
		grid-column: 1;
		grid-row: 2;
	}
	.content-res {
		grid-column: 2;
		grid-row: 2;
	}
	.mainfooter-res {
		grid-column: 1 / 3;
		grid-row: 3;
	background-color: #222;
	color: #ffffff;
	padding: 15px;
	text-align: center;
	margin-top:50px;
	}
}
</style>
    


</head>

<body>
    <div id="fondo"></div>
    <div id='mesa' style="display: none;"></div>

    <div id="tablero">



<div id="wrapper-responsive">
	<nav id="navbar-main" class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false" aria-controls="navbar">
							<i class="fa fa-bars"></i> Menu
						</button>
				<a class="navbar-brand" href="#">Bosque Del Apache</a>
				<p class="navbar-text">New Mexico's Wildlife Refuge</p>

			</div>
			<div class="navbar-collapse collapse">
				<ul id="nav-main" class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Visit <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#headings">Wildlife &amp; Habitat</a></li>
							<li><a href="#content-formatting">Content</a></li>
							<li><a href="#tables">Tables</a></li>
							<li><a href="#forms">Forms</a></li>
							<li><a href="#images">Images</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Wildlife &amp; Habitat <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#dropdowns">Dropdowns</a></li>
							<li><a href="#input-groups">Input Groups</a></li>
							<li><a href="#navs">Navs</a></li>
							<li><a href="#navbar">Navbar</a></li>
							<li><a href="#pagination">Pagination</a></li>
							<li><a href="#alerts">Alerts</a></li>
							<li><a href="#labels">Labels</a></li>
							<li><a href="#progress">Progress</a></li>
							<li><a href="#media-object">Media Object</a></li>
							<li><a href="#list-groups">List Groups</a></li>
							<li><a href="#panels">Panels</a></li>
							<li><a href="#wells">Wells</a></li>
						</ul>
					</li>
					<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Seasons of Wildlife</a></li>
					<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">About the Refuge</a></li>

				</ul>
			</div>
		</div>
	</nav>

	<section id="content" class="section section-white">
		<div class="intro"></div>
		<div class="container">
			<div class="wrapper-responsive">
				<header class="mainheader-res">
					<h1><strong>New Mexico's Natural Paradise</strong></h1>
					<h3>Bosque del Apache | National Wildlife Refuge</h3>
					<h5>by Scott Fowler, <em>The Santa Fe New Mexican</em></h5>
					<hr>
				</header>


				<div class="panel-res">
					<h4 class="text-uppercase"><strong>What We Do</strong></h4>
					<ul>
						<li><a href="#">Resource Management</a></li>
						<li><a href="#">Conservation</a></li>
						<li><a href="#">Get Involved</a></li>
						<li><a href="#">Partnerships</a></li>
						<li><a href="#">In the Community</a></li>
						<li><a href="#">Science</a></li>
					</ul>
				</div>

				<div class="content-res">
					<h2>Nature is on View and Wilderness is Truly Wild</h2>
					<p>Established in 1939 to provide a critical stopover for migrating waterfowl, the refuge is well known for the thousands of sandhill cranes, geese and other waterfowl that winter here each year.</p>

					<p>Situated between the Chupadera Mountains to the west and the San Pascual Mountains to the east, the 57,331-acre refuge harbors a wild stretch of the Rio Grande, a ribbon of cottonwood and willow trees visible on the landscape from distant mesas.
						</p>

					<p>Petroglyphs tell the story of an ancient people that lived and hunted here. The river and its diversity of wildlife have drawn humans to this area for at least 11,000 years when humans migrated along this corridor, sometimes settling to hunt, fish
						and farm. Artifacts and stone tools found nearby tell us that nomadic paleoindian hunters pursued herds of mammoth and bison in the valley.</p>

					<p>Today, Bosque del Apache is part of the National Wildlife Refuge System, a national network of lands and waters set aside and managed for the benefit of wildlife, habitat and you.</p>

					<img class="thumbnail" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/660925/Crop-Field-512-x-219.jpg" alt="Bosque photo">

					<h2>Resource Management</h2>

					<p>When thousands of migratory birds arrive at Bosque del Apache National Wildlife Refuge, they find fresh water in the impoundment ponds, and acres of habitat and wetlands to gather, feed, and rest.</p>

					<p>Refuge staff depends upon and utilizes various tools to manage the Bosque del Apache National Wildlife Refuge for the benefit of wildlife. Management tools used on the refuge include prescribed burning, exotic plant control, moist soil management,
						farming and water level manipulation.</p>

					<p>Bosque del Apache Refuge cooperates with local farmers to grow crops for wintering waterfowl and cranes. Farmers plant alfalfa and corn, harvesting the alfalfa and leaving the corn for wildlife. The refuge staff grows corn, winter wheat, clover,
						and native plants as additional food, supplements for migrating waterfowl and other wildlife.</p>

					<p>The refuge uses gates and dams to flood and drain certain wetlands on seasonal schedules. Lowering water levels in marshes to create moist fields promotes growth of native marsh plants. Marsh management is rotated so that varied habitats are always
						available. Dry impoundments are disced or burned, then re-flooded, to allow natural marsh plants to grow. When mature marsh conditions are reached, the cycle is repeated. Wildlife foods grown this way include smartweed, millets, chufa, bulrush,
						and sedges.</p>

					<p>Many cottonwood and willow bosques that once lined the Rio Grande have been lost to human developments. Salt cedar or "tamarisk," originally introduced as an ornamental plant and for erosion control, has taken over vast areas. It is a plant that
						has very little value to wildlife. Salt cedar is being cleared and areas are being planted with cottonwood, black willow, and understory plants to restore native bosques that are used by wildlife to nest, rest and feed. </p>

					<p>Irrigation canals ensure critical water flow. Daily monitoring, mowing, and clearing keeps them functioning. Controlling the water enables refuge staff to manage the habitat. Throughout the refuge, a network of small canals connects different “moist
						soil units” with the region’s main water supply, which is a 57-mile canal that runs along the river. Each moist-soil unit can be flooded or drained as needed to grow the best mix of wetland plants to feed migrating birds. With wetland plants hearty
						and thriving, a great diversity of native wildlife -- from prowling coyotes to year-round and migratory birds – continue to live in and around the wetlands.</p>

				</div>
			</div>
		</div>
		<footer class="mainfooter-res">
			<div class="container">
				<small>Copyright &copy; 2017 Madjaybird Design, All Rights Reserved.</small>
			</div>
		</footer>
</div>
</section>


</div>



    </div>

</body>
</thead>
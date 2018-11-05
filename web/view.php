<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Mini Car Inventory System</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
 
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
	<div class="wrapper">

	    <!-- Sidebar -->
	    <nav id="sidebar">
	        <div class="sidebar-header">
	            <h3>Inventory System</h3>
	        </div>

	        <ul class="list-unstyled components">
	            <li>
	                <a aria-expanded="true" class="dropdown-toggle">Add New</a>
	                <ul class="list-unstyled" id="pageSubmenu">
	                    <li>
	                        <a href="./addManufacturer.php">Manufacturer</a>
	                    </li>
	                    <li>
	                        <a href="./addModel.php">Model</a>
	                    </li>
	                </ul>
	            </li>
	            <li class="active">
	                <a href="./view.php">View All</a>
	            </li>
	        </ul>
	    </nav>

	    <!-- Page Content -->
	    <div id="content">
	        <div class="container-fluid">
	        	<h3>Inventory</h3>
	        	<table id="example" class="display" style="width:100%">
			        <thead>
			            <tr>
			                <th>Serial number</th>
			                <th>Model</th>
			                <th>Manufacturer</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			    </table>
	        </div>	    
	    </div>

		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>
		      <div class="modal-body">

		      	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators"></ol>
				  <!-- Wrapper for slides -->
				  <div class="carousel-inner"></div>
				  <!-- Controls -->
				  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left"></span>
				  </a>
				  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right"></span>
				  </a>
				</div>


		        <p><strong style="color:#000000">Manufacturer :  </strong><span id="manufacturer_name"></span></p>
		        <p><b style="color:#000000">Model : </b><span id="model_name"></span></p>
		        <p><b style="color:#000000">Registration Number : </b><span id="registration_number"></span></p>
		        <p><b style="color:#000000">Manufacturing Year : </b><span id="manufacturing_year"></span></p>
		        <p><b style="color:#000000">Color : </b><span id="color"></span></p>
		        <p><b style="color:#000000">Note : </b><span id="note"></span></p>
		      </div>
		      <div class="modal-footer">
		      	<button type="button" id="sell" class="btn btn-default" data-id="a" onclick="sellVehicle()">Sell</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
		</div>

	</div>     

    <!-- jQuery CDN -->
    <script  src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

    <script type="text/javascript">
    	
    	$(document).ready(function(){
    		getInventory();
    	})

    	function getInventory(){
    		$.fn.dataTable.ext.errMode = 'none';
    		$('#example').DataTable({
			    ajax: {
			        url: '../src/api/inventory/read.php',
			        dataSrc: 'records'
			    },
			    fnRowCallback : function(nRow, aData, iDisplayIndex){
					$("td:first", nRow).html(iDisplayIndex +1);
					return nRow;
				},
			    columns: [
			      { data : null},
			      { data: "model_name" }, 
			      { data: "manufacturer_name" },
			      {
		            "mData": null,
		            "bSortable": false,
		            "mRender": function (o) { return '<button  data-toggle="modal" data-target="#myModal" onclick="showDetails('+ o.id + ')">' + 'View' + '</button>';}
		           }
			    ]
			});
    	}

    	function showDetails(id){
    		$('#sell').data('id',id);
    		$('.carousel-inner').html("");
    		$.ajax({
    			url:'../src/api/model/read.php?id='+id,
    			type:'GET',
    			success:function(data){
    				console.log(data);
    				$('#manufacturer_name').html(data['manufacturer_name']);
    				$('#model_name').html(data['model_name']);
    				if(data['manufacturing_year']!="" && data['manufacturing_year'] != null){
	    				$('#manufacturing_year').html(data['manufacturing_year']);
    				}else{
    					$('#manufacturing_year').html("N/A");
    				}
    				if(data['registration_number']!="" && data['registration_number'] != null){
    					$('#registration_number').html(data['registration_number']);
    				}else{
    					$('#registration_number').html("N/A");
    				}
    				if(data['color']!="" && data['color'] != null){
    					$('#color').html(data['color']);
    				}else{
    					$('#color').html("N/A");
    				}
    				if(data['note']!="" && data['note'] != null){ 	   					   	
    					$('#note').html(data['note']);
    				}else{
    					$('#note').html("N/A");
					}

					if(data['image_1']!="" && data['image_1'] != null){
						$('<div class="item active"><img style="max-width:100%" src="../uploads/'+data['image_1']+'">').appendTo('.carousel-inner');
					    $('<li data-target="#carousel-example-generic" data-slide-to="0"></li>').appendTo('.carousel-indicators')
					}

					if(data['image_2']!="" && data['image_2'] != null){
						$('<div class="item"><img style="max-width:100%" src="../uploads/'+data['image_2']+'">').appendTo('.carousel-inner');
					    $('<li data-target="#carousel-example-generic" data-slide-to="1"></li>').appendTo('.carousel-indicators')
					}
    			},
    			error:function(){
    				console.log("Unable to fetch");
    			}
    		});
    	}

    	function sellVehicle(){
    		var id = $('#sell').data('id');
    		$.ajax({
    			url: "../src/api/model/sell.php",
    			type:"POST",
    			data: '{"id":'+id+',"is_sold":1}',
    			dataType:"json",
    			contentType: "application/json",
    			success: function(){
    				alert("Updated successfully");
    				window.location.href = "./view.php";
    			},
    			error: function(){
    				alert("Unable to update");
    			}
    		})
    	}

    </script>

</body>
</html>
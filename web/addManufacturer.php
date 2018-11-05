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
	                    <li class="active">
	                        <a href="./addManufacturer.php">Manufacturer</a>
	                    </li>
	                    <li>
	                        <a href="./addModel.php">Model</a>
	                    </li>
	                </ul>
	            </li>
	            <li>
	                <a href="./view.php">View All</a>
	            </li>
	        </ul>
	    </nav>

	    <!-- Page Content -->
	    <div id="content" >
	        <div class="container-fluid center">
	        	<p>
					<h3> Add new manufacturer</h3>
	        	</p>
        		<p>
		        	<input type="text" name="name" id="name" required="true" placeholder="Enter manufacturer name here" style="width: 50%"><br>
				</p>
				<p>
		        	<button onclick="addManufacturer()">Add</button>
	        	</p>
	        </div>
	    </div>
	</div>     

    <!-- jQuery CDN -->
    <script  src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
    		
    	function addManufacturer(){
    		var name = $('#name').val();
    		if(name == undefined || name == ""){
    			alert("Please enter name");
    		}else{
    			alert("Entered name : "+name);
    			// Call api here
    			// manufacturer/create

    			$.ajax({
    				url : '../src/api/manufacturer/create.php',
    				type: 'POST',
    				data: '{"name": "'+name+'"}',
    				contentType: "application/json; charset=utf-8",
    				dataType: "json",
    				success:function(data){
    					console.log("success");
    					alert("Manufacturer created successfully");
    					window.location.href = "./addManufacturer.php";
    				}
    			});
    		}
    	}

    </script>

</body>
</html>
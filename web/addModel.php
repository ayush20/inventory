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
	                    <li>
	                        <a href="./addManufacturer.php">Manufacturer</a>
	                    </li>
	                    <li class="active">
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
	    <div id="content">
	    	<div class="container-fluid center">
		        <p>
			        <h3>Add new model</h3>
		        </p>
	        	<p>
		        	<input type="text" name="name" id="name" required="true" placeholder="Enter model name here">
		        	<select name="manufacturer" id="manufacturer" required="true">
		        		<option value="-1">Select a manufacturer</option>
		        	</select>
				</p>
				<p>
		        	<input type="text" name="color" id="color" required="true" placeholder="Enter color" style="width: 50%"><br>
		        </p>
		        <p>
		        	<input type="text" name="manufacturing_year" id="manufacturing_year" required="true" placeholder="Enter manufacturing year" style="width: 50%"><br>
		        </p>
		        <p>
		        	<input type="text" name="registration_number" id="registration_number" required="true" placeholder="Enter registration number here" style="width: 50%"><br>
		        </p>
		        <p>
		        	<input type="text" name="note" id="note" required="true" placeholder="Enter additional note here" style="width: 50%"><br>
				</p>
				<p>

					<input type="file" class="fileUpload" name="fileUpload" id="image_1">
					<input type="hidden" name="image_url_1" id="image_url_1"> 
				</p>
				<p>
					<input type="file" class="fileUpload" name="fileUpload" id="image_2">
					<input type="hidden" name="image_url_2" id="image_url_2"> 
				</p>
				<p>
		        	<button onclick="addModel()">Add</button>
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

    <script type="text/javascript" src="./assets/js/jquery.liteuploader.js"></script>

    <script type="text/javascript">
    	function addModel(){
    		var name = $('#name').val();
    		var manufacturerElement = document.getElementById('manufacturer');
    		var manufacturer = manufacturerElement.options[manufacturerElement.selectedIndex].value;
    		var color = $('#color').val();
    		var manufacturing_year = $('#manufacturing_year').val();
    		var registration_number = $('#registration_number').val();
    		var note = $('#note').val();
    		var image_1 = $('#image_url_1').val();
    		var image_2 = $('#image_url_2').val();
    		if(name == undefined || name == ""){
    			alert("Please enter name");
    		}else if(manufacturer == undefined || manufacturer == "-1"){
    			alert("Please select a manufacturer from dropdown");
    		}else{
    			// Call api here
    			// model/create

    			$.ajax({
    				url : '../src/api/model/create.php',
    				type : "POST",
    				data : '{"name":"'+name+'","manufacturer_id":'+manufacturer+',"note":"'+note+'","color":"'+color+'","manufacturing_year":"'+manufacturing_year+'","registration_number":"'+registration_number+'","image_1":"'+image_1+'","image_2":"'+image_2+'"}',
    				dataType:"json",
    				contentType : "application/json",
    				success: function(data){
    					console.log(data);
    					alert("Model created successfully");
    					window.location.href = "./addModel.php";
    				}
    			});
    		}
    	}

    	$(document).ready(function(){
    		getManufacturer();

            $('#image_1').liteUploader({
                script: '../src/api/model/uploadImage.php'
            })
            .on('lu:success', function (e, response) {
                $('#image_url_1').val(response);
            });

            $('#image_2').liteUploader({
                script: '../src/api/model/uploadImage.php'
            })
            .on('lu:success', function (e, response) {
                $('#image_url_2').val(response);
            });
    	})

    	function getManufacturer(){
    		$.ajax({
    			url : "../src/api/manufacturer/read.php",
    			type: "GET",
    			success: function(data){
    				for (var i = 0; i<data.records.length; i++){
					    var opt = document.createElement('option');
					    opt.value = data.records[i]['id'];
					    opt.innerHTML = data.records[i]['name'];
					    $("#manufacturer").append(opt);
					}
    			}
    		});
    	}

    </script>

</body>
</html>
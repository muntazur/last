@extends('layout.main')

@section('navigation')

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">

                   <!Navbar Brand>
            <a class="navbar-brand" href="/">Inventory</a>

                  <!links>
            <ul class="navbar-nav">
                
                <li class="nav-item active">
                	
				      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				        
				      </a>
				      <div class="dropdown-menu">
				        <a class="dropdown-item" href="logout">Logout</a>
				      </div>                
			    </li>
                

            </ul>

        </nav>

@endsection

@section('content')

<div class="container" style="margin-top:65px">
	<div class="row" style="margin-top: 10px">

		<div class="col-sm-4 brand pad">
            <h5> Add a new brand </h5>
            <p id="msgBrand"></p>
			<form id="brandForm">
	            
				<input type="text" name="brand" placeholder="Enter brand name" class="form-control" style="width:100%">
				<button id="submitBrand" type="submit" class="btn btn-primary btn-sm">Add</button>

			</form>
			<a href="manage_brand" class="btn btn-info btn-sm">Manage</a>

		</div>

		<div class="col-sm-4 brand pad">

			<h5>Add a new category</h5>
			<p id="msgCategory"></p>

			<form id="categoryForm">
				<input type="text" name="category" placeholder="Enter category name" class="form-control" style="width:100%">

					<?php 
						use App\Http\Controllers\InventoryController;
								$table = InventoryController::getCategoryList();
					?>


			
				<button id="submitCategory" type="submit" class="btn btn-primary btn-sm">Add</button>

			</form>	
			<a href="manage_category" class="btn btn-info btn-sm">Manage</a>

		</div>

		<div class="col-sm-4 brand pad">
			
			<h5> Add a new product </h5>
			<p id="msgProduct"></p>

			<form id="productForm">

				<input type="text" name="product" placeholder="Enter product name" class="form-control" style="width:100%">

				<select name="category" class="form-control" style="width:100%">


				@foreach($table as $row)

					<option value="{{$row->name}}">{{$row->name}}</option>

				@endforeach

				</select>

				<select name="brand" class="form-control" style="width:100%">

					<?php 
						//use App\Http\Controllers\InventoryController;
						$table = InventoryController::getBrandList();
					?>

					@foreach($table as $row)

						<option value="{{$row->name}}">{{$row->name}}</option>

					@endforeach
							
					</select>

					<input type="text" name="price" placeholder="Enter price" class="form-control" style="width:100%">

					<input type="text" name="quantity" placeholder="Enter quantity" class="form-control" style="width:100%">	
					<button id="submitProduct" type="submit" class="btn btn-primary btn-sm">Add</button>

			</form>	
			<a href="manage_product" class="btn btn-info btn-sm">Manage</a>	
		</div>

	</div>

	<div class="row" style="margin-top: 15px;">
		<div class="col brand pad">
			<h5>Make an order </h5>
			<form id="orderForm">
			<span><input type="text" name="customer" placeholder="Enter customer name" required="required"><input type="date" name="date" required="required"></span>
			<br>
			<br>


			<table class="table table-striped table-bordered table-condensed table-dark">
				<thead>
					<th>Item Name</th>
					<th>Total Quantity</th>
					<th>Quantity</th>
					<th>Price/item</th>
					<th>Total cost</th>
				</thead>
				<tbody>

				</tbody>
			</table>
             
             <span><button id="order" class="btn btn-primary">New</button>
             <button type="submit" class="btn btn-success">Submit</button></span>

            </form>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 brand pad"></div>
		<div class="col-md-4 brand pad">
			<!--button type="button" id="print" class="btn btn-primary btn-sm">print</button -->
			<a class="btn btn-danger" href="/print">print</a>
		</div>
		<div class="col-md-4 brand pad"></div>
</div>
@endsection

@section('jquery')
	<script type="text/javascript">
	    $.ajaxSetup({

	        headers: {

	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

	        }

	    });

	    $("#brandForm").on('submit',function(e)
	    {   
	    	e.preventDefault();
	    	var data = $(this).serialize();

	    	$.ajax({
	    		type:'POST',
	    		url:'/save_brand',
	    		data:data,
	    		success:function(result)
	    		{
	    			if(result.msg=='have')
	    			{
	    				$("#msgBrand").html('Already Exists !');
	    			}
	    			else
	    			{
	    				$("#msgBrand").html(result.msg);
	    			}
	    		},
	    		error:function()
	    		{
	    			alert(data);
	    		}
	    	});
	    });



	    //Category
	    $("#categoryForm").on('submit',function(e)
	    {   
	    	e.preventDefault();
	    	var data = $(this).serialize();

	    	$.ajax({
	    		type:'POST',
	    		url:'/save_category',
	    		data:data,
	    		success:function(result)
	    		{
	    			if(result.msg=='have')
	    			{
	    				$("#msgCategory").html('Already Exists !');
	    		
	    			}
	    			else
	    			{
	    				$("#msgCategory").html(result.msg);
	    				/*
	    				$.each(result.table,function(){
	    					
	    					$.each(this,function(index,value)
	    					{
	    					   //$("#select_parent").html(value);
	    					   console.log(value);
	    					});
	    				});*/
	    				setTimeout(function(){
	    					window.location.reload();
	    				},1000);
	    			}
	    		},
	    		error:function()
	    		{
	    			alert(data);
	    		}
	    	});
	    });



	    //save product

	    $("#productForm").on('submit',function(e)
	    {
	    
	    	e.preventDefault();

	    	var data = $(this).serialize();
	    	$.ajax({
	    		type:'POST',
	    		url:'/save_product',
	    		data:data,
	    		success:function(result)
	    		{
	    			if(result.msg=='have')
	    			{
	    				$("#msgProduct").html('Already Exists !');
	    		
	    			}
	    			else
	    			{
	    				$("#msgProduct").html(result.msg);
	    				/*
	    				$.each(result.table,fuvar name = $("input[name=product]").val();nction(){
	    					
	    					$.each(this,function(index,value)
	    					{
	    					   //$("#select_parent").html(value);
	    					   console.log(value);
	    					});
	    				});*/
	    				setTimeout(function(){
	    					window.location.reload();
	    				},1000);
	    			}
	    		},
	    		error:function()
	    		{
	    			alert(data);
	    		}
	    	});
	    });

	    $("#order").click(function(e){
	    	e.preventDefault();

	    	$.ajax({

	    		type:'GET',
	    		url:'/get_order',
	    		success:function(data)
	    		{
	    			$("tbody").html(data.html);
	    		},
	    		error:function()
	    		{
	    			alert('error');
	    		}
	    	});
	    });
	    $("#orderForm").on('submit',function(e){
	    	e.preventDefault();
	    	var data = $(this).serialize();

	    	$.ajax({
	    		type:'POST',
	    		url:'/save_order',
	    		data:data,
	    		success:function(result)
	    		{
	    			alert('created');
	    		},
	    		error:function()
	    		{
	    			alert('error');
	    		}
	    	});
	    });

	    /*$("#print").on('click',function(e){
	    	e.preventDefault();

	    	$.ajax({
	    		type:'GET',
	    		url:'/print',
	    		success:function(result)
	    		{
	    			alert('ok');
	    		},
	    		error:function()
	    		{
	    			alert('Error in printing');
	    		}
	    	})
	    });*/
</script>
@endsection
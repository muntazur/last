@extends('layout.main')


@section('navigation')

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">

                   <!Navbar Brand>
            <a class="navbar-brand" href="/">Inventory Management System</a>

                  <!links>
            <ul class="navbar-nav">

                <li class="nav-item active"><a href="logout"class="nav-link">Logout</a></li>
                

            </ul>

        </nav>

@endsection

@section('content')
<div class="container">
<table class="table table-striped table-bordered table-condensed table-dark">
	<thead>
		<th>Brand</th>
		<th>Status</th>
		<th>Action</th>
	</thead>
	<tbody>
		@foreach($table as $row)
		    <tr>
			
				<td>{{$row->name}}</td>

				@if($row->status==1)
				  <td>
				  	<ul>
				  		<li>
				  			<button type="button" class="btn btn-success btn-sm">active</button>
				  		</li>
				  	</ul>
				  </td>
				@endif

				<td>
					<ul>
						<li>

							<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal" data-id="{{$row->name}}">Edit</button>

							<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{$row->name}}">Delete</button>

						</li>
												
					</ul>
				</td>
			
		    </tr>
		@endforeach
	</tbody>
</table>



<div class="modal fade" id="editModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" align="center">
				<h4 class="modal-title">Update brand</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body" align="center">

			 <form id="editForm">

				<p id="msg"></p>
				<input type="text" name="brand" value="" class="form-control" style="width:80%;text-align: center;" placeholder="">
				<input type="hidden" name="previous" value="">
				<button id="updateBrand" type="submit" class="btn btn-info btn-sm">update</button>

			</form>

			</div>
			<div class="modal-footer" align="center">

				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">close</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="deleteModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" align="center">
				<h4 class="modal-title">Delete Brand</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body" align="center">

			 <form id="deleteForm">

				<p id="msg"></p>
				<input type="text" name="brand" value="" class="form-control" style="width:80%;text-align: center;" placeholder="" readonly="readonly">
				
				<button id="deleteBrand" type="submit" class="btn btn-info btn-sm">Delete</button>

			</form>

			</div>
			<div class="modal-footer" align="center">

				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">close</button>
			</div>
		</div>
	</div>
</div>

</div>
@endsection

@section('jquery')
<script type="text/javascript">
    

	    $.ajaxSetup({

	        headers: {

	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

	        }

	    });

	$("#editModal").on('show.bs.modal',function(e) {
		var brand = $(e.relatedTarget).data('id');

		var modal=$(this);
		modal.find('.modal-body input[name=brand]').val(brand);
		modal.find('.modal-body input[name=previous]').val(brand);
	});

	$("#deleteModal").on('show.bs.modal',function(e) {
		var brand = $(e.relatedTarget).data('id');

		var modal=$(this);
		modal.find('.modal-body input[name=brand]').val(brand);
		
	});

	$("#editForm").on('submit',function(e)
	{   
		
		e.preventDefault();
		var data = $(this).serialize();

		$.ajax({
			type:'POST',
			url:'/update_brand',
			data:data,
			success:function(result)
			{
				if(result.msg)
				{
					$("#msg").html(result.msg);
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
    

	$("#deleteForm").on('submit',function(e)
	{   
		e.preventDefault()
		var data = $(this).serialize();
        //console.log(brand);
       
	    	$.ajax({
					type:'POST',
					url:'/delete_brand',
					data:data,
					success:function(result)
					{
						if(result.msg)
						{   
							$("#msg").html(result.msg);
							//alert('Deleted');
							setTimeout(function() {
								// body...
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
  


</script>
@endsection
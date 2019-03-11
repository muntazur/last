@extends('layout.main')


@section('navigation')

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">

                   <!Navbar Brand>
            <a class="navbar-brand" href="/">Inventory</a>

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
		<th>Category</th>
		<th>Parent Category</th>
		<th>Status</th>
		<th>Action</th>
	</thead>
	<tbody>
		@foreach($table as $row)
		    <tr>
			
				<td>{{$row->name}}</td>
				<td>{{$row->parent_category}}</td>

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
							<button id="category" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal" data-id="{{$row->name}}">
							<input type="hidden" name="parent" id="parent"
							value="{{$row->parent_category}}">Edit
							</button>

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
				<input type="text" name="category" value="" class="form-control" style="width:80%;text-align: center;" placeholder="">
				<input type="text" name='parent' value="" class="form-control" style="width:80%;text-align: center;" placeholder="">

				<input type="hidden" name="previous" value="">
				<button type="submit" class="btn btn-info btn-sm">update</button>

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
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form id="deleteForm">
				<input type="text" name="brand" readonly="readonly" value="">
				<button type="submit">delete</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal">close</button>
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
	$("#category").click(function(){
		var value = $(this).find("#parent").val();
		console.log(value);
	});

	$("#editModal").on('show.bs.modal',function(e) {
		var category = $(e.relatedTarget).data('id');

		var modal=$(this);
		modal.find('.modal-body input[name=category]').val(category);
		//modal.find('.modal-body input[name=previous]').val(brand);
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
    
    $("#deleteModal").on('show.bs.modal',function(e)
    {   
    	var brand = $(e.relatedTarget).data('id');
    	var modal=$(this);

    	modal.find('.modal-body input[name=brand]').val(brand);
    });

	$("#deleteForm").on('submit',function(e)
	{   
		e.preventDefault()
		var data=$(this).serialize();
        console.log(data);

    	$.ajax({
				type:'POST',
				url:'/delete_brand',
				data:data,
				success:function(result)
				{
					if(result.msg)
					{
						$("#msg").html(result.msg);
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
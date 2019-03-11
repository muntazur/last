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
		<th>Product</th>
		<th>Category</th>
		<th>Brand</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Status</th>
		<th>Action</th>
	</thead>
	<tbody>
		@foreach($table as $row)
		    <tr>
			
				<td>{{$row->name}}</td>
				<td>{{$row->category}}</td>
				<td>{{$row->brand}}</td>
				<td>{{$row->price}}</td>
				<td>{{$row->quantity}}</td>

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
							<button type="button" class="btn btn-info btn-sm">Edit</button>
						</li>
						<li>
							<button type="button" class="btn btn-danger btn-sm">Delete</button>
						</li>
					</ul>
				</td>
			
		    </tr>
		@endforeach
	</tbody>
</table>
@endsection
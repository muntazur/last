
<?php 
  use App\Http\Controllers\InventoryController;
  $productTable = InventoryController::getProduct(); 
 ?>
<td>
	<select name="name" id="sel" required="required">
		<option value="">Choose</option>
		@foreach($productTable as $row)
			<option value="{{$row->name}}">{{$row->name}}</option>
		@endforeach
	</select>
</td>
<td><input id="total_quantity" type="text" name="total_quantity" value="" readonly="readonly" style="width:100%"></td>

<td><input id="quantity" type="number" name="quantity" value="" style="width:100%"></td>
<td><input id="price" type="text" name="price" value="" readonly="readonly" style="width:100%"></td>
<td> <input id="total_cost" type="text" name="total_cost" value="" readonly="readonly" style="width:100%"></td>


	<script type="text/javascript">

	    $.ajaxSetup({

	        headers: {

	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

	        }

	    });

		$("#sel").change(function()
		{   
			var name = $(this).val();
			$.ajax({
				type:'POST',
				url: '/get_single_product',
				data:{name:name},
				success:function(data)
				{
					$("#total_quantity").val(data.quantity);
					$("#price").val(data.price);
					$("#quantity").val(0);
					$("#total_cost").val(0);
				},
				error:function()
				{
					alert(data);
				}
			});
			
		});

		$("#quantity").change(function(){
			var quantity = $(this).val();
			var price = $("#price").val();
			$("#total_cost").val(quantity*price);
		});
</script>

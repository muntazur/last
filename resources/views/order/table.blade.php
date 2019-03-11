<?php 
  use App\Http\Controllers\InventoryController;
  $productTable = InventoryController::getProduct(); 
 ?>
<td>
	<select name="name">
		@foreach($productTable as $row)
			<option value="{{$row->name}}">{{$row->name}}</option>
		@endforeach
	</select>
</td>
<td><input type="text" name="total_quantity" value="{{$row->quantity}}" readonly="readonly" style="width:100%"></td>

<td><input type="text" name="quantity" value="" style="width:100%"></td>
<td><input type="text" name="price" value="{{$row->price}}" readonly="readonly" style="width:100%"></td>
<td> <input type="text" name="total_cost" value="" readonly="readonly" style="width:100%"></td>
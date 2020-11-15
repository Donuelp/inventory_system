@extends('layouts.app', ['activePage' => 'items', 'menuParent' => 'Inventory', 'titlePage' => __('Items')])
@section('content')
	<div class="content">
		<div class="row">
			<div class="col-lg-11 pt-5 ml-auto mr-auto">
				<button class="btn btn-simple mb-3 text-white" data-toggle="modal" data-target="#items_modal" id="add_item_modal">
				  <i class="tim-icons icon-simple-add pb-1 pr-1"></i> Add Item
				</button>
		        <div class="card" id="card_item_table ">
		            <div class="card-header">
		               <h4 class="card-title">Item Table Information</h4>
		            </div>
		            <div class="card-body">
		                <div class="table-responsive ps">
		                  <table class="table" id="item_table">
		                     <thead class="text-primary">
		                        <tr>
		                        	<th class="text-center"> Item ID </th>
			                        <th class="text-center"> Item Name </th>
			                        <th class="text-center"> Item Description </th>
			                        <th class="text-center"> Item Category </th>
			                        <th class="text-center"> Location </th>
			                        <th class="text-center"> Price </th>
			                        <th class="text-center"> Cost </th>
			                        <th class="text-center"> Created At </th>
			                        <th class="text-center"> Actions </th>
		                        </tr>
		                     </thead>
		                      <tbody>
		                        @isset($items)
		                        @foreach($items as $item)
		                        <tr>
		                        	<td class="text-center"> {{ $item->item_id }}</td>
		                            <td class="text-center"> {{ $item->item_name }} </td>
		                            <td class="text-center"> {{ $item->item_description }} </td>
		                            <td class="text-center"> {{ $item->category_name }} </td>
		                            <td class="text-center"> {{ $item->branch_name }} </td>
		                            <td class="text-center"> {{ $item->item_price }} </td>
		                            <td class="text-center"> {{ $item->item_cost }} </td>
		                            <td class="text-center"> {{\Carbon\Carbon::parse($item->item_created_at)->format('Y-m-d')}} </td>
		                           
		                            <td class="text-center">
		                            	<button type="button" rel="tooltip" class="btn btn-info btn-sm btn-icon" data-original-title="Edit Details" title="" onclick="edit_branch({{$item->item_id}}, this)"><i class="tim-icons icon-pencil"></i></button>

		                                <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon" data-original-title="Remove Branch" title="" onclick="delete_branch({{$item->item_id}}, this)"><i class="tim-icons icon-simple-remove"></i></button>
		                            </td>
		                        </tr>
		                        @endforeach
		                        @endif      
		                      </tbody>
		                  </table>
		                  	<div class="ps__rail-x" style="left: 0px; bottom: 0px;">
		                     	<div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
		                     	</div>
		                  	</div>
			                <div class="ps__rail-y" style="top: 0px; right: 0px;">
			                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;">
			                    </div>
			                </div>
		               	</div>
		            </div>
		        </div>
		    </div>
		</div>
		
	</div>

@include('pages.components.modals.masterfile_modals.add_items') {{-- Add items modal --}}
<style>

	#success_add, #add_button_holder, #edit_button_holder, #add_text, #save_text
	{
		display: none;
	}

</style>
@endsection
@push('js')
	<script>
		// Global variables
		var curr_id = null;	

		//End Global variables
		$(document).ready(function(){
			$('#item_table').DataTable({
		        "pagingType": "full_numbers",
		        "lengthMenu": [
		          [5, 10, 15, -1],
		          [5, 10, 15, "All"]
		        ],
		        // responsive: true,
		        language: {
		          search: "_INPUT_",
		          searchPlaceholder: "Search records",
		        },
		        "order": [[0, "desc"]],
		        "bInfo": false

		    });
		});
		$('#add_item_modal').on('click', function(){
			$('#item_name').val('');
			$('#item_desc').val('');
			$('#item_cost').val('');
			$('#item_price').val('');
			$('#item_quantity').val('');
			$("#category_id").val($("#category_id option:first").val());
			$("#branch_id").val($("#branch_id option:first").val());
			$("#measure_id").val($("#measure_id option:first").val());
			$('#add_button_holder').show();
			$('#add_another').show();
			$('#edit_button_holder').hide();
		});
		function createItem()
		{
		    let form = $('#item_form')[0];
		    let data = new FormData(form);
		    
		    $.ajax({
		    url: '{{ route('items.store') }}',
		    method: 'POST',
		    data: data,
		    processData: false,
		    contentType: false,
		    cache: false,
		    timeout: 600000,
		    beforeSend : function(){
		      $('#item_body').toggle('display');
		    },
		    success : function(response){
		                $('#item_form').each(function(){
		                    this.reset();   //form fields will be cleared.
		                });
		                $('#add_text').show();
		                $('#success_add').toggle('display');
		            }   
		    });
	  	}
	  	function toggleAddAnother()
	  	{
	  		$('#item_body').toggle('display');
      		$('#success_add').toggle('display');
      		$('#add_text').show();
      		$('#save_text').hide();

	  	}
	  	function toggleModal(){
		    //If user chose to close the modal after adding new user
		    //From the modal add users or add subscription
		    $('#item_form').toggle('display');
		    $('#item_add').toggle('display');
		    $('#items_modal').modal('toggle');
		    location.reload();
		}
		function edit_branch(id, row)
		{
			$.ajax({
				url: 'branches/'+id+'/edit',
				method: 'GET',
				success : function(response){
					curr_id = id;
					$('#branches_modal').modal('toggle');
					$('#branch_name').val(response[0]['branch_name']);
					$('#branch_desc').val(response[0]['branch_desc']);
					$('#add_button_holder').hide();
					$('#edit_button_holder').show();

				} 
			});
		}
		function save_changes(id, row)
		{
			let form = $('#branch_form')[0];
		    let data = new FormData(form);
		    data.append('id', curr_id);
		    
		    $.ajax({
		    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },  
		    url: '{{ route('branches.updateAJAX') }}',
		    method: 'POST',
		    data: data,
		    processData: false,
		    contentType: false,
		    cache: false,
		    timeout: 600000,
		    beforeSend : function(){
		      $('#branch_body').toggle('display');
		    },
		    success : function(response){
		    			$('#add_text').hide();
		    			$('#add_another').hide();
      					$('#save_text').show();
		                $('#item_form').each(function(){
		                    this.reset();   //form fields will be cleared.
		                });
		                $('#success_add').toggle('display');
		            }   
		     });
		}
	  	function delete_branch(id, row)
	  	{
	      let this_table = $('#card_branch_table').DataTable();
	      let data = {
	        id: id
	      }

	      //calls function destroyAJAX from UserController then calls removeAcc from User model 
	      swal({
	        title: 'Are you sure?',
	        text: "You won't be able to revert this!",
	        type: 'warning',
	        showCancelButton: true,
	        confirmButtonClass: 'btn btn-danger',
	        confirmButtonText: 'Yes, delete it!',
	        cancelButtonClass: 'btn btn-info',
	        buttonsStyling: false
	        }).then(function() {
	          console.log('then')
	        $.ajax({
	        headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },  
	        url: '{{ route('branches.destroyAJAX') }}',
	        method: 'POST',
	        data: data,
	        success : function(response){
	                  swal({
	                    title: 'Deleted!',
	                    text: 'Account has been deleted.',
	                    type: 'success',
	                    confirmButtonClass: "btn btn-success",
	                    buttonsStyling: false
	                  });
	                  this_table.row($(row).parents('tr')).remove().draw();
	                  console.log(response);
	                }   
	         });
	         
	      }).catch(swal.noop);
	    }
	</script>
@endpush
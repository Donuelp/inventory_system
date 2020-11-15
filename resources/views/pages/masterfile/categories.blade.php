@extends('layouts.app', ['activePage' => 'categories', 'menuParent' => 'Inventory', 'titlePage' => __('Branches')])
@section('content')
	<div class="content">
		<div class="row">
			<div class="col-lg-11 pt-5 ml-auto mr-auto">
				<button class="btn btn-simple mb-3 text-white" data-toggle="modal" data-target="#category_modal" id="add_category_modal">
				  <i class="tim-icons icon-simple-add pb-1 pr-1"></i> Add Categories
				</button>
		        <div class="card" id="card_category_table ">
		            <div class="card-header">
		               <h4 class="card-title">Category Table Information</h4>
		            </div>
		            <div class="card-body">
		                <div class="table-responsive ps">
		                  <table class="table" id="category_table">
		                     <thead class="text-primary">
		                        <tr>
		                        	<th class="text-center"> Category ID </th>
			                        <th class="text-center"> Category Name </th>
			                        <th class="text-center"> Category Description </th>
			                        <th class="text-center"> Created At </th>
			                        <th class="text-center">Inventory</th>
			                        <th class="text-center"> Actions </th>
		                        </tr>
		                     </thead>
		                      <tbody>
		                        @isset($categories)
		                        @foreach($categories as $category)
		                        <tr>
		                        	<td class="text-center"> {{ $category->id }}</td>
		                            <td class="text-center"> {{ $category->name }} </td>
		                            <td class="text-center"> {{ $category->description }} </td>
		                            <td class="text-center"> {{\Carbon\Carbon::parse($category->created_at)->format('Y')}} </td>
		                            <td class="text-center">
		                            	<button type="button" class="btn btn-simple btn-info btn-small text-white">
		                            		View Inventory
		                            	</button>
		                            </td>
		                            {{-- icon-pencil --}}
		                            <td class="text-center">
		                            	<button type="button" rel="tooltip" class="btn btn-info btn-sm btn-icon" data-original-title="Edit Details" title="" onclick="edit_category({{$category->id}}, this)"><i class="tim-icons icon-pencil"></i></button>

		                                <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon" data-original-title="Remove Branch" title="" onclick="delete_branch({{$category->id}}, this)"><i class="tim-icons icon-simple-remove"></i></button>
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

@include('pages.components.modals.masterfile_modals.add_categories') {{-- Add branches modal --}}
<style>
	#success_add, #add_button_holder, #edit_button_holder, #add_text, #save_text
	{
		display: none;
	}
</style>
@endsection
@push('js')
	<script>
		$(document).ready(function(){
			$('#category_table').DataTable({
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
		        "bInfo": false,
		        "order": [[0, "desc"]]
		    });
		});
		$('#add_category_modal').on('click', function(){
			$('#category_name').val('');
			$('#category_desc').val('');
			$('#add_button_holder').show();
			$('#add_another').show();
			$('#edit_button_holder').hide();
		});
		function createCategory()
		{
		    let form = $('#category_form')[0];
		    let data = new FormData(form);
		    
		    $.ajax({
		    url: '{{ route('categories.store') }}',
		    method: 'POST',
		    data: data,
		    processData: false,
		    contentType: false,
		    cache: false,
		    timeout: 600000,
		    beforeSend : function(){
		      $('#category_body').toggle('display');
		    },
		    success : function(response){
		                $('#category_form').each(function(){
		                    this.reset();   //form fields will be cleared.
		                });
		                $('#success_add').toggle('display');
		            }   
		     });
	  	}
	  	function toggleAddAnother()
	  	{
	  		$('#category_body').toggle('display');
      		$('#success_add').toggle('display');
	  	}
	  	function toggleModal(){
		    //If user chose to close the modal after adding new user
		    //From the modal add users or add subscription
		    $('#category_form').toggle('display');
		    $('#success_add').toggle('display');
		    $('#category_modal').modal('toggle');
		    location.reload();
		}
		function edit_category(id, row)
		{
			$.ajax({
				url: 'categories/'+id+'/edit',
				method: 'GET',
				success : function(response){
					curr_id = id;
					$('#category_modal').modal('toggle');
					$('#category_name').val(response[0]['name']);
					$('#category_desc').val(response[0]['description']);
					$('#add_button_holder').hide();
					$('#edit_button_holder').show();

				} 
			});
		}

		function save_changes(id, row)
		{
			let form = $('#category_form')[0];
		    let data = new FormData(form);
		    data.append('id', curr_id);
		    
		    $.ajax({
		    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },  
		    url: '{{ route('categories.updateAJAX') }}',
		    method: 'POST',
		    data: data,
		    processData: false,
		    contentType: false,
		    cache: false,
		    timeout: 600000,
		    beforeSend : function(){
		      $('#category_body').toggle('display');
		    },
		    success : function(response){
		    			$('#add_text').hide();
		    			$('#add_another').hide();
      					$('#save_text').show();
		                $('#category_form').each(function(){
		                    this.reset();   //form fields will be cleared.
		                });
		                $('#success_add').toggle('display');
		            }   
		     });
		}
		
	  	function delete_category(id, row)
	  	{
	      let this_table = $('#card_category_table').DataTable();

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
	        url: 'category/'+id,
	        method: 'GET',
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
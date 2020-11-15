<div class="modal fade modal-info bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="items_modal" aria-hidden="true" id="items_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	<div class="modal-header">
		    <h3 class="modal-title text-white" id="exampleModalLongTitle">Add New Item</h3>
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		      <i class="tim-icons icon-simple-remove text-white"></i>
		    </button>
		</div>
		<hr>
		<div id="item_body">
	    	<div class="modal-body">
	    		<form class="form" method="POST" enctype="multipart/form-data" id="item_form">
                  @csrf
			    	<div class="row">
			    		<div class="col-lg-6">
			    			<div class="input-group no-border form-control-lg">
			                    <div class="input-group-prepend">
			                       <div class="input-group-text">
			                          <i class="tim-icons icon-app"></i>
			                       </div>
			                    </div>
			                    <input type="text" name="item_name" id="item_name" class="form-control" required="" autocomplete="off" placeholder="Item Name">
			                </div>

			                <div class="input-group no-border form-control-lg">
				                <div class="input-group-prepend">
				                      <div class="input-group-text">
				                        <i class="tim-icons icon-align-left-2"></i>
				                      </div>
				                  </div>
			                  <textarea placeholder="Item Description" id="item_desc" name="item_desc" class="form-control"></textarea>
			               </div>
			               <div class="row">
			                	<div class="col-lg-6">
			                		<div class="input-group no-border form-control-lg">
					                    <div class="input-group-prepend">
					                       <div class="input-group-text">
					                          <i class="tim-icons icon-money-coins"></i>
					                       </div>
					                    </div>
					                    <input type="number" name="item_cost" id="item_cost" class="form-control" required="" autocomplete="off" placeholder="Item Cost">
					                </div>
			                	</div>
			                	<div class="col-lg-6">
			                		<div class="input-group no-border form-control-lg">
					                    <div class="input-group-prepend">
					                       <div class="input-group-text">
					                          <i class="tim-icons icon-tag"></i>
					                       </div>
					                    </div>
					                    <input type="number" name="item_price" id="item_price" class="form-control" required="" autocomplete="off" placeholder="Item Price">
					                </div>
			                	</div>
			                </div>
			    		</div>
			    		<div class="col-lg-6">
			    			<div class="input-group no-border form-control-lg">
			                  <select class="form-control" name="category_id" id="category_id"  title="">
			                    <option value="">{{ __('Select Category') }}</option>
			                    @isset($categories)
			                    	@foreach($categories as $category)
			                    		<option value="{{ $category->id }}">{{ $category->name }}</option>
			                    	@endforeach
			                    @endif
			                  </select>
			                </div>
			                <div class="input-group no-border form-control-lg">
			                  <select class="form-control" name="branch_id" id="branch_id"  title="">
			                    <option value="">{{ __('Select Location') }}</option>
			                    @isset($branches)
			                    	@foreach($branches as $branch)
			                    		<option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
			                    	@endforeach
			                    @endif
			                  </select>
			                </div>
			                <div class="row">
			                	<div class="col-lg-6">
			                		<div class="input-group no-border form-control-lg">
					                    <div class="input-group-prepend">
					                       <div class="input-group-text">
					                          <i class="tim-icons icon-molecule-40"></i>
					                       </div>
					                    </div>
					                    <input type="number" name="item_quantity" id="item_quantity" class="form-control" required="" autocomplete="off" placeholder="Quantity">
					                </div>
			                	</div>
			                	<div class="col-lg-6">
			                		<div class="input-group no-border form-control-lg">
					                  <select class="form-control" name="measure_id" id="measure_id" title="" >
					                    <option value="">{{ __('Unit Measure') }}</option>
					                    @isset($measurements)
						                    @foreach($measurements as $measurement) 
						                    	<option value="{{$measurement->id}}">
						                    		{{$measurement->name}}
						                    	</option>
						                    @endforeach	
					                    @endif
					                  </select>
					                </div>
			                	</div>
			                </div>
			    		</div>
			    	</div>
		    	</form>
		    	<div class="container pt-5">
                 	<div class="row">
	                    <div class="col-md-12">
	                      <div id="add_button_holder">
	                        <button id="add_item_button" class="btn btn-simple btn-neutral d-block" style="width: 100%;" onclick="createItem()">Add Item</button> 
	                      </div>
	                      <div id="edit_button_holder">
	                        <button id="edit_item_button" class="btn btn-simple btn-neutral d-block" style="width: 100%;" onclick="save_changes()">Save Changes</button>
	                      </div> 
	                    </div>
	                    <div class="col-md-12">
	                       <button class="btn btn-simple btn-neutral d-block" style="width: 100%;" data-dismiss="modal">Cancel</button>
	                    </div>
                 	</div>
              	</div>
		    </div> 
	    </div>
	    <div id="success_add">
            <div class="modal-body text-center mt-3 mb-3">
              <h1 class="text-success">
                SUCCESS
              </h1>
              <div id="add_text">
                <p class="text-default d-block text-white">
                  Successfuly Added New Item 
                </p>
              </div>
              <div id="save_text">
                <p class="text-default d-block text-white" id="save_text">
                  Saved Changes
                </p>
              </div>
           </div>
      		<div id="afterCompleteBtns" class="mb-3" style="display: flex; justify-content: center;">
	            <div class="row" style="width: 100%;">
	              <div class="col-lg-6" id="add_another">
	                <button class="btn btn-simple btn-neutral" onclick="toggleAddAnother()" style="width: 100%;">
	                  Add Another Item
	                </button>
	              </div> 
	              <div class="col-lg-6">
	                <button class="btn btn-simple btn-neutral" onclick="toggleModal()" style="width: 100%;">
	                  Close Modal
	                </button>
	              </div>
	            </div>
          	</div>
        </div>	
    </div>
  </div>
</div>
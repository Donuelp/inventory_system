<div class="modal fade modal-info" id="measurement_modal" tabindex="-1" role="dialog" aria-labelledby="measurement_modal" aria-hidden="true">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <div class="card card-login card-plain">
        <div id="measurement_body">
          <div class="modal-body">
              <fieldset id="modal_field">
                 <form class="form" method="POST" enctype="multipart/form-data" id="measurement_form">
                  @csrf
                    {{-- <input type="hidden" name="_token" value="WKMeMxwENKyC8qWcdffNRb5oNNz0MIwNvBrY7xA5">  --}}                       
                    <div class="card-content">
                        <div class="input-group no-border form-control-lg">
                            <div class="input-group-prepend">
                               <div class="input-group-text">
                                  <i class="tim-icons icon-single-02"></i>
                               </div>
                            </div>
                            <input type="text" name="measurement_name" id="measurement_name" class="form-control" required="" autocomplete="off" placeholder="Measurement Name">
                        </div>
                       <div class="input-group no-border form-control-lg">
                          <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="tim-icons icon-align-left-2"></i>
                              </div>
                          </div>
                          <textarea placeholder="Measurement Description" id="measurement_desc" name="measurement_desc" class="form-control"></textarea>
                       </div>
                    </div>
                 </form>
              </fieldset>
              <div class="container pt-5">
                 <div class="row">
                    <div class="col-md-12">
                      <div id="add_button_holder">
                        <button id="add_category_button" class="btn btn-simple btn-neutral d-block" style="width: 100%;" onclick="createMeasurement()">Add Measurement</button> 
                      </div>
                      <div id="edit_button_holder">
                        <button id="edit_category_button" class="btn btn-simple btn-neutral d-block" style="width: 100%;" onclick="save_changes()">Save Changes</button>
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
                  Successfuly Added New Measurement 
                </p>
              </div>
              <div id="save_text">
                <p class="text-default d-block text-white" id="save_text">
                  Saved Changes
                </p>
              </div>
           </div>
           <div class="modal-footer text-center">
              <div id="afterCompleteBtns">
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-12" id="add_another">
                      <button class="btn btn-simple btn-neutral btn-block mb-3" onclick="toggleAddAnother()" style="width: 100%;">
                        Add Another Measurement
                      </button>
                    </div>  
                  </div> 
                  <div class="col-md-12">
                    <button class="btn btn-simple btn-neutral btn-block" onclick="toggleModal()" style="width: 100%;">
                      Close Modal
                    </button>
                  </div>
                </div>
              </div>
           </div>
        </div>  
      </div>
    </div>
  </div>
</div>


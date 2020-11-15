<div class="modal fade modal-info" id="users_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <div class="card card-login card-plain">
        {{-- Checks if user is admin or superadmin --}}
        @if(Auth::user()->role_id == 1)
          <div id="form_body">
            <div class="modal-body">
              <fieldset id="modal_field">
                <form class="form" method="POST" enctype="multipart/form-data" id="add_user_form">
                  @csrf
                  <div class="card-content">
                    <div class="fileinput fileinput-new" data-provides="fileinput" style="width: 100%;">
                      <div class="img-container d-flex justify-content-center" style="width: 100%;">
                        <div class="fileinput-new thumbnail img-circle" style="width: 100%;">
                          <img src="{{ asset('black') }}/img/placeholder.jpg" alt="...">
                        </div>
                      </div>
                      <div class="img-container d-flex justify-content-center" style="width: 100%;">
                        <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                      </div>
                      <div>
                        <span class="btn btn-file btn-simple " style="width: 100%;">
                          <span class="fileinput-new" style="width: 100%;">{{ __('Select image') }}</span>
                          <span class="fileinput-exists" style="width: 100%;">{{ __('Change') }}</span>
                          <input type="file" name="photo" id = "input-picture" />
                        </span>
                          <a href="#pablo" class="btn btn-danger btn-simple fileinput-exists" data-dismiss="fileinput" style="width: 100%;"><i class="fa fa-times"></i> {{ __('Remove') }}</a>
                      </div>
                      @include('alerts.feedback', ['field' => 'photo'])
                    </div>
                    <div class="input-group no-border form-control-lg">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="tim-icons icon-single-02"></i>
                        </div>
                      </div>
                        <input type="text" name="name" class="form-control" autocomplete="off" required="" placeholder="Full name" >
                    </div>

                    <div class="input-group no-border form-control-lg">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="tim-icons icon-email-85"></i>
                        </div>
                      </div>
                        <input type="text" name="email" class="form-control" autocomplete="off" required="" placeholder="Email Address">
                    </div>

                    <div class="input-group no-border form-control-lg">
                      <select class="form-control" name="role_id"  title="" >
                        <option value="">{{ __('Select Role Level') }}</option>
                        @foreach($roles as $role)
                        <option value="{{$role['id']}}">{{$role['name']}}</option>
                        @endforeach
                      </select>
                    </div>

                   {{--  <div class="input-group no-border form-control-lg" id="sub_level_container">
                      <select class="form-control" name="sub_level"  title="" >
                        <option value="">{{ __('Select Subscription Level') }}</option>
                        @isset($subs)
                          @foreach($subs as $sub)
                            <option value="{{$sub->id}}">{{$sub->name}}</option>
                          @endforeach
                        @endif
                      </select>
                    </div> --}}

                    <div class="input-group no-border form-control-lg">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="tim-icons icon-key-25"></i>
                        </div>
                      </div>
                        <input type="text" name="password" required=""  placeholder="Default Password" class="form-control text-white" value="default_pass">
                    </div>
                  </div>
                </form>
              </fieldset>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <button class="btn btn-simple btn-default d-block" style="width: 100%;" onclick="create_users()">Add User</button>
                </div>
                <div class="col-md-6">
                  <button class="btn btn-simple btn-default d-block" style="width: 100%;" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>
          <div id="success_add">
             <div class="modal-body text-center mt-3 mb-3">
                <h1 class="text-success">
                  SUCCESS
                </h1>
                 <p class="text-default d-block">Successfuly Added User Account</p>
             </div>
             <div class="modal-footer text-center">
                <div id="afterCompleteBtns">
                  <div class="row">
                    <div class="col-md-12">
                      <button class="btn btn-simple btn-block mb-3" onclick="toggleAddAnother('form_body', 'success_add')" style="width: 100%;">
                        Add Another User
                      </button>
                    </div> 
                    <div class="col-md-12">
                      <button class="btn btn-simple btn-block" onclick="toggleModal('form_body','success_add','users_modal')" style="width: 100%;">
                        Close Modal
                      </button>
                    </div>
                  </div>
                </div>
             </div>
          </div>  
        @else
          <div id="no-access" class="d-flex justify-content-center align-items-center" style="height: 100%;">
              <h1>FORBIDDEN ACCESS</h1>
          </div>
        @endif   
      </div>
    </div>
  </div>
</div>
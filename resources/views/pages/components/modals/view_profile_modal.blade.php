<div class="modal fade modal-info bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="profile_modal">
   <div class="modal-dialog modal-lg">
      <div class="modal-content ">
         <div class="container">
            <div class="row" style="min-height: 300px">
               <div class="col-md-3">
                  <div class="row bg-default" style="height: 100%;">
                     <div class="col-md-12" style="height: 100%;">
                        <div class="pills-container d-flex justify-content-center align-items-center" style="height: 100%; width: 100%;">
                           <ul class="nav nav-pills nav-pills-info nav-pills-icons flex-column">
                              <li class="nav-item">
                                 <a class="nav-link active show" data-toggle="tab" href="#link4">
                                 <i class="tim-icons icon-badge"></i> Profile
                                 </a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" data-toggle="tab" href="#link5">
                                 <i class="tim-icons icon-settings"></i> Settings
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-9">
                  <div class="tab-content pt-3">
                     <div class="tab-pane active show" id="link4">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="group pt-3">
                                 <h4 class="text-white text-bold text-center">
                                    NAME
                                    <span class="d-block text-default text-center"><small id="profile_name"></small></span>
                                 </h4>
                              </div>
                              <div class="group pt-2">
                                 <h4 class="text-white text-bold text-center">
                                    EMAIL ADDRESS
                                    <span class="d-block text-default text-center"><small id="profile_email"></small></span>
                                 </h4>
                              </div>
                              <div class="group pt-2">
                                 <h4 class="text-white text-bold text-center">
                                    JOIN DATE
                                    <span class="d-block text-default text-center"><small id="profile_date"></small></span>
                                 </h4>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="author d-flex flex-column align-items-center justify-content-center" style="width: 100%; height: 100%;">
                                 <img class="avatar" src="{{asset('black/img/avatar.png')}}" style="width: 100px; height: 100px;">
                                 <h5 class="title pt-2" id="profile_role"></h5>
                              </div>
                           </div>
                        </div>
                        <div class="row" >
                           <div class="col-md-12 pb-2">
                              <button class="btn btn-neutral" style="width: 100%;" data-dismiss="modal">CLOSE MODAL</button>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane" id="link5">
                        {{-- @if(auth()->user()->role_id == 4 || auth()->user()->role_id == 1)
                        <div class="input-group no-border form-control-lg">
                           <select class="form-control" name="profile_role_id" id="profile_role_id" title="" >
                              <option disabled>──────────</option>
                              <option value="1">{{ __('Admin') }}</option>
                              <option value="2" selected="">{{ __('Support / Staff') }}</option>
                              <option value="3">{{ __('Member') }}</option>
                           </select>
                        </div>
                        @endif --}}
                        {{-- <div class="input-group no-border form-control-lg">
                           <select class="form-control" name="profile_sub_level"  title="" id="profile_sub_level">
                              <option disabled>──────────</option>
                              @isset($subs)
	                              @foreach($subs as $sub)
	                              	<option value="{{$sub->id}}">{{$sub->name}}</option>
	                              @endforeach
                              @endif
                           </select>
                        </div> --}}
                        <div class="row" style="width: 100%; position: absolute; bottom: 10;">
                           <div class="col-md-6">
                              <button class="btn btn-neutral" style="width: 100%;" id="profile_changes" onclick="upgrade_user('{{auth()->user()->role_id}}')">SAVE CHANGES</button>
                           </div>
                           <div class="col-md-6">
                              <button class="btn btn-neutral" style="width: 100%;" data-dismiss="modal">CLOSE MODAL</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>   
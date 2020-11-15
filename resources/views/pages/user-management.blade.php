@extends('layouts.app', ['activePage' => 'manage_users', 'menuParent' => 'manage_users', 'titlePage' => __('Dashboard')])
@section('content')
  <div class="content">
    <button class="btn btn-simple mb-3 text-white" data-toggle="modal" data-target="#users_modal">
      <i class="tim-icons icon-single-02 pb-1 pr-1"></i> Add Users
    </button>

    <div class="row">
      <div class="col-lg-6">
         <div class="card" id="card_admin_table">
            <div class="card-header">
               <h4 class="card-title">Admin Table Information</h4>
            </div>
            <div class="card-body">
               <div class="table-responsive ps">
                  <table class="table" id="admin_table">
                     <thead class="text-primary">
                        <tr>
                           <th> Name </th>
                           <th> Role </th>
                           <th class="text-center"> Since </th>
                           <th class="text-right"> Actions </th>
                        </tr>
                     </thead>
                     <tbody>
                        @isset($admins)
                        @foreach($admins as $admin)
                        <tr>
                           <td> {{$admin->name}} </td>
                           <td> Admin </td>
                           <td class="text-center"> {{\Carbon\Carbon::parse($admin->created_at)->format('Y')}} </td>
                           <td class="text-right">
                              <button type="button" rel="tooltip" class="btn btn-info btn-sm btn-icon" data-original-title="View Profile" title="" onclick="view_profile({{$admin->id}})"><i class="tim-icons icon-single-02"></i></button>
                              <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon" data-original-title="Remove Account" title="" onclick="delete_user({{$admin->id}}, this, 'admin_table')"><i class="tim-icons icon-simple-remove"></i></button>
                           </td>
                        </tr>
                        @endforeach
                        @endif      
                     </tbody>
                  </table>
                  <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                     <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                  </div>
                  <div class="ps__rail-y" style="top: 0px; right: 0px;">
                     <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-lg-6">
         <div class="card" id="card_employee_table">
            <div class="card-header">
               <h4 class="card-title">Employee Table Information</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive ps">
                  <table class="table" id="employee_table">
                     <thead class="text-primary">
                        <tr>
                           <th> Name </th>
                           <th> Role </th>
                           <th class="text-center"> Since </th>
                           <th class="text-right"> Actions </th>
                        </tr>
                     </thead>
                      <tbody>
                        @isset($members)
                        @foreach($members as $member)
                        <tr>
                           <td> {{$member->name}} </td>
                           <td> Admin </td>
                           <td class="text-center"> {{\Carbon\Carbon::parse($member->created_at)->format('Y')}} </td>
                           <td class="text-right">
                              <button type="button" rel="tooltip" class="btn btn-info btn-sm btn-icon" data-original-title="View Profile" title="" onclick="view_profile({{$member->id}})"><i class="tim-icons icon-single-02"></i></button>
                              <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon" data-original-title="Remove Account" title="" onclick="delete_user({{$member->id}}, this, 'admin_table')"><i class="tim-icons icon-simple-remove"></i></button>
                           </td>
                        </tr>
                        @endforeach
                        @endif      
                      </tbody>
                  </table>
                  <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                     <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
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
  @include('pages.components.modals.user_modals') {{-- Add user modal --}}
  @include('pages.components.modals.view_profile_modal') {{-- Add view profile modal --}}

@endsection
<style>
  #success_add{
    display: none;
    transition: .5s;
    transition-timing-function: ease-in;
  }
  #success_add_sub{
    display: none;
    transition: .5s;
    transition-timing-function: ease-in;
  }
</style>
@push('js')
  <script>
    $(document).ready(function(){
      $('#admin_table').DataTable({

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
      });

      $('#employee_table').DataTable({

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
      });

    });
    function view_profile(id)
    {
      $.ajax({
      url: '{{ url('user/get_user') }}/'+id,
      method: 'GET',
      data: id,
      success : function(response){
                  data = JSON.parse(response);
                  
                  $('#profile_name').html(data['name']);
                  $('#profile_email').html(data['email']);
                  $('#profile_date').html(data['date']);
                  $('#profile_role').html(data['role']);
                  $('#profile_modal').modal('show');
              }   
       });
    }
    function create_users(){
      let form = $('#add_user_form')[0];
      let data = new FormData(form);

      //calls function store from UserController   
      $.ajax({
        url: '{{ route('user.store') }}',
        method: 'POST',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        beforeSend : function(){
          $('#form_body').toggle('display');
        },
        success : function(response){
          $('#add_user_form').each(function(){
              this.reset();   //form fields will be cleared.
          });
          $('#success_add').toggle('display');
          console.log(response);
        }   
      });
    }
    function delete_user(id, row, table){
      let this_table = $('#'+table).DataTable();
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
        url: '{{ route('user.destroyAJAX') }}',
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
                }   
         });
         
      }).catch(swal.noop);
    }
    function toggleModal(formName, successForm, modalName){
      //If user chose to close the modal after adding new user
      //From the modal add users or add subscription
      $('#'+formName).toggle('display');
      $('#'+successForm).toggle('display');
      $('#'+modalName).modal('toggle');
      location.reload();
    }
    function toggleAddAnother(formName, successForm){
      //If user chose to add another user
      //From the modal add users or add subscription
      $('#'+formName).toggle('display');
      $('#'+successForm).toggle('display');
    }
  </script>
@endpush


@extends('welcome')
@section('content')
    <div class="container">
      <select class="form-select w-50 mb-5 d-inline-block" id="companies" aria-label="Default select example" required>
        <option disabled value="" selected>Select Company</option>
        @if($companies)
        @foreach ($companies as $company )
        <option value={{$company->id}}>{{$company->name}}</option>
        @endforeach
        @endif
      </select>
      <button type="button" class="btn btn-primary mb-5  float-right" data-toggle="modal" data-target="#Create">
        Create Employee
      </button>
      <div class="modal fade" id="Create" tabindex="-1" role="dialog" aria-labelledby="CreateLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="CreateLabel">Create Employee</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="form" enctype="multipart/form-data" method="post" action="{{ route('employee.store') }}" >
              @csrf
            <div class="modal-body">
                    <div class="form-group">
                      <label for="Name">Name</label>
                      <input type="text" class="form-control" name="name" id="Name"placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                      <label for="email">email</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                      <label for="password">password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                    </div>
                    <div class="form-group">
                      <label for="company_id">Select Company</label>
                      <select class="form-select" name="company_id" id="company_id"aria-label="Default select example" required>
                        <option disabled value="" selected>Select Company</option>
                        @if($companies)
                        @foreach ($companies as $company )
                        <option value={{$company->id}}>{{$company->name}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required/>
                      </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>
    <script type="text/javascript">
      var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url : "/filter",
          type : "GET",
          data : function ( d ) {
              d.company_id  = $('#companies').find(":selected").val();
              d._token = "{{csrf_token()}}"
          }
        },
          columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'company', name: 'company'},
            {data: 'image', name: 'image'},
          ]
        });
    
 $("#companies").change(function(){
  table.draw()
});
     </script>
@endsection
@extends('welcome')
@section('content')
    <div class="container">
        @if ($errors->any())
    <div class="alert alert-danger" id="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <button type="button" class="btn btn-primary mb-5  float-right" data-toggle="modal" data-target="#Create">
            Create
          </button>
          <div class="modal fade" id="Create" tabindex="-1" role="dialog" aria-labelledby="CreateLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="CreateLabel">Create</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form id="form" enctype="multipart/form-data" method="post" action="{{ route('company.store') }}" >
                <div class="modal-body">
                        @csrf
                        <div class="form-group">
                          <label for="Name">Name</label>
                          <input type="text" class="form-control" name="name" id="Name"placeholder="Enter Company Name" required>
                        </div>
                        <div class="form-group">
                          <label for="address">Address</label>
                          <input type="text" class="form-control" name="address" id="address" placeholder="Enter Company Address" required>
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" class="@error('logo') is-invalid @enderror form-control" id="logo" name="logo" accept="image/*" required/>
                            @error('logo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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
                    <th>Adress</th>
                    <th>created At</th>
                    <th>Logo</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
       setTimeout(function() {
         $('#alert').fadeOut('fast');
        }, 3000);
        $(function () {   
          var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('company.index') }}",
              columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'address', name: 'address'},
                  {data: 'created_at', name: 'created_at'},
                  {data: 'logo', name: 'logo'},
              ]
          });
          
        });
      </script>
@endsection
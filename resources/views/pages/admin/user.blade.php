@extends('layout.master')

@push('plugin-styles')
  <!-- Plugin css import here -->
@endpush

@section('content')

    <section id="input-style">
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800"></h1>

            <!-- Page Heading -->
            <div class="button">
                <button id="add" class="btn btn-primary">ADD User</button> &nbsp;
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> User  </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>name </th>
                                <th>email</th>
                                <th>password</th>
                                <th>operation</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--add -->


                <div class="modal fade text-left" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    {{-- @endif --}}
                    <div class="modal-dialog  modal-xs" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Add</h6>
                    <button aria-label="Close" type="reset"  data-dismiss="modal">x</button>
                </div>
                <form action="{{ route('users.store') }}" method="POST" id="addForm">
                    <input type="hidden" name="_id" id="_id" >

                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label>name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <div class="form-group">
                            <label>email</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label>password</label>
                            <input type="text" class="form-control" id="password" name="password">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="addBtn">Save</button>
                        <button type="reset"  data-dismiss="modal" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('plugin-scripts')
  <!-- Plugin js import here -->
@endpush

@push('custom-scripts')

    <script type="text/javascript">

            $(function () {

            $("#add").click(function () {
            $('#_id').val('');
            $("#addForm").trigger("reset");
            $("#addModal").modal('show');

            });

            var table = $('#dataTable').DataTable({
            destroy: true,
            processing: true,

            serverSide: true,
            stateSave: true,

            ajax: "{{route('users.index')}}",

            columns: [

            {data: 'DT_RowIndex', name: 'id'},

            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'password_hint', name: 'password_hint'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

            });


            $("#addBtn").click(function (e) {
            e.preventDefault();

            $("#addBtn").html('<i class="fa fa-load"></i> ... ');
            $("#addBtn").attr('disabled',true);
            addNewRow("{{route('users.store')}}", table);
            $("#addBtn").html('<i>Save</i> ');
            }); // end add new question


            $('body').on('click', '.edit', function () {

            $("#addModal").modal('show');

            var id = $(this).data('id');

            $.get("{{ route('users.index') }}" + '/' + id + '/edit', function (data) {

            $('#_id').val(data.id);

            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#password').val(data.password);

            })

            }) ;// end edit function;


            //soft delete
            $('body').on('click', '.delete', function () {

            var id = $(this).data("id");
            var token = '{{csrf_token()}}';
            deleteRow("{{ route('users.index')}}"+"/"+  id, table, token);

            });


            });

   </script>
@endpush

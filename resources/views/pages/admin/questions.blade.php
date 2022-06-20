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
                <button id="add" class="btn btn-primary">ADD</button> &nbsp;
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Quiz  </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>question </th>
                                <th>a</th>
                                <th>b</th>
                                <th> c </th>
                                <th> d </th>
                                <th> answer </th>
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
                <form action="{{ route('questions.store') }}" method="POST" id="addForm">
                    <input type="hidden" name="_id" id="_id" >

                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label>question</label>
                            <input type="text" class="form-control" id="question" name="question">
                        </div>

                        <div class="form-group">
                            <label>A</label>
                            <input type="text" class="form-control" id="opt1" name="opt1">
                        </div>
                        <div class="form-group">
                            <label>B</label>
                            <input type="text" class="form-control" id="opt2" name="opt2">
                        </div>
                        <div class="form-group">
                            <label>C</label>
                            <input type="text" class="form-control" id="opt3" name="opt3">
                        </div>
                        <div class="form-group">
                            <label>D</label>
                            <input type="text" class="form-control" id="opt4" name="opt4">
                        </div>
                        <div class="form-group">
                            <label for="roundText">answer</label>
                            <select name="answer" id="answer" class="form-control SlectBox">

                                <option value="opt1"> a</option>
                                <option value="opt2">b</option>
                                <option value="opt3">c</option>
                                <option value="opt4">d</option>
                            </select>
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

            ajax: "{{route('questions.index')}}",

            columns: [

            {data: 'DT_RowIndex', name: 'id'},

            {data: 'question', name: 'question'},
            {data: 'opt1', name: 'opt1'},
            {data: 'opt2', name: 'opt2'},
            {data: 'opt3', name: 'opt3'},
            {data: 'opt4', name: 'opt4'},
            {data: 'answer', name: 'answer'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

            });


            $("#addBtn").click(function (e) {
            e.preventDefault();

            $("#addBtn").html('<i class="fa fa-load"></i> ... ');
            $("#addBtn").attr('disabled',true);
            addNewRow("{{route('questions.store')}}", table);
            $("#addBtn").html('<i class="btn btn-primary">Save</i> ');

            }); // end add new question


            $('body').on('click', '.edit', function () {

            $("#addModal").modal('show');

            var id = $(this).data('id');

            $.get("{{ route('questions.index') }}" + '/' + id + '/edit', function (data) {

            $('#_id').val(data.id);

            $('#question').val(data.question);
            $('#opt1').val(data.opt1);
            $('#opt2').val(data.opt2);
            $('#opt3').val(data.opt3);
            $('#opt4').val(data.opt4);
            $('#answer').val(data.answer);

            })

            }) ;// end edit function;


            //soft delete
            $('body').on('click', '.delete', function () {

            var id = $(this).data("id");
            var token = '{{csrf_token()}}';
            deleteRow("{{ route('questions.index')}}"+"/"+  id, table, token);

            });


            });

   </script>
@endpush

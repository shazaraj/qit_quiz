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

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Quiz Result </h6>
                </div><div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">

                <div class="d-flex align-items-center flex-wrap text-nowrap" style="margin: 15px;">
                    <div  class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                        <a  href="{{ url('export_excel') }}" style="color: #ffffff"> Download Excel File</a>
                    </div>
                </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>user </th>
                                <th>wrong answer</th>
                                <th>correct answer</th>
                                <th>result</th>
                                <th>operation</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

            ajax: "{{route('results.index')}}",

            columns: [

            {data: 'DT_RowIndex', name: 'id'},

            {data: 'name', name: 'name'},
            {data: 'wrong_ans', name: 'wrong_ans'},
            {data: 'correct_ans', name: 'correct_ans'},
            {data: 'result', name: 'result'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

            });

            //soft delete
            $('body').on('click', '.delete', function () {

            var id = $(this).data("id");
            var token = '{{csrf_token()}}';
            deleteRow("{{ route('results.index')}}"+"/"+  id, table, token);

            });


            });

   </script>
@endpush

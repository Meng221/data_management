@extends('layout')

@section('title')
    ຍ້ອມຮັບ
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ຍອມຮັບການແກ້ໄຂ</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        {{-- <th class="col-1">#</th> --}}
                        <th class="col-1">ກຸ່ມ</th>
                        <th class="col-5">ຫົວຂໍ້ບົດຈົບຊັ້ນ</th>
                        <th>ລືີ້ງປື້ມ(ສະບັບແກ້ໄຂ)</th>
                        <th>Accept / Reject</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($thesisTopics as $topic)
                        @foreach ($topic->edits as $edit)
                            @if ($edit->accept != 1)
                                <tr>
                                    <td>{{ $topic->studentGroup->group_number }}</td>
                                    <td>{{ $topic->topic_name }}</td>
                                    <td>
                                        @if ($topic->edits->isNotEmpty())
                                            <a href="{{ asset('storage/' . $edit->file_path) }}" target="_blank">
                                                View Edit
                                            </a><br>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('change', $edit->id) }}" class="btn btn-success"><i
                                            class="bi bi-check-lg text-light"></i></a>
                                        {{-- <a href="{{ route('change', $edit->id) }}" class="btn btn-danger"><i class="bi bi-x-lg"></i></a> --}}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@section('head-link')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('page-script')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection

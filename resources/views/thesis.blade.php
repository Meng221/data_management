@extends('layout')

@section('title')
    ປື້ມບົດຈົບຊັ້ນ
@endsection

@section('head-link')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ປື້ມບົດຈົບຊັ້ນ</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        {{-- <th class="col-1">#</th> --}}
                        <th class="col-1">ກຸ່ມ</th>
                        <th class="col-5">ຫົວຂໍ້ບົດຈົບຊັ້ນ</th>
                        <th>ລືີ້ງປື້ມ</th>
                        <th>ລືີ້ງປື້ມ(ສະບັບແກ້ໄຂ)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $rank = 1;
                    @endphp
                    @foreach ($thesisTopics as $topic)
                        <tr>
                            {{-- <td>{{ $rank++ }}</td> --}}
                            <td>{{ $topic->studentGroup->group_number }}</td>
                            <td>{{ $topic->topic_name }}</td>
                            <td>
                                @if ($topic->book)
                                    @php
                                        $bookFilePath = $topic->book->book_file;
                                        $bookFileName = pathinfo($bookFilePath, PATHINFO_FILENAME);
                                        $bookFileExtension = pathinfo($bookFilePath, PATHINFO_EXTENSION);
                                        $bookFileNameWithoutTimestamp =
                                            preg_replace('/^\d+_/', '', $bookFileName) . '.' . $bookFileExtension;
                                    @endphp
                                    <a href="{{ asset('storage/' . $topic->book->book_file) }}"
                                        target="_blank">{{ $bookFileNameWithoutTimestamp }}</a>
                                @else
                                    No PDF available
                                @endif
                            </td>
                            <td>
                                @if ($topic->edits->isNotEmpty())
                                    @foreach ($topic->edits as $edit)
                                        @php
                                            $bookFilePath = $edit->thesis_edit_file;
                                            $bookFileName = pathinfo($bookFilePath, PATHINFO_FILENAME);
                                            $bookFileExtension = pathinfo($bookFilePath, PATHINFO_EXTENSION);
                                            $bookFileNameWithoutTimestamp =
                                                preg_replace('/^\d+_/', '', $bookFileName) . '.' . $bookFileExtension;
                                        @endphp
                                        <a href="{{ asset('storage/' . $edit->thesis_edit_file) }}" target="_blank">
                                            {{ $bookFileNameWithoutTimestamp }}
                                            @if ($edit->accept == 1)
                                                <i class="bi bi-check-circle-fill text-success"></i>
                                            @endif
                                        </a><br>
                                    @endforeach
                                @else
                                    <span>ຍັງບໍ່ໄດ້ສົ່ງສະບັບແກ້ໄຂ</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
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
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]s
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection

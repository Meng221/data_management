@extends('layout')

@section('title')
    ຍ້ອມຮັບ
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ລາຍງານຄະແນນສອບບົດຈົບຊັ້ນ</h3>
        </div>
        <div class="card-body" style="overflow-x: auto">
            <table id="example1" class="table table-bordered table-striped" style="width: 160%">
                <thead>
                    <tr>
                        <th class="col-1">ກຸ່ມ</th>
                        <th>ຫົວຂໍ້ບົດຈົບຊັ້ນ</th>
                        <th>ຊື່ນັກສຶກສາ</th>
                        <th>ເນື້ອໃນບົດທີ 4</th>
                        <th>ເນື້ອໃນບົດທີ 5</th>
                        <th>ຄ/ບຂອງເອກະສານ</th>
                        <th>Poster</th>
                        <th>ຄ/ບຂອງຊື້ນງານ</th>
                        <th>ຄະແນນນໍາສະເໜີ</th>
                        <th>ຄະແນນຕອບຄໍາຖາມ</th>
                        <th>ຄະແນນລວມ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($thesisTopics as $topic)
                        @foreach ($topic->studentGroup->students as $student)
                            @php
                                $score = $topic->scoreAndComments->where('student_id', $student->id)->first();
                            @endphp
                            @if ($score)
                                <tr>
                                    <td>{{ $topic->studentGroup->group_number }}</td>
                                    <td>{{ $topic->topic_name }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $score->lesson_4 }}</td>
                                    <td>{{ $score->lesson_5 }}</td>
                                    <td>{{ $score->thesis }}</td>
                                    <td>{{ $score->poster }}</td>
                                    <td>{{ $score->project }}</td>
                                    <td>{{ $score->q_and_a }}</td>
                                    <td>{{ $score->presentation }}</td>
                                    <td>{{ $score->average }}</td>
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
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection

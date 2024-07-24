@extends('layout')

@section('title')
    Allow sending thesis
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ລາຍການຂໍອະນຸຍາດຂໍສົ່ງປື້ມ</h3>
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
                        <th>ອະນຸຍາດ / ບໍ່ອະນຸຍາດ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($thesisTopics as $thesis)
                        @if ($thesis->book->verified == 0)
                        <tr>
                            <td>{{ $thesis->studentGroup->group_number }}</td>
                            <td>{{ $thesis->topic_name }}</td>
                            <td>
                                3
                            </td>
                            <td>
                                <a href="{{ route('allow-thesis', $thesis->book->id) }}">
                                    <i class="bi bi-check-lg btn-sm btn-success"></i>
                                </a>
                                <a href="#">
                                    <i class="bi bi-x-lg btn-sm btn-danger"></i>
                                </a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

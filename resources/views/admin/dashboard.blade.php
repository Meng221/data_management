@extends('admin.adminlayout');

@section('title')
    ໜ້າທໍາອິດ
@endsection

@section('content')
    <div class="container-fluid">
        <h5 class="mb-2">Info</h5>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif --}}
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 col-12 ">
                <div class="info-box" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#AvisorReModal">
                    <span class="info-box-icon bg-info"><i class="bi bi-person-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">ຂໍ້ມູນບົດຈົບຊັ້ນ</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            @if (auth()->check())
                @if (auth()->user()->user_type === 'teacher')
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box " style="cursor: pointer" data-bs-toggle="modal"
                            data-bs-target="#SentThesisModal">
                            <span class="info-box-icon bg-success"><i class="bi bi-journal-arrow-up"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">ສົ່ງປື້ມບົດຈົບຊັ້ນ</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                @endif
            @endif
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#SentEditModal">
                    <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">ສົ່ງປື້ມທີ່ແກ້ໄຂແລ້ວ<br>(ຫຼັງປ້ອງກັນແລ້ວ)</span>

                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            @if (auth()->check())
                @if (auth()->user()->user_type === 'teacher')
                    <div class="col-md-3 col-sm-6 col-12">
                        <a class="info-box" style="cursor: pointer" href="{{ route('scoreAndComment') }}">
                            <span class="info-box-icon bg-danger"><i class="far fa-flag"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">ໃຫ້ຄະແນນ ແລະ ຄວາມ<br>ເຫັນກຸ່ມບົດຈົບຊັ້ນ</span>
                                {{-- <span class="info-box-number"></span> --}}
                            </div>
                            <!-- /.info-box-content -->
                        </a>
                        <!-- /.info-box -->
                    </div>
                @endif
            @endif
        </div>



        <div class="d-flex gap-3">
            <div class="card col-lg-8">
                <div class=" modal-header">
                    <h3 class="card-title">ຈໍານວນກຸ່ມໃນແຕ່ລະປະເພດ</h3>
                    @if (auth()->check())
                        @if (auth()->user()->user_type === 'teacher')
                            <div>
                                <a href="" class="btn btn-light w-100" data-bs-toggle="modal"
                                    data-bs-target="#addTypeModal"><i class="bi bi-plus"></i></a>
                            </div>
                        @endif
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>ປະເພດບົດ</th>
                                <th>ສົ່ງປື້ມແລ້ວ</th>
                                <th>ຍັງບໍ່ສົ່ງ</th>
                                <th style="width: 150px">ຈ/ນທັງໝົດ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>Database</td>
                                <td><span class="badge text-success fs-6">{{ $topicsWithDatabaseAndBookId }}</span></td>
                                <td><span class="badge text-danger fs-6">{{ $topicsWithDatabaseAndNullBookId }}</span></td>
                                <td><span class="badge text-warning fs-6">{{ $count }}</span></td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Network</td>
                                <td><span class="badge text-success fs-6">{{ $topicsWithNetworkAndBookId }}</span></td>
                                <td><span class="badge text-danger fs-6">{{ $topicsWithNetAndNullBookId }}</span></td>
                                <td><span class="badge text-warning fs-6">{{ $netcount }}</span></td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>IOT</td>
                                <td><span class="badge text-success fs-6">{{ $topicsWithIOTAndBookId }}</span></td>
                                <td><span class="badge text-danger fs-6">{{ $topicsWithIOTAndNullBookId }}</span></td>
                                <td><span class="badge text-warning fs-6">{{ $iotcount }}</span></td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Animation</td>
                                <td><span class="badge text-success fs-6">{{ $topicsWithAnimeAndBookId }}</span></td>
                                <td><span class="badge text-danger fs-6">{{ $topicsWithAnimeAndNullBookId }}</span></td>
                                <td><span class="badge text-warning fs-6">{{ $animecount }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>

            <div class="w-100">
                <div class="d-flex gap-3">
                    <!-- small card -->
                    <div class="small-box bg-white p-2" style="width: 100%">
                        <div class="inner">
                            <h3>{{ $topicsWithBookId }}</h3>

                            <p>ກຸ່ມທີ່ສົ່ງປື້ມ</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-check text-success"></i>
                        </div>
                    </div>
                    <div class="small-box bg-white p-2" style="width: 100%">
                        <div class="inner">
                            <h3>{{ $topicsNull }}</h3>

                            <p>ກຸ່ມຍັງບໍ່ສົ່ງປື້ມ</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-xmark text-danger"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <!-- small card -->
                    <div class="small-box bg-white p-3 mb-1">
                        <div class="inner">
                            <h3>{{ $topics }}</h3>
                            <p>ກຸ່ມທັງໝົດ</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-user-group"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="card-title text-center">ເພີ່ມປະເພດບົດ</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form action="{{ route('admin.addtype') }}" method="POST">
                            @csrf
                            <div class="row mb-4">
                                <label for="typename-input" class="col-sm-3 col-form-label">ຊື່ປະເພດ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="typename-input" name="typename"
                                        required>
                                </div>
                            </div><!-- end row -->
                            <div class="row justify-content-end">
                                <div class="col-sm-9">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary w-md px-4">ເພີ່ມ</button>
                                        <button type="button" class="btn btn-danger w-md" data-bs-dismiss="modal"
                                            aria-label="Close">ຍົກເລິກ</button>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </form><!-- end form -->
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="giveScoreModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="card-title text-center">ໃບໃຫ້ຄະແນນ ແລະ ຄໍາເຫັນກຸ່ມ</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form>
                            <div class="row mb-4">
                                <label for="fullname-input" class="col-sm-3 col-form-label">ເລກກຸ່ມ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="horizontal-firstname-input"
                                        name="groupnumber">
                                </div>
                            </div><!-- end row -->
                            <div class="row mb-4">
                                <label for="fullname-input" class="col-sm-3 col-form-label">ຊື່ຫົວຂໍ້</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="horizontal-firstname-input"
                                        name="topic">
                                </div>
                            </div><!-- end row -->
                            <div class="row mb-4">
                                <label for="image-input" class="col-sm-3 col-form-label">ກໍາມະການ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="committee">
                                </div>
                            </div><!-- end row -->
                            <div class="row mb-4">
                                <label for="email-input" class="col-sm-3 col-form-label">ຄໍາເຫັນກ</label>
                                <div class="col-sm-9">
                                    <textarea name="article" id="" cols="30" rows="10" class="form-control" name="description"></textarea>
                                </div>
                            </div><!-- end row -->


                            <div class="row justify-content-end">
                                <div class="col-sm-9">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary w-md px-4">ສົ່ງ</button>
                                        <button type="button" class="btn btn-danger w-md" data-bs-dismiss="modal"
                                            aria-label="Close">ຍົກເລິກ</button>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </form><!-- end form -->
                    </div>
                </div>
            </div>
        </div>

        {{-- this form for create sent edit thesis --}}
        <div class="modal fade" id="SentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between bg-primary">
                        <h4 class="card-title text-center">ຂໍ້ມູນການແກ້ໄຂບົດຈົບຊັ້ນ</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form action="{{ route('sent-thesis-edit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4">
                                <label for="fullname-input" class="col-sm-3 col-form-label">ເລກກຸ່ມ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="group_number">
                                </div>
                            </div><!-- end row -->
                            <div class="row mb-4">
                                <label for="fullname-input" class="col-sm-3 col-form-label">ຊື່ຫົວຂໍ້</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="horizontal-firstname-input"
                                        name="topic">
                                </div>
                            </div><!-- end row -->

                            <div class="row mb-4">
                                <label for="email-input" class="col-sm-3 col-form-label">ໄຟລ໌</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="horizontal-firstname-input"
                                        name="file">
                                </div>
                            </div><!-- end row -->


                            <div class="row justify-content-end">
                                <div class="col-sm-9">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary w-md px-4">ສົ່ງ</button>
                                        <button type="button" class="btn btn-danger w-md" data-bs-dismiss="modal"
                                            aria-label="Close">ຍົກເລິກ</button>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </form><!-- end form -->

                    </div><!-- end cardbody -->
                </div>
            </div>
        </div>


        {{-- Send Thesis modal --}}
        <div class="modal fade" id="SentThesisModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="card-title text-center">ສົ່ງປື້ມບົດຈົບຊັ້ນ</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form action="{{ route('sent-thesis') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4">
                                <label for="advisor-input" class="col-sm-3 col-form-label">ອາຈານທີ່ປຶກສາ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="advisor" required>
                                </div>
                            </div><!-- end row -->

                            <div class="row mb-4">
                                <label for="email-input" class="col-sm-3 col-form-label">ອີເມລ</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="InputEmail1"
                                        aria-describedby="emailHelp" name="email" required>
                                </div>
                            </div><!-- end row -->
                            <h5>ຂໍ້ມູນກຸ່ມ</h5>
                            <div class="row mb-4 border mx-1 py-3 me-0 rounded">
                                <div class="row mb-4 mx-0">
                                    <label for="groupNumber" class="col-sm-3 col-form-label">ເລກກຸ່ມ</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="group_number" required>
                                    </div>
                                </div>
                                <div class="row mb-4 mx-0">
                                    <label for="thesistopic" class="col-sm-3 col-form-label">ຊື່ຫົວຂໍ້</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="thesis_topic" required>
                                    </div>
                                </div>
                                <div class="row mb-4 mx-0">
                                    <label for="thesis_file" class="col-sm-3 col-form-label">ໄຟລ໌</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" name="file"
                                            aria-label="file example" required>
                                    </div>
                                </div>
                            </div><!-- end row -->
                            <div class="row justify-content-end">
                                <div class="col-sm-9">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary w-md px-4">ສົ່ງ</button>
                                        <button type="button" class="btn btn-danger w-md" data-bs-dismiss="modal"
                                            aria-label="Close">ຍົກເລິກ</button>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </form><!-- end form -->
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="AvisorReModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="card modal-content card-primary px-0 w-100">
                    <div class="card-header modal-header">
                        <h3 class="card-title">ຂໍ້ມູນນັກສຶກສາ</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('student-groups.store') }}" method="POST" class="needs-validation">
                        <div class="card-body">
                            @csrf
                            <div class="d-flex justify-content-between">
                                <div class="col-lg-2">
                                    <label for="student">ນັກສຶກສາ</label>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control" placeholder="ລະຫັດນັກສຶກສາ"
                                                    name="students[0][student_id]">
                                            </div>
                                            <div class="col-5">
                                                <input type="text" class="form-control" placeholder="ຊື່ ແລະ ນາມສະກຸນ"
                                                    name="students[0][name]">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" class="form-control" placeholder="ເບີໂທ"
                                                    name="students[0][phone]">
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <div class="form-group">
                                        {{-- <label for="student">ນັກສຶກສາຄົນທີ່ 2</label> --}}
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control" placeholder="ລະຫັດນັກສຶກສາ"
                                                    name="students[1][student_id]">
                                            </div>
                                            <div class="col-5">
                                                <input type="text" class="form-control" placeholder="ຊື່ ແລະ ນາມສະກຸນ"
                                                    name="students[1][name]">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" class="form-control" placeholder="ເບີໂທ"
                                                    name="students[1][phone]">
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <div class="form-group">
                                        {{-- <label for="student">ນັກສຶກສາຄົນທີ່ 3</label> --}}
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control" placeholder="ລະຫັດນັກສຶກສາ"
                                                    name="students[2][student_id]">
                                            </div>
                                            <div class="col-5">
                                                <input type="text" class="form-control" placeholder="ຊື່ ແລະ ນາມສະກຸນ"
                                                    name="students[2][name]">
                                            </div>
                                            <div class="col-4">
                                                <input type="" class="form-control" placeholder="ເບີໂທ"
                                                    name="students[2][phone]">
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{-- <label for="student">ນັກສຶກສາຄົນທີ່ 3</label> --}}
                                <div class="row">
                                    <div class="col-3">
                                        <input type="text" class="form-control" placeholder="ປີ" name="year">
                                    </div>
                                    <div class="col-5">
                                        <input type="text" class="form-control" placeholder="ຫ້ອງ" name="room">
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" placeholder="ສົກຮຽນ"
                                            name="academic_year">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input custom-control-input-danger" type="checkbox"
                                    id="degreeCheckbox" name="degree" value="ປະລິນຍາຕີ">
                                <label for="degreeCheckbox" class="custom-control-label">ປະລິນຍາຕີ</label>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>ລະດັບການຮຽນ</label>
                                        <select class="custom-select" disabled name="level">
                                            <option selected>ເລືອກ</option>
                                            <option value="ຕໍ່ເນື່ອງ">ຕໍ່ເນື່ອງ</option>
                                            <option value="ປົກກະຕິ">ປົກກະຕິ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>ສາຂາຮຽນ</label>
                                        <select class="custom-select" disabled name="major">
                                            <option selected>ເລືອກ</option>
                                            <option value="ວິສະວະກໍາຄອມພິວເຕີ">ວິສະວະກໍາຄອມພິວເຕີ</option>
                                            <option value="ເຕັກໂນໂລຊີຂໍມູນຂ່າວສານ">ເຕັກໂນໂລຊີຂໍມູນຂ່າວສານ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>ລະບົບ</label>
                                        <select class="custom-select" disabled name="system">
                                            <option selected>ເລືອກ</option>
                                            <option value="ໃນແຜນ">ໃນແຜນ</option>
                                            <option value="ລະບົບຈ່າຍຄ່າຮຽນ">ລະບົບຈ່າຍຄ່າຮຽນ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>ເວລາຮຽນ</label>
                                        <select class="custom-select" name="study_time" disabled>
                                            <option selected>ເລືອກ</option>
                                            <option value="ພາກກາງເວັນ">ພາກກາງເວັນ</option>
                                            <option value="ພາກຄໍ່າ">ພາກຄໍ່າ</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>ປະເພດບົດຈົບຊັ້ນ</label>
                                <select class="custom-select" name="type">
                                    <option selected disabled>ເລືອກ</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="thesis">ຫົວຂໍ້ບົດໂຄງການຈົບຊັ້ນ</label>
                                <input type="text" class="form-control" id="ThesisInput" placeholder="ຊື່ຫົວຂໍ້"
                                    name="topic_name">
                            </div>
                            <div class="form-group">
                                <label for="thesisEng">ຫົວຂໍ້ບົດໂຄງການຈົບຊັ້ນ(ພາສາອັງກິດ)</label>
                                <input type="text" class="form-control" id="ThesisInput"
                                    placeholder="ຊື່ຫົວຂໍ້(ພາສາອັງກິດ)" name="topic_name_eng">
                            </div>
                            <div class="form-group">
                                <label for="advisor">ອາຈານທີ່ປຶກສາ</label>
                                <input type="text" class="form-control" id="AdvisorInput"
                                    placeholder="ຊື່ອາຈານທີ່ປຶກສາ" name="advisor">
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
            $('#degreeCheckbox').change(function() {
                if ($(this).is(':checked')) {
                    $('.custom-select').prop('disabled', false);
                } else {
                    $('.custom-select').prop('disabled', true);
                }
            })
        });
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            $('.swalDefaultSuccess').click(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });
        })
    </script>
    @if (session('success'))
        <script>
            $(document).ready(function() {
                swal({
                    title: 'success!', // Congratulations
                    text: '{{ session('success') }}',
                    type: 'success',
                    button: {
                        text: "Continue",
                        value: true,
                        visible: true,
                        className: "btn btn-primary"
                    }
                });
            });
        </script>
    @endif
@endsection

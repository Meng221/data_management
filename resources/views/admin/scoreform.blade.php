@extends('admin.adminlayout')

@section('title')
    Score
@endsection

@section('content')
    <div class="content-fluid">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ໜ້າໃຫ້ຄະແນນ ແລະ ຄໍາເຫັນການປ້ອງກັນບົດຈົບຊັ້ນ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Project Add</li>
                        </ol>
                    </div>
                </div>
                <div>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <div class="d-flex align-items-center">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                aria-label="Warning:">
                                <use xlink:href="#exclamation-triangle-fill" />
                            </svg>
                            <div>
                                ປ້ອນເລກກຸ່ມໃສ່ຊ່ອງຄົ້ນຫາແລ້ວກົດຄົ້ນຫາເພື່ອດືງຂໍ້ມູນຂອງກຸ່ມມາສະແດງໃນຟອມທາງລຸ່ມ
                            </div>
                        </div>
                        <a href="#" class="close text-decoration-none" data-dismiss="alert"
                            aria-label="close">&times;</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('search') }}" method="get">
                            <div class="input-group">
                                <input type="search" name="group_number" class="form-control form-control-lg"
                                    placeholder="ໃສ່ເລກກຸ່ມ (ແລ້ວກົດ Enter ຫຼື ປຸ່ມທາງຂວາ)">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if (session('error'))
                    <div class="alert mb-0">
                        <p class="text text-danger">
                            {{ session('error') }}
                        </p>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert mb-0">
                        <p class="text text-success">
                            {{ $success }}
                        </p>
                    </div>
                @endif
                @error('group_number')
                    <div class="my-2 text text-danger">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div><!-- /.container-fluid -->
        </div>
        <hr class="mb-3">
        @error('comment')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        @error('lesson_4_score.*')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        @error('lesson_5_score.*')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        @error('thesis_score.*')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        @error('poster_score.*')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        @error('project_score.*')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        @error('present_score.*')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        @error('qascore.*')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <!-- Main content -->
        <div class="content">
            @if (isset($group) && isset($thesisTopic))
                <form action="{{ route('submit-score') }}" method="POST" onsubmit="enableTotalScore()">
                    @csrf
                    <input type="hidden" name="thesis_topic_id" value="{{ $thesisTopic->id }}">
                    <input type="hidden" name="group_id" value="{{ $group->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">ຂໍ້ມູນກຸ່ມ</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="GroupNumber">ເລກກຸ່ມ</label>
                                        <input type="text" id="GroupNumber" class="form-control"
                                            value="{{ $group->group_number }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="GroupTitle">ຊື່ຫົວຂໍ້</label>
                                        <input type="text" id="GroupTitle" class="form-control"
                                            value="{{ $thesisTopic->topic_name }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="GroupAdvisor">ອາຈານທີ່ປຶກສາ</label>
                                        <input type="text" id="GroupAdvisor" class="form-control"
                                            value="{{ $group->advisor }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="TopicType">ປະເພດ</label>
                                        <input type="text" value="{{ $thesisTopic->type->name }}" class="form-control"
                                            disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="Comments">ຄໍາເຫັນ</label>
                                        <textarea id="Comments" class="form-control" rows="4" name="comment"></textarea>
                                        @error('comment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @php
                                $rank = 1;
                            @endphp
                            @foreach ($group->students as $student)
                                <div class="card card-secondary collapsed-card">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ $rank++ . '. ' . $student->name }}</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body collapse">
                                        <div class="form-group">
                                            <label for="student">ນັກສຶກສາ</label>
                                            <div class="row">
                                                <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                                                <div class="col-4">
                                                    <input type="text" name="student_code[]" class="form-control"
                                                        placeholder="ລະຫັດນັກສຶກສາ" value="{{ $student->student_id }}"
                                                        disabled>
                                                </div>
                                                <div class="col-5">
                                                    <input type="text" name="name[]" class="form-control"
                                                        placeholder="ຊື່ ແລະ ນາມສະກຸນ" value="{{ $student->name }}"
                                                        disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="lesson4">ເນື້ອໃນບົດທີ່ 4</label>
                                            <div class="d-flex justify-content-between align-items-center gap-2">
                                                <input type="range" class="custom-range lesson-4-range" min="0"
                                                    max="100" value="0" name="lesson_4_score[]">
                                                <input type="number" class="form-control col-2 lesson-4-score"
                                                    max="100" value="0" name="lesson_4_score[]">
                                                @error('lesson_4_score.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="lesson5">ເນື້ອໃນບົດທີ່ 5</label>
                                            <div class="d-flex justify-content-between align-items-center gap-2">
                                                <input type="range" class="custom-range lesson-5-range" min="0"
                                                    max="100" value="0" name="lesson_5_score[]">
                                                <input type="number" class="form-control col-2 lesson-5-score"
                                                    max="100" value="0" name="lesson_5_score[]">
                                                @error('lesson_5_score.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="document">ຄວາມສົມບູນຂອງເອກະສານ</label>
                                            <div class="d-flex justify-content-between align-items-center gap-2">
                                                <input type="range" class="custom-range document-range" min="0"
                                                    max="100" value="0" name="thesis_score[]">
                                                <input type="number" class="form-control col-2 document-score"
                                                    max="100" value="0" name="thesis_score[]">
                                                @error('thesis_score.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="poster">Poster</label>
                                            <div class="d-flex justify-content-between align-items-center gap-2">
                                                <input type="range" class="custom-range poster-range" min="0"
                                                    max="100" value="0" name="poster_score[]">
                                                <input type="number" class="form-control col-2 poster-score"
                                                    max="100" value="0" name="poster_score[]">
                                                @error('poster_score.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="project">ຄວາມສົມບູນຂອງຊີ້ນງານ</label>
                                            <div class="d-flex justify-content-between align-items-center gap-2">
                                                <input type="range" class="custom-range project-range" min="0"
                                                    max="100" value="0" name="project_score[]">
                                                <input type="number" class="form-control col-2 project-score"
                                                    max="100" value="0" name="project_score[]">
                                                @error('project_score.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="presentation">ຄະແນນການນໍາສະເໜີ</label>
                                            <div class="d-flex justify-content-between align-items-center gap-2">
                                                <input type="range" class="custom-range presentation-range"
                                                    min="0" max="100" value="0" name="present_score[]">
                                                <input type="number" class="form-control col-2 presentation-score"
                                                    max="100" value="0" name="present_score[]">
                                                @error('present_score.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="qa">ຄະແນນການຕອບຄໍາຖາມ</label>
                                            <div class="d-flex justify-content-between align-items-center gap-2">
                                                <input type="range" class="custom-range qa-range" min="0"
                                                    max="100" value="0" name="qascore[]">
                                                <input type="number" class="form-control col-2 qa-score" max="100"
                                                    value="0" name="qascore[]">
                                                @error('qascore.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <label for="qa">ຄະແນນລວມ</label>
                                            <input type="number" class="form-control col-2 total-score" max="100"
                                                value="0" disabled name="total[]">

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('home') }}" class="btn btn-secondary">ກັບໜ້າທໍາອິດ</a>
                            <input type="submit" value="ບັນທຶກຄະແນນ" class="btn btn-success float-right">
                        </div>
                    </div>
                </form>
            @endif
        </div>


    </div>
    <!-- /.content -->


    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
    </div>
@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
            function calculateTotalScore(card) {
                let totalScore = 0;
                $(card).find('.custom-range').each(function() {
                    totalScore += parseInt($(this).val()) || 0;
                });
                $(card).find('.total-score').val(totalScore);
            }

            function syncRangeAndNumber(card) {
                $(card).find('.custom-range').on('input', function() {
                    let value = $(this).val();
                    $(this).closest('.d-flex').find('.form-control').val(value);
                    calculateTotalScore(card);
                });

                $(card).find('.form-control').on('input', function() {
                    let value = $(this).val();
                    $(this).closest('.d-flex').find('.custom-range').val(value);
                    calculateTotalScore(card);
                });
            }

            $('.card-body').each(function() {
                syncRangeAndNumber(this);
                calculateTotalScore(this);
            });
        });

        function enableTotalScore() {
            $('.total-score').prop('disabled', false);
        }
    </script>
@endsection

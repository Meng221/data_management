@extends('layout')

@section('title')
    Comments
@endsection

@section('content')
    <section class="content">



        @foreach ($thesisTopics as $topic)
            @php
                $comment = auth()->user()->id === $topic->studentGroup->user_id;
            @endphp
            @if (auth()->user()->id === $topic->studentGroup->user_id)
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ກຸ່ມທີ່ <span>{{ $topic->studentGroup->group_number }}</span></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                <div class="row my-3">
                                    <h2>{{ $topic->topic_name }}</h2>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label>ຄໍາເຫັນຈາກກໍາມະການ</label>
                                        <hr>
                                        @foreach ($topic->studentGroup->comments as $comment)
                                            <div class="post">
                                                <div class="user-block">
                                                    <img class="img-circle img-bordered-sm"
                                                        src="{{ asset('dist/img/profile.png') }}" alt="user image">
                                                    <span class="username">
                                                        <a href="#">{{ $comment->user->name }}</a>
                                                    </span>
                                                </div>
                                                <!-- /.user-block -->
                                                <p>
                                                    {{ $comment->comment }}
                                                </p>

                                                <p>
                                                    <a href="#" class="link-black text-sm">
                                                        <i class="bi bi-calendar-check me-1"></i>
                                                        Date: {{ $comment->created_at }}
                                                    </a>
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                                {{-- display students in tag li --}}
                                <h5 class="text-muted">ສະມາຊິກກຸ່ມ</h5>
                                <ul class="list-unstyled">
                                    @foreach ($topic->studentGroup->students as $student)
                                        <li>
                                            <p>
                                                <i class="bi bi-person-fill"></i>
                                                {{ $student->name }}
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            @else
                {{-- <div class="text-center">
                    <h1>No Comment</h1>
                </div> --}}
            @endif
        @endforeach
        <!-- /.card -->
    </section>
@endsection

{{-- <div class="post clearfix">
    <div class="user-block">
        <img class="img-circle img-bordered-sm" src="{{ asset('dist/img/profile.png') }}"
            alt="User Image">
        <span class="username">
            <a href="#">ຊອ ປອ ສິດທິພອນ ພັນດາລາ</a>
        </span>
    </div>
    <!-- /.user-block -->
    <p>
        Lorem ipsum represents a long-held tradition for designers,
        typographers and the like. Some people hate it and argue for
        its demise, but others ignore.
    </p>
    <p>
        <a href="#" class="link-black text-sm">
            <i class="bi bi-calendar-check"></i>
            Date: 17/06/2024
        </a>
    </p>
</div>

<div class="post">
    <div class="user-block">
        <img class="img-circle img-bordered-sm" src="{{ asset('dist/img/profile.png') }}"
            alt="user image">
        <span class="username">
            <a href="#">ປທ ກະຕ່າຍ ໄຊຍະສົມບັດ</a>
        </span>
    </div>
    <!-- /.user-block -->
    <p>
        Lorem ipsum represents a long-held tradition for designers,
        typographers and the like. Some people hate it and argue for
        its demise, but others ignore.
    </p>

    <p>
        <a href="#" class="link-black text-sm">
            <i class="bi bi-calendar-check"></i>
            Date: 17/06/2024
        </a>
    </p>
</div> --}}

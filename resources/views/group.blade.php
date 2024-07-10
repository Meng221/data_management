@extends('layout')

@section('title')
    ກຸ່ມທັງໝົດ
@endsection

@section('content')
    <div class="student-groups">
        <h1 class="mb-3">Groups</h1>
        <div class="table-container">
            <table class="table table-bordered table-custom">
                <thead class="text-center">
                    <tr>
                        <th scope="col" style="width: 40px;">ກຸ່ມ</th>
                        <th scope="col" style="width: 250px;">ຊື່ ແລະ ນາມສະກຸນ</th>
                        <th scope="col" style="width: 130px;">ເບີໂທ</th>
                        <th scope="col" style="width: 70px;">ຫ້ອງ</th>
                        <th scope="col">ຊື່ບົດຈົບຊັ້ນ</th>
                        <th scope="col">ຊື່ບົດຈົບຊັ້ນພາສາອັງກິດ</th>
                        <th scope="col">ປະເພດ</th>
                        <th scope="col">ອາຈານທີ່ປຶກສາ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($studentGroups as $group)
                        @php
                            $studentCount = $group->students->count();
                        @endphp
                        @foreach ($group->students as $student)
                            <tr class="text-center">
                                @if ($loop->first)
                                    <th scope="row" rowspan="{{ $studentCount }}" class="vertical-align-middle">
                                        {{ $group->group_number }}</th>
                                @endif
                                <td scope="row" class="text-start">{{ $student->name }}</td>
                                <td scope="row" class="text-start">{{ $student->phone }}</td>
                                @if ($loop->first)
                                    <td scope="row" rowspan="{{ $studentCount }}" class="vertical-align-middle">
                                        {{ $group->room }}</td>
                                    <td scope="row" rowspan="{{ $studentCount }}" class="vertical-align-middle">
                                        {{ $group->thesisTopic->topic_name }}</td>
                                    <td scope="row" rowspan="{{ $studentCount }}" class="vertical-align-middle">
                                        {{ $group->thesisTopic->topic_name_eng }}</td>
                                    <td scope="row" rowspan="{{ $studentCount }}" class="vertical-align-middle">
                                        {{ $group->thesisTopic->type->name }}</td>
                                    <td scope="row" rowspan="{{ $studentCount }}" class="vertical-align-middle">
                                        {{ $group->advisor }}</td>
                                @endif
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@extends('layout')

@section('title')
    ປ້ອງກັນ
@endsection

@section('content')
    <h4>ຜົນການປ້ອງກັນບົດຈົບຊັ້ນ</h4>
    <div style="overflow-x: auto;">
        <table class="table table-bordered" style="width: 120%">
            <thead class="text-center">
                <tr>
                    <th scope="col" style="width: 50px;">ກຸ່ມ</th>
                    <th scope="col">ຊື່ ແລະ ນາມສະກຸນ</th>
                    <th scope="col">ເບີໂທ</th>
                    <th scope="col" style="width: 90px;">ຫ້ອງ</th>
                    <th scope="col">ຊື່ບົດຈົບຊັ້ນ</th>
                    <th scope="col">ຊື່ບົດຈົບຊັ້ນພາສາອັງກິດ</th>
                    <th scope="col">ປະເພດ</th>
                    <th scope="col" style="width: 80px;">ສົ່ງປື້ມ</th>
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
                                    {{ $group->group_number }}
                                </th>
                            @endif
                            <td scope="row" class="text-start">{{ $student->name }}</td>
                            <td scope="row" class="text-start">{{ $student->phone }}</td>
                            @if ($loop->first)
                                <td scope="row" rowspan="{{ $studentCount }}" class="vertical-align-middle">
                                    {{ $group->room }}
                                </td>
                                <td scope="row" rowspan="{{ $studentCount }}" class="vertical-align-middle">
                                    {{ Str::limit($group->thesisTopic->topic_name, 25) }}
                                </td>
                                <td scope="row" rowspan="{{ $studentCount }}" class="vertical-align-middle">
                                    {{ Str::limit($group->thesisTopic->topic_name_eng, 25) }}
                                </td>
                                <td scope="row" rowspan="{{ $studentCount }}" class="vertical-align-middle">
                                    {{ $group->thesisTopic->type->name }}
                                </td>
                                <td scope="row" rowspan="{{ $studentCount }}" class="vertical-align-middle">
                                    @if ($group->thesisTopic->book_id != null)
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                    @else
                                        <i class="bi bi-x-circle-fill text-danger"></i>
                                    @endif
                                </td>
                                <td scope="row" rowspan="{{ $studentCount }}" class="vertical-align-middle">
                                    {{ $group->advisor }}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

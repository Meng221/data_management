@extends('layout')

@section('title')
    Edit
@endsection

@section('content')
    {{-- @foreach ($plans as $item) --}}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">ແກ້ໄຂແຜນດໍາເນີນການ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.update', $plan->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <label for="fullname-input" class="col-sm-3 col-form-label">ຊື່ຫົວຂໍ້</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="horizontal-firstname-input" name="title"
                                    value="{{ $plan->plan_title }}">
                            </div>
                        </div>
                        @error('title')
                            <div class="my-2 text text-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                        <div class="row mb-4">
                            <label for="image-input" class="col-sm-3 col-form-label">ໄຟລ໌</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="file" value="{{ $plan->pdf_data }}">
                            </div>
                        </div>
                        @error('file')
                            <div class="my-2 text text-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                        <div class="row mb-4">
                            <label for="email-input" class="col-sm-3 col-form-label">ຄໍາອະທິບາຍ</label>
                            <div class="col-sm-9">
                                <textarea name="description" id="" cols="30" rows="10" class="form-control"
                                    value="{{ $plan->description }}"></textarea>
                            </div>
                        </div>
                        @error('description')
                            <div class="my-2 text text-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror

                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary w-md" name="submit">Submit</button>
                                    <button type="button" class="btn btn-danger w-md"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    {{-- @endforeach --}}
@endsection

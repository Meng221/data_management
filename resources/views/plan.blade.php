@extends('layout')

@section('title')
    ແຜນການຕ່າງໆ
@endsection

@section('content')
    @if (auth()->check())
        @if (auth()->user()->user_type === 'teacher')
            <button class="btn btn-primary" id="addBtn" data-bs-toggle="modal" data-bs-target="#postModal">+
                ສ້າງໂພສ
            </button>
            <hr>
        @endif
    @endif


    {{-- this form fo create post --}}
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-primary py-2 align-items-center">
                    <h4 class="modal-title" id="exampleModalLabel">ສ້າງໂພສ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/insert" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <label for="fullname-input" class="col-sm-3 col-form-label">ຊື່ຫົວຂໍ້</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="horizontal-firstname-input" name="title"
                                    value="{{ old('title') }}" placeholder="ຫົວຂໍ້">
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
                                <input type="file" class="form-control" name="file">
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
                                <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="ຄໍາອະທິບາຍ">{{ old('description') }}</textarea>
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
    </div>




    <h4>All Plan for thesis</h4>
    @foreach ($posts as $item)
        @php
            $date = $item->updated_at;
        @endphp
        <div class="info-box d-flex justify-content-between">
            <div class="d-flex position-relative my-3">
                <div class="overflow-hidden w-25">
                    <embed src="{{ asset('storage/' . $item->pdf_data) }}" class="w-100" />
                </div>
                <div class="mx-3">
                    <h5 class="mt-0">{{ $item->plan_title }}</h5>
                    <p>{{ $item->description }}</p>
                    <a href="{{ asset('storage/' . $item->pdf_data) }}" target="_blank" rel="noopener noreferrer">View
                        Detail</a>
                    <p class="card-text text-end"><small class="text-muted">Date of post: </small>{{ $date }}
                    </p>
                </div>
            </div>
            @if (auth()->check())
                @if (auth()->user()->user_type === 'teacher')
                    <div class="d-flex gap-3" target="_blank">

                        <a href="{{ route('edit', $item->id) }}" class="text-dark" id="addBtn"><i
                                class="fas fa-edit"></i>Edit</a>
                        <a href="{{ route('delete', $item->id) }}"
                            onclick="return confirm('Do you want to delete {{ $item->plan_title }}?')" class="text-dark"><i
                                class="bi bi-trash-fill"></i>Delete
                        </a>
                        <a href="#" class="text-dark"><i class="fas fa-save me-1"></i>Save</a>
                    </div>
                @endif
            @endif

        </div>
    @endforeach

    {{-- <div class="modal fade" id="viewpdfModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <embed src="" id="modal-pdf" class="w-100 border-0" height="650px" type="application/pdf" />

                </div>
            </div>
        </div>

    </div> --}}
@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
            $('[data-bs-toggle="modal"]').click(function() {
                const src = $(this).data('pdf-src');
                $('#modal-pdf').attr('src', src);
            });
        });
    </script>
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#postModal').modal('show');
            });
        </script>
    @endif

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

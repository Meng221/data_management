@extends('admin.adminlayout')

@section('title')
    ອາຈານທີ່ປຶກສາ
@endsection

@section('content')
    <h4>ອາຈານທີ່ປຶກສາຂອງພາກວິຊາ CEIT</h4>
    @if (auth()->check())
        @if (auth()->user()->user_type === 'teacher')
            <button class="btn btn-primary my-4" id="addBtn" data-bs-toggle="modal" data-bs-target="#userModal">+
                ເພີ່ມອາຈານທີ່ປຶກສາ</button>
            <hr>
        @endif
    @endif
    {{-- this form for add new advisor --}}
    <div class="row row-cols-md-3">
        @foreach ($posts as $item)
            <div class="col col-lg-3">
                <div class="card advisor">
                    <img src="{{ asset('storage/' . $item->picture) }}" class="card-img-top" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                    <div class="card-body advisor-card">
                        <h5 class="card-title">{{ $item->fullname }}</h5>
                        <br>
                        <p class="d-block text-start">{{ $item->email }}</p>
                        <p class="card-text text-start"><small class="text-muted">Last Updated:
                                {{ $item->updated_at }}</small></p>
                    </div>
                    @if (auth()->check())
                        @if (auth()->user()->user_type === 'teacher')
                            <div class="card-body border-top border-1 d-flex justify-content-end gap-3">
                                <a href="{{ route('admin.editadvisor', $item->id) }}"
                                    class="link-secondary text-decoration-none"><i class="bi bi-pencil-square"></i>Edit</a>
                                <a href="{{ route('admin.advisordelete', $item->id) }}"
                                    class="link-secondary text-decoration-none"
                                    onclick="return confirm('Do you wnat to delete {{ $item->fullname }}?')"
                                    class="text-dark"><i class="bi bi-trash3-fill"></i>Delete</a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    </div>



    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary py-2 align-items-center">
                    <h4 class="modal-title" id="exampleModalLabel">ຂໍ້ມູນອານຈານທີ່ປຶກສາ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="clearFormButton"></button>
                </div>
                <div class="modal-body">
                    <form action="/advisorinsert" method="post" enctype="multipart/form-data" id="myForm">

                        @csrf
                        <div class="row mb-4">
                            <label for="fullname" class="col-sm-3 col-form-label">ຊື່ ແລະ ນາມສະກຸນ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="horizontal-firstname-input" name="fullname"
                                    placeholder="ຊື່ ແລະ ນາມສະກຸນ">
                            </div>
                        </div><!-- end row -->
                        @error('fullname')
                            <div class="my-2 text text-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                        <div class="row mb-4">
                            <label for="email" class="col-sm-3 col-form-label">ອີເມລ</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="horizontal-email-input" name="email"
                                    placeholder="ໃສ່ອີເມລ">
                            </div>
                        </div><!-- end row -->
                        @error('email')
                            <div class="my-2 text text-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                        <div class="row mb-4">
                            <label for="image-input" class="col-sm-3 col-form-label">ຮູບພາບ</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="image" id="img-input">
                            </div>
                            <img src="#" alt="" id="previewImg" class="mt-4" style="width: 100%">
                        </div><!-- end row -->
                        @error('image')
                            <div class="my-2 text text-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary w-md" name="submit">Submit</button>
                                    <button type="button" class="btn btn-danger w-md" aria-label="Close"
                                        data-bs-dismiss="modal" id="clearFormButton">Cancel</button>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </form><!-- end form -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Image dialog --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Advisor Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="" id="modal-img" class="img-fluid h-100 w-auto" alt="Advisor Image">
                </div>
            </div>
        </div>
    </div>
@endsection


@section('page-script')
    @if ($errors->any())
        <script script>
            $(document).ready(function() {
                $('#userModal').modal('show');

            });
        </script>
    @endif
    <script>
        $(document).ready(function() {

            // preview Img
            $('#img-input').change(function(evt) {
                const file = this.files[0];
                if (file) {
                    $('#previewImg').attr('src', URL.createObjectURL(file));
                }
            });
            $('#clearFormButton').click(function() {
                $('#myForm')[0].reset();
            });
            $('img[data-bs-toggle="modal"]').click(function() {
                const src = $(this).attr('src');
                $('#modal-img').attr('src', src);
            });

        });
    </script>

    @if (session('success'))
        <script>
            $(document).ready(function() {
                swal({
                    title: 'success!', // Congratulations
                    //text: '{{ session('success') }}',
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

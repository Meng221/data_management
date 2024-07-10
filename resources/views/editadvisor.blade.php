@extends('layout')

@section('title')
    Home
@endsection

@section('content')
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">ອັບເດດອານຈານທີ່ປຶກສາ</h4>

                <a href="/advisor" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="clearFormButton"></a>
            </div>
            <div class="modal-body">
                <form action="/advisorupdate/{{ $advisors->id }}" method="post" enctype="multipart/form-data"
                    id="myForm">
                    @csrf
                    <div class="row mb-4">
                        <label for="fullname" class="col-sm-3 col-form-label">ຊື່ ແລະ ນາມສະກຸນ</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="horizontal-firstname-input" name="fullname"
                                value="{{ $advisors->fullname }}">
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
                                value="{{ $advisors->email }}">
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
                        <img src="{{ asset('storage/' . $advisors->picture) }}" alt="Current Image" id="previewImg"
                            class="mt-4 img-thumbnail" style="width: 100%">
                    </div><!-- end row -->
                    @error('image')
                        <div class="my-2 text text-danger">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                    <div class="row justify-content-end">
                        <div class="col-sm-9">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary w-md" name="update">Update</button>
                                <a href="/advisor" class="btn btn-danger w-md" aria-label="Close"
                                    data-bs-dismiss="modal" id="clearFormButton">Cancel</a>
                                
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </form><!-- end form -->
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
            // Preview image when a new file is selected
            $('#img-input').change(function(evt) {
                const file = this.files[0];
                if (file) {
                    $('#previewImg').attr('src', URL.createObjectURL(file));
                }
            });

            // Reset form and image preview
            $('#clearFormButton').click(function() {
                $('#myForm')[0].reset();
                // Reset image preview to the original image
                $('#previewImg').attr('src', '{{ asset('storage/' . $advisors->picture) }}');
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

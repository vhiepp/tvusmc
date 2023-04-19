@extends('admin.master')

@section('content')
    <script src="/assets/ckeditor/ckeditor.js"></script>

    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Chỉnh sửa bài viết</h4>
                </div>
                </div>
                <div class="iq-card-body">
                <form method="POST" enctype="multipart/form-data">
                        <div class="row">

                            <div class="form-group col-sm-12">
                                <label for="title">Tiêu đề bài viết</label>
                                <input type="text" name="title" value="{{ $blog['title'] }}" class="form-control" id="title" required>
                            </div>

                            <div class="form-group col-sm-12 col-lg-6">
                                <label>Ảnh nền</label>
                                <div class="custom-file">
                                    <input type="file" name="thumb" class="custom-file-input" id="formFile">
                                    <label class="custom-file-label" for="formFile">Choose file</label>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 col-lg-6">
                                <label>Danh mục</label>
                                <select class="form-control form-control-sm mb-3" name="categories" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}" @if ($blog['category_id'] == $category['id'])
                                            @selected(true)
                                        @endif>{{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <img src="{{ $blog['thumb'] }}" id="imgPreview" class="img-fluid col-12" alt="">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Nội dung bài viết</label>
                                <textarea name="content" id="inputContent">
                                    {!! $blog['content'] !!}
                                </textarea>
                            </div>
                        </div>
                        <div class="checkbox mb-3">
                            <label><input type="checkbox" @if ($blog['active'] == 1)
                                @checked(true)
                            @endif name="post-now"> Đăng ngay</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        @csrf
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const thumbnail = document.getElementById("formFile");

        const previewImage = document.getElementById("imgPreview");

        thumbnail.addEventListener("change", function() {
            const file = this.files[0];

            const reader = new FileReader();

            reader.addEventListener("load",function() {
                previewImage.setAttribute("src",this.result);
            });

            reader.readAsDataURL(file);
        });
    </script>
    <script>
        CKEDITOR.replace('inputContent', {
            width: 1200,
            height: 500,
        })
    </script>

@endsection
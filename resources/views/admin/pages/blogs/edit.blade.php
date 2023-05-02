@extends('admin.master')

@section('content')
    <script src="/assets/ckeditor/ckeditor.js"></script>
    <script src="/assets/ckfinder/ckfinder.js"></script>

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
                                <label>Chọn ảnh nền</label>
                                <input type="text" placeholder="Bấm để chọn ảnh" onclick="ckFinderStart()" value="{{ $blog['thumb'] }}" name="thumb" class="form-control" id="formFile" required>
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
        const ckFinderStart = () => {
            CKFinder.popup( {
                 chooseFiles: true,
                 onInit: function( finder ) {
                     finder.on( 'files:choose', function( evt ) {
                         var file = evt.data.files.first();
                         document.getElementById( 'formFile' ).value = file.getUrl();
                         document.getElementById( 'imgPreview' ).src = file.getUrl();
                     } );
                     finder.on( 'file:choose:resizedImage', function( evt ) {
                         document.getElementById( 'formFile' ).value = evt.data.resizedUrl;
                         document.getElementById( 'imgPreview' ).src = evt.data.resizedUrl;
                     } );
                 }
            } );
        }
    </script>
    <script>
        CKEDITOR.replace('inputContent', {
            width: 1200,
            height: 500,
        })
    </script>

@endsection
@extends('admin.master')

@section('head')
<style>
    #ckeditor {
        width: 100%;
        max-width: 960px;
        border: 1px solid #ccc;
    }
</style>
@endsection

@section('content')
    <script src="/ckeditor5/ckeditor.js"></script>
    <script src="/assets/ckfinder/ckfinder.js"></script>

    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">Tạo bài viết mới</h4>
                   </div>
                </div>
                <div class="iq-card-body">
                   <form method="POST" enctype="multipart/form-data">
                        <div class="row">

                            <div class="form-group col-sm-12">
                                <label for="title">Tiêu đề bài viết</label>
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title" required>
                            </div>

                            <div class="form-group col-sm-12 col-lg-3">
                                <label>Danh mục</label>
                                <select class="form-control form-control-sm mb-3" name="categories" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-sm-12 col-lg-3">
                                <label>Ngày đăng</label>
                                <input type="datetime" id="timepicker" placeholder="Giờ:phút ngày/tháng/năm" class="form-control" value="{{ old('time-start') ? old('time-start') : date('d/m/Y', strtotime(\App\Helpers\Date::getNow())) }}"  name="time-post" required>
                            </div>

                            <div class="form-group col-sm-12 col-lg-3">
                                <label>Chọn ảnh nền</label>
                                <input type="text" placeholder="Bấm để chọn ảnh" onclick="ckFinderStart()" name="thumb" class="form-control" id="formFile" required>
                            </div>

                            <div class="form-group col-sm-12 col-lg-3">
                                <img src="" id="imgPreview" class="img-fluid col-12" alt="">
                            </div>

                             <div class="form-group col-sm-12">
                                <textarea name="content" id="inputContent" hidden required></textarea>
                                <label>Nội dung bài viết</label>
                                <div id="ckeditor"></div>
                             </div>
                        </div>
                        <div class="checkbox mb-3">
                            <label><input type="checkbox" name="post-now"> Đăng ngay</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Tạo</button>
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
        BalloonEditor.create(document.querySelector("#ckeditor"), {
        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
        mediaEmbed: {
          previewsInData: true,
        },
        placeholder: "Soạn nội dung...",
        ckfinder: {
          uploadUrl: "/api/upload",
          options: {
            resourceType: "Images",
          },
        },
      })
        .then((editor) => {
          editor.model.document.on("change:data", () => {
            document.getElementById('inputContent').value = editor.getData()
          });
        })
        .catch((err) => {
          console.error(err.stack);
        });

        flatpickr("#timepicker", {
            shorthandCurrentMonth: true,
            ariaDateFormat: "d/m/Y",
            allowInput: true,
            altInput: true,
            altFormat: "d/m/Y",
            dateFormat: "d/m/Y",
            time_24hr: true,
            defaultHour: 7,
            locale: 'vn',
            disableMobile: true,
        });
    </script>

@endsection

@extends('admin.master')

@section('head')
<style>
    #ckeditor {
        width: 100%;
        max-width: 1200px;
        border: 1px solid #ccc;
    }
</style>
@endsection

@section('content')
    <script src="/ckeditor5/ckeditor.js"></script>

    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h3 class="card-title">Chỉnh sửa</h3>
                   </div>
                </div>
                <div class="iq-card-body">
                   <form method="POST" id="form-document" enctype="multipart/form-data">
                        <div class="row justify-content-center">
                             <div class="form-group col-sm-12 col-md-8">
                                <textarea name="content" id="inputContent" hidden required>
                                    @include('introduce')
                                </textarea>
                                <div id="ckeditor">
                                    @include('introduce')
                                </div>
                             </div>
                        </div>
                        <div>
                            <button class="btn btn-primary" style="margin: 0 auto; display:block; width: 100px">Lưu</button>
                        </div>
                        @csrf
                   </form>
                </div>
             </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        BalloonEditor.create(document.querySelector("#ckeditor"), {
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
    </script>

@endsection

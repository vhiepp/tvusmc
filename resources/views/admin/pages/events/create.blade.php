@extends('admin.master')

@section('content')
    
    <script src="/assets/ckeditor/ckeditor.js"></script>
        
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Tạo sự kiện</h6>
                        </div>
                    </div>
                    <div class="card-body p-3 pt-4">
                        <form class="row g-3" method="POST" enctype="multipart/form-data">
                            <div class="col-12">
                                <div class="input-group input-group-static">
                                    <label for="inputTitle">Tên sự kiện</label>
                                    <input type="text" class="form-control" name="name" id="inputTitle" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="input-group input-group-static">
                                    <label for="inputCategories">Danh mục</label>
                                    <select id="inputCategories" name="categories" class="form-control" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="input-group input-group-static">
                                    <label for="">Thời gian bắt đầu</label>
                                    <input type="datetime-local" name="time-start" class="form-control" id="" required>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="input-group input-group-static">
                                    <label for="">Thời gian kết thúc</label>
                                    <input type="datetime-local" name="time-end" class="form-control" id="" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-static">
                                    <label for="formFile" >Ảnh nền</label>
                                    <input class="form-control" name="thumb" type="file" id="formFile" required>
                                </div>
                            </div>
                            <div class="col-12 col-xxl-6 col-lg-6">
                                <img src="" id="imgPreview" class="img-fluid col-12" alt="">
                            </div>
                            <div class="col-12 mt-4">
                                <div class="input-group input-group-static">
                                    <label for="inputContent" class="me-4">Nội dung sự kiện</label>
                                    <textarea type="text" class="form-control" name="content" id="inputContent" placeholder="Soạn nội dung">{!! old('content') !!}</textarea>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="post-now" type="checkbox" id="inputCheck">
                                    <label class="form-check-label" for="inputCheck">Đăng ngay</label>
                                </div>
                            </div>
                            @csrf
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Tạo</button>
                            </div>
                        </form>
                    </div>
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
        });
    </script>

@endsection
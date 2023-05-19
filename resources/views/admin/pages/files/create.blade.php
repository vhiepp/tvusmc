@extends('admin.master')

@section('content')
    
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">Upload file</h4>
                   </div>
                </div>
                <div class="iq-card-body">
                   <form method="POST" enctype="multipart/form-data" onsubmit="btnLoad()">
                        <div class="row">

                            <div class="form-group col-sm-12 col-md-6">
                                <label>Chọn file</label>
                                <input type="file" class="form-control-file" name="file" required>
                            </div>

                            <div class="form-group col-sm-12 col-lg-6">
                                <label>Loại</label>
                                <select class="form-control form-control-sm mb-3" name="type" required>
                                    <option value="0" selected>Danh sách</option>
                                    <option value="1">Văn bản</option>
                                </select>
                             </div>

                            <div class="form-group col-sm-12">
                                <label for="name">Đặt lại tên (Nếu cần, Lưu ý: chỉ nhập tên không nhập đuôi file.)</label>
                                <input type="text" name="file_name" value="{{ old('file_name') }}" class="form-control" id="file_name">
                            </div>

                            <div class="col-sm-12">
                                <span>
                                    Lưu ý: file sẽ được lưu vào GG Driver tại thư mục <b>TVUSMC/files/ngày-tháng-năm/filename.xyz</b> ; ngày-tháng-năm là thời gian upload file, xyz là loại file (vd: .docx, .pdf, .txt, ...)
                                </span>
                            </div>
                        </div>
                        <button type="submit" style="width: 100px; height: 40px" id="btn-submit" class="btn btn-primary">
                            Upload
                        </button>
                        @csrf
                   </form>
                </div>
             </div>
        </div>
    </div>

@endsection

@section('script')
    
    <script>

        const btnLoad = () => {
            document.getElementById('btn-submit').innerHTML = '<img src="/assets/img/loading.gif" style="width: 20px; min-width: 20px;">';
        }

    </script>

@endsection
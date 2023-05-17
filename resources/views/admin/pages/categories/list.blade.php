@extends('admin.master')

@section('content')


<div class="row">
    <div class="col-sm-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">
                        Danh mục
                        <span class="badge badge-info ml-2">
                            {{ $categories->total() }}
                        </span>
                    </h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Ngày đăng</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <h5 class="mb-0 font-weight-bold" title="{{$category['name']}}">{{
                                            str()->title(str()->limit($category['name'], 50)) }}</h5>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-secondary text-xs font-weight-bold">
                                        {{ $category['description']}}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-secondary text-xs font-weight-bold">
                                        {{
                                        $category['created_at']->day . '/' . $category['created_at']->month . '/' .
                                        $category['created_at']->year
                                        }}
                                    </span>
                                </td>
                                <td>
                                    <button type="button" class="btn mb-3 btn-danger rounded-pill"
                                        onclick="alertModalShow('Cảnh báo', 'Bạn chắc chắn muốn xóa danh mục này! Tất cả bài viết và sự kiện liên quan đến danh mục đều sẽ bị xóa!', '{{ route('admin.categories.delete', ['slug' => $category['slug']]) }}');">
                                        <i class="ri-delete-bin-line"></i>
                                        Xóa
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ view('admin.components.paginate', [
                        'items' => $categories,
                    ]) }}
            </div>
        </div>
    </div>
    
    <div class="col-sm-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Thêm danh mục</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <form action="{{ route('admin.categories.create') }}" method="POST">
                    <div class="row">
    
                        <div class="form-group col-sm-12">
                            <label for="name">Tên danh mục</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name"
                                required>
                        </div>
    
                        <div class="form-group col-sm-12">
                            <label>Mô tả</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>


@include('admin.alerts.modal')
@endsection
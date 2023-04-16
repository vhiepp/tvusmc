@extends('admin.master')

@section('content')
   
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Danh mục</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên danh mục</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mô tả</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ngày đăng</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1 mw-500">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 ms-2 text-sm">{{ $category['name'] }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class=" text-sm font-weight-bold mb-0">
                                                    {{ $category['description'] ? $category['description'] : '...'}} 
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{
                                                        $category['created_at']->day . '/' . $category['created_at']->month . '/' .$category['created_at']->year
                                                    }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <a class="text-danger font-weight-bold ms-2" onclick="alertModalShow('Xóa danh mục ' + '{{ $category['name'] }}', 'Bạn chắc chắn muốn xóa danh mục này! Tất cả bài viết và sự kiện liên quan đến danh mục này đều sẽ bị xóa!', '{{ route('admin.categories.delete', ['slug' => $category['slug']]) }}');" style="cursor: pointer" >
                                                    Xóa
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Thêm danh mục</h6>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <form class="row g-3" action="{{ route('admin.categories.create') }}" method="POST">
                            <div class="col-12">
                                <div class="input-group input-group-outline my-2">
                                    <label for="inputName" class="form-label">
                                        Tên danh mục
                                    </label>
                                    <input type="text" class="form-control" name="name" id="inputName" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group input-group-outline my-2">
                                    <label for="inputDescription" class="form-label">Mô tả</label>
                                    <input type="text" class="form-control" name="description" id="inputDescription" value="{{ old('description') }}">{{ old('description') }}</input>
                                </div>
                            </div>
                            @csrf
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('admin.alerts.modal')
@endsection
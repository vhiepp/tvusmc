@extends('admin.master')

@section('content')
    
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Danh mục</h6>
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
                                                <a href="javascript:;" class="text-danger font-weight-bold ms-2" data-toggle="tooltip" data-original-title="Edit user">
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
                    <div class="card-header pb-0">
                        <h6>Thêm danh mục</h6>
                        @if (session('success'))
                            <span class="text-sm text-success">
                                {{ session('success') }}
                            </span>
                        @endif
                    </div>
                    <div class="card-body p-3">
                        <form class="row g-3" action="{{ route('admin.categories.create') }}" method="POST">
                            <div class="col-12">

                                <label for="inputName" class="form-label">
                                    Tên danh mục:
                                    @if (session('err-category'))
                                        <span class="text-sm text-danger">
                                            {{ session('err-category') }}
                                        </span>
                                    @endif
                                </label>
                                <input type="text" class="form-control" name="name" id="inputName" value="{{ old('name') }}" placeholder="Nhập tên danh mục" required>
                            </div>
                            <div class="col-12">
                                <label for="inputDescription" class="form-label">Mô tả</label>
                                <textarea type="text" class="form-control" name="description" id="inputDescription" value="{{ old('description') }}" placeholder="Soạn nội dung">{{ old('description') }}</textarea>
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
    

@endsection
@extends('admin.master')


@section('content')
    
    <div class="row">

        <div class="col-sm-12">

            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">
                         Thành viên
                         <span class="badge badge-success ml-2">
                             {{ $users->total() }}
                         </span>
                     </h4>
                   </div>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <div class="row justify-content-between">
                           <div class="col-sm-12 col-md-6">
                              <div id="user_list_datatable_info" class="dataTables_filter">
                                 <form class="mr-3 position-relative">
                                    <div class="form-group mb-0">
                                       <input type="search" class="form-control" id="exampleInputSearch" placeholder="Search" aria-controls="user-list-table">
                                    </div>
                                 </form>
                              </div>
                           </div>
                           <div class="col-sm-12 col-md-6">
                              <div class="user-list-files d-flex float-right">
                                 <a href="javascript:void();" class="chat-icon-video">
                                    Excel
                                  </a>
                                  <a href="javascript:void();" class="chat-icon-delete">
                                    Pdf
                                  </a>
                                </div>
                           </div>
                        </div>
                        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                          <thead>
                              <tr>
                                 <th class="text-center">avatar</th>
                                 <th>Họ tên</th>
                                 <th>Mã số</th>
                                 <th>Email</th>
                                 <th class="text-center">Số ĐT</th>
                                 <th>Lớp</th>
                                 <th>Giới tính</th>
                                 <th>Địa chỉ</th>
                                 <th>Năm sinh</th>
                                 <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($users as $index => $user)
                               
                                <tr>
                                    <td class="text-center">
                                        <img class="rounded-circle img-fluid avatar-40" src="{{ $user['avatar'] }}" alt="Avatar">
                                    </td>
                                    <td>
                                        {{ str()->title($user['name']) }}
                                    </td>
                                    <td>
                                        {{ $user['mssv'] }}
                                    </td>
                                    <td>
                                        {{ $user['email'] }}
                                    </td>
                                    <td class="text-center">
                                        {{ $user['phone'] }}
                                    </td>
                                    <td>
                                        {{  str()->upper($user['class']) }}
                                    </td>
                                    <td>
                                        @switch($user['sex'])
                                            @case(1)
                                                <span class="badge iq-bg-success">Nam</span>
                                                @break
                                            @case(2)
                                                <span class="badge iq-bg-primary">Nữ</span>
                                                @break
                                            @default
                                                <span class="badge iq-bg-danger">Khác</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        {{ $user['address'] }}
                                    </td>
                                    <td>
                                        {{ date('d/m/Y', strtotime($user['birthday'])) }}
                                    </td>
                                    <td>
                                        <div class="flex align-items-center list-user-action">
                                            {{-- <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Add" href="#"><i class="ri-user-add-line"></i></a> --}}
                                            <a data-placement="top" data-toggle="modal"\
                                                onclick="userEdit(
                                                        {{ $user['id'] }},
                                                        {
                                                            name: '{{ str()->title($user['name']) }}',
                                                            sur_name: '{{ str()->title($user['sur_name']) }}',
                                                            given_name: '{{ str()->title($user['given_name']) }}',
                                                            mssv: '{{ $user['mssv'] }}',
                                                            class: '{{ str()->upper($user['class']) }}',
                                                            email: '{{ $user['email'] }}',
                                                            phone: '{{ $user['phone'] }}',
                                                            address: '{{ $user['address'] }}',
                                                            birthday: '{{ date('d/m/Y', strtotime($user['birthday'])) }}',
                                                            sex: '{{ $user['sex'] }}'
                                                        }
                                                    )"
                                                data-target=".bd-example-modal-lg" title="" data-original-title="Edit" href="#">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                            <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" class="text-danger" href="#" onclick="alertModalShow('Cảnh báo', 'Bạn chắc chắn muốn xóa users này! Sẽ không khôi phục lại được dữ liệu sau khi xóa!', '{{ route('admin.users.delete', ['id' => $user['id']]) }}');">
                                                <i class="ri-delete-bin-line"></i>
                                            </a> 
                                        </div>
                                    </td>
                                </tr> 
                            @endforeach                             
                          </tbody>
                        </table>
                     </div>
                        
                     {{ view('admin.components.paginate', [
                        'items' => $users,
                     ]) }}
                </div>
             </div>

        </div>

        <div class="col-sm-12">

            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">
                         Quản trị
                         <span class="badge badge-info ml-2">
                             {{ $usersAdmin->count() }}
                         </span>
                     </h4>
                   </div>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <div class="row justify-content-between">
                           <div class="col-sm-12 col-md-6">
                           </div>
                           <div class="col-sm-12 col-md-6">
                              <div class="user-list-files d-flex float-right">
                                 <a href="javascript:void();" class="chat-icon-video">
                                    Excel
                                  </a>
                                  <a href="javascript:void();" class="chat-icon-delete">
                                    Pdf
                                  </a>
                                </div>
                           </div>
                        </div>
                        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                          <thead>
                              <tr>
                                 <th class="text-center">avatar</th>
                                 <th>Họ tên</th>
                                 <th>Mã số</th>
                                 <th>Email</th>
                                 <th class="text-center">Số ĐT</th>
                                 <th>Lớp</th>
                                 <th>Giới tính</th>
                                 <th>Địa chỉ</th>
                                 <th>Năm sinh</th>
                                 <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($usersAdmin as $index => $user)
                               
                                <tr>
                                    <td class="text-center">
                                        <img class="rounded-circle img-fluid avatar-40" src="{{ $user['avatar'] }}" alt="Avatar">
                                    </td>
                                    <td>
                                        {{ str()->title($user['name']) }}
                                    </td>
                                    <td>
                                        {{ $user['mssv'] }}
                                    </td>
                                    <td>
                                        {{ $user['email'] }}
                                    </td>
                                    <td class="text-center">
                                        {{ $user['phone'] }}
                                    </td>
                                    <td>
                                        {{ str()->upper($user['class']) }}
                                    </td>
                                    <td>
                                        @switch($user['sex'])
                                            @case(1)
                                                <span class="badge iq-bg-success">Nam</span>
                                                @break
                                            @case(2)
                                                <span class="badge iq-bg-primary">Nữ</span>
                                                @break
                                            @default
                                                <span class="badge iq-bg-danger">Khác</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        {{ $user['address'] }}
                                    </td>
                                    <td>
                                        {{ date('d/m/Y', strtotime($user['birthday'])) }}
                                    </td>
                                    <td>
                                        <div class="flex align-items-center list-user-action">
                                            {{-- <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Add" href="#"><i class="ri-user-add-line"></i></a> --}}
                                            <a data-placement="top" data-toggle="modal"\
                                                onclick="userEdit(
                                                        {{ $user['id'] }},
                                                        {
                                                            name: '{{ str()->title($user['name']) }}',
                                                            sur_name: '{{ str()->title($user['sur_name']) }}',
                                                            given_name: '{{ str()->title($user['given_name']) }}',
                                                            mssv: '{{ $user['mssv'] }}',
                                                            class: '{{ str()->upper($user['class']) }}',
                                                            email: '{{ $user['email'] }}',
                                                            phone: '{{ $user['phone'] }}',
                                                            address: '{{ $user['address'] }}',
                                                            birthday: '{{ date('d/m/Y', strtotime($user['birthday'])) }}',
                                                            sex: '{{ $user['sex'] }}'
                                                        }
                                                    )"
                                                data-target=".bd-example-modal-lg" title="" data-original-title="Edit" href="#">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                            {{-- <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a> --}}
                                        </div>
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

    @include('admin.alerts.modal')

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form id="form-user-edit" action="/admin/users/edit" method="post">
                <input type="hidden" name="id" id="id" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="name-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="sur_name">Họ</label>
                                <input type="text" class="form-control" id="sur_name" name="sur_name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="given_name">Tên</label>
                                <input type="text" class="form-control" id="given_name" name="given_name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mssv">MSSV</label>
                                <input type="text" class="form-control" id="mssv" name="mssv">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="class">Mã lớp</label>
                                <input type="text" class="form-control" id="class" name="class">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email <span class="text-danger">(*)</span></label>
                                <input type="text" class="form-control" id="email" required disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone">SĐT</label>
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="birthday">Ngày sinh</label>
                                <input type="datetime" id="birthday" placeholder="ngày/tháng/năm"  name="birthday">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mr-4">Giới tính:</label>
                                <input type="radio" name="sex" id="nam" value="1">
                                <label class="mr-2" for="nam">Nam</label>
                                <input type="radio" name="sex" id="nu" value="2">
                                <label class="mr-2" for="nu">Nữ</label>
                                <input type="radio" name="sex" id="khac" value="3">
                                <label class="mr-2" for="khac">Khác</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>
                @csrf
            </form>
        </div>
     </div>

@endsection

@section('script')

    <script>

        const userEdit = (id, data = {
            birthday: '1/1/2000',
            sex: 3,
        }) => {

            $('#id').val(id)

            $('#name-title').html(data.name)
            $('#sur_name').val(data.sur_name)
            $('#given_name').val(data.given_name)

            $('#mssv').val(data.mssv)
            $('#class').val(data.class)
            $('#email').val(data.email)
            $('#phone').val(data.phone)
            $('#address').val(data.address)
            $('#birthday').val(data.birthday)

            flatpickr("#birthday", {
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

            switch (data.sex) {
                case '1':
                    $('#nam').attr('checked', true);
                    break;
                case '2': 
                    $('#nu').attr('checked', true);
                    break;
                default:
                    $('#khac').attr('checked', true);
                    break;
            }

        }

        
    </script>

@endsection
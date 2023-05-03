@if (auth()->check() && auth()->user()['role'] != 'leader')

    {{-- <div class="modal fade bd-example-modal-lg show" tabindex="-1" id="updateInfoModal" role="dialog" aria-labelledby="myLargeModalLabel" style="display: block;" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Cập nhật thông tin</h4>
                    <button type="button" class="close" onclick="document.getElementById('updateInfoModal').style='display: none;'" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Họ và tên đệm <span class="text-danger">(*)</span></label>
                                    <input type="text" placeholder="Họ và tên đệm" name="" value="{{ auth()->user()['sur_name'] }}" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tên <span class="text-danger">(*)</span></label>
                                    <input type="text" placeholder="Tên" name="" value="{{ auth()->user()['given_name'] }}" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email <span class="text-danger">(*)</span></label>
                                    <input type="email" class="form-control" id="" value="{{ auth()->user()['email'] }}" 
                                    @if (auth()->user()['provider'] == 'microsoft' || auth()->user()['provider'] == 'google')
                                        @disabled(true)
                                    @endif placeholder="mssv@st.tvu.edu.vn or name@gmail.com" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Mssv <span class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control" id="" value="{{ auth()->user()['mssv'] }}" 
                                    @if (auth()->user()['provider'] == 'microsoft')
                                        @disabled(true)
                                    @endif placeholder="Mã số sinh viên" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="document.getElementById('updateInfoModal').style='display: none;'" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

@endif

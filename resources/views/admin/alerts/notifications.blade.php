<div class="position-fixed bottom-1 end-1 z-index-2">
    @if (session('success'))
        <div class="toast fade show p-2 bg-white" role="alert" aria-live="assertive" id="successToast" aria-atomic="true">
            <div class="toast-header border-0">
                <i class="material-icons text-success me-2">check</i>
                <span class="me-auto font-weight-bold">Thành công</span>
                <small class="text-body">0 mins ago</small>
                <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
            </div>
            <hr class="horizontal dark m-0">
            <div class="toast-body">
                {{session('success')}}
            </div>
        </div>
    @endif
    @if (session('info'))
        <div class="toast fade show p-2 mt-2 bg-gradient-info" role="alert" aria-live="assertive" id="infoToast" aria-atomic="true">
            <div class="toast-header bg-transparent border-0">
            <i class="material-icons text-white me-2">notifications</i>
                <span class="me-auto text-white font-weight-bold">Thông tin</span>
                <small class="text-white">0 mins ago</small>
                <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
            </div>
            <hr class="horizontal light m-0">
            <div class="toast-body text-white">
                {{session('info')}}
            </div>
        </div>
    @endif
    @if (session('warning'))
        <div class="toast fade show p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="warningToast"
            aria-atomic="true">
            <div class="toast-header border-0">
                <i class="material-icons text-warning me-2">
                    travel_explore
                </i>
                <span class="me-auto font-weight-bold">Cảnh báo</span>
                <small class="text-body">0 mins ago</small>
                <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
            </div>
            <hr class="horizontal dark m-0">
            <div class="toast-body">
                {{session('warning')}}
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="toast fade show p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="dangerToast"
            aria-atomic="true">
            <div class="toast-header border-0">
                <i class="material-icons text-danger me-2">
                    campaign
                </i>
                <span class="me-auto text-gradient text-danger font-weight-bold">Thất bại!</span>
                <small class="text-body">0 mins ago</small>
                <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
            </div>
            <hr class="horizontal dark m-0">
            <div class="toast-body">
                {{session('error')}}
            </div>
        </div>
    @endif

</div>
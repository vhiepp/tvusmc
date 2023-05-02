<div class="notifications" id="notifications" style="z-index: 1000;" >
    @if (session('success'))
        <div class="alert text-white bg-success" role="alert">
            <div class="iq-alert-icon">
                <i class="ri-alert-line"></i>
            </div>
            <div class="iq-alert-text">
                {!! session('success') !!}
            </div>
            <button type="button" class="close ml-3" data-dismiss="alert" aria-label="Close">
                <i class="ri-close-line"></i>
            </button>
        </div>
    @endif
    @if (session('info'))
        <div class="alert text-white bg-primary" role="alert">
            <div class="iq-alert-icon">
                <i class="ri-alert-line"></i>
            </div>
            <div class="iq-alert-text">
                {!! session('success') !!}
            </div>
            <button type="button" class="close ml-3" data-dismiss="alert" aria-label="Close">
                <i class="ri-close-line"></i>
            </button>
        </div>
    @endif
    @if (session('warning'))
        <div class="alert text-white bg-warning" role="alert">
            <div class="iq-alert-icon">
                <i class="ri-alert-line"></i>
            </div>
            <div class="iq-alert-text">
                {!! session('warning') !!}
            </div>
            <button type="button" class="close ml-3" data-dismiss="alert" aria-label="Close">
                <i class="ri-close-line"></i>
            </button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert text-white bg-danger" role="alert">
            <div class="iq-alert-icon">
                <i class="ri-information-line"></i>
            </div>
            <div class="iq-alert-text">
                {!! session('error') !!}
            </div>
            <button type="button" class="close ml-3" data-dismiss="alert" aria-label="Close">
                <i class="ri-close-line"></i>
            </button>
        </div>
    @endif

</div>

<script>
    const notification = document.getElementById('notifications');

    setTimeout(() => {
        notification.style = 'display: none';
    }, 8000);
</script>
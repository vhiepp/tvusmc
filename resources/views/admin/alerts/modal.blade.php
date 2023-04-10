<!-- Modal -->
<div class="modal fade text-secondary" id="alertModal" tabindex="-1" aria-labelledby="alertModal" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel"></h5>
                <button type="button" onclick="alertModalHide()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="alertModalBody">
            ...
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn bg-gradient-primary" id="btn-modal-ok">Ok</button>
                <button type="button" class="btn bg-gradient-dark" onclick="alertModalHide()" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    const alertModalShow = (title, msg, url) => {

        let modal = document.getElementById('alertModal');
        modal.classList.add('show');
        modal.style = 'display: block';

        document.getElementById('alertModalLabel').innerHTML = title;
        document.getElementById('alertModalBody').innerHTML = msg;

        document.getElementById('btn-modal-ok').addEventListener('click', () => {
            window.location = url;
        })
        
    }

    const alertModalHide = () => {
        let modal = document.getElementById('alertModal');
        modal.classList.remove('show');
        modal.style = 'display: none';
    }
</script>
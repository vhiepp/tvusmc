<!-- Modal -->
<div class="modal fade hide" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="alertModalLabel">...</h5>
             <button type="button" onclick="alertModalHide()" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body" id="alertModalBody">
             ...
          </div>
          <div class="modal-footer">
             <button type="button" id="btn-modal-ok" onclick="btnLoad()" class="btn btn-primary">OK</button>
             <button type="button" onclick="alertModalHide()" class="btn btn-secondary"  data-dismiss="modal">Close</button>
          </div>
       </div>
    </div>
 </div>

<script>
    const alertModalShow = (title, msg, url) => {

        $('#alertModal').addClass('show');

        document.getElementById('alertModalLabel').innerHTML = title;
        document.getElementById('alertModalBody').innerHTML = msg;

        document.getElementById('btn-modal-ok').addEventListener('click', () => {
            window.location = url;
        })
        
    }

    const alertModalHide = () => {
        $('#alertModal').removeClass('show');    
    }

    const btnLoad = () => {
        document.getElementById('btn-modal-ok').innerHTML = '<img src="/assets/img/loading.gif" style="width: 20px; min-width: 20px;">';
    }
</script>
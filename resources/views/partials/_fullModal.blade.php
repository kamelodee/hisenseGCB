<!-- Modal -->
<div class="modal fade" id="fullModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="fullModalTitle"></h5>
          <button type="button"  class="close btn btn-secondary btn-sm" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- <form action="#" method="post" onsubmit="SubmitAdd(event)" id="saveForm"> --}}
        @csrf


        <div class="modal-body" id="fullModalBody">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="close btn btn-secondary btn-sm" data-dismiss="modal" aria-label="Close">
            Close
          </button> 
          
        </div>
        </form>
      </div>
    </div>
  </div>
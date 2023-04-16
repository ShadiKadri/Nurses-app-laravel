<div class="modal fade" id="exampleModalCaring" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assigned Caring information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Assigned Nurser: {{  $item->nurse->nurse->name}}</p>
                <p>Patient Name: {{ $item->patient->patient->name }}</p>
                <p>Caring Type: {{ $item->caringType->name }}</p>
                <p>Time: {{ $item->time }}</p>
                <p>Description: {{  $item->description }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

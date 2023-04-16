<div class="modal fade" id="exampleModalpatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Patient information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="badge badge-pill badge-dark">Role: {{ $user->role->name }}</p>
                <p>Name: {{ $user->name }}</p>
                <p>Room Photo:</p>
                <img src="{{ asset('images') }}/{{ $user->room_photo }}" class="table-user-thumb"
                                            alt="">
                <p>Is Stopped : {{ $user->is_stopped }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

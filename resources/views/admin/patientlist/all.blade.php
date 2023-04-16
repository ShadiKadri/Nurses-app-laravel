@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Total Appointments: {{ $bookings->count() }}
                    </div>
                    <form action="{{ route('patients') }}" method="GET">

                        <div class="card-header">
                            Filter by Date: &nbsp;
                            <div class="row">
                                <div class="col-md-10 col-sm-6">
                                    <input type="text" class="form-control datetimepicker-input" id="datepicker"
                                        data-toggle="datetimepicker" data-target="#datepicker" name="date"
                                        placeholder=@isset($date) {{ $date }} @endisset>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>

                        </div>
                    </form>

                    <div class="card-body table-responsive-lg">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Room Photo</th>
                                    <th scope="col">Patinet</th>
                                    <th scope="col">Nurse</th>
                                    <th scope="col">Caring Type</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $key=>$item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset('images') }}/{{ $item->patient->room_photo }}" width="80">
                                        </td>
                                        <td>{{ $item->patient->name }}</td>
                                        <td>{{ $item->nurse->name }}</td>
                                        <td>{{ $item->caringType->name }}</td>
                                        <td>{{ $item->time }}</td>
                                        <td>{{ $item->description }}</td>
                                    </tr>
                                @empty
                                    <td>There is no Assigned Carings!</td>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    {{-- Pagination --}}
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

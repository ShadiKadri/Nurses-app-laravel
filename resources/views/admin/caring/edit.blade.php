@extends('admin.layouts.master')

@section('content')

    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-edit bg-blue"></i>
                    <div class="d-inline">
                        <h5>Carings</h5>
                        <span>Update Assigned Caring</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../index.html"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Caring</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if (Session::has('message'))
                <div class="alert bg-success alert-success text-white text-center" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Edit Assigned Caring</h3>
                </div>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('caring.update', [$caring->id]) }}" method="post"
                        enctype="multipart/form-data">@csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Select Nurse</label>
                                <select class="form-control @error('nurse') is-invalid @enderror" name="nurse">
                                    <option value="">select Nurse</option>
                                    @foreach ($nurses as $nurse)
                                        <option value={{$nurse->id}} @if($nurse->id == $caring->nurse_id) selected @endif>{{$nurse->name}}</option>
                                    @endforeach
                                </select>
                                @error('nurse')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="">Select Patient</label>
                                <select class="form-control @error('patient') is-invalid @enderror" name="patient">
                                    <option value="">select Patient</option>
                                    @foreach ($patients as $patient)
                                        <option value={{$patient->id}} @if($patient->id == $caring->patient_id) selected @endif >{{$patient->name}}</option>
                                    @endforeach
                                </select>
                                @error('patient')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Select Caring Type</label>
                                <select class="form-control @error('caring') is-invalid @enderror" name="caring">
                                    <option value="">select Caring Type</option>
                                    @foreach ($caringTypes as $type)
                                        <option value={{$type->id}}  @if($type->id == $caring->caring_type_id) selected @endif >{{$type->name}}</option>
                                    @endforeach
                                </select>
                                @error('caring')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Date</label>
                                <input type="text" class="form-control datetimepicker-input" id="datepicker"
                                    data-toggle="datetimepicker" data-target="#datepicker" name="date" value = {{ date('DD-MM-YYYY',$caring->time)}}>
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Time</label>
                                        <input class="form-control" type="time" id="time" name="time" value={{date('hh:mm:ss a',$caring->time)}}/>  
                                        @error('time')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                        </div>

                        <div class ="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleTextarea1">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="exampleTextarea1"
                                        rows="4" name="description">{{$caring->description}}
                                    </textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
 
        // Below code sets format to the
        // datetimepicker having id as
        // datetime
        $('#time').datetimepicker({
            format: 'hh:mm:ss a'
        });
    </script>

@endsection

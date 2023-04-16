@extends('admin.layouts.master')

@section('content')

    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-command bg-blue"></i>
                    <div class="d-inline">
                        <h5>Carigs</h5>
                        <span>Assign Caring</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../index.html"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Carings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
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
                    <h3>Assign Caring</h3>
                </div>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('caring.store') }}" method="post"
                        enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Select Nurse</label>
                                <select class="form-control @error('nurse') is-invalid @enderror" name="nurse">
                                    <option value="">select Nurse</option>
                                    @foreach ($nurses as $nurse)
                                        <option value={{$nurse->id}}>{{$nurse->name}}</option>
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
                                        <option value={{$patient->id}}>{{$patient->name}}</option>
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
                                        <option value={{$type->id}}>{{$type->name}}</option>
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
                                    data-toggle="datetimepicker" data-target="#datepicker" name="date">
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Time</label>
                                        <input class="form-control" type="time" id="time" name="time"/>  
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
                                        rows="4" name="description">{{ old('description') }}
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
        $('#timepicker').datetimepicker({
            format: 'hh:mm:ss a'
        });
    </script>
@endsection

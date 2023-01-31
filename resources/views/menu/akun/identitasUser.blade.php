@extends('componen.admin')
@section('title', 'Identitas')
    

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-light text-center font-weight-bold">IDENTITAS</div>

                <div class="card-body">
                  
                    @if(Auth()->user()->jk == "Laki-Laki")
                    <img class="img-profile rounded-circle"
                        src="{{ asset('template/img/undraw_profile.svg') }}">
                    @else
                    <img class="img-profile rounded-circle"
                        src="{{ asset('template/img/undraw_profile_3.svg') }}">
                        @endif  


                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-light text-center font-weight-bold">{{ __('DATA DIRI') }}</div>

                <div class="card-body">
                  


                        <div class="form-group">
                            <input type="text" class="form-control " readonly value="{{ Auth()->user()->name }}" name="">

                        </div>

                         <div class="form-group mt-3">
                        <input type="text" class="form-control text-uppercase" readonly readonly value="{{ Auth()->user()->username }}" name="">
                        </div>

                        <div class="form-group mt-3">
                            <input type="text" class="form-control" readonly  value="{{ Auth()->user()->jk }}">
                        </div>
                        {{-- <div class="form-group mt-3">
                            <input type="text" class="form-control"  readonly value="{{ Auth()->user()->email }}">
                        </div> --}}
                        

                        
                        
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
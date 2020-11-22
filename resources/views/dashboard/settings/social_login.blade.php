@extends('dashboard.layouts.app')
@section('title','settings create')
@section('content')
    <h3>Roles</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
    </nav>
    <div class="tile">


    @php
    $socials = ['facebook','google'];
        @endphp

        <!-- start form  -->

        <form action="{{ route('setting.store') }}" method="post">
            @csrf

            <div class="row">
                @foreach($socials as $social)
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">{{ $social }} client id </label>
                            <input type="text" class="form-control" value="{{ setting($social .'_client_id') }}"
                                   name="{{ $social }}_client_id">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">{{ $social }} client secret </label>
                            <input type="text" class="form-control" value="{{ setting($social.'_client_secret') }}"
                                   name="{{ $social }}_client_secret">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">{{ $social }}  redirect url </label>
                            <input type="text" class="form-control" value="{{ setting($social .'_callback_url') }}"
                                   name="{{ $social }}_callback_url">
                        </div>
                    </div>
                @endforeach


                </div> <!-- end of row  -->

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
        </form>
        <!-- end form  -->
    </div>

@endsection

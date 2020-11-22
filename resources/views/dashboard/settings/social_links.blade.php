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
        $socials = ['facebook','google','youtube'];
    @endphp

    <!-- start form  -->

        <form action="{{ route('setting.store') }}" method="post">
            @csrf
            <div class="row">
                @foreach($socials as $social)
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">{{ $social }}  link</label>
                            <input type="text" class="form-control" value="{{ setting($social .'_link') }}"
                                   name="{{ $social }}_link">
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

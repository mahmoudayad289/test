@extends('dashboard.layouts.app')
@section('title','categories create')
@section('content')

    <h3>Categories</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item "><a href="{{ route('categories.index') }}">Categories</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('categories.create') }}">Add</a></li>
        </ol>
    </nav>
    <div class="tile">

        <!-- start form  -->

        <form action="{{ route('categories.store') }}" method="post">
            @csrf
            @include('dashboard.includes._errors')

                <div class="form-group">
                    <label for="" class="font-weight-bold">@lang('site.name')</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name">
                </div>



            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
        <!-- end form  -->
    </div>
@endsection

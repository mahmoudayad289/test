@extends('dashboard.layouts.app')
@section('title','categories edit')
@section('content')
    <h3>Categories</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item "><a href="{{ route('categories.index') }}">Categories</a></li>
            <li class="breadcrumb-item active"><a href="">Edit</a></li>
        </ol>
    </nav>
    <div class="tile">

        <!-- start form  -->

        <form action="{{ route('categories.update', $category->id) }}" method="post">
            @csrf
            @method('put')
            @include('dashboard.includes._errors')
            <div class="form-group">
                <label for="" class="font-weight-bold">Name</label>
                <input type="text" value="{{ $category->name }}" class="form-control" name="name">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
        <!-- end form  -->
    </div>
@endsection

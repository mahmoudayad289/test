@extends('dashboard.layouts.app')
@section('title','roles edit')
@section('content')
    <h3>Roles</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item "><a href="{{ route('roles.index') }}">Roles</a></li>
            <li class="breadcrumb-item active"><a href="">Edit</a></li>
        </ol>
    </nav>
    <div class="tile">

        <!-- start form  -->

        <form action="{{ route('roles.update', $role->id) }}" method="post">
            @csrf
            @method('put')
            @include('dashboard.includes._errors')
            <div class="form-group">
                <label for="" class="font-weight-bold">Name</label>
                <input type="text" value="{{ $role->name }}" class="form-control" name="name">
            </div>

            <div class="form-group">
                <h2>permissions</h2>

                <label for='selectAll'>Select All</label>
                <input id="select-all" type="checkbox">

                <div class="animated-checkbox">
                    <div class="row">
                        @forelse($permissions as $permission)
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ $role->hasPermissionTo($permission->id)  ? 'checked' : '' }}>
                                    <span class="label-text">@lang('site.' . $permission->name)</span>
                                </label>
                            </div>
                        @empty
                            <p>no permissions</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
        <!-- end form  -->
    </div>
@endsection

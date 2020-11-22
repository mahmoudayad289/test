@extends('dashboard.layouts.app')
@section('title','roles create')
@section('content')
    <h3>@lang('site.roles')</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
            <li class="breadcrumb-item "><a href="{{ route('roles.index') }}">@lang('site.roles')</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('roles.create') }}">@lang('site.add')</a></li>
        </ol>
    </nav>
    <div class="tile">

        <!-- start form  -->

        <form action="{{ route('roles.store') }}" method="post">
            @csrf
            @include('dashboard.includes._errors')
            <div class="form-group">
                <label for="" class="font-weight-bold">@lang('site.name')</label>
                <input type="text" class="form-control" value="{{ old('name') }}" name="name">
            </div>


            <div class="form-group">
                <h2>@lang('site.permissions')</h2>
                <label for='selectAll'>@lang('site.select_all')</label>
                <input id="select-all" type="checkbox">

                <div class="animated-checkbox">
                    <div class="row">


                        @forelse($permissions as $permission)
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                    <span class="label-text">@lang('site.' . $permission->name)</span>
                                </label>
                            </div>
                            @empty
                            <p>@lang('site.no_permissions')</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">@lang('site.create')</button>
            </div>
        </form>
        <!-- end form  -->
    </div>

@endsection

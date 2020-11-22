@extends('dashboard.layouts.app')
@section('title','users edit')
@section('content')
    <h3>@lang('site.users')</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
            <li class="breadcrumb-item "><a href="{{ route('users.index') }}">@lang('site.users')</a></li>
            <li class="breadcrumb-item active"><a href="">@lang('site.edit')</a></li>
        </ol>
    </nav>
    <div class="tile">

        <!-- start form  -->

        <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('dashboard.includes._errors')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="font-weight-bold">@lang('site.name')</label>
                        <input type="text" value="{{ $user->name }}" class="form-control" name="name">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="font-weight-bold">@lang('site.email')</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" name="email">
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <img src="{{ $user->image_path  }}" class="img-thumbnail image-perview" width="100px" alt="">
                    </div>
                    <div class="form-group">
                        <label for="" class="font-weight-bold">@lang('site.image')</label>
                        <input type="file" class="form-control image"  name="avatar">
                    </div>
                </div>
            </div>








            <div class="form-group">
                <h4>@lang('site.roles')</h4>

                <label for='selectAll'>@lang('site.select_all')</label>
                <input id="select-all" type="checkbox">

                <div class="animated-checkbox">
                    <div class="row">
                        @forelse($roles as $role)
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $user->hasRole($role->id)  ? 'checked' : '' }}>
                                    <span class="label-text">@lang('site.' . $role->name)</span>
                                </label>
                            </div>
                        @empty
                            <p>@lang('site.no_data')</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">@lang('site.save')</button>
            </div>
        </form>
        <!-- end form  -->
    </div>
@endsection

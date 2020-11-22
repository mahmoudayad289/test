@extends('dashboard.layouts.app')
@section('title','users create')
@section('content')
    <h3>@lang('site.users')</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
            <li class="breadcrumb-item "><a href="{{ route('users.index') }}">@lang('site.users')</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('users.create') }}">@lang('site.add')</a></li>
        </ol>
    </nav>
    <div class="tile">

        <!-- start form  -->

        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('dashboard.includes._errors')

            <div class="row">


                <!-- name -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">@lang('site.name')</label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" >
                        </div>
                    </div> <!-- end of col-md-6 -->


                <!-- email  -->
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="" class="font-weight-bold">@lang('site.email')</label>
                        <input type="email" class="form-control" value="{{ old('email') }}" name="email">
                    </div>
                </div> <!-- end of col-md-6 -->




                <!-- password -->
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="" class="font-weight-bold">@lang('site.password')</label>
                        <input type="password" class="form-control" value="{{ old('password') }}" name="password">
                    </div>
                </div> <!-- end of col-md-6 -->
                <!-- confirm password -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="font-weight-bold">@lang('site.confirm_password')</label>
                        <input type="password" class="form-control" value="{{ old('password') }}" name="password_confirmation">
                    </div>
                </div> <!-- end of col-md-6 -->
            </div> <!-- end of row  -->

            <!-- avatar  -->
            <div class="col-md-6">

                <div class="form-group">
                    <img src="{{asset('uploads/image_user/avatar.jpg')}}" class="img-thumbnail image-perview" width="100px" alt="">
                </div>
                <div class="form-group">
                    <label for="" class="font-weight-bold">@lang('site.image')</label>
                    <input type="file" class="form-control image"  name="avatar">
                </div>



            </div> <!-- end of col-md-6 -->




            <div class="form-group">
                <h4>@lang('site.roles')</h4>

                <label for='selectAll'>@lang('site.select_all')</label>
                <input id="select-all" type="checkbox">

                <div class="animated-checkbox">
                    <div class="row">
                        @forelse($roles as $role)
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                                    <span class="label-text">@lang('site.' . $role->name)</span>
                                </label>
                            </div>
                            @empty
                            <p>no roles</p>
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

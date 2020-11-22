@extends('dashboard.layouts.app')
@section('title','users')
@section('content')
    <h3>@lang('site.users') <small>{{ $users->total() }}</small></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">@lang('site.users')</a></li>
        </ol>
    </nav>
    <div class="tile ">

        <!-- start form  -->

        <form action="">
            <div class="row mb-2">
                <div class="col-md-3">
                    <input type="search" autofocus class="form-control" name="search" value="{{ request()->search }}" placeholder="@lang('site.search')">
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="role" id="">
                        <option value="">@lang('site.all_roles') </option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">@lang('site.' . $role->name)</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <button class="btn btn-info"><i class="fa fa-search"></i>@lang('site.search')</button>
                    @if(auth()->user()->hasPermissionTo('create_users'))
                    <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</a>
                     @endif
                </div>


            </div>
        </form>

        <!-- end form  -->

        <div class="row">
            <div class="col-md-12">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.email')</th>
                            <th>@lang('site.image')</th>
                            <th style="width: 30%">@lang('site.roles')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><img src="{{ $user->image_path }}" class="img-fluid" style="border-radius: 50%" width="40px" alt=""></td>
                                <td>
                                    @forelse($user->roles as $role)
                                     <h5 style="display: inline-block"><span class="badge badge-info p-1"> @lang('site.' . $role->name)</span></h5>
                                    @empty
                                        <p>No roles</p>
                                    @endforelse
                                </td>
                                <td>
                                    @if(auth()->user()->hasPermissionTo('update_users'))
                                    <a href="{{ route('users.edit' , $user->id) }}"
                                       class="btn btn-info btn-sm"><i class="fa fa-edit"></i>@lang('site.edit')</a>
                                    @endif

                                        @if(auth()->user()->hasPermissionTo('delete_users'))
                                            <form action="{{ route('users.destroy', $user->id) }}" method="post" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm delete"><i
                                                        class="fa fa-trash"></i>
                                                    @lang('site.delete')
                                                </button>
                                            </form>
                                        @endif
                                </td>
                            @empty
                                <td>@lang('site.no_users')</td>
                                @endforelse

                            </tr>

                        </tbody>
                    </table>
                </div>

                {{ $users->appends(request()->query())->links() }}
            </div> <!-- end col 12 -->
        </div> <!-- end of row  -->
    </div>
@endsection

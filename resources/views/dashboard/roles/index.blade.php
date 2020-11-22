@extends('dashboard.layouts.app')
@section('title','roles')
@section('content')
    <h3>@lang('site.roles')<small>{{ $roles->total() }}</small></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('roles.index') }}">@lang('site.roles')</a></li>
        </ol>
    </nav>
    <div class="tile">

        <!-- start form  -->

        <form action="">
            <div class="row mb-2">
                <div class="col-md-3">
                    <input type="search" autofocus class="form-control" value="{{ request()->search }}" name="search" placeholder="@lang('site.search')">
                </div>

                <div class="col-md-4">
                    <button class="btn btn-info"><i class="fa fa-search"></i>@lang('site.search')</button>
                    @if(auth()->user()->hasPermissionTo('create_roles'))
                    <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</a>
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
                            <th style="width: 30%">@lang('site.permissions')</th>
                            <th>@lang('site.count')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @forelse($role->permissions as $perm)
                                        <h5 style="display: inline-block">  <span class="badge badge-info p-1"> @lang('site.' . $perm->name)</span></h5>
                                    @empty
                                        <p>@lang('site.no_permissions')</p>
                                    @endforelse
                                </td>
                                <td>{{ $role->users_count }}</td>
                                <td>
                                    @if(auth()->user()->hasPermissionTo('update_roles'))
                                    <a href="{{ route('roles.edit' , $role->id) }}"
                                       class="btn btn-info btn-sm"><i class="fa fa-edit"></i>@lang('site.edit')</a>
                                    @endif

                                        @if(auth()->user()->hasPermissionTo('delete_roles'))
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="post"
                                          style="display: inline-block">
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
                                    <td>@lang('no_data')</td>
                                @endforelse

                            </tr>

                        </tbody>
                    </table>
                </div>

                {{ $roles->appends(request()->query())->links() }}
            </div> <!-- end col 12 -->
        </div> <!-- end of row  -->
    </div>
@endsection

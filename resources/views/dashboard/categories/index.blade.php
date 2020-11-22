@extends('dashboard.layouts.app')
@section('title','categories')
@section('content')
    <h3>@lang('site.categories')<small>{{ $categories->total() }}</small></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}">@lang('site.categories')</a></li>
        </ol>
    </nav>
    <div class="tile">

        <!-- start form  -->

        <form action="">
            <div class="row mb-2">
                <div class="col-md-3">
                    <input type="search" autofocus class="form-control" name="search" value="{{ request()->search }}" placeholder="@lang('site.search')">
                </div>

                <div class="col-md-4">
                    <button class="btn btn-primary"><i class="fa fa-search"></i>@lang('site.search')</button>
                    @if(auth()->user()->hasPermissionTo('create_categories'))
                        <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</a>
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
                            <th>@lang('site.action')</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @if(auth()->user()->hasPermissionTo('update_categories'))
                                        <a href="{{ route('categories.edit' , $category->id) }}"
                                           class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>edit</a>
                                    @endif


                                        @if(auth()->user()->hasPermissionTo('delete_categories'))
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="post"
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
                                    <td>@lang('site.no_data')</td>
                                @endforelse

                            </tr>

                        </tbody>
                    </table>
                </div>

                {{ $categories->appends(request()->query())->links() }}
            </div> <!-- end col 12 -->
        </div> <!-- end of row  -->
    </div>
@endsection

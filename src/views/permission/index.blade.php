@extends('app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-edit fa-fw "></i>
                {{ trans('deeppermission.permission.title') }}
                <span>
                {{ trans("general.list") }}
            </span>
            </h1>
        </div>
    </div>
    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-lg-12">
                <div>
                    <div class="widget-body no-padding">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('deeppermission.permission.name') }}</th>
                                    <th>{{ trans('deeppermission.permission.code') }}</th>
                                    <th>{{ trans('deeppermission.permission.group_permission') }}</th>
                                    <th>{{ trans('deeppermission.general.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}.</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->code }}</td>
                                        <td>{{ @$permission->group->name }}</td>
                                        <td>
                                            @if (Auth::user()->hasPermission("permission.edit"))
                                                <a class="btn btn-sm btn-primary" href="{{ url("/permission/$permission->id/edit") }}"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if (Auth::user()->hasPermission("permission.delete"))
                                                <form method="post"
                                                      action="{{ route('permission.destroy', $permission->id) }}"
                                                      class="inline" onsubmit="return confirm('{{ trans('deeppermission.general.are_you_sure') }}')">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                            title="{{ trans('pages.common.delete_this_record') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @if (Auth::user()->hasPermission("permission.add"))
                                    <tr>
                                        {!! Form::open(array("url" => "permission", "method" => "post")) !!}
                                        <td></td>
                                        <td class="@error('name') has-error @enderror">
                                            {!! Form::text('name', "", ['class' => 'form-control', 'placeholder' => trans('deeppermission.permission.name')]) !!}
                                            @error('name')
                                            <span class="help-block text-red validation_error">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td class="@error('code') has-error @enderror">
                                            {!! Form::text('code', "", ['class' => 'form-control', 'placeholder' => trans('deeppermission.permission.name')]) !!}
                                            @error('code')
                                            <span class="help-block text-red validation_error">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td class="@error('permission_group_id') has-error @enderror">
                                            {!! Form::select('permission_group_id', $getPermissionGroup, "", ['class' => 'form-control select2']) !!}
                                            @error('permission_group_id')
                                            <span class="help-block text-red validation_error">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-check"></i> Submit
                                            </button>
                                        </td>
                                        {!! Form::close() !!}
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            {{ $permissions->links() }}
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
@endsection

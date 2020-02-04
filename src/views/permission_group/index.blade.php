@extends('app')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-edit fa-fw "></i>
                {{ trans('deeppermission.group.title') }}
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
                                    <th>{{ trans('deeppermission.group.name') }}</th>
                                    <th>{{ trans('deeppermission.group.code') }}</th>
                                    <th>{{ trans('deeppermission.group.permission') }}</th>
                                    <th>{{ trans('deeppermission.general.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($permissionGroup as $group)
                                    <tr>
                                        <td>{{ $group->id }}.</td>
                                        <td>{{ $group->name }}</td>
                                        <td>{{ $group->code }}</td>
                                        <td>
                                            <?php
                                            $permission_array = array();
                                            foreach ($group->permissions as $permission)
                                            {
                                                $permission_array[] = $permission->code;
                                            }
                                            echo implode(", ", $permission_array);
                                            ?>
                                        </td>
                                        <td>
                                            @if (Auth::user()->hasPermission("permission_group.edit"))
                                                <a class="btn btn-sm btn-primary" href="{{ url("/permission/group/$group->id/edit") }}"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if (Auth::user()->hasPermission("permission_group.delete"))
                                                <form method="post"
                                                      action="{{ route('group.destroy', $group->id) }}"
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

                                @if (Auth::user()->hasPermission("permission_group.add"))
                                    <tr>
                                        <td></td>
                                        {!! Form::open(array("url" => "permission/group", "method" => "post")) !!}
                                        <td class="@error('name') has-error @enderror">
                                            {!! Form::text('name', "", ['class' => 'form-control', 'placeholder' => trans('deeppermission.group.name')]) !!}
                                            @error('name')
                                            <span class="help-block text-red validation_error">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td class="@error('code') has-error @enderror">
                                            {!! Form::text('code', "", ['class' => 'form-control', 'placeholder' => trans('deeppermission.group.name')]) !!}
                                            @error('code')
                                            <span class="help-block text-red validation_error">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-check"></i> Submit
                                            </button>
                                        </td>
                                        {!! Form::close() !!}
                                        <td></td>
                                    </tr>
                                @endif
                                </tbody>
                                {{ $permissionGroup->links() }}
                            </table>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
@endsection

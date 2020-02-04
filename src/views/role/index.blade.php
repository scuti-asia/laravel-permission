@extends('app')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-edit fa-fw "></i> 
                Role
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
                                    <th>{{ trans('deeppermission.role.name') }}</th>
                                    <th>{{ trans('deeppermission.role.code') }}</th>
                                    <th>{{ trans('deeppermission.general.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}.</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->code }}</td>
                                    <td>
                                        @if (Auth::user()->hasPermission("role.edit"))
                                        <a class="btn btn-sm btn-primary" href="{{ url("/role/$role->id/edit") }}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-sm btn-warning" href="{{ url("/role/$role->id/permission") }}"><i class="fa fa-key"></i></a>
                                        @endif

                                        @if (Auth::user()->hasPermission("role.delete"))
                                            <form method="post"
                                                  action="{{ route('role.destroy', $role->id) }}"
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
                                @if (Auth::user()->hasPermission("role.add"))
                                <tr>
                                    {!! Form::open(array("url" => "role", "method" => "post")) !!}
                                    <td></td>
                                    <td class="@error('name') has-error @enderror">
                                        {!! Form::text('name', "", ['class' => 'form-control', 'placeholder' => trans('deeppermission.role.name')]) !!}
                                        @error('name')
                                        <span class="help-block text-red validation_error">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="@error('code') has-error @enderror">
                                        {!! Form::text('code', "", ['class' => 'form-control', 'placeholder' => trans('deeppermission.role.name')]) !!}
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

                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
@endsection
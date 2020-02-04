@extends('app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-edit fa-fw "></i>
                {{ trans("backend.user.list.title") }}
                <span>>
                {{ trans("general.list") }}
            </span>
            </h1>
        </div>
    </div>

    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-lg-12">
                <div>
                    @if (!isset($permission))
                        {!! Form::open(array("url" => "permission", "method" => "post")) !!}
                    @else
                        {!! Form::open(array("url" => "permission/$permission->id", "method" => "put")) !!}
                    @endif
                    <div class="widget-body">
                        <div class="form-group @error('name') has-error @enderror">
                            {!! Form::label('name', trans('deeppermission.permission.name'), ['class' => 'control-label']) !!}
                            <span class="text-red">*</span>
                            {!! Form::text('name', old('name', @$permission->name), ['class' => 'form-control', 'placeholder' => trans('deeppermission.permission.name')]) !!}
                            @error('name')
                            <span class="help-block text-red validation_error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('code') has-error @enderror">
                            {!! Form::label('code', trans('deeppermission.permission.code'), ['class' => 'control-label']) !!}
                            <span class="text-red">*</span>
                            {!! Form::text('code', old('code', @$permission->code), ['class' => 'form-control', 'placeholder' => trans('deeppermission.permission.code')]) !!}
                            @error('code')
                            <span class="help-block text-red validation_error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('permission_group_id') has-error @enderror">
                            {!! Form::label('name', trans('deeppermission.permission.group_permission'), ['class' => 'control-label']) !!}
                            <span class="text-red">*</span>
                            {!! Form::select('permission_group_id', $getPermissionGroup, @$permission->permission_group_id, ['class' => 'form-control select2']) !!}
                            @error('permission_group_id')
                            <span class="help-block text-red validation_error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="widget-footer" style="text-align: left;">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check"></i> Submit
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </article>
        </div>
    </section>
@endsection

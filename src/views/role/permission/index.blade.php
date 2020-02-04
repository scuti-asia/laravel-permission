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
                {!! Form::open(array("url" => "/role/$role->id/permission", "method" => "post")) !!}
                <div class="widget-body">
                    <div class="row">
                        @foreach ($permissionGroup as $group)
                            <div class="col-lg-12">
                                <h4>{{ $group->name }}</h4>
                            </div>
                            @foreach ($group->permissions as $permission)
                            <div class="col-lg-4">
                                <input name="permission_id[]" type="checkbox" value="{{ $permission->id }}"
                                <?php
                                    foreach ($role->permissions as $rp)
                                    {
                                        if ($permission->id === $rp->id)
                                        {
                                            echo "checked"; break;
                                        }
                                    }
                                ?>
                                >
                                {{ $permission->name  }} ({{ $permission->code }})
                            </div>
                            @endforeach
                        @endforeach
                    </div>
                    <div class="widget-footer" style="text-align: left;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check"></i> Submit
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
            <div>
        </article>
	</div>
</section>
@endsection

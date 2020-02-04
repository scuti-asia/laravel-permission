@extends('app')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-edit fa-fw "></i>
                {{ $user->name }}
            <span>>
                {{ trans('deeppermission.user.permission_of') }}
            </span>
        </h1>
    </div>
</div>

<section id="widget-grid" class="">
    <div class="row">
        <article class="col-lg-12">
            <div>
                {!! Form::open(array("url" => "/user/$user->id/permission", "method" => "post")) !!}
                <div class="widget-body">
                    @if (session('dp_announce'))
                    <div class="callout callout-success">
                        <p>{{ session('dp_announce') }}</p>
                    </div>
                    @endif
                    <div class="row">
                        @foreach ($permissionGroup as $group)
                            <div class="col-lg-12">
                                <h4>{{ $group->name }}</h4>
                            </div>
                            @foreach ($group->permissions as $permission)
                            <div class="col-lg-4">
                                <input type="checkbox" value="{{ $permission->id }}" name="permission_id[]"
                                <?php
                                    $user->loadAllPermissionAndRole();
                                    foreach ($user->__localPermissions as $rp)
                                    {
                                        if ($permission->id === $rp->id)
                                        {
                                            if ($rp->inherited)
                                            {
                                                echo "checked disabled ";
                                            }
                                            else {
                                                echo "checked "; break;
                                            }
                                        }
                                    }
                                ?>
                                >
                                {{ $permission->name  }} ({{ $permission->code }})
                            </div>
                            @endforeach
                        @endforeach
                    </div>
                    <div class="widget-footer">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </article>
    </div>
</section>
@endsection

<div class="form-group">
    <label class="col-md-4 control-label">Name</label>
    <div class="col-md-6">
        {!! Form::text('name',null,array('class'=>'form-control',"required"=>true)) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">E-Mail Address</label>
    <div class="col-md-6">
        @if(Auth::user()->canDo('user','update'))
            {!! Form::input('email', 'email',null,array('class'=>'form-control',"required"=>true)) !!}
        @else
            {!! Form::input('email', 'email',null,array('class'=>'form-control', 'disabled')) !!}
        @endif
    </div>
</div>

    @if(isset($user) && $user->canDo('user','update'))
        <div class="form-group">
            <label class="col-md-4 control-label">Role</label>
            <div class="col-md-6">
                {!! Form::select('role[]', $roleList,isset($user)?$user->roles()->lists("id")->toArray():"",array('class'=>'form-control select2', 'multiple', "required")) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Status</label>
            <div class="col-md-6">
                {{--The default user role have to dynamically set and allow to change in the system--}}
                {!! Form::select('status', array('active'=>'Active','pending'=>'Pending','suspend'=>'Suspend'),isset($user)?null:'pending',array('class'=>'form-control')) !!}
            </div>
        </div>
    @endif
@if(! isset($user) or Auth::user()->id == $user->id )
    <div class="form-group">
        <label class="col-md-4 control-label">Password</label>
        <div class="col-md-6">
            <input type="password" class="form-control" name="password" required min="6">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Confirm Password</label>
        <div class="col-md-6">
            <input type="password" class="form-control" name="password_confirmation" required min="6">
        </div>
    </div>
@endif


<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-success">
            {!! $submitButtonText !!}
        </button>
        <a href="{{Auth::user()->canDo('user','show') ? route('admin.users.index') : url('/')}}" type="" class="btn btn-info">
            back
        </a>
    </div>
</div>
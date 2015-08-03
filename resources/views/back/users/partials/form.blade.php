<div class="form-group">
    <label class="col-md-4 control-label">Name</label>
    <div class="col-md-6">
        {{Form::text('name',null,array('class'=>'form-control'))}}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">School Name</label>
    <div class="col-md-6">
        {{Form::text('school',null,array('class'=>'form-control'))}}
    </div>
</div>

{{--<div class="form-group">--}}
    {{--<label class="col-md-4 control-label">Grade</label>--}}
    {{--<div class="col-md-6">--}}
        {{--{{Form::text('grade',null,array('class'=>'form-control'))}}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group">
    <label class="col-md-4 control-label">Student Number</label>
    <div class="col-md-6">
        {{Form::text('student_number',null,array('class'=>'form-control'))}}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">E-Mail Address</label>
    <div class="col-md-6">
        @if(Auth::user()->is(array('dev','admin')))
            {{Form::input('email', 'email',null,array('class'=>'form-control'))}}
        @else
            {{Form::input('email', 'email',null,array('class'=>'form-control', 'disabled'))}}
        @endif
    </div>
</div>

@if(Auth::user()->is(array('dev', 'admin')))
<div class="form-group">
    <label class="col-md-4 control-label">Role</label>
    <div class="col-md-6">
        {{Form::select('role[]', $roleList,isset($user)?null:Cache::get('default_role')->id,array('class'=>'form-control', 'multiple'))}}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Status</label>
    <div class="col-md-6">
        {{--The default user role have to dynamically set and allow to change in the system--}}
        {{Form::select('status', array('active'=>'Active','pending'=>'Pending','suspend'=>'Suspend'),isset($user)?null:'pending',array('class'=>'form-control'))}}
    </div>
</div>
@endif
@if(! isset($user) or Auth::user()->id == $user->id )
    <div class="form-group">
        <label class="col-md-4 control-label">Password</label>
        <div class="col-md-6">
            <input type="password" class="form-control" name="password">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Confirm Password</label>
        <div class="col-md-6">
            <input type="password" class="form-control" name="password_confirmation">
        </div>
    </div>
@endif


<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-success">
            {{$submitButtonText}}
        </button>
        <a href="{{Auth::user()->is(array('dev','admin'))? route('admin.users.index') : url('/')}}" type="" class="btn btn-info">
            back
        </a>
    </div>
</div>
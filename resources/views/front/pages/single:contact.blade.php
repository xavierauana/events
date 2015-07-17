@extends('front.layouts.default')

@section('meta')
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="Hege Refsnes">
@endsection

@section('title') Contact @endsection

@section('content')
    <div class="container" style="padding-top:0">
        <div class="page-title" style="background-color: #fdd204; width: 100%; margin:0; height:130px; line-height: 130px; font-size: 5.5em; font-weight:600; text-align: right; padding-right: 15px; color: #231f20;">
            Contact Us
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3690.86984853313!2d114.1698871!3d22.320761500000007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x340400c8701a5863%3A0x6023aefef194db02!2s168+Sai+Yeung+Choi+Street+South%2C+168+Sai+Yeung+Choi+St+S%2C+Mong+Kok!5e0!3m2!1sen!2shk!4v1433737004729" width="100%" height="450" frameborder="0" style="border:0; margin-bottom:30px"></iframe>
        <div class="content" style="margin: 0 15px" >
            <div class="col-md-5"">
            <p><strong>電話：</strong> 1234 5678</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium blanditiis ea error expedita, explicabo illo inventore minima numquam reprehenderit repudiandae velit vero vitae voluptas? Aliquam amet animi beatae blanditiis commodi distinctio dolor dolorem, earum est hic, illum in ipsum itaque libero magni maiores maxime necessitatibus nihil non, nostrum odio omnis praesentium quasi quo repudiandae sed tenetur ut? Ad aspernatur consequuntur culpa cupiditate ducimus eveniet expedita harum impedit in ipsa, iusto magni neque nisi nostrum officiis pariatur quis repellat reprehenderit temporibus voluptate? Aut distinctio dolor ea harum qui? Commodi culpa, cupiditate dignissimos ea eos fugiat ipsa nam non provident, quam quidem.</p>
        </div>
        <div class="col-md-7" style="border-left:1px solid" >

            {!! Form::open(['url'=>'somewhere', "role"=>"form"]) !!}

            {{--  Form Input--}}
            <div class="form-group">
                {!! Form::text("name",null,["class"=>"form-control","placeholder"=>"姓名"]) !!}
                {!! $errors->first('name',"<span class='input-error'>:message</span>") !!}
            </div>
            {{--  Form Input--}}
            <div class="form-group">
                {!! Form::input("email","email",null,["class"=>"form-control","placeholder"=>"電郵"]) !!}
                {!! $errors->first('email',"<span class='input-error'>:message</span>") !!}
            </div>

            {{--  Form Input--}}
            <div class="form-group">
                {!! Form::text("tel",null,["class"=>"form-control","placeholder"=>"電話"]) !!}
                {!! $errors->first('tel',"<span class='input-error'>:message</span>") !!}
            </div>

            {{--  Form Input--}}
            <div class="form-group">
                {!! Form::textarea("message",null,["class"=>"form-control","placeholder"=>"訊息"]) !!}
                {!! $errors->first('message',"<span class='input-error'>:message</span>") !!}
            </div>

            {!! Form::submit("Send",["class"=>"pull-right btn btn-default"]) !!}


            {!! Form::close() !!}


        </div>
    </div>
    </div>
@endsection
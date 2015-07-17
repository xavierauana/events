<footer class="container" style="margin-top:50px">
    <div class="row" style="position: relative;">
        <div class="col-xs-12 col-sm-6 col-sm-push-6">
            <div class="col-xs-4 hidden-xs">
                {{-- Newsletter Form Input--}}
                <div class="form-group">
                    {!! Form::label("newsletter","Newsletter:") !!}
                    {!! Form::input("email","newsletter",null,["class"=>"form-control"]) !!}
                    {!! $errors->first('newsletter',"<span class='input-error'>:message</span>") !!}
                </div>
                {!! Form::submit("Subscribe",['class'=>'btn btn-default']) !!}
            </div>
            <div class="col-sm-5 col-xs-12">
                <ul class="list-inline" style="margin-top: 10px" id="footer-social-links">
                    <li>
                        <a href="">
                            <i class="fa fa-2x fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-2x fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-2x fa-google-plus"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-2x fa-linkedin"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-2x fa-youtube-play"></i>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="col-sm-3 hidden-xs">
                <img src="/front/imgs/logo.jpg" width="100%" alt="" style="bottom:0; position:relative" />
            </div>

        </div>
        <div class="col-xs-12 col-sm-6 col-sm-pull-6">
            <ul class="list-inline">
                <li><a href="testi">Q & A</a></li>
                <li><a href="testi">TERMS OF SERVICES</a></li>
                <li><a href="testi">PRIVACY POLICY</a></li>
                <li><a href="testi">技術支援</a></li>
                <li><a href="testi">訂閱通訊</a></li>
                <li><a href="testi">SITE MAP</a></li>
                <li><a href="testi">聯絡我們</a></li>
            </ul>
            <br class="hidden-xs" />
            <br class="hidden-xs" />
            <p class="small" >@ 2015 FARUMRADIO.COM ALL RIGHTS RESERVED </p>
        </div>
    </div>
</footer>
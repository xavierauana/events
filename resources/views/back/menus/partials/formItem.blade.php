<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="@if(isset($menuItem)) @if($menuItem->internalUrl) active @endif @else active @endif"><a href="#interalUrl" aria-controls="home" role="tab" data-toggle="tab">Internal Page</a></li>
        <li role="presentation" class="@if(isset($menuItem)) @if($menuItem->externalUrl) active @endif @endif"><a href="#externalUrl" aria-controls="home" role="tab" data-toggle="tab">External URL</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade @if(isset($menuItem)) @if($menuItem->internalUrl) in active @endif @else in active @endif" id="interalUrl">
            {{-- Internal Page URL Select Form Input--}}
            <div class="form-group">
                {!!  Form::label("internalUrl","Internal Page:") !!}
                {!!  Form::select("internalUrl",$internalUrls,null,array("class"=>"form-control")) !!}
                {{ $errors->first('internalUrl',"<span class='input-error'>:message</span>") }}
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade @if(isset($menuItem)) @if($menuItem->externalUrl) in active @endif @endif" id="externalUrl">
            {{-- URL Form Input--}}
            <div class="form-group">
                {!!  Form::label("externalUrl","External URL:") !!}
                {!!  Form::input("url", "externalUrl",null,array("class"=>"form-control")) !!}
                {{ $errors->first('externalUrl',"<span class='input-error'>:message</span>") }}
            </div>
        </div>
    </div>

</div>



{{-- Active Form Input--}}
<div class="form-group">
    {!!  Form::label("display","Display Name:") !!}
    {!!  Form::text("display",null,array("class"=>"form-control")) !!}
    {{ $errors->first('display',"<span class='input-error'>:message</span>") }}
</div>
{{-- Active Form Input--}}
<div class="form-group">
    {!!  Form::label("target","Target:") !!}
    {!!  Form::select("target",array('_blank'=>'_blank','_parent'=>'_parent', '_self'=>'_self','_top'=>'_top'),null,array("class"=>"form-control")) !!}
    {{ $errors->first('target',"<span class='input-error'>:message</span>") }}
</div>

{{-- Active Form Input--}}
<div class="form-group">
    {!!  Form::label("active","Active:") !!}
    {!!  Form::select("active",array(0=>"Not Active", 1=>"Active"),null,array("class"=>"form-control")) !!}
    {{ $errors->first('active',"<span class='input-error'>:message</span>") }}
</div>

{!!  Form::submit("Create", array('class'=>'btn btn-success')) !!}

<a class="btn btn-info" href="{{route('admin.menus.index')}}" >Back</a>
<div class="form-group">
    {!! Form::label('date','Date of Birth',['class' => 'control-label']) !!}
    {!! Form::date('date',null,['class' => 'form-control']) !!}
    @error('date')
    <span class="text text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('phone','Phone Number',['class' => 'control-label']) !!}
    {!! Form::number('phone',null,['class' => 'form-control']) !!}
    @error('phone')
    <span class="text text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('bio','Bio',['class' => 'control-label']) !!}
    {!! Form::textarea('bio',null,['class' => 'form-control','rows' => 3]) !!}
    @error('bio')
    <span class="text text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('profile_image','Profile Image',['class' => 'control-label']) !!}
    {!! Form::file('profile_image',null,['class' => 'form-control']) !!}
    @error('profile_image')
    <span class="text text-danger">{{$message}}</span>
    @enderror
</div>

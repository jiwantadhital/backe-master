<div class="form-group">
    {!! Form::label('name','Name',['class' => 'control-label']) !!}
    {!! Form::text('name',null,['class' => 'form-control']) !!}
    @error('name')
    <span class="text text-danger">{{$message}}</span>
    @enderror
<div class="form-group">
    {!! Form::label('status','Status',['class' => 'control-label']) !!}
    {!! Form::radio('status',1,true) !!}Active
    {!! Form::radio('status',0) !!}De-Active
</div>

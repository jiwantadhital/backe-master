<div class="form-group">
    {!! Form::label('category_id', 'Category'); !!}
    {!! Form::select('category_id', $data['categories'], null,['class' => 'form-control','placeholder' => 'Select Category']) !!}
    @error('category_id')
    <span class="text text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('name','Name',['class' => 'control-label']) !!}
    {!! Form::text('name',null,['class' => 'form-control']) !!}
    @error('name')
    <span class="text text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('slug','Slug',['class' => 'control-label']) !!}
    {!! Form::text('slug',null,['class' => 'form-control']) !!}
    @error('slug')
    <span class="text text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('rank','Rank',['class' => 'control-label']) !!}
    {!! Form::number('rank',null,['class' => 'form-control']) !!}
    @error('rank')
    <span class="text text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('description','Description',['class' => 'control-label']) !!}
    {!! Form::textarea('description',null,['class' => 'form-control','rows' => 3,'placeholder' => 'Describe here...']) !!}
    @error('description')
    <span class="text text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('image_file','Image',['class' => 'control-label']) !!}
    {!! Form::file('image_file',null,['class' => 'form-control']) !!}
    @error('image_file')
    <span class="text text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('status','Status',['class' => 'control-label']) !!}
    {!! Form::radio('status',1) !!}Active
    {!! Form::radio('status',0,true) !!}De-Active
</div>

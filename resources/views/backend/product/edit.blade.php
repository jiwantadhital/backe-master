@extends('backend.layouts.master')
@section('title',$title )
@section('main-content')
    <div class="card-header">
        <h3 class="card-title">{{$title}}
            <a href="{{route($base_route . 'index')}}" class="btn btn-primary"><i class="fas fa-list-alt"></i> List</a>
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
{{--        {!! Form::open(['route' => $base_route . 'store','method' => 'post']) !!}--}}
        {!! Form::model($data['row'],['route' => [$base_route . 'update',$data['row']->id],'method' => 'put','files' => true]) !!}
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#basic" data-toggle="tab">Basic Form</a></li>
                <li class="nav-item"><a class="nav-link" href="#images" data-toggle="tab">Images</a></li>
                <li class="nav-item"><a class="nav-link" href="#attributes" data-toggle="tab">Attributes</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="basic">
                   {{--basic form--}}
                    @include($folder. 'includes.basic')
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="meta">
                    @include($folder. 'includes.meta')

                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="images">
                    @include($folder. 'includes.images')

                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="attributes">
                    @include($folder. 'includes.attributes')

                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
        
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        {!! Form::submit('Update ' . $panel,['class' => 'btn btn-info']) !!}
    </div>
    {!! Form::close() !!}
    <!-- /.card-footer-->
@endsection

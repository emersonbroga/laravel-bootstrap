@extends('layouts.admin')

@section('content')
<div class="col-md-12 main">
    <h1 class="page-header">{{ trans('project.words.users') }}</h1>

    <h2 class="sub-header">{{ trans('project.words.users') }}</h2>
    
    <div>
        
        {{ Form::model( $user, array('route' => array('admin.users.update', $user->id ), 'method' => 'put', 'files' => true )) }}
           <div class="row">
                <div class="form-group col-xs-12">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', Input::old('email'), ['class'=> 'form-control', 'placeholder' => 'User email']) }}
                    {{ $errors->first('email', '<p class="text-danger">:message</p>') }}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12">
                    {{ Form::label('password', 'Password') }}
                    {{ Form::password('password', ['class'=> 'form-control', 'placeholder' => '******']) }}
                    {{ $errors->first('password', '<p class="text-danger">:message</p>') }}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12">
                    {{ Form::label('password_confirmation', 'Password confirmation') }}
                    {{ Form::password('password_confirmation', ['class'=> 'form-control', 'placeholder' => '******']) }}
                    {{ $errors->first('password_confirmation', '<p class="text-danger">:message</p>') }}
                </div>
            </div>
            @if($isRoot && $user->id !== Auth::user()->id)
            <div class="row">
                <div class="form-group col-xs-12">
                    {{ Form::label('is_admin', 'Is admin') }}
                    <label class="radio-label">{{ Form::radio('is_admin', '1', (Input::old('is_admin')==1)) }} YES </label>
                    <label class="radio-label">{{ Form::radio('is_admin', '0', (Input::old('is_admin',0)==0)) }} NO </label>
                    {{ $errors->first('is_admin', '<p class="text-danger">:message</p>') }}
                </div>
            </div>
            @endif
            <div class="row">
                <div class="form-group action col-xs-12 btn-toolbar">
                    <span class="pull-left">
                        {{ btn_back() }} 
                    </span>
                    <span class="pull-right">
                        {{ btn_save() }}
                    </span>
                </div>
            </div>
        {{ Form::close() }}
    </div>
</div>
@stop
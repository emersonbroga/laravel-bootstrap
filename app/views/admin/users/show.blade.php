@extends('layouts.admin')

@section('content')
<div class="col-md-12 main">
    <h1 class="page-header">{{ trans('project.words.users') }}</h1>

    <h2 class="sub-header">{{ trans('project.words.user') }}</h2>
    
    <div>
        <div class="col-xs-6">
            <p class="form-control-static">{{ Form::label('id', 'Id') }}: {{ $model->id }}</p>
            <p class="form-control-static">{{ Form::label('email', 'Email') }}: {{ $model->email }}</p>
            <p class="form-control-static">{{ Form::label('password', 'Password') }}: ******</p>
            <p class="form-control-static">{{ Form::label('role', 'Role') }}: {{ $model->role }}</p>
            <p>
                <small class="text-muted">{{ Form::label('created_at', 'Created at') }}: {{ $model->created_at }}</small><br/>
                <small class="text-muted">{{ Form::label('updated_at', 'Updated at') }}: {{ $model->updated_at }}</small><br/>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="form-group action col-xs-12 btn-toolbar">
            

            @if($model->id !== $user->id && Input::get('confirm', false))
                <div class="alert alert-danger" role="alert"> 
                    <a href="{{ route('admin.users.show', $model->id) }}" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></a>
                    {{ trans( 'project.admin.delete-question' )}} {{ btn_delete('admin.users.destroy', $model->id) }}
                </div>
            @else
                <span class="pull-left">
                    {{ btn_back() }} 
                </span>
                <span class="pull-right">
                    {{ btn_list('admin.users.index') }} 
                    {{ btn_edit('admin.users.edit', $model->id) }}
                </span>
            @endif

            
        </div>
    </div>
</div>
@stop
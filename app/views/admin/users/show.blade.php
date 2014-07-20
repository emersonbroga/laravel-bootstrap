@extends('layouts.admin')

@section('content')
<div class="col-md-12 main">
    <h1 class="page-header">{{ trans('project.words.users') }}</h1>

    <h2 class="sub-header">{{ trans('project.words.user') }}</h2>
    
    

    <div>
        <div class="col-xs-6">
            <p class="form-control-static">{{ Form::label('id', 'Id') }}: {{ $user->id }}</p>
            <p class="form-control-static">{{ Form::label('email', 'Email') }}: {{ $user->email }}</p>
            <p class="form-control-static">{{ Form::label('password', 'Password') }}: ******</p>
            <p class="form-control-static">{{ Form::label('is_admin', 'Is admin') }}: {{ ($user->is_admin) ? 'yes' : 'no' }}</p>
            <p>
                <small class="text-muted">{{ Form::label('created_at', 'Created at') }}: {{ $user->created_at }}</small><br/>
                <small class="text-muted">{{ Form::label('updated_at', 'Updated at') }}: {{ $user->updated_at }}</small><br/>
            </p>
        </div>
        @if($user->pages && ($isRoot || $user->id === Auth::user()->id))
        <div class="col-xs-6">
            <p class="form-control-static"><label>Pages</label></p>
            <ol>
                @foreach($user->pages as $page)
                    <li><a href="{{ route('admin.pages.show', $page->id ) }}">{{ $page->name }}</a></li>
                @endforeach
            </ol>
        </div>
        @endif
     
    </div>
    <div class="row">
        <div class="form-group action col-xs-12 btn-toolbar">
            

            @if($user->id !== Auth::user()->id && Input::get('confirm', false))
                <div class="alert alert-danger" role="alert"> 
                    <a href="{{ route('admin.users.show', $user->id) }}" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></a>
                    Are you sure you want to delete? {{ btn_delete('admin.users.destroy', $user->id) }}
                </div>
            @else
                <span class="pull-left">
                    {{ btn_back() }} 
                </span>
                <span class="pull-right">
                    {{ btn_list('admin.users.index') }} 
                    {{ btn_edit('admin.users.edit', $user->id) }}
                </span>
            @endif

            
        </div>
    </div>
</div>
@stop
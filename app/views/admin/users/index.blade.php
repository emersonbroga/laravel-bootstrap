@extends('layouts.admin')
@section('content')

      <div class="col-sm-12 main">
          <h1 class="page-header">{{ trans('project.words.users') }}</h1>
          

          <h2 class="sub-header">{{ trans('project.admin.list-of', ['name' => trans('project.words.users')]) }}</h2>
          <div class="table-responsive">

            @if(!$users)
              <div class="alert alert-info"><strong>{{ trans('project.words.user') }}</strong> {{ trans('project.admin.not-found') }}!</div>
            @else
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Email</th>
                  <th>Pages</th>
                  <th class="col-xs-2 text-right">{{ btn_add('admin.users.create') }}</th>
                </tr>
              </thead>

              <tbody>
                @foreach($users as $user)
                <tr>
                  <td>{{{ $user->id }}}</td>
                  <td>{{{ $user->email }}}</td>
                  <td>{{{ $user->id }}}
                  <td class="text-right">
                    {{ btn_edit('admin.users.edit', $user->id) }}
                    {{ btn_show('admin.users.show', $user->id) }}
                    @if($user->id !== Auth::user()->id)
                        {{ btn_delete_confirm('admin.users.show', $user->id) }}
                    @endif

                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <!-- pagination -->
            
            {{ $users->links() }}

            <!-- / pagination -->
            @endif
          </div>
        </div>
   

@stop
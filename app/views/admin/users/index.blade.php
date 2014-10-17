@extends('layouts.admin')
@section('content')

      <div class="col-sm-12 main">
          <h1 class="page-header">{{ trans('project.words.users') }}</h1>
          

          <h2 class="sub-header">{{ trans('project.admin.list-of', ['name' => trans('project.words.users')]) }}</h2>
          <div class="table-responsive">

            @if(!$data)
              <div class="alert alert-info"><strong>{{ trans('project.words.user') }}</strong> {{ trans('project.admin.not-found') }}!</div>
            @else
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Email</th>
                  <th class="col-xs-2 text-right">{{ btn_add('admin.users.create') }}</th>
                </tr>
              </thead>

              <tbody>
                @foreach($data as $record)
                <tr>
                  <td>{{{ $record->id }}}</td>
                  <td>{{{ $record->email }}}</td>
                  <td class="text-right">
                    {{ btn_edit('admin.users.edit', $record->id) }}
                    {{ btn_show('admin.users.show', $record->id) }}
                    @if($record->id !== $user->id)
                        {{ btn_delete_confirm('admin.users.show', $record->id) }}
                    @endif

                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <!-- pagination -->
            
            {{ $data_links }}

            <!-- / pagination -->
            @endif
          </div>
        </div>
   

@stop
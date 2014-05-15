@extends('layouts.admin')
@section('content')

      <div class="col-sm-12 main">
          <h1 class="page-header">Users</h1>
          

          <h2 class="sub-header">List of users</h2>
          <div class="table-responsive">

            @if(!$users)
              <div class="alert alert-info"><strong>Users</strong> not found!</div>
            @else
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Email</th>
                </tr>
              </thead>

              <tbody>
                @foreach($users as $user)
                <tr>
                  <td>{{ e($user->id) }}</td>
                  <td>{{ e($user->email) }}</td>
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
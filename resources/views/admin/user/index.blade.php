@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Employees</h3>
        </div>
    	  <table class="table">
    		  <thead>
            <tr>
              <th>Name</th>
              <th class="text-right">Total hours</th>
              <th class="text-right">Total pay</th>
            </tr>
          </thead>
          <tbody>
          @foreach($users as $user)
            <tr>
              <td>
                <a href="{{ url('admin/users/' . $user->id) }}">{{ $user->last_name }}, {{ $user->first_name}}</a>
              </td>
              <td class="text-right">
                {{ $user->total_hours }}
              </td>
              <td class="text-right">
                £{{ number_format($user->total_pay, 2) }}
              </td>
            </tr>
          @endforeach
          </tbody>
    	 </table>
      </div>
    </div>
  </div>
</div>
@endsection
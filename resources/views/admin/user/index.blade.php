@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
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
                    {{ $user->total_pay }}
                </td>
            </tr>
            @endforeach
            </tbody>
    	</table>
    </div>
  </div>
</div>
@endsection
@extends('layouts.app')

@section('content')

<div class="container">
  
  <div class="row">
		<div class="col-md-12">
			<h1>{{ $user->first_name }} {{ $user->last_name }}</h1>
		</div>
	</div>
  <div class="row">
    <div class="col-md-6">
    	employee details here
    </div>
    <div class="col-md-6">
    	other employee details here
    </div>
	</div>
	<div class="row">
		<div class="col-md-12">
			@foreach($user->payPeriods as $payPeriod)

				<a href="{{ url('admin/pay_periods/' . $payPeriod->id) }}">{{ $payPeriod->start }} to {{ $payPeriod->end }}</a>
			@endforeach
			
		</div>
	</div>
</div>

@endsection
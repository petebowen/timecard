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
			table with payslips here once i've got it nice enough looking in the employee view
		</div>
	</div>
</div>

@endsection
@extends('layouts.app')

@section('content')

<div class="container"> 
  <div class="row">
  	<div class="col-md-12">
	  	<div class="panel panel-primary">
	  		<div class="panel-heading">
	  			<h3 class="panel-title">Time sheet</h3> 
	  		</div>
	  		<div class="panel-body">
	  			<p>For: <strong>{{ $payPeriod->user->first_name }} {{ $payPeriod->user->last_name}}</strong>

	  			<p>Period: <strong>{{ $payPeriod->start->toDateString() }}</strong> to <strong>{{ $payPeriod->end->toDateString() }}</strong>

	  			<p>Normal rate: <strong>£{{ $payPeriod->normal_rate }}</strong>
	  			<p>Overtime rate: <strong>£{{ $payPeriod->overtime_rate }}</strong>

	  			<div class="panel panel-primary">
	  				<div class="panel-body">
	  					<div class="row">
	  						<div class="col-md-4">
	  							<p>Total hours
	  							<p class="huge">{{ $payPeriod->normal_hours + $payPeriod->overtime_hours }}
	  						</div>
	  						<div class="col-md-4">
	  							<p>Normal time
	  							<p class="huge">{{ $payPeriod->normal_hours }}
	  						</div>
	  						<div class="col-md-4">
	  							<p>Overtime
	  							<p class="huge">{{ $payPeriod->overtime_hours }}
	  						</div>
	  					</div>
	  				</div>
	  			</div>
	  			<table class="table">
	  				<thead>
	  					<tr>
	  						<th>Date</th>
	  						<th>Time in</th>
	  						<th>Time out</th>
	  						<th class="text-right">Hours worked</th>
	  					</tr>
	  				</thead>
	  				<tbody>
	  					@foreach($payPeriod->workPeriods as$workPeriod)
	  					<tr>
	  						<td>
	  							{{ $workPeriod->work_date->toDateString() }}
	  						</td>
	  						<td>
	  							{{ $workPeriod->start }}
	  						</td>
	  						<td>
	  							{{ $workPeriod->end }}
	  						</td>
	  						<td class="text-right">
			             {{ $workPeriod->HoursWorked }}
			         </td>
	  					</tr>
	  					@endforeach
	  				</tbody>
	  			</table>
	  			<div class="row">
	  				<div class="col-md-4">
	  					<table class="table table-bordered">
    	  				<tbody>
    	  					<tr>
    	  						<th>Gross pay</th>
    	  						<td class="text-right">
                      £{{ $payPeriod->gross }}
                    </td>
    	  					</tr>
    	  					<tr>
    	  						<th>Tax</th>
    	  						<td class="text-right">
                      (£{{ $payPeriod->tax }})
                    </td>
    	  					</tr>
    	  					<tr>
    	  						<th>National insurance</th>
    	  						<td class="text-right">
                      (£{{ $payPeriod->national_insurance }})
                    </td>
    	  					</tr>
    	  					<tr>
    	  						<th>Net pay</th>
    	  						<td class="text-right">
                      <strong>£{{ $payPeriod->net }}</strong>
                    </td>
    	  					</tr>
    	  				</tbody>
    	  			</table>
	  				</div>
	  			</div>
	  		</div>
	  	</div>
	  </div>
	</div>
</div>

@endsection
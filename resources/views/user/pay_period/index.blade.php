@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
    	<div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Time sheets</h3>
        </div>
        <table class="table">
        	<thead>
        		<tr>
        			<th>Period</th>
        			<th class="text-right">Normal hours</th>
        			<th class="text-right">Overtime hours</th>
        			<th class="text-right">Normal rate</th>
        			<th class="text-right">Overtime rate</th>
        			<th class="text-right">Gross pay</th>
        			<th class="text-right">Tax</th>
        			<th class="text-right">National insurance</th>
        			<th class="text-right">Net pay</th>
        		</tr>
        	</thead>
        	<tbody>
        	
          	@foreach($payPeriods as $payPeriod)

    		   	<tr>
  		    		<td>
  		    			{{ $payPeriod->start->toDateString() }} to {{ $payPeriod->end->toDateString()}}
  		    		</td>
  		    		<td class="text-right">
  		    			{{ $payPeriod->normal_hours }}
  		    		</td>
  		    		<td class="text-right">
  		    			{{ $payPeriod->overtime_hours}}
  		    		</td>
  		    		<td class="text-right">
  		    			£{{ $payPeriod->normal_rate}}
  		    		</td>
  		    		<td class="text-right">
  		    			£{{ $payPeriod->overtime_rate}}
  		    		</td>
  		    		<td class="text-right">
  		    			£{{ $payPeriod->gross}}
  		    		</td>
  		    		<td class="text-right">
  		    			(£{{ $payPeriod->tax}})
  		    		</td>
  		    		<td class="text-right">
  		    			(£{{ $payPeriod->national_insurance}})
  		    		</td>
  		    		<td class="text-right">
  		    			<strong>£{{ $payPeriod->net}}</strong>
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
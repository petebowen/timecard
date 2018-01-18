@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
		<div class="col-md-12">
			<h1>{{ $user->first_name }} {{ $user->last_name }}</h1>
		</div>
	</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel panel-heading">
          <h3 class="panel-title">Personal details</h3>
        </div>
        <div class="panel-body">
          <p class="text-warning">Please note that changes to contract details will take effect at the start of the next pay period.
                    
          {!! Form::model(
            $user,
            ['action' => ['Admin\UserController@update', $user->id],
          ]) !!}
          {{ method_field('PUT') }}

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('first_name','First name') !!}
              {!! Form::text('first_name',null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('last_name','Last name') !!}
              {!! Form::text('last_name',null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('email','Email') !!}
              {!! Form::email('email',null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('tax_code','Tax code') !!}
              {!! Form::text('tax_code',null, ['class' => 'form-control']) !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('contracted_hours','Contracted hours') !!}
              {!! Form::text('contracted_hours',null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('normal_rate','Normal rate') !!}
              {!! Form::text('normal_rate',null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('overtime_rate','Overtime rate') !!}
              {!! Form::text('overtime_rate',null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary pull-right" style="margin-top:40px;">Save changes</button>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
	</div>
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
      			@foreach($user->payPeriods as $payPeriod)
  		    	<tr>
  		    		<td>
  		    			<a href="{{ url('admin/pay_periods/' . $payPeriod->id) }}">{{ $payPeriod->start->toDateString() }} to {{ $payPeriod->end->toDateString() }}</a>
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
  		    			£{{ $payPeriod->tax}}
  		    		</td>
  		    		<td class="text-right">
  		    			£{{ $payPeriod->national_insurance}}
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
</div>

@endsection
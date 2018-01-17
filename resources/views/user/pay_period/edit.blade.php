@extends('layouts.app')

<div class="container">
  <div class="row">
    <div class="col-md-12"> 
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit recorded times for the period {{$payPeriod->start->toDateString()}} to {{$payPeriod->end->toDateString()}}</h3>
        </div>
        <div class="panel-body">
            
        @foreach($payPeriod->workPeriods as $workPeriod)  
          <div class="row" style="margin-top: 20px;">
            <div class="col-md-2">
            	{{ $workPeriod->work_date->format('l') }}
            </div>
            <div class="col-md-10">

            {!! Form::model(
                $workPeriod,
                ['action' => ['User\WorkPeriodController@update', $workPeriod->id],
                'class' => 'form-inline'
                ]) !!}
                    		
                {{ method_field('PUT') }}

                	<div class="form-group">
                			{!! Form::label('start','Start') !!}
                			{!! Form::time('start') !!}
            			</div>

            			<div class="form-group">
                			{!! Form::label('end','End') !!}
                			{!! Form::time('end') !!}
            			</div>

                  <div class="form-group">
                		  <button type="submit" class="btn btn-default btn-sm">Save changes</button>
                  </div>
                {!! Form::close() !!}

            </div>
          </div> 
 	    @endforeach
  		  </div>
      </div>
    </div>
  </div>

@section('content')
@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Timesheet for the period {{$payPeriod->start->toDateString()}} to {{$payPeriod->end->toDateString()}}</h3>
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
                    		

                  @if($workPeriod->work_date->format('l') == $today)

                    @if($workPeriod->start == '00:00')
                      <div class="form-group">  
                        <input type="submit" name="clock_in" class="btn btn-success" value="Clock in">
                      </div>
                            
                      
                    @elseif($workPeriod->end == '00:00')
                      <div class="form-group">
                        <input type="submit" name="clock_out" class="btn btn-danger" value="Clock out">
                      </div>
                    @endif

                  @endif
                {!! Form::close() !!}

            </div>
          </div> 
 	    @endforeach
  		  </div>
      </div>
    </div>
  </div>
</div>


@endsection
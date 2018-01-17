@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12"> 
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Edit recorded times for the period {{$payPeriod->start->toDateString()}} to {{$payPeriod->end->toDateString()}}</h3>
        </div>
        <div class="panel-body">       
          @foreach($payPeriod->workPeriods as $workPeriod)  
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">
                    {{ $workPeriod->work_date->format('l\, Y-m-d') }}
                  </h3>
                </div>
                <div class="panel-body">
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
                      <button type="submit" class="btn btn-info">Save changes</button>
                  </div>

                {!! Form::close() !!}

                </div>	
            </div>
            </div>
          </div> 
 	    @endforeach
  		  </div>
      </div>
    </div>
  </div>

@endsection
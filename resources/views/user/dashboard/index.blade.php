@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row" style="margin-bottom: 40px;">
    <div class="col-md-12">

      {!! Form::model(
       $todaysWorkPeriod,
      ['action' => ['User\WorkPeriodController@update', $todaysWorkPeriod->id],
      'class' => 'form-inline'
      ]) !!}
                        
      {{ method_field('PUT') }}

      @if(!$todaysWorkPeriod->start)
        <div class="form-group">  
          <input type="submit" name="clock_in" class="btn btn-success btn-huge" value="Clock in now">
        </div>
      
      @elseif(!$todaysWorkPeriod->end)
        <div class="form-group">
          <input type="submit" name="clock_out" class="btn btn-danger btn-huge" value="Clock out now">
        </div>
     
      @endif
      {!! Form::close() !!}
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Time sheet</h3>
        </div>
        <div class="panel-body">
           <a href="{{ url('user/pay_periods/' . $payPeriod->id . '/edit') }}" class="pull-right">Edit time worked</a>
          <p>For: <strong>{{ $payPeriod->user->first_name }} {{ $payPeriod->user->last_name}}</strong>

          <p>Period: <strong>{{ $payPeriod->start->toDateString() }}</strong> to <strong>{{ $payPeriod->end->toDateString() }}</strong>

          <p>Normal rate: <strong>£{{ $payPeriod->normal_rate }}</strong>
          <p>Overtime rate: <strong>£{{ $payPeriod->overtime_rate }}</strong>


          <div class="panel panel-primary">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-4">
                  <p>Total hours
                  <p class="huge">{{ round($payPeriod->normal_hours + $payPeriod->overtime_hours, 2) }}
                </div>
                <div class="col-md-4">
                  <p>Normal time
                  <p class="huge">{{ round($payPeriod->normal_hours, 2) }}
                </div>
                <div class="col-md-4">
                  <p>Overtime
                  <p class="huge">{{ round($payPeriod->overtime_hours, 2) }}
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
              @foreach($payPeriod->workPeriods as $workPeriod)
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
                  {{ round($workPeriod->HoursWorked, 2) }}
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
                <td class="text-right">£{{ round($payPeriod->gross,2) }}</td>
              </tr>
              <tr>
                <th>Tax</th>
                <td class="text-right">(£{{ round($payPeriod->tax,2) }})</td>
              </tr>
              <tr>
                <th>National insurance</th>
                <td class="text-right">(£{{ round($payPeriod->national_insurance,2) }})</td>
              </tr>
              <tr>
                <th>Net pay</th>
                <td class="text-right"><strong>£{{ round($payPeriod->net,2) }}</strong></td>
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
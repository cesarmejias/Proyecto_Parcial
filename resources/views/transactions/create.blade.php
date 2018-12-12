@extends('admin.layout')

 @section('title', '| Create New Transaction')

 @section('content')
     <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <h1>Create New Transaction</h1>
        <hr>

   
         {{ Form::open(array('route' => 'transactions.store')) }}

        <div class="form-group">
            {{ Form::label('amount', 'Transaction Amount') }}
            {{ Form::textarea('amount', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::submit('Create Transaction', array('class' => 'btn btn-success btn-lg btn-block')) }}
            {{ Form::close() }}
        </div>
        </div>
    </div>

  @endsection
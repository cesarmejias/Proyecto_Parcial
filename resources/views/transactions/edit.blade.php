@extends('layouts.app')

@section('title', '| Edit Transaction')

@section('content')
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h1>Edit Transaction</h1>
        <hr>
            {{ Form::model($transaction, array('route' => array('transactions.update', $transaction->id), 'method' => 'PUT')) }}
            <div class="form-group">
            {{ Form::label('amount', 'Amount') }}
            {{ Form::text('amount', null, array('class' => 'form-control')) }}<br>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
    </div>
    </div>
</div>

@endsection
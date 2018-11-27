@extends('layouts.app')

@section('title', '| View Transaction')

@section('content')

<div class="container">

    <h1>{{ $transaction->amount }}</h1>
    <hr>
    <p class="lead">{{ $transaction->state }} </p>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['transactions.destroy', $transaction->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @can('Edit Transaction')
    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Transaction')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

@endsection
@extends('layouts.app')

@section('title', '| View Transaction')

@section('content')

<div class="container">


    <h1>Transaccion realizada por: {{ $transaction->user_name }}</h1>
    <hr>
    <h1>Categoria: {{ $transaction->category_name }}</h1>
    <hr>
    <h1>Cantidad: {{ $transaction->amount }}</h1>
    <hr>
    <h1>Creado: {{ $transaction->created_at->diffForHumans() }}</h1>
    <hr>
    <h1>Actualizado: {{ $transaction->updated_at->diffForHumans() }}</h1>
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
@extends('layouts.app')

@section('title', '| View Category')

@section('content')

<div class="container">


    
    <h1>Categoria: {{ $category->name }}</h1>
    <hr>
    <h1>Description: {{ $category->description }}</h1>
    <hr>
    <h1>Creado: {{ $category->created_at->diffForHumans() }}</h1>
    <hr>
    <h1>Actualizado: {{ $category->updated_at->diffForHumans() }}</h1>
    <hr>
    
    {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @can('Edit Category')
    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Category')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

@endsection
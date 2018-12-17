@extends('layouts.app')

 @section('title', '| Create New Transaction')

 @section('content')
     <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <h1>Create New Transaction</h1>
        <hr>

   
         {{ Form::open(array('route' => 'transactions.store')) }}
 
           <select name="category_id" id="category_id" class="form-control">
                 <ul>
                    <option value=''>Categoria</option>
                    @foreach($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </ul>
           </select>
            {{-- {{ Form::label('category_id', 'Category') }}
            {{ Form::text('category', null, array('class' => 'form-control')) }} --}}
            <br>
            <select name="state" id="state" class="form-control">
                <option value=''>Tipo de Transaccion</option>
                <option value="Deposito">DEPOSITO</option>
                <option value="Retiro">RETIRO</option>
           </select>
            <br>
            {{ Form::label('amount', 'Amount') }}
            {{ Form::text('amount', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::submit('Create Transaction', array('class' => 'btn btn-success btn-lg btn-block')) }}
            {{ Form::close() }}
        </div>
        </div>
    </div>

  @endsection
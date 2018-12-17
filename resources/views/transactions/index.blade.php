@extends('admin.layout')

@section('title', '| Transactions')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    @section('content-header')
    <h1><i class="fa fa-key"></i>Transactions</h1>
    <hr>
 
    <div class="page-header">
      <h1>
        {{Form::open(['route' =>'transactions.index','method' =>'GET','class'=>'form-inline pull-right'])}}

            <h6><label>Date</label></h6>
            <input type="date" name="date" class="form-control" >
            
            
            <div class="form-group">
            <select name="state" id="state" class="form-control">
                <option value=''>Tipo de Transaccion</option>
                <option value="Deposito">DEPOSITO</option>
                <option value="Retiro">RETIRO</option>
            </select>
            
            <select name="category" id="category" class="form-control">
                 <ul>
                    <option value=''>Categoria</option>
                    @foreach($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </ul>
           </select>
            </div> 

                                                            
             <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </div>
        {{Form::close()}}
      </h1>
    </div>

    @endsection
    <div class="panel-heading">Page {{ $transactions->currentPage() }} of {{ $transactions->lastPage() }}</div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Transaction</th>
                    <th>Cantidad</th>
                    <th>Categoria</th>
                    <th>Tipo de Transaccion</th>
                     @role('Admin')
                    <th>Operation</th>
                     @endrole
                </tr>
            </thead>

            <tbody>
                @foreach ($transactions as $transaction)
                <tr>

                    <td><a href="{{ route('transactions.show', $transaction->id ) }}"><b>{{ $transaction->id }}</b><br>
                    </td>
                     <td>{{ $transaction->amount }}
                     </td>
                     <td>{{ $transaction->category_name }}
                     </td>
                     <td>{{ $transaction->state }}
                     </td>

                    <td>
                        @role('Admin')
                    <a href="{{ URL::to('transactions/'.$transaction->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['transactions.destroy', $transaction->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    @endrole
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>


    <a href="{{ URL::to('transactions/create') }}" class="btn btn-success">New Transaction</a>
    <div class="text-center">
                        {!! $transactions->links() !!}
                    </div>

</div>

@endsection
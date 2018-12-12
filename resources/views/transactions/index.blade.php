{{-- @extends('admin.layout')
@section('content')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Transactions</h3></div>
                    <div class="panel-heading">Page {{ $transactions->currentPage() }} of {{ $transactions->lastPage() }}</div>
                    @foreach ($transactions as $transaction)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('transactions.show', $transaction->id ) }}"><b>{{ $transaction->title }}</b><br>
                                     <p class="teaser"> Transaction:
                                       {{  str_limit($transaction->id) }}
                                    </p>
                                    <p class="teaser"> Amount:
                                       {{  str_limit($transaction->amount) }}
                                    </p>
                                </a>
                            </li>
                        </div>
                    @endforeach
                    
                    </div>
                    <div class="text-center">
                        {!! $transactions->links() !!}
                    </div>
                </div>
            </div>
@endsection --}}

@extends('admin.layout')

@section('title', '| Transactions')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    @section('content-header')
    <h1><i class="fa fa-key"></i>Transactions</h1>
    <hr>
    @endsection
    <div class="panel-heading">Page {{ $transactions->currentPage() }} of {{ $transactions->lastPage() }}</div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Transaction</th>
                    <th>Cantidad</th>
                    <th>Operation</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($transactions as $transaction)
                <tr>

                    <td><a href="{{ route('transactions.show', $transaction->id ) }}"><b>{{ $transaction->id }}</b><br>
                    </td>
                     <td>{{ $transaction->amount }}
                     </td>
                    <td>
                    <a href="{{ URL::to('transactions/'.$transaction->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['transactions.destroy', $transaction->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

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
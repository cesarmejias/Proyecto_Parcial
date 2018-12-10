@extends('admin.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Transactions</h3></div>
                    <div class="panel-heading">Page {{ $transactions->currentPage() }} of {{ $transactions->lastPage() }}</div>
                    @foreach ($transactions as $transaction)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('transactions.show', $transaction->id ) }}"><b>{{ $transaction->title }}</b><br>
                                    <p class="teaser">
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
        </div>
@endsection
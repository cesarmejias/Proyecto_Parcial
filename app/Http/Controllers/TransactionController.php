<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transaction;
use Auth;
use Session;

class TransactionController extends Controller
{

        public function __construct() {
        $this->middleware(['auth'])->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderby('id', 'desc')->paginate(5); //show only 5 items at a time in descending order

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            //Validating amount field
        $this->validate($request, [
            'amount' =>'required',
            ]);

        $amount = $request['amount'];

        $transaction = Transaction::create($request->only('amount'));

    //Display a successful message upon save
        return redirect()->route('transactions.index')
            ->with('flash_message', 'Article,
             '. $transaction->amount.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id); //Find transaction of id = $id

        return view ('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'amount'=>'required',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->title = $request->input('amount');
        $transaction->save();

        return redirect()->route('transactions.show', 
            $transaction->id)->with('flash_message', 
            'Article, '. $transaction->amount.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('flash_message',
             'Transaction successfully deleted');
    }
}

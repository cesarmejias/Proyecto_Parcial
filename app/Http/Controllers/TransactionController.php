<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transaction;
use Auth;
use Session;
use App\Repositories\UserRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\CategoryRepository;
use App\User;
use App\Category;
use Carbon\Carbon;
use DB;
use Exception;

class TransactionController extends Controller
{
    /**
     * GroupRepository $groupRepository
     */
    protected $userRepository;

     /**
     * TransactionRepository $transactionRepository
     */
    protected $transactionRepository;

     /**
     * CategoryRepository $categoryRepository
     */
    protected $CategoryRepository;

        public function __construct(UserRepository $userRepository, TransactionRepository $transactionRepository, CategoryRepository $categoryRepository) {
        $this->middleware(['auth'])->except('index', 'show');
        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;
        $this->categoryRepository = $categoryRepository;
        Carbon::setlocale('es');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CategoryRepository $categoryRepository)
    {
        $categories = $this->categoryRepository->search([])->get();
        $state= $request->get('state');
        $category= $request->get('category');
        $date= $request->get('date');

        $transactions = Transaction::orderby('id', 'asc')
        ->State($state)
        ->Category($category)
        ->Date($date)
        ->paginate(5);

        return view('transactions.index', compact('transactions', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryRepository $categoryRepository)
    {
        $categories = $this->categoryRepository->search([])->get();
        return view('transactions.create', compact('categories'));
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
            'state' =>'required',
            ]);

        try {
            DB::beginTransaction();

            $params = array_merge($request->only('amount','state','category_id'), ['user_id' => \Auth::user()->id]);

            $this->transactionRepository->create($params);

            DB::commit();

            //Display a su ccessful message upon save
            return redirect()->route('transactions.index')->with('alert_success', 'Transaction creada satisfactoriamente!');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $transaction = $this->transactionRepository->getById($id);
       
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
        $transaction = $this->transactionRepository->getById($id);

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
            'Transaction, '. $transaction->amount.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = $this->transactionRepository->getById($id);
        $this->delete($user);

        return redirect()->route('transactions.index')
            ->with('flash_message',
             'Transaction successfully deleted');
    }
}

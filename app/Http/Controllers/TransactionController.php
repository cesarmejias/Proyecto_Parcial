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
    public function index()
    {
        $transactions = Transaction::orderby('id', 'asc')->paginate(5); //show only 5 items at a time in descending order

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
            ->with('flash_message', 'Transaction,
             '. $transaction->amount.' created');
    }


    $this->validate($request, [
            'name'=>'required|max:100',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);

        try{
            DB::beginTransaction();

            $user= $this->userRepository->create($request->only('email', 'name', 'password'));

            $roles = $request['roles']; //Retrieving the roles field
    //Checking if a role was selected
        if (isset($roles)) 
        {

            foreach ($roles as $role) {
            $role_r = Role::where('id', '=', $role)->firstOrFail();            
            $user->assignRole($role_r); //Assigning role to user
            }
        } 

            DB::commit();

            return redirect()->route('users.index')->with('alert_success', 'Usuario creado satisfactoriamente!');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use DB;
use Exception;
use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;

class UserController extends Controller 
{

     /**
     * UserRepository $userRepository
     */
    protected $userRepository;


    public function __construct(UserRepository $userRepository) {
        $this->middleware(['auth']);
        $this->userRepository = $userRepository;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index() {
    //Get all users and pass it to the view
        $users = $this->userRepository->search([])->get();
        return view('users.index')->with('users', $users);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create() {
    //Get all roles and pass it to the view
        $roles = Role::get();
        return view('users.create', ['roles'=>$roles]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request) {
    //Validate name, email and password fields
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
    public function show($id) {
        return redirect('users'); 
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id) {
        $user = $this->userRepository->getById($id);
        //$user = User::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles

        return view('users.edit', compact('user', 'roles')); //pass user and roles data to view

    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id) {
       
       //Validate name, email and password fields    
        $this->validate($request, [
            'name'=>'required|max:100',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'required|min:6|confirmed'
        ]);

         $user = $this->userRepository->getById($id); //Get role specified by id


        try {
            DB::beginTransaction();

            $this->userRepository->update($user, $request->only('name','email','password'));

            $roles = $request['roles']; //Retreive all roles

         if (isset($roles)) {        
             $user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
         }        
         else {
             $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
         }

            DB::commit();

            return redirect()->route('users.index')->with('alert_success', 'Datos de Usuario actualizados satisfactoriamente!');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id, UserRepository $userRepository ) {
    //Find a user with a given id and delete
        //$user = User::findOrFail($id); 
        //$user->delete();
        $user = $this->userRepository->getById($id);
        $this->userRepository->delete($user);

        return redirect()->route('users.index')
            ->with('flash_message',
             'User successfully deleted.');
    }
}
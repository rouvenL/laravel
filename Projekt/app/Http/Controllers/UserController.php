<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Auth;
use App\User;
use App\Company;

class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        $route = $request->route()->getName();
        $formData = $request->except(['_method', '_token']); // get every input from the form request
        $user = User::find($id); // get the ID of the User
        $validateData = $request->validate([
            'email' => 'unique:users,email,'.$user->id,
        ]);
        
            foreach($formData as $data => $value)
            {   
                if($value != null)
                {
                    if($data == 'password')//checks if input is a password
                    {
                        $user->$data = Hash::make($value); //hash the password
                    }
                    else
                    {
                        $user->$data = $value;   
                    }
                }
            }
            $user->save();
        
        if($route == 'admin.update')
        {
            return Redirect::route('admin');
        }
        
        else
        {
            return Redirect::route('home');
        }

    }
    
    public function index(Request $request)
    { 
        $route = $request->route()->getName();
        $id = $request->segment(count($request->segments()));
        $users = User::with('company')->get();
        $companies = Company::all();  
        $types = [ 0 => User::ADMIN_TYPE, 1 => User::DEFAULT_TYPE];
        
        if($route == 'admin' || $route == 'admin.update' || $route == 'admin.company.update') //checks if request is coming from an admin-route to return
        {                                                                                     //the correct view
            return view('admin')->with('users', $users)->with('types', $types)->with('companies', $companies)->with('id', $id);
        }
        
        else                           
        {
            $authUser = Auth::user();
            return view('edituser')->with('users', $users)->with('types', $types)->with('companies', $companies)->with('authUser', $authUser);// passes values to view
        }
        
    }
    
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        
        return Redirect::route('admin');
    }
    
    public function create(Request $request)
    {
        $company_id = Company::where('id', $request['company_id'])->first()->id; //get the company_id of the selected company
        
        User::create([
            'company_id' => $company_id,
            'surname' => $request['surname'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'type' => User::DEFAULT_TYPE, //Registered User is Admin -> if User::DEFAULT_TYPE Registered is not an Admin
        ]);
        
        return Redirect::route('admin');
    }
}

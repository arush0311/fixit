<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;
use App\Participent;
use Session;

class clientController extends Controller
{


    public function index()
    {

    	return redirect('home');

	}



	public function logout()
	{
		Session::forget('c_id');
		Session::forget('c_username');

		return redirect('login');
	}


	public function add(Request $request)
	{

		$this->validate($request,[
				'name' => 'required|unique:participents,name,NULL,id,c_id,'.Session::get('c_id')
			]);
		$participent = new Participent;
		$participent->name = $request->name;
		$participent->c_id = Session::get('c_id');
		$participent->save();
		Session::flash("message","The participent has been added successfully");
		return redirect('home');
	}

	public function home()
	{
		$username = Session::get('c_username');
		$fixtures=[];
		$participents = Participent::where('c_id',Session::get('c_id'))->get();
		$participents = $participents->toArray();
		$i =0;

		while(count($participents) > 0)
		{
			$rand1 = array_rand((array)$participents);
			$rand2 = array_rand((array)$participents);
			$fixtures[$i][0] = $participents[$rand1];
			$fixtures[$i][1] = $participents[$rand2];
			unset($participents[$rand1]);
			unset($participents[$rand2]);
			$i = $i + 1;

		}
		return view('client.home')->with('username',$username)->withFixtures($fixtures);
	}


	public function reset()
	{
		Participent::where('c_id',Session::get('c_id'))->delete();
		Session::flash("message","The record of all participents has been deleted.");
		return redirect('home');
	}




    public function login()
    {
    	if(Session::has('c_id'))
		{
			return redirect('home');
		}
		return view('client.login');
    }



    public function authenticate(Request $request)
    {

    	$validator = Validator::make($request->all(),[
    		'username' => 'required',
    		'password' => 'required'
    	]);

    	if ($validator->fails()) {
            return redirect('login')
          				->withErrors($validator)
                        ->withInput();
        }

    	$username = $request->username;
    	$password = sha1($request->password);

    	$client = Client::where('username','=',$username)->where('password','=',$password)->first();

    
    	if(!$client)
    	{
    		$validator->errors()->add('wrongDetails',"The Credentials you provided are Incorrect");
    		return redirect('login')
    				->withErrors($validator)
                    ->withInput();
    	 	   
		}

    	Session::put('c_id',$client->id);
    	Session::put('c_username',$client->username);
    	return redirect('home');
    }
}


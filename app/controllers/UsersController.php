<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
    public $restful = true;

	public function index()
	{
		$users = User::all();
		return View::make('users.index',array("data"=> json_encode($users)));
	}


    public function SignUp($userID,$user_category,$role_id,$password,$is_active,$is_pass_changed,$is_thirdparty_user,$potential_points,$global_rank,$created_on,$last_login_date,$last_updated_on)
    {
        $user = new User();
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }
        if($last_login_date!="")
        {
            $last_login_date =new DateTime($last_login_date);
        }
        $user->user_id=$userID ;
        $user->user_category = $user_category;
        $user->user_password=$password;
        $user->potential_points = $potential_points;
        $user->global_rank= $global_rank;
        $user->role_id = $role_id;
        $user->is_active = $is_active;
        $user->is_pass_changed = $is_pass_changed;
        $user->is_thirdparty_user = $is_thirdparty_user;
        $user->created_on = $created_on;
        $user->last_login_date = $last_login_date;
        $user->last_updated_on = $last_updated_on;
        $user->save();
        //return View::make('hello');

        return View::make("Users/Create.show",array("data"=> json_encode($user)));
    }
	/**
	 * Show the form for creating a new user
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}

	/**
	 * Create a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), User::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		User::create($data);

		return Redirect::route('users.index');
	}

	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $user = DB::table('users')->where('user_id', $id)->first();

		return View::make('users.index', array("data"=> json_encode($user)));
	}

	/**
	 * Show the form for editing the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($userID,$user_category,$role_id,$password,$is_active,$is_pass_changed,$is_thirdparty_user,$potential_points,$global_rank,$created_on,$last_login_date,$last_updated_on)
	{


        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }
        if($last_login_date!="")
        {
            $last_login_date =new DateTime($last_login_date);
        }

        //$user->save();
        DB::table('users')
            ->where('user_id', $userID)
            ->update(array('user_category' =>$user_category,'role_id'=>$role_id,'user_password'=>$password,'potential_points'=>$potential_points,'global_rank'=>$global_rank,
                'is_active'=>$is_active,'is_pass_changed'=>$is_pass_changed,'is_thirdparty_user'=>$is_thirdparty_user,'created_on'=>$created_on,'last_login_date'=>$last_login_date,
                 'last_updated_on'=>$last_updated_on));

        $user = DB::table('users')->where('user_id', $userID)->first();
        return View::make("Users/Update.show",array("data"=> json_encode($user)));
	}

	/**
	 * Update the specified user in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::findOrFail($id);

		$validator = Validator::make($data = Input::all(), User::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user->update($data);

		return Redirect::route('users.index');
	}

	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        DB::table('users')->where('user_id', $id)->delete();

		return View::make('Users/Delete.index',array("data"=>'1'));
	}

}

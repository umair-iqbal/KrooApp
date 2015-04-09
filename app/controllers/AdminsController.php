<?php

class AdminsController extends \BaseController {

	/**
	 * Display a listing of admins
	 *
	 * @return Response
	 */

    public $restful = true;
	public function index()
	{
		$admins = Admin::all();
        return View::make('admins.index',array("data"=> json_encode($admins)));
	}

	/**
	 * Show the form for creating a new admin
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admins.create');
	}

	/**
	 * Create a newly created admin in storage.
	 *
	 * @return Response
	 */
    public function store($adminID,$password,$is_active,$created_on,$last_login_date,$last_updated_on)
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
        DB::table('admins')
            ->insert(array('admin_id'=> $adminID,'admin_password'=>$password,'is_active'=>$is_active,'created_on'=>$created_on,'last_login_date'=>$last_login_date,
                'last_updated_on'=>$last_updated_on));

        $admin = DB::table('admins')->where('admin_id', $adminID)->first();
        return View::make("admins/Create.index",array("data"=> json_encode($admin)));
    }

	/**
	 * Display the specified admin.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $user = DB::table('admins')->where('admin_id', $id)->first();

        return View::make('admins.index', array("data"=> json_encode($user)));
	}

	/**
	 * Show the form for editing the specified admin.
	 *
	 * @param  int  $userID
	 * @return Response
	 */
    public function edit($adminID,$password,$is_active,$created_on,$last_login_date,$last_updated_on)
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
        DB::table('admins')
            ->where('admin_id', $adminID)
            ->update(array('admin_password'=>$password,'is_active'=>$is_active,'created_on'=>$created_on,'last_login_date'=>$last_login_date,
                'last_updated_on'=>$last_updated_on));

        $admin = DB::table('admins')->where('admin_id', $adminID)->first();
        return View::make("admins/Update.index",array("data"=> json_encode($admin)));
    }

	/**
	 * Update the specified admin in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$admin = Admin::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Admin::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$admin->update($data);

		return Redirect::route('admins.index');
	}

	/**
	 * Remove the specified admin from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $admin = DB::table('admins')->where('admin_id', $id)->first();
        if($admin!=null) {
            DB::table('admins')->where('admin_id', $id)->delete();
            $admin = DB::table('admins')->where('admin_id', $id)->first();
            if ($admin == null)
                return View::make('admins/Delete.index', array("data" => '1'));
            else
                return View::make('admins/Delete.index', array("data" => '0'));
        }
        else
            return View::make('admins/Delete.index', array("data" => '0'));

	}

}

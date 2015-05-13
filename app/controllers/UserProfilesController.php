<?php

class UserProfilesController extends \BaseController {

	/**
	 * Display a listing of userprofiles
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$userprofiles = Userprofile::all();
        return View::make('user_profiles.index',array("data"=> json_encode($userprofiles)));
	}

	/**
	 * Show the form for creating a new userprofile
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('userprofiles.create');
	}

	/**
	 * Store a newly created userprofile in storage.
	 *
	 * @return Response
	 */
    public function store($user_id,$full_name,$phone_no,$dob,$country,$gender,$is_active,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }

        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }


        //$user->save();
        DB::table('user_profiles')
            ->insert(array('user_id'=> $user_id,'full_name'=>$full_name,'phone_no'=>$phone_no,'dob'=>$dob,'country'=>$country,'gender'=>$gender,'is_active'=>$is_active,'created_on'=>$created_on,'last_updated_on'=>$last_updated_on));

        $role = DB::table('user_profiles')->where('user_id', $user_id)->first();
        return View::make("user_profiles/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Display the specified userprofile.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

        $role = DB::table('user_profiles')->where('sr_no', $id)->first();

        return View::make('user_profiles.index', array("data"=> json_encode($role)));
	}


    /**
     * @param $id
     * @return mixed
     */
    public function showByEmail($id)
    {

        $data = DB::table('users')->where('user_id', $id)->first();
        if($data!=null)
        {
            return View::make('user_profiles.index', array("data"=> 'Success :' .json_encode($data)));
        }
       else{
           return Response::json(array('response-code' => '405', 'response-message' => 'user not exist.'));
       }


    }

	/**
	 * Show the form for editing the specified userprofile.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$user_id,$full_name,$phone_no,$dob,$country,$gender,$is_active,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }

        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }


        //$user->save();
        DB::table('user_profiles')
            ->where('sr_no',$sr_no)
            ->update(array('user_id'=> $user_id,'full_name'=>$full_name,'phone_no'=>$phone_no,'dob'=>$dob,'country'=>$country,'gender'=>$gender,'is_active'=>$is_active,'created_on'=>$created_on,'last_updated_on'=>$last_updated_on));

        $role = DB::table('user_profiles')->where('sr_no', $sr_no)->first();
        return View::make("user_profiles/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Update the specified userprofile in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$userprofile = Userprofile::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Userprofile::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$userprofile->update($data);

		return Redirect::route('userprofiles.index');
	}

	/**
	 * Remove the specified userprofile from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $role = DB::table('user_profiles')->where('sr_no', $id)->first();
        if($role!=null) {
            DB::table('user_profiles')->where('sr_no', $id)->delete();
            $role = DB::table('user_profiles')->where('sr_no', $id)->first();
            if ($role == null)
                return View::make('user_profiles/Delete.index', array("data" => '1'));
            else
                return View::make('user_profiles/Delete.index', array("data" => '0'));
        }
        else
            return View::make('user_profiles/Delete.index', array("data" => '0'));

    }

}

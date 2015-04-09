<?php

class AdminProfilesController extends \BaseController {

	/**
	 * Display a listing of adminprofiles
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$adminprofiles = Adminprofile::all();

        return View::make('Admin_profiles.index',array("data"=> json_encode($adminprofiles)));
	}



	/**
	 * Show the form for creating a new adminprofile
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('adminprofiles.create');
	}

	/**
	 * Store a newly created adminprofile in storage.
	 *
	 * @return Response
	 */
    public function store($adminID,$full_name,$phone,$dob,$country,$gender,$is_active,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }

        DB::table('admin_profiles')
            ->insert(array('admin_id'=> $adminID,'full_name'=>$full_name,'dob'=>$dob,'phone'=>$phone,'country'=>$country,'gender'=>$gender,'is_active'=>$is_active,'created_on'=>$created_on,
                'last_updated_on'=>$last_updated_on));

        $adminprofiles = DB::table('admin_profiles')->where('admin_id', $adminID)->first();
        return View::make('Admin_profiles/Create.index',array("data"=> json_encode($adminprofiles)));
    }

	/**
	 * Display the specified adminprofile.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $admin_profiles = DB::table('admin_profiles')->where('sr_no', $id)->first();

        return View::make('Admin_profiles.index',array("data"=> json_encode($admin_profiles)));
	}

	/**
	 * Show the form for editing the specified adminprofile.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($id,$adminID,$full_name,$phone,$dob,$country,$gender,$is_active,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }

        DB::table('admin_profiles')
            ->where('sr_no', $id)
            ->update(array('admin_id'=> $adminID,'full_name'=>$full_name,'dob'=>$dob,'phone'=>$phone,'country'=>$country,'gender'=>$gender,'is_active'=>$is_active,'created_on'=>$created_on,
                'last_updated_on'=>$last_updated_on));

        $adminprofiles = DB::table('admin_profiles')->where('sr_no', $id)->first();
        return View::make('Admin_profiles/Update.index',array("data"=> json_encode($adminprofiles)));
    }

	/**
	 * Update the specified adminprofile in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$adminprofile = Adminprofile::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Adminprofile::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$adminprofile->update($data);

		return Redirect::route('adminprofiles.index');
	}

	/**
	 * Remove the specified adminprofile from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $admin = DB::table('admin_profiles')->where('sr_no', $id)->first();
        if($admin!=null) {
            DB::table('admin_profiles')->where('sr_no', $id)->delete();
            $admin = DB::table('admin_profiles')->where('sr_no', $id)->first();
            if ($admin == null)
                return View::make('Admin_profiles/Delete.index', array("data" => '1'));
            else
                return View::make('Admin_profiles/Delete.index', array("data" => '0'));
        }
        else
            return View::make('Admin_profiles/Delete.index', array("data" => '0'));
    }

}

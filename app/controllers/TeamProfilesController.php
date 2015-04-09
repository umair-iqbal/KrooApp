<?php

class TeamProfilesController extends \BaseController {

	/**
	 * Display a listing of teamprofiles
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$teamprofiles = Teamprofile::all();
        return View::make('Team_profiles.index',array("data"=> json_encode($teamprofiles)));
	}

	/**
	 * Show the form for creating a new teamprofile
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('teamprofiles.create');
	}

	/**
	 * Store a newly created teamprofile in storage.
	 *
	 * @return Response
	 */
    public function store($teamID,$email,$phone_no,$is_active,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }

        DB::table('team_profiles')
            ->insert(array('team_id'=> $teamID,'email'=>$email,'phone_no'=>$phone_no,'is_active'=>$is_active,'created_on'=>$created_on,
                'last_updated_on'=>$last_updated_on));

        $adminprofiles = DB::table('team_profiles')->where('team_id', $teamID)->first();
        return View::make('Team_profiles/Create.index',array("data"=> json_encode($adminprofiles)));
    }

	/**
	 * Display the specified teamprofile.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $team_profiles = DB::table('team_profiles')->where('sr_no', $id)->first();
        return View::make('Team_profiles.index',array("data"=> json_encode($team_profiles)));
	}

	/**
	 * Show the form for editing the specified teamprofile.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$teamID,$email,$phone_no,$is_active,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }

        DB::table('team_profiles')
            ->where('sr_no',$sr_no)
            ->update(array('team_id'=> $teamID,'email'=>$email,'phone_no'=>$phone_no,'is_active'=>$is_active,'created_on'=>$created_on,
                'last_updated_on'=>$last_updated_on));

        $Teamprofiles = DB::table('team_profiles')->where('team_id', $teamID)->first();
        return View::make('Team_profiles/Create.index',array("data"=> json_encode($Teamprofiles)));
    }

	/**
	 * Update the specified teamprofile in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$teamprofile = Teamprofile::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Teamprofile::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$teamprofile->update($data);

		return Redirect::route('teamprofiles.index');
	}

	/**
	 * Remove the specified teamprofile from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $admin = DB::table('team_profiles')->where('sr_no', $id)->first();
        if($admin!=null) {
            DB::table('team_profiles')->where('sr_no', $id)->delete();
            $admin = DB::table('team_profiles')->where('sr_no', $id)->first();
            if ($admin == null)
                return View::make('Team_profiles/Delete.index', array("data" => '1'));
            else
                return View::make('Team_profiles/Delete.index', array("data" => '0'));
        }
        else
            return View::make('Team_profiles/Delete.index', array("data" => '0'));
    }

}

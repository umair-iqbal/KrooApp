<?php

class TeamAvatarsController extends \BaseController {

	/**
	 * Display a listing of teamavatars
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$teamavatars = Teamavatar::all();

        return View::make('Team_avatars.index',array("data"=> json_encode($teamavatars)));
	}

	/**
	 * Show the form for creating a new teamavatar
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('teamavatars.create');
	}

	/**
	 * Store a newly created teamavatar in storage.
	 *
	 * @return Response
	 */
    public function store($teamID,$avatar_id,$is_current_avatar,$is_active,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }

        DB::table('Team_avatars')
            ->insert(array('team_id'=> $teamID,'avatar_id'=>$avatar_id,'is_current_avatar'=>$is_current_avatar,'is_active'=>$is_active,'created_on'=>$created_on,
                'last_updated_on'=>$last_updated_on));

        $adminprofiles = DB::table('team_avatars')->where('team_id', $teamID)->first();
        return View::make('Team_avatars/Create.index',array("data"=> json_encode($adminprofiles)));
    }

	/**
	 * Display the specified teamavatar.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $Team_avatars = DB::table('team_avatars')->where('sr_no', $id)->first();
        return View::make('Team_avatars.index',array("data"=> json_encode($Team_avatars)));
	}

	/**
	 * Show the form for editing the specified teamavatar.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$teamID,$avatar_id,$is_current_avatar,$is_active,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }

        DB::table('team_avatars')
            ->where('s_no',$sr_no)
            ->update(array('team_id'=> $teamID,'avatar_id'=>$avatar_id,'is_current_avatar'=>$is_current_avatar,'is_active'=>$is_active,'created_on'=>$created_on,
                'last_updated_on'=>$last_updated_on));

        $adminprofiles = DB::table('team_avatars')->where('sr_no', $sr_no)->first();
        return View::make('Team_avatars/Create.index',array("data"=> json_encode($adminprofiles)));
    }

	/**
	 * Update the specified teamavatar in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$teamavatar = Teamavatar::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Teamavatar::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$teamavatar->update($data);

		return Redirect::route('teamavatars.index');
	}

	/**
	 * Remove the specified teamavatar from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $admin = DB::table('team_avatars')->where('sr_no', $id)->first();
        if($admin!=null) {
            DB::table('team_avatars')->where('sr_no', $id)->delete();
            $admin = DB::table('team_avatars')->where('sr_no', $id)->first();
            if ($admin == null)
                return View::make('Team_avatars/Delete.index', array("data" => '1'));
            else
                return View::make('Team_avatars/Delete.index', array("data" => '0'));
        }
        else
            return View::make('Team_avatars/Delete.index', array("data" => '0'));
    }

}

<?php

class TeamsController extends \BaseController {

	/**
	 * Display a listing of teams
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$teams = Team::all();

        return View::make('teams.index',array("data"=> json_encode($teams)));
	}

	/**
	 * Show the form for creating a new team
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('teams.create');
	}

	/**
	 * Store a newly created team in storage.
	 *
	 * @return Response
	 */
    public function store($team_id,$league_id,$api_team_id,$is_active,$is_pass_changed,$created_on,$last_login_date,$last_updated_on,$team_password)
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
        DB::table('teams')
            ->insert(array('team_id'=> $team_id,'$league_id'=>$league_id,'api_team_id'=>$api_team_id,'is_active'=>$is_active,'is_pass_changed'=>$is_pass_changed,'created_on'=>$created_on,'last_login_date'=>$last_login_date,'last_updated_on'=>$last_updated_on,
                'team_password'=>$team_password));

        $role = DB::table('teams')->where('team_id', $team_id)->first();
        return View::make("teams/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Display the specified team.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

        $role = DB::table('teams')->where('team_id', $id)->first();

        return View::make('teams.index', array("data"=> json_encode($role)));
	}

	/**
	 * Show the form for editing the specified team.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($team_id,$league_id,$api_team_id,$is_active,$is_pass_changed,$created_on,$last_login_date,$last_updated_on,$team_password)
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
        DB::table('teams')
            ->where('team_id',$team_id)
            ->update(array('team_id'=> $team_id,'$league_id'=>$league_id,'api_team_id'=>$api_team_id,'is_active'=>$is_active,'is_pass_changed'=>$is_pass_changed,'created_on'=>$created_on,'last_login_date'=>$last_login_date,'last_updated_on'=>$last_updated_on,
                'team_password'=>$team_password));

        $role = DB::table('teams')->where('team_id', $team_id)->first();
        return View::make("teams/Create.index",array("data"=> json_encode($role)));
    }
	/**
	 * Update the specified team in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$team = Team::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Team::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$team->update($data);

		return Redirect::route('teams.index');
	}

	/**
	 * Remove the specified team from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $role = DB::table('teams')->where('team_id', $id)->first();
        if($role!=null) {
            DB::table('teams')->where('team_id', $id)->delete();
            $role = DB::table('teams')->where('team_id', $id)->first();
            if ($role == null)
                return View::make('teams/Delete.index', array("data" => '1'));
            else
                return View::make('teams/Delete.index', array("data" => '0'));
        }
        else
            return View::make('teams/Delete.index', array("data" => '0'));

    }

}

<?php

class LeagueTeamsController extends \BaseController {

	/**
	 * Display a listing of leagueteams
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
        $data = Input::all();
        if($data!=null) {
            $match = ['league_id' => $data['league_id'], 'is_active' => 'Y'];
            $leagueteams = DB::table('league_teams')->where($match)->get();
            if($leagueteams!=null) {
                return Response::json(array('status' => 200, 'datajson' => $leagueteams));
            }
            else
            {
                return Response::json(array('status' => 200, 'datajson' => null ,'status_message'=>'no record found'));
            }
        }
        else{
            $leagueteams = DB::table('league_teams')->where('is_active','Y')->get();

            if($leagueteams!=null) {
                return Response::json(array('status' => 200, 'datajson' => $leagueteams));
            }
            else
            {
                return Response::json(array('status' => 200, 'datajson' => null ,'status_message'=>'no record found'));
            }
        }
	}

	/**
	 * Show the form for creating a new leagueteam
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('leagueteams.create');
	}

	/**
	 * Store a newly created leagueteam in storage.
	 *
	 * @return Response
	 */
    public function store($teamID,$team_name,$team_abbr,$division_id,$division_name,$venue,$city,$country,$league_id,$is_active,$created_on,$last_updated_on)
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
        DB::table('league_teams')
            ->insert(array('team_id'=> $teamID,'team_name'=>$team_name,'team_abbr'=>$team_abbr,'division_id'=>$division_id,'division_name'=>$division_name,'venue'=>$venue,'city'=>$city,
                'country'=>$country,'league_id'=>$league_id,'is_active'=>$is_active,'created_on'=>$created_on,'last_updated_on'=>$last_updated_on));

        $league = DB::table('league_teams')->where('team_id', $teamID)->first();
        return View::make("League_teams/Create.index",array("data"=> json_encode($league)));
    }

	/**
	 * Display the specified leagueteam.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $League_teams = DB::table('league_teams')->where('team_id', $id)->first();
        return View::make('League_teams.index', array("data"=> json_encode($League_teams)));
	}

	/**
	 * Show the form for editing the specified leagueteam.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($teamID,$team_name,$team_abbr,$division_id,$division_name,$venue,$city,$country,$league_id,$is_active,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }

        DB::table('League_teams')
            ->where('team_id',$teamID)
            ->update(array('team_id'=> $teamID,'team_name'=>$team_name,'team_abbr'=>$team_abbr,'division_id'=>$division_id,'division_name'=>$division_name,'venue'=>$venue,'city'=>$city,
                'country'=>$country,'league_id'=>$league_id,'is_active'=>$is_active,'created_on'=>$created_on,'last_updated_on'=>$last_updated_on));

        $league = DB::table('League_teams')->where('team_id', $teamID)->first();
        return View::make("League_teams/Update.index",array("data"=> json_encode($league)));
    }

	/**
	 * Update the specified leagueteam in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$leagueteam = Leagueteam::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Leagueteam::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$leagueteam->update($data);

		return Redirect::route('leagueteams.index');
	}

	/**
	 * Remove the specified leagueteam from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $league = DB::table('league_teams')->where('team_id', $id)->first();
        if($league!=null) {
            DB::table('league_teams')->where('team_id', $id)->delete();
            $league = DB::table('league_teams')->where('team_id', $id)->first();
            if ($league == null)
                return View::make('League_teams/Delete.index', array("data" => '1'));
            else
                return View::make('League_teams/Delete.index', array("data" => '0'));
        }
        else
            return View::make('League_teams/Delete.index', array("data" => '0'));

    }

}

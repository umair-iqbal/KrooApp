<?php

class NflLiveEventScoresController extends \BaseController {

	/**
	 * Display a listing of nflliveeventscores
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$nflliveeventscores = Nflliveeventscore::all();

        return View::make('nfl_live_event_scores.index',array("data"=> json_encode($nflliveeventscores)));
	}

	/**
	 * Show the form for creating a new nflliveeventscore
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('nflliveeventscores.create');
	}

	/**
	 * Store a newly created nflliveeventscore in storage.
	 *
	 * @return Response
	 */
    public function store($event_id,$quarter_no,$h_points,$a_points,$h_yards,$a_yards,$h_pass_yards,$a_pass_yards,$h_rush_yards,$a_rush_yards,$h_total_turnovers,
                          $a_total_turnovers,$h_first_downs,$a_first_downs,$h_kick_off,$a_kick_off,$h_punt_return,$a_punt_return,$h_total_touchdowns,$a_total_touchdowns
        ,$h_field_goals_made,$a_field_goals_made,$h_total_fumbles_lost,$a_total_fumbles_lost,$h_total_interceptions,$a_total_interceptions,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="") {
            $last_updated_on = new DateTime($last_updated_on);
        }

        DB::table('nfl_live_event_scores')
            ->insert(array('event_id'=>$event_id,'quarter_no'=>$quarter_no,'h_points'=> $h_points,'a_points'=>$a_points,'h_yards'=>$h_yards,'a_yards'=>$a_yards,
                'h_pass_yards'=>$h_pass_yards,'a_pass_yards'=>$a_pass_yards,'h_rush_yards'=>$h_rush_yards,'a_rush_yards'=>$a_rush_yards,'h_total_turnovers'=>$h_total_turnovers,'a_total_turnovers'=>$a_total_turnovers,
                'h_first_downs'=>$h_first_downs,'a_first_downs'=>$a_first_downs,'h_kick_off'=>$h_kick_off,'a_kick_off'=>$a_kick_off,'h_punt_return'=>$h_punt_return,'a_punt_return'=>$a_punt_return,
                'h_total_touchdowns'=>$h_total_touchdowns,'a_total_touchdowns'=>$a_total_touchdowns,'h_field_goals_made'=>$h_field_goals_made,'a_field_goals_made'=>$a_field_goals_made,
                'h_total_fumbles_lost'=>$h_total_fumbles_lost,'a_total_fumbles_lost'=>$a_total_fumbles_lost,'h_total_interceptions'=>$h_total_interceptions,'a_total_interceptions'=>$a_total_interceptions,'created_on'=>$created_on, 'last_updated_on'=>$last_updated_on));

        $league = DB::table('nfl_live_event_scores')->where('event_id', $event_id)->first();
        return View::make("nfl_live_event_scores/Create.index",array("data"=> json_encode($league)));
    }
	/**
	 * Display the specified nflliveeventscore.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $nfl_live_event_scores = DB::table('nfl_live_event_scores')->where('sr_no', $id)->first();
        return View::make('nfl_live_event_scores.index', array("data"=> json_encode($nfl_live_event_scores)));
	}

	/**
	 * Show the form for editing the specified nflliveeventscore.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$event_id,$quarter_no,$h_points,$a_points,$h_yards,$a_yards,$h_pass_yards,$a_pass_yards,$h_rush_yards,$a_rush_yards,$h_total_turnovers,
                         $a_total_turnovers,$h_first_downs,$a_first_downs,$h_kick_off,$a_kick_off,$h_punt_return,$a_punt_return,$h_total_touchdowns,$a_total_touchdowns
        ,$h_field_goals_made,$a_field_goals_made,$h_total_fumbles_lost,$a_total_fumbles_lost,$h_total_interceptions,$a_total_interceptions,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="") {
            $last_updated_on = new DateTime($last_updated_on);
        }

        DB::table('nfl_live_event_scores')
            ->where('sr_no',$sr_no)
            ->update(array('event_id'=>$event_id,'quarter_no'=>$quarter_no,'h_points'=> $h_points,'a_points'=>$a_points,'h_yards'=>$h_yards,'a_yards'=>$a_yards,
                'h_pass_yards'=>$h_pass_yards,'a_pass_yards'=>$a_pass_yards,'h_rush_yards'=>$h_rush_yards,'a_rush_yards'=>$a_rush_yards,'h_total_turnovers'=>$h_total_turnovers,'a_total_turnovers'=>$a_total_turnovers,
                'h_first_downs'=>$h_first_downs,'a_first_downs'=>$a_first_downs,'h_kick_off'=>$h_kick_off,'a_kick_off'=>$a_kick_off,'h_punt_return'=>$h_punt_return,'a_punt_return'=>$a_punt_return,
                'h_total_touchdowns'=>$h_total_touchdowns,'a_total_touchdowns'=>$a_total_touchdowns,'h_field_goals_made'=>$h_field_goals_made,'a_field_goals_made'=>$a_field_goals_made,
                'h_total_fumbles_lost'=>$h_total_fumbles_lost,'a_total_fumbles_lost'=>$a_total_fumbles_lost,'h_total_interceptions'=>$h_total_interceptions,'a_total_interceptions'=>$a_total_interceptions,'created_on'=>$created_on, 'last_updated_on'=>$last_updated_on));

        $league = DB::table('nfl_live_event_scores')->where('sr_no', $sr_no)->first();
        return View::make("nfl_live_event_scores/Create.index",array("data"=> json_encode($league)));
    }

	/**
	 * Update the specified nflliveeventscore in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$nflliveeventscore = Nflliveeventscore::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Nflliveeventscore::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$nflliveeventscore->update($data);

		return Redirect::route('nflliveeventscores.index');
	}

	/**
	 * Remove the specified nflliveeventscore from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $league = DB::table('nfl_live_event_scores')->where('sr_no', $id)->first();
        if($league!=null) {
            DB::table('nfl_live_event_scores')->where('sr_no', $id)->delete();
            $league = DB::table('nfl_live_event_scores')->where('sr_no', $id)->first();
            if ($league == null)
                return View::make('nfl_live_event_scores/Delete.index', array("data" => '1'));
            else
                return View::make('nfl_live_event_scores/Delete.index', array("data" => '0'));
        }
        else
            return View::make('nfl_live_event_scores/Delete.index', array("data" => '0'));
    }

}

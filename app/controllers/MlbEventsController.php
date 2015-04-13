<?php

class MlbEventsController extends \BaseController {

	/**
	 * Display a listing of mlbevents
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$mlbevents = Mlbevent::all();

        return View::make('mlb_events.index',array("data"=> json_encode($mlbevents)));
	}

	/**
	 * Show the form for creating a new mlbevent
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('mlbevents.create');
	}

	/**
	 * Store a newly created mlbevent in storage.
	 *
	 * @return Response
	 */
    public function store($event_id,$season_id,$season_year,$season_type,$league_id,$status,$home_team_id,$away_team_id,$venue_id,$venue_name,
        $venue_city,$venue_country,$venue_zip,$venue_state,$is_active,$created_on,$schedduled_on,$last_update_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_update_on!="") {
            $last_update_on = new DateTime($last_update_on);
        }
        if($schedduled_on!="")
        {
            $schedduled_on =new DateTime($schedduled_on);
        }

        DB::table('mlb_events')
            ->insert(array('event_id'=>$event_id,'season_id'=> $season_id,'season_year'=>$season_year,'season_type'=>$season_type,'league_id'=>$league_id,
                'status'=>$status,'home_team_id'=>$home_team_id,'away_team_id'=>$away_team_id,'venue_id'=>$venue_id,'venue_name'=>$venue_name,'venue_city'=>$venue_city,
                'venue_country'=>$venue_country,'venue_zip'=>$venue_zip,'venue_state'=>$venue_state,'is_active'=>$is_active,'created_on'=>$created_on,
                'schedduled_on'=>$schedduled_on,'last_update_on'=>$last_update_on));

        $league = DB::table('mlb_events')->where('event_id', $event_id)->first();
        return View::make("mlb_events/Create.index",array("data"=> json_encode($league)));
    }

	/**
	 * Display the specified mlbevent.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $mlb_events = DB::table('mlb_events')->where('event_id', $id)->first();
        return View::make('mlb_events.index', array("data"=> json_encode($mlb_events)));
	}

	/**
	 * Show the form for editing the specified mlbevent.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($event_id,$season_id,$season_year,$season_type,$league_id,$status,$home_team_id,$away_team_id,$venue_id,$venue_name,
                          $venue_city,$venue_country,$venue_zip,$venue_state,$is_active,$created_on,$schedduled_on,$last_update_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_update_on!="") {
            $last_update_on = new DateTime($last_update_on);
        }
        if($schedduled_on!="")
        {
            $schedduled_on =new DateTime($schedduled_on);
        }

        DB::table('mlb_events')
            ->where('event_id',$event_id)
            ->update(array('event_id'=>$event_id,'season_id'=> $season_id,'season_year'=>$season_year,'season_type'=>$season_type,'league_id'=>$league_id,
                'status'=>$status,'home_team_id'=>$home_team_id,'away_team_id'=>$away_team_id,'venue_id'=>$venue_id,'venue_name'=>$venue_name,'venue_city'=>$venue_city,
                'venue_country'=>$venue_country,'venue_zip'=>$venue_zip,'venue_state'=>$venue_state,'is_active'=>$is_active,'created_on'=>$created_on,
                'schedduled_on'=>$schedduled_on,'last_update_on'=>$last_update_on));

        $league = DB::table('mlb_events')->where('event_id', $event_id)->first();
        return View::make("mlb_events/Create.index",array("data"=> json_encode($league)));
    }

	/**
	 * Update the specified mlbevent in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$mlbevent = Mlbevent::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Mlbevent::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$mlbevent->update($data);

		return Redirect::route('mlbevents.index');
	}

	/**
	 * Remove the specified mlbevent from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $league = DB::table('mlb_events')->where('event_id', $id)->first();
        if($league!=null) {
            DB::table('mlb_events')->where('event_id', $id)->delete();
            $league = DB::table('mlb_events')->where('event_id', $id)->first();
            if ($league == null)
                return View::make('mlb_events/Delete.index', array("data" => '1'));
            else
                return View::make('mlb_events/Delete.index', array("data" => '0'));
        }
        else
            return View::make('mlb_events/Delete.index', array("data" => '0'));
    }

}

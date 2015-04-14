<?php

class NbaLiveEventsController extends \BaseController {

	/**
	 * Display a listing of nbaliveevents
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$nbaliveevents = Nbaliveevent::all();
        return View::make('nba_live_events.index',array("data"=> json_encode($nbaliveevents)));
	}

	/**
	 * Show the form for creating a new nbaliveevent
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('nbaliveevents.create');
	}

	/**
	 * Store a newly created nbaliveevent in storage.
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

        DB::table('nba_live_events')
            ->insert(array('event_id'=>$event_id,'season_id'=> $season_id,'season_year'=>$season_year,'season_type'=>$season_type,'league_id'=>$league_id,
                'status'=>$status,'home_team_id'=>$home_team_id,'away_team_id'=>$away_team_id,'venue_id'=>$venue_id,'venue_name'=>$venue_name,'venue_city'=>$venue_city,
                'venue_country'=>$venue_country,'venue_zip'=>$venue_zip,'venue_state'=>$venue_state,'is_active'=>$is_active,'created_on'=>$created_on,
                'schedduled_on'=>$schedduled_on,'last_update_on'=>$last_update_on));

        $league = DB::table('nba_live_events')->where('event_id', $event_id)->first();
        return View::make("nba_live_events/Create.index",array("data"=> json_encode($league)));
    }


	/**
	 * Display the specified nbaliveevent.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

        $nba_live_events = DB::table('nba_live_events')->where('sr_no', $id)->first();
        return View::make('nba_live_events.index', array("data"=> json_encode($nba_live_events)));
	}

	/**
	 * Show the form for editing the specified nbaliveevent.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$event_id,$season_id,$season_year,$season_type,$league_id,$status,$home_team_id,$away_team_id,$venue_id,$venue_name,
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

        DB::table('nba_live_events')
            ->where('sr_no',$sr_no)
            ->update(array('event_id'=>$event_id,'season_id'=> $season_id,'season_year'=>$season_year,'season_type'=>$season_type,'league_id'=>$league_id,
                'status'=>$status,'home_team_id'=>$home_team_id,'away_team_id'=>$away_team_id,'venue_id'=>$venue_id,'venue_name'=>$venue_name,'venue_city'=>$venue_city,
                'venue_country'=>$venue_country,'venue_zip'=>$venue_zip,'venue_state'=>$venue_state,'is_active'=>$is_active,'created_on'=>$created_on,
                'schedduled_on'=>$schedduled_on,'last_update_on'=>$last_update_on));

        $league = DB::table('nba_live_events')->where('sr_no', $sr_no)->first();
        return View::make("nba_live_events/Create.index",array("data"=> json_encode($league)));
    }

	/**
	 * Update the specified nbaliveevent in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$nbaliveevent = Nbaliveevent::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Nbaliveevent::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$nbaliveevent->update($data);

		return Redirect::route('nbaliveevents.index');
	}

	/**
	 * Remove the specified nbaliveevent from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $league = DB::table('nba_live_events')->where('sr_no', $id)->first();
        if($league!=null) {
            DB::table('nba_live_events')->where('sr_no', $id)->delete();
            $league = DB::table('nba_live_events')->where('sr_no', $id)->first();
            if ($league == null)
                return View::make('nba_live_events/Delete.index', array("data" => '1'));
            else
                return View::make('nba_live_events/Delete.index', array("data" => '0'));
        }
        else
            return View::make('nba_live_events/Delete.index', array("data" => '0'));
    }

}

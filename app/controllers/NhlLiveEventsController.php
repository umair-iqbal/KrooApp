<?php

class NhlLiveEventsController extends \BaseController {

	/**
	 * Display a listing of nhlliveevents
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$nhlliveevents = Nhlliveevent::all();
        return View::make('nhl_live_events.index',array("data"=> json_encode($nhlliveevents)));
	}

	/**
	 * Show the form for creating a new nhlliveevent
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('nhlliveevents.create');
	}

	/**
	 * Store a newly created nhlliveevent in storage.
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

        DB::table('nhl_live_events')
            ->insert(array('event_id'=>$event_id,'season_id'=> $season_id,'season_year'=>$season_year,'season_type'=>$season_type,'league_id'=>$league_id,
                'status'=>$status,'home_team_id'=>$home_team_id,'away_team_id'=>$away_team_id,'venue_id'=>$venue_id,'venue_name'=>$venue_name,'venue_city'=>$venue_city,
                'venue_country'=>$venue_country,'venue_zip'=>$venue_zip,'venue_state'=>$venue_state,'is_active'=>$is_active,'created_on'=>$created_on,
                'schedduled_on'=>$schedduled_on,'last_update_on'=>$last_update_on));

        $league = DB::table('nhl_live_events')->where('event_id', $event_id)->first();
        return View::make("nhl_live_events/Create.index",array("data"=> json_encode($league)));
    }


    /**
	 * Display the specified nhlliveevent.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

        $nhl_live_events = DB::table('nhl_live_events')->where('sr_no', $id)->first();
        return View::make('nhl_live_events.index', array("data"=> json_encode($nhl_live_events)));
	}

	/**
	 * Show the form for editing the specified nhlliveevent.
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

        DB::table('nhl_live_events')
            ->where('sr_no',$sr_no)
            ->update(array('event_id'=>$event_id,'season_id'=> $season_id,'season_year'=>$season_year,'season_type'=>$season_type,'league_id'=>$league_id,
                'status'=>$status,'home_team_id'=>$home_team_id,'away_team_id'=>$away_team_id,'venue_id'=>$venue_id,'venue_name'=>$venue_name,'venue_city'=>$venue_city,
                'venue_country'=>$venue_country,'venue_zip'=>$venue_zip,'venue_state'=>$venue_state,'is_active'=>$is_active,'created_on'=>$created_on,
                'schedduled_on'=>$schedduled_on,'last_update_on'=>$last_update_on));

        $league = DB::table('nhl_live_events')->where('sr_no', $sr_no)->first();
        return View::make("nhl_live_events/Create.index",array("data"=> json_encode($league)));
    }

	/**
	 * Update the specified nhlliveevent in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$nhlliveevent = Nhlliveevent::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Nhlliveevent::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$nhlliveevent->update($data);

		return Redirect::route('nhlliveevents.index');
	}

	/**
	 * Remove the specified nhlliveevent from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $league = DB::table('nhl_live_events')->where('sr_no', $id)->first();
        if($league!=null) {
            DB::table('nhl_live_events')->where('sr_no', $id)->delete();
            $league = DB::table('nhl_live_events')->where('sr_no', $id)->first();
            if ($league == null)
                return View::make('nhl_live_events/Delete.index', array("data" => '1'));
            else
                return View::make('nhl_live_events/Delete.index', array("data" => '0'));
        }
        else
            return View::make('nhl_live_events/Delete.index', array("data" => '0'));
    }

}

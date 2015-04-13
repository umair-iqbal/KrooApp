<?php

class NflEventsController extends \BaseController {

	/**
	 * Display a listing of nflevents
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$nflevents = Nflevent::all();
        return View::make('nfl_events.index',array("data"=> json_encode($nflevents)));
	}

	/**
	 * Show the form for creating a new nflevent
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('nflevents.create');
	}

	/**
	 * Store a newly created nflevent in storage.
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

        DB::table('nfl_events')
            ->insert(array('event_id'=>$event_id,'season_id'=> $season_id,'season_year'=>$season_year,'season_type'=>$season_type,'league_id'=>$league_id,
                'status'=>$status,'home_team_id'=>$home_team_id,'away_team_id'=>$away_team_id,'venue_id'=>$venue_id,'venue_name'=>$venue_name,'venue_city'=>$venue_city,
                'venue_country'=>$venue_country,'venue_zip'=>$venue_zip,'venue_state'=>$venue_state,'is_active'=>$is_active,'created_on'=>$created_on,
                'schedduled_on'=>$schedduled_on,'last_update_on'=>$last_update_on));

        $league = DB::table('nfl_events')->where('event_id', $event_id)->first();
        return View::make("nfl_events/Create.index",array("data"=> json_encode($league)));
    }

	/**
	 * Display the specified nflevent.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

        $nfl_events = DB::table('nfl_events')->where('event_id', $id)->first();
        return View::make('nfl_events.index', array("data"=> json_encode($nfl_events)));
	}

	/**
	 * Show the form for editing the specified nflevent.
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

        DB::table('nfl_events')
            ->where('event_id',$event_id)
            ->update(array('event_id'=>$event_id,'season_id'=> $season_id,'season_year'=>$season_year,'season_type'=>$season_type,'league_id'=>$league_id,
                'status'=>$status,'home_team_id'=>$home_team_id,'away_team_id'=>$away_team_id,'venue_id'=>$venue_id,'venue_name'=>$venue_name,'venue_city'=>$venue_city,
                'venue_country'=>$venue_country,'venue_zip'=>$venue_zip,'venue_state'=>$venue_state,'is_active'=>$is_active,'created_on'=>$created_on,
                'schedduled_on'=>$schedduled_on,'last_update_on'=>$last_update_on));

        $league = DB::table('nfl_events')->where('event_id', $event_id)->first();
        return View::make("nfl_events/Create.index",array("data"=> json_encode($league)));
    }

	/**
	 * Update the specified nflevent in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$nflevent = Nflevent::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Nflevent::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$nflevent->update($data);

		return Redirect::route('nflevents.index');
	}

	/**
	 * Remove the specified nflevent from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $league = DB::table('nfl_events')->where('event_id', $id)->first();
        if($league!=null) {
            DB::table('nfl_events')->where('event_id', $id)->delete();
            $league = DB::table('nfl_events')->where('event_id', $id)->first();
            if ($league == null)
                return View::make('nfl_events/Delete.index', array("data" => '1'));
            else
                return View::make('nfl_events/Delete.index', array("data" => '0'));
        }
        else
            return View::make('nfl_events/Delete.index', array("data" => '0'));
    }

}

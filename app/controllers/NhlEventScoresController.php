<?php

class NhlEventScoresController extends \BaseController {

	/**
	 * Display a listing of nhleventscores
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$nhleventscores = Nhleventscore::all();

        return View::make('nhl_event_scores.index',array("data"=> json_encode($nhleventscores)));
	}

	/**
	 * Show the form for creating a new nhleventscore
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('nhleventscores.create');
	}

	/**
	 * Store a newly created nhleventscore in storage.
	 *
	 * @return Response
	 */
    public function store($event_id,$h_goals,$a_goals,$h_assists,$a_assists,$h_points,$a_points,$h_shot_on_goal,$a_shot_on_goal,$h_power_plays,
                          $a_power_plays,$h_penalty_minutes,$a_penalty_minutes,$h_power_play_goals,$a_power_play_goals,$h_short_handed_goals,$a_short_handed_goals,$h_total_faceoffs,$a_total_faceoffs
        ,$period_no,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="") {
            $last_updated_on = new DateTime($last_updated_on);
        }

        DB::table('nhl_event_scores')
            ->insert(array('event_id'=>$event_id,'h_goals'=>$h_goals,'a_goals'=>$a_goals,'h_assists'=>$h_assists,'a_assists'=>$a_assists,'h_points'=> $h_points,'a_points'=>$a_points,'h_shot_on_goal'=>$h_shot_on_goal,'a_shot_on_goal'=>$a_shot_on_goal,
                'h_power_plays'=>$h_power_plays,'a_power_plays'=>$a_power_plays,'h_penalty_minutes'=>$h_penalty_minutes,'a_penalty_minutes'=>$a_penalty_minutes,'h_power_play_goals'=>$h_power_play_goals,'a_power_play_goals'=>$a_power_play_goals,
                'h_short_handed_goals'=>$h_short_handed_goals,'a_short_handed_goals'=>$a_short_handed_goals,'h_total_faceoffs'=>$h_total_faceoffs,'a_total_faceoffs'=>$a_total_faceoffs,
                'period_no'=>$period_no,'created_on'=>$created_on, 'last_updated_on'=>$last_updated_on));

        $league = DB::table('nhl_event_scores')->where('event_id', $event_id)->first();
        return View::make("nhl_event_scores/Create.index",array("data"=> json_encode($league)));
    }

	/**
	 * Display the specified nhleventscore.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $nhl_event_scores = DB::table('nhl_event_scores')->where('sr_no', $id)->first();
        return View::make('nhl_event_scores.index', array("data"=> json_encode($nhl_event_scores)));
	}

	/**
	 * Show the form for editing the specified nhleventscore.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$event_id,$h_goals,$a_goals,$h_assists,$a_assists,$h_points,$a_points,$h_shot_on_goal,$a_shot_on_goal,$h_power_plays,
                          $a_power_plays,$h_penalty_minutes,$a_penalty_minutes,$h_power_play_goals,$a_power_play_goals,$h_short_handed_goals,$a_short_handed_goals,$h_total_faceoffs,$a_total_faceoffs
        ,$period_no,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="") {
            $last_updated_on = new DateTime($last_updated_on);
        }

        DB::table('nhl_event_scores')
            ->where('sr_no',$sr_no)
            ->update(array('event_id'=>$event_id,'h_goals'=>$h_goals,'a_goals'=>$a_goals,'h_assists'=>$h_assists,'a_assists'=>$a_assists,'h_points'=> $h_points,'a_points'=>$a_points,'h_shot_on_goal'=>$h_shot_on_goal,'a_shot_on_goal'=>$a_shot_on_goal,
                'h_power_plays'=>$h_power_plays,'a_power_plays'=>$a_power_plays,'h_penalty_minutes'=>$h_penalty_minutes,'a_penalty_minutes'=>$a_penalty_minutes,'h_power_play_goals'=>$h_power_play_goals,'a_power_play_goals'=>$a_power_play_goals,
                'h_short_handed_goals'=>$h_short_handed_goals,'a_short_handed_goals'=>$a_short_handed_goals,'h_total_faceoffs'=>$h_total_faceoffs,'a_total_faceoffs'=>$a_total_faceoffs,
                'period_no'=>$period_no,'created_on'=>$created_on, 'last_updated_on'=>$last_updated_on));

        $league = DB::table('nhl_event_scores')->where('sr_no', $sr_no)->first();
        return View::make("nhl_event_scores/Create.index",array("data"=> json_encode($league)));
    }
	/**
	 * Update the specified nhleventscore in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$nhleventscore = Nhleventscore::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Nhleventscore::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$nhleventscore->update($data);

		return Redirect::route('nhleventscores.index');
	}

	/**
	 * Remove the specified nhleventscore from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $league = DB::table('nhl_event_scores')->where('sr_no', $id)->first();
        if($league!=null) {
            DB::table('nhl_event_scores')->where('sr_no', $id)->delete();
            $league = DB::table('nhl_event_scores')->where('sr_no', $id)->first();
            if ($league == null)
                return View::make('nhl_event_scores/Delete.index', array("data" => '1'));
            else
                return View::make('nhl_event_scores/Delete.index', array("data" => '0'));
        }
        else
            return View::make('nhl_event_scores/Delete.index', array("data" => '0'));
    }


}

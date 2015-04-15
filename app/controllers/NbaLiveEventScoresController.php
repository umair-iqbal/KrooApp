<?php

class NbaLiveEventScoresController extends \BaseController {

	/**
	 * Display a listing of nbaliveeventscores
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$nbaliveeventscores = Nbaliveeventscore::all();
        return View::make('nba_live_event_scores.index',array("data"=> json_encode($nbaliveeventscores)));
	}

	/**
	 * Show the form for creating a new nbaliveeventscore
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('nbaliveeventscores.create');
	}

	/**
	 * Store a newly created nbaliveeventscore in storage.
	 *
	 * @return Response
	 */
    public function store($event_id,$h_points,$a_points,$h_assists,$a_assists,$h_rebounds,$a_rebounds,$h_blocks,$a_blocks,$h_steals,
                          $a_steals,$h_turnovers,$a_turnovers,$h_3pointers_made,$a_3pointers_made,$h_3pointers_attempt,$a_3pointers_attempt,$h_foul_shots_made,$a_foul_shots_made
        ,$h_foul_shots_attempt,$a_foul_shots_attempt,$quarter_no,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="") {
            $last_updated_on = new DateTime($last_updated_on);
        }

        DB::table('nba_live_event_scores')
            ->insert(array('event_id'=>$event_id,'h_points'=> $h_points,'a_points'=>$a_points,'h_assists'=>$h_assists,'a_assists'=>$a_assists,
                'h_rebounds'=>$h_rebounds,'a_rebounds'=>$a_rebounds,'h_blocks'=>$h_blocks,'a_blocks'=>$a_blocks,'h_steals'=>$h_steals,'a_steals'=>$a_steals,
                'h_turnovers'=>$h_turnovers,'a_turnovers'=>$a_turnovers,'h_3pointers_made'=>$h_3pointers_made,'a_3pointers_made'=>$a_3pointers_made,'h_3pointers_attempt'=>$h_3pointers_attempt,'a_3pointers_attempt'=>$a_3pointers_attempt,
                'h_foul_shots_made'=>$h_foul_shots_made,'a_foul_shots_made'=>$a_foul_shots_made,'h_foul_shots_attempt'=>$h_foul_shots_attempt,'a_foul_shots_attempt'=>$a_foul_shots_attempt,
                'quarter_no'=>$quarter_no,'created_on'=>$created_on, 'last_updated_on'=>$last_updated_on));

        $league = DB::table('nba_live_event_scores')->where('event_id', $event_id)->first();
        return View::make("nba_live_event_scores/Create.index",array("data"=> json_encode($league)));
    }


	/**
	 * Display the specified nbaliveeventscore.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

        $nba_live_event_scores = DB::table('nba_live_event_scores')->where('sr_no', $id)->first();
        return View::make('nba_live_event_scores.index', array("data"=> json_encode($nba_live_event_scores)));
	}

	/**
	 * Show the form for editing the specified nbaliveeventscore.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$event_id,$h_points,$a_points,$h_assists,$a_assists,$h_rebounds,$a_rebounds,$h_blocks,$a_blocks,$h_steals,
                         $a_steals,$h_turnovers,$a_turnovers,$h_3pointers_made,$a_3pointers_made,$h_3pointers_attempt,$a_3pointers_attempt,$h_foul_shots_made,$a_foul_shots_made
        ,$h_foul_shots_attempt,$a_foul_shots_attempt,$quarter_no,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="") {
            $last_updated_on = new DateTime($last_updated_on);
        }

        DB::table('nba_live_event_scores')
            ->where('sr_no',$sr_no)
            ->update(array('event_id'=>$event_id,'h_points'=> $h_points,'a_points'=>$a_points,'h_assists'=>$h_assists,'a_assists'=>$a_assists,
                'h_rebounds'=>$h_rebounds,'a_rebounds'=>$a_rebounds,'h_blocks'=>$h_blocks,'a_blocks'=>$a_blocks,'h_steals'=>$h_steals,'a_steals'=>$a_steals,
                'h_turnovers'=>$h_turnovers,'a_turnovers'=>$a_turnovers,'h_3pointers_made'=>$h_3pointers_made,'a_3pointers_made'=>$a_3pointers_made,'h_3pointers_attempt'=>$h_3pointers_attempt,'a_3pointers_attempt'=>$a_3pointers_attempt,
                'h_foul_shots_made'=>$h_foul_shots_made,'a_foul_shots_made'=>$a_foul_shots_made,'h_foul_shots_attempt'=>$h_foul_shots_attempt,'a_foul_shots_attempt'=>$a_foul_shots_attempt,
                'quarter_no'=>$quarter_no,'created_on'=>$created_on, 'last_updated_on'=>$last_updated_on));

        $league = DB::table('nba_live_event_scores')->where('sr_no', $sr_no)->first();
        return View::make("nba_live_event_scores/Create.index",array("data"=> json_encode($league)));
    }


	/**
	 * Update the specified nbaliveeventscore in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$nbaliveeventscore = Nbaliveeventscore::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Nbaliveeventscore::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$nbaliveeventscore->update($data);

		return Redirect::route('nbaliveeventscores.index');
	}

	/**
	 * Remove the specified nbaliveeventscore from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $league = DB::table('nba_live_event_scores')->where('sr_no', $id)->first();
        if($league!=null) {
            DB::table('nba_live_event_scores')->where('sr_no', $id)->delete();
            $league = DB::table('nba_live_event_scores')->where('sr_no', $id)->first();
            if ($league == null)
                return View::make('nba_live_event_scores/Delete.index', array("data" => '1'));
            else
                return View::make('nba_live_event_scores/Delete.index', array("data" => '0'));
        }
        else
            return View::make('nba_live_event_scores/Delete.index', array("data" => '0'));
    }

}

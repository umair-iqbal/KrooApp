<?php

class MlbLiveEventScoresController extends \BaseController {

	/**
	 * Display a listing of mlbliveeventscores
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$mlbliveeventscores = Mlbliveeventscore::all();
        return View::make('mlb_live_event_scores.index',array("data"=> json_encode($mlbliveeventscores)));
	}

	/**
	 * Show the form for creating a new mlbliveeventscore
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('mlbliveeventscores.create');
	}

	/**
	 * Store a newly created mlbliveeventscore in storage.
	 *
	 * @return Response
	 */
    public function store($event_id,$h_runs,$a_runs,$h_pitches,$a_pitches,$h_balls,$a_balls,$h_strikes,$a_strikes,$h_strikes_outs,
                          $a_strikes_outs,$h_doubles,$a_doubles,$h_triples,$a_triples,$h_home_runs,$a_home_runs,$h_works,$a_works
        ,$h_errors,$a_errors,$h_hit_by_pitch,$a_hit_by_pitch,$h_double_plays,$a_double_plays,$inning_no,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="") {
            $last_updated_on = new DateTime($last_updated_on);
        }

        DB::table('mlb_live_event_scores')
            ->insert(array('event_id'=>$event_id,'h_runs'=> $h_runs,'a_runs'=>$a_runs,'h_pitches'=>$h_pitches,'a_pitches'=>$a_pitches,
                'h_balls'=>$h_balls,'a_balls'=>$a_balls,'h_strikes'=>$h_strikes,'a_strikes'=>$a_strikes,'h_strikes_outs'=>$h_strikes_outs,'a_strikes_outs'=>$a_strikes_outs,
                'h_doubles'=>$h_doubles,'a_doubles'=>$a_doubles,'h_triples'=>$h_triples,'a_triples'=>$a_triples,'h_home_runs'=>$h_home_runs,'a_home_runs'=>$a_home_runs,
                'h_works'=>$h_works,'a_works'=>$a_works,'h_errors'=>$h_errors,'a_errors'=>$a_errors,'h_hit_by_pitch'=>$h_hit_by_pitch,'a_hit_by_pitch'=>$a_hit_by_pitch,
                'h_double_plays'=>$h_double_plays,'a_double_plays'=>$a_double_plays,'inning_no'=>$inning_no,'created_on'=>$created_on, 'last_updated_on'=>$last_updated_on));

        $league = DB::table('mlb_live_event_scores')->where('event_id', $event_id)->first();
        return View::make("mlb_live_event_scores/Create.index",array("data"=> json_encode($league)));
    }

    /**
	 * Display the specified mlbliveeventscore.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

        $mlb_live_event_scores = DB::table('mlb_live_event_scores')->where('sr_no', $id)->first();
        return View::make('mlb_live_event_scores.index', array("data"=> json_encode($mlb_live_event_scores)));
	}

	/**
	 * Show the form for editing the specified mlbliveeventscore.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$event_id,$h_runs,$a_runs,$h_pitches,$a_pitches,$h_balls,$a_balls,$h_strikes,$a_strikes,$h_strikes_outs,
                         $a_strikes_outs,$h_doubles,$a_doubles,$h_triples,$a_triples,$h_home_runs,$a_home_runs,$h_works,$a_works
        ,$h_errors,$a_errors,$h_hit_by_pitch,$a_hit_by_pitch,$h_double_plays,$a_double_plays,$inning_no,$created_on,$last_updated_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="") {
            $last_updated_on = new DateTime($last_updated_on);
        }

        DB::table('mlb_live_event_scores',$sr_no)
            ->where('sr_no')
            ->update(array('event_id'=>$event_id,'h_runs'=> $h_runs,'a_runs'=>$a_runs,'h_pitches'=>$h_pitches,'a_pitches'=>$a_pitches,
                'h_balls'=>$h_balls,'a_balls'=>$a_balls,'h_strikes'=>$h_strikes,'a_strikes'=>$a_strikes,'h_strikes_outs'=>$h_strikes_outs,'a_strikes_outs'=>$a_strikes_outs,
                'h_doubles'=>$h_doubles,'a_doubles'=>$a_doubles,'h_triples'=>$h_triples,'a_triples'=>$a_triples,'h_home_runs'=>$h_home_runs,'a_home_runs'=>$a_home_runs,
                'h_works'=>$h_works,'a_works'=>$a_works,'h_errors'=>$h_errors,'a_errors'=>$a_errors,'h_hit_by_pitch'=>$h_hit_by_pitch,'a_hit_by_pitch'=>$a_hit_by_pitch,
                'h_double_plays'=>$h_double_plays,'a_double_plays'=>$a_double_plays,'inning_no'=>$inning_no,'created_on'=>$created_on, 'last_updated_on'=>$last_updated_on));

        $league = DB::table('mlb_live_event_scores')->where('sr_no', $sr_no)->first();
        return View::make("mlb_live_event_scores/Create.index",array("data"=> json_encode($league)));
    }

	/**
	 * Update the specified mlbliveeventscore in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$mlbliveeventscore = Mlbliveeventscore::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Mlbliveeventscore::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$mlbliveeventscore->update($data);

		return Redirect::route('mlbliveeventscores.index');
	}

	/**
	 * Remove the specified mlbliveeventscore from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $league = DB::table('mlb_live_event_scores')->where('sr_no', $id)->first();
        if($league!=null) {
            DB::table('mlb_live_event_scores')->where('sr_no', $id)->delete();
            $league = DB::table('mlb_live_event_scores')->where('sr_no', $id)->first();
            if ($league == null)
                return View::make('mlb_live_event_scores/Delete.index', array("data" => '1'));
            else
                return View::make('mlb_live_event_scores/Delete.index', array("data" => '0'));
        }
        else
            return View::make('mlb_live_event_scores/Delete.index', array("data" => '0'));
    }

}

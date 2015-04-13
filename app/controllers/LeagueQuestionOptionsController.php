<?php

class LeagueQuestionOptionsController extends \BaseController {

	/**
	 * Display a listing of leaguequestionoptions
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$leaguequestionoptions = Leaguequestionoption::all();
        return View::make('league_question_options.index',array("data"=> json_encode($leaguequestionoptions)));
	}

	/**
	 * Show the form for creating a new leaguequestionoption
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('leaguequestionoptions.create');
	}

	/**
	 * Store a newly created leaguequestionoption in storage.
	 *
	 * @return Response
	 */
    public function store($league_ques_id,$range_start,$range_end,$potential_points,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by,$option_motiv_text)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }
        
        DB::table('league_question_options')
            ->insert(array('league_ques_id'=>$league_ques_id,'range_start'=> $range_start,'range_end'=>$range_end,'potential_points'=>$potential_points,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by,'option_motiv_text'=>$option_motiv_text));

        $league = DB::table('league_question_options')->where('league_ques_id', $league_ques_id)->first();
        return View::make("league_question_options/Create.index",array("data"=> json_encode($league)));
    }

	/**
	 * Display the specified leaguequestionoption.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $league_question_options = DB::table('league_question_options')->where('league_ques_id', $id)->first();
        return View::make('league_question_options.index', array("data"=> json_encode($league_question_options)));
	}

	/**
	 * Show the form for editing the specified leaguequestionoption.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$league_ques_id,$range_start,$range_end,$potential_points,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by,$option_motiv_text)
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
        DB::table('league_question_options')
            ->where('sr_no',$sr_no)
            ->update(array('league_ques_id'=>$league_ques_id,'range_start'=> $range_start,'range_end'=>$range_end,'potential_points'=>$potential_points,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by,'option_motiv_text'=>$option_motiv_text));

        $league = DB::table('league_question_options')->where('sr_no', $sr_no)->first();
        return View::make("league_question_options/Update.index",array("data"=> json_encode($league)));
    }
	/**
	 * Update the specified leaguequestionoption in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$leaguequestionoption = Leaguequestionoption::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Leaguequestionoption::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$leaguequestionoption->update($data);

		return Redirect::route('leaguequestionoptions.index');
	}

	/**
	 * Remove the specified leaguequestionoption from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $league = DB::table('league_question_options')->where('sr_no', $id)->first();
        if($league!=null) {
            DB::table('league_question_options')->where('sr_no', $id)->delete();
            $league = DB::table('league_question_options')->where('sr_no', $id)->first();
            if ($league == null)
                return View::make('league_question_options/Delete.index', array("data" => '1'));
            else
                return View::make('league_question_options/Delete.index', array("data" => '0'));
        }
        else
            return View::make('league_question_options/Delete.index', array("data" => '0'));
    }

}

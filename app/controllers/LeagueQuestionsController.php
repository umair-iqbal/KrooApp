<?php

class LeagueQuestionsController extends \BaseController {

	/**
	 * Display a listing of leaguequestions
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$leaguequestions = Leaguequestion::all();

        return View::make('league_questions.index',array("data"=> json_encode($leaguequestions)));
	}

	/**
	 * Show the form for creating a new leaguequestion
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('leaguequestions.create');
	}

	/**
	 * Store a newly created leaguequestion in storage.
	 *
	 * @return Response
	 */
    public function store($league_id,$constant_id,$question_text,$event_id,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }
        if($last_updated_on!="")
        {
            $last_updated_on =new DateTime($last_updated_on);
        }

        DB::table('league_questions')
            ->insert(array('league_id'=>$league_id,'constant_id'=> $constant_id,'question_text'=>$question_text,'event_id'=>$event_id,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $league = DB::table('league_questions')->where('league_id', $league_id)->first();
        return View::make("league_questions/Create.index",array("data"=> json_encode($league)));
    }
	/**
	 * Display the specified leaguequestion.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $league_questions = DB::table('league_questions')->where('sr_no', $id)->first();
        return View::make('league_questions.index', array("data"=> json_encode($league_questions)));
	}

	/**
	 * Show the form for editing the specified leaguequestion.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$league_id,$constant_id,$question_text,$event_id,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
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
        DB::table('league_questions')
            ->where('sr_no',$sr_no)
            ->update(array('sr_no'=>$sr_no,'league_id'=>$league_id,'constant_id'=> $constant_id,'question_text'=>$question_text,'event_id'=>$event_id,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $league = DB::table('league_questions')->where('sr_no', $sr_no)->first();
        return View::make("league_questions/Update.index",array("data"=> json_encode($league)));
    }

	/**
	 * Update the specified leaguequestion in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$leaguequestion = Leaguequestion::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Leaguequestion::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$leaguequestion->update($data);

		return Redirect::route('leaguequestions.index');
	}

	/**
	 * Remove the specified leaguequestion from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $league = DB::table('league_questions')->where('sr_no', $id)->first();
        if($league!=null) {
            DB::table('league_questions')->where('sr_no', $id)->delete();
            $league = DB::table('league_questions')->where('sr_no', $id)->first();
            if ($league == null)
                return View::make('league_questions/Delete.index', array("data" => '1'));
            else
                return View::make('league_questions/Delete.index', array("data" => '0'));
        }
        else
            return View::make('league_questions/Delete.index', array("data" => '0'));
    }

}

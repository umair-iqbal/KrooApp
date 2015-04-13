<?php

class LeagueQuestionConstantsController extends \BaseController {

	/**
	 * Display a listing of leaguequestionconstants
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$leaguequestionconstants = Leaguequestionconstant::all();
        return View::make('league_question_constants.index',array("data"=> json_encode($leaguequestionconstants)));
	}

	/**
	 * Show the form for creating a new leaguequestionconstant
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('leaguequestionconstants.create');
	}

	/**
	 * Store a newly created leaguequestionconstant in storage.
	 *
	 * @return Response
	 */
    public function store($constant_id,$leagueID,$constant_desc,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
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
        DB::table('league_question_constants')
            ->insert(array('constant_id'=>$constant_id,'league_id'=> $leagueID,'league_name'=>$constant_desc,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $league = DB::table('league_question_constants')->where('constant_id', $constant_id)->first();
        return View::make("league_question_constants/Create.index",array("data"=> json_encode($league)));
    }

	/**
	 * Display the specified leaguequestionconstant.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $league_question_constants = DB::table('league_question_constants')->where('constant_id', $id)->first();
        return View::make('league_question_constants.index', array("data"=> json_encode($league_question_constants)));
	}

	/**
	 * Show the form for editing the specified leaguequestionconstant.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($constant_id,$leagueID,$league_name,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
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
        DB::table('league_question_constants')
            ->where('constant_id',$constant_id)
            ->update(array('constant_id'=>$constant_id,'league_id'=> $leagueID,'league_name'=>$league_name,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $league = DB::table('league_question_constants')->where('constant_id', $constant_id)->first();
        return View::make("league_question_constants/Update.index",array("data"=> json_encode($league)));
    }

	/**
	 * Update the specified leaguequestionconstant in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$leaguequestionconstant = Leaguequestionconstant::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Leaguequestionconstant::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$leaguequestionconstant->update($data);

		return Redirect::route('leaguequestionconstants.index');
	}

	/**
	 * Remove the specified leaguequestionconstant from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $league = DB::table('league_question_constants')->where('constant_id', $id)->first();
        if($league!=null) {
            DB::table('league_question_constants')->where('constant_id', $id)->delete();
            $league = DB::table('league_question_constants')->where('constant_id', $id)->first();
            if ($league == null)
                return View::make('league_question_constants/Delete.index', array("data" => '1'));
            else
                return View::make('league_question_constants/Delete.index', array("data" => '0'));
        }
        else
            return View::make('league_question_constants/Delete.index', array("data" => '0'));
    }

}

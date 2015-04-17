<?php

class LeagueGameLevelsController extends \BaseController {

	/**
	 * Display a listing of leaguegamelevels
	 *
	 * @return Response
	 */

    public $restful = true;
	public function index()
	{
		$leaguegamelevels = Leaguegamelevel::all();

        return View::make('League_game_levels.index',array("data"=> json_encode($leaguegamelevels)));
	}

	/**
	 * Show the form for creating a new leaguegamelevel
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('leaguegamelevels.create');
	}

	/**
	 * Store a newly created leaguegamelevel in storage.
	 *
	 * @return Response
	 */
    public function store($leagueID,$level_no,$level_desc,$is_active,$created_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }


        //$user->save();
        DB::table('league_game_levels')
            ->insert(array('league_id'=> $leagueID,'level_no'=>$level_no,'level_desc'=>$level_desc,'is_active'=>$is_active,'created_on'=>$created_on));

        $league = DB::table('league_game_levels')->where('league_id', $leagueID)->first();
        return View::make("League_game_levels/Create.index",array("data"=> json_encode($league)));
    }
	/**
	 * Display the specified leaguegamelevel.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $leagues = DB::table('league_game_levels')->where('league_id', $id)->first();
        return View::make('League_game_levels.index', array("data"=> json_encode($leagues)));
	}

	/**
	 * Show the form for editing the specified leaguegamelevel.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$leagueID,$level_no,$level_desc,$is_active,$created_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }


        //$user->save();
        DB::table('league_game_levels')
            ->where('sr_no',$sr_no)
            ->update(array('league_id'=> $leagueID,'level_no'=>$level_no,'level_desc'=>$level_desc,'is_active'=>$is_active,'created_on'=>$created_on));

        $league = DB::table('league_game_levels')->where('sr_no', $sr_no)->first();
        return View::make("League_game_levels/Create.index",array("data"=> json_encode($league)));
    }

	/**
	 * Update the specified leaguegamelevel in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$leaguegamelevel = Leaguegamelevel::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Leaguegamelevel::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$leaguegamelevel->update($data);

		return Redirect::route('leaguegamelevels.index');
	}

	/**
	 * Remove the specified leaguegamelevel from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $league = DB::table('league_game_levels')->where('sr_no', $id)->first();
        if($league!=null) {
            DB::table('league_game_levels')->where('sr_no', $id)->delete();
            $league = DB::table('league_game_levels')->where('sr_no', $id)->first();
            if ($league == null)
                return View::make('League_game_levels/Delete.index', array("data" => '1'));
            else
                return View::make('League_game_levels/Delete.index', array("data" => '0'));
        }
        else
            return View::make('League_game_levels/Delete.index', array("data" => '0'));

    }

}

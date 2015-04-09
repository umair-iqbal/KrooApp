<?php

class LeaguesController extends \BaseController {

	/**
	 * Display a listing of leagues
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$leagues = League::all();

        return View::make('Leagues.index',array("data"=> json_encode($leagues)));
	}

	/**
	 * Show the form for creating a new league
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('leagues.create');
	}

	/**
	 * Store a newly created league in storage.
	 *
	 * @return Response
	 */
    public function store($leagueID,$league_name,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
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
        DB::table('leagues')
            ->insert(array('league_id'=> $leagueID,'league_name'=>$league_name,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $league = DB::table('leagues')->where('league_id', $leagueID)->first();
        return View::make("Leagues/Create.index",array("data"=> json_encode($league)));
    }

	/**
	 * Display the specified league.
	 *
	 * @param  int  $id
	 * @return Response
	 */

        public function show($id)
    {
        $leagues = DB::table('leagues')->where('league_id', $id)->first();
        return View::make('Leagues.index', array("data"=> json_encode($leagues)));
    }


	/**
	 * Show the form for editing the specified league.
	 *
	 * @param  int  $id
	 * @return Response
	 */

    public function edit($leagueID,$league_name,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
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
        DB::table('leagues')
            ->where('league_id',$leagueID)
            ->update(array('league_id'=> $leagueID,'league_name'=>$league_name,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $league = DB::table('leagues')->where('league_id', $leagueID)->first();
        return View::make("Leagues/Update.index",array("data"=> json_encode($league)));
    }

	/**
	 * Update the specified league in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$league = League::findOrFail($id);

		$validator = Validator::make($data = Input::all(), League::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$league->update($data);

		return Redirect::route('leagues.index');
	}

	/**
	 * Remove the specified league from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $league = DB::table('leagues')->where('league_id', $id)->first();
        if($league!=null) {
            DB::table('leagues')->where('league_id', $id)->delete();
            $league = DB::table('leagues')->where('league_id', $id)->first();
            if ($league == null)
                return View::make('Leagues/Delete.index', array("data" => '1'));
            else
                return View::make('Leagues/Delete.index', array("data" => '0'));
        }
        else
            return View::make('Leagues/Delete.index', array("data" => '0'));

    }

}

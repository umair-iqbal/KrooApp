<?php

class UserEventsController extends \BaseController {

	/**
	 * Display a listing of userevents
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$userevents = Userevent::all();

        return View::make('user_events.index',array("data"=> json_encode($userevents)));
	}

	/**
	 * Show the form for creating a new userevent
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('userevents.create');
	}

	/**
	 * Store a newly created userevent in storage.
	 *
	 * @return Response
	 */
    public function store($user_id,$event_id,$is_active,$is_attended,$is_played,$created_on,$last_updated_on)
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
        DB::table('user_events')
            ->insert(array('user_id'=> $user_id,'event_id'=>$event_id,'is_active'=>$is_active,'is_attended'=>$is_attended,'is_played'=>$is_played,'created_on'=>$created_on,'last_updated_on'=>$last_updated_on,
               ));

        $role = DB::table('user_events')->where('user_id', $user_id)->first();
        return View::make("user_events/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Display the specified userevent.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $role = DB::table('user_events')->where('sr_no', $id)->first();

        return View::make('user_events.index', array("data"=> json_encode($role)));
	}

    /**
     * @param $id
     * @return mixed
     */
    public function showByEmail()
    {

        $data = Input::all();
        if ($data != null) {
            $id = $data['user_id'];
            $dataU = DB::table('users')->where('user_id', $id)->first();

            if ($dataU != null) {
                $match = ['user_id' => $id, 'is_attended' => 'N'];
                $team = DB::table('user_events')->where($match)->get();


                foreach ($team as $item) {
                    $data1 = EventsView::where('event_id', $item->event_id)->get();
                    if ($data1 != null) {
                        $result[] = $data1;
                    }
                }

                if ($team != null) {
                    return Response::json(array('status' => 200, 'datajson' => array('events'=>$result)));
                } else {
                    return Response::json(array('status' => 200, 'datajson' => 'no record found'));
                }
            } else {
                return Response::json(array('status' => 200, 'datajson' => 'user not exist'));
            }
        }
        else
        {
            return Response::json(array('status' => 203, 'datajson' => 'invalid query string'));
        }

    }

	/**
	 * Show the form for editing the specified userevent.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$user_id,$event_id,$is_active,$is_attended,$is_played,$created_on,$last_updated_on)
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
        DB::table('user_events')
            ->where('sr_no',$sr_no)
            ->update(array('user_id'=> $user_id,'event_id'=>$event_id,'is_active'=>$is_active,'is_attended'=>$is_attended,'is_played'=>$is_played,'created_on'=>$created_on,'last_updated_on'=>$last_updated_on,
            ));

        $role = DB::table('user_events')->where('sr_no', $sr_no)->first();
        return View::make("user_events/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Update the specified userevent in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$userevent = Userevent::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Userevent::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$userevent->update($data);

		return Redirect::route('userevents.index');
	}

	/**
	 * Remove the specified userevent from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $role = DB::table('user_events')->where('sr_no', $id)->first();
        if($role!=null) {
            DB::table('user_events')->where('sr_no', $id)->delete();
            $role = DB::table('user_events')->where('sr_no', $id)->first();
            if ($role == null)
                return View::make('user_events/Delete.index', array("data" => '1'));
            else
                return View::make('user_events/Delete.index', array("data" => '0'));
        }
        else
            return View::make('user_events/Delete.index', array("data" => '0'));

    }
}

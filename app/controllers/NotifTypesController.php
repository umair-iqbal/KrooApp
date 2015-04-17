<?php

class NotifTypesController extends \BaseController {

	/**
	 * Display a listing of notiftypes
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$notiftypes = Notiftype::all();

        return View::make('notif_types.index',array("data"=> json_encode($notiftypes)));
	}

	/**
	 * Show the form for creating a new notiftype
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('notiftypes.create');
	}

	/**
	 * Store a newly created notiftype in storage.
	 *
	 * @return Response
	 */
    public function store($notif_type_id,$notif_type_desc,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
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
        DB::table('notif_type')
            ->insert(array('notif_type_id'=> $notif_type_id,'notif_type_desc'=>$notif_type_desc,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $role = DB::table('notif_type')->where('notif_type_id', $notif_type_id)->first();
        return View::make("notif_types/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Display the specified notiftype.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $role = DB::table('notif_type')->where('notif_type_id', $id)->first();

        return View::make('notif_types.index', array("data"=> json_encode($role)));
	}

	/**
	 * Show the form for editing the specified notiftype.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($notif_type_id,$notif_type_desc,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
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
        DB::table('notif_type')
            ->where('notif_type_id',$notif_type_id)
            ->update(array('notif_type_id'=> $notif_type_id,'notif_type_desc'=>$notif_type_desc,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $role = DB::table('notif_type')->where('notif_type_id', $notif_type_id)->first();
        return View::make("notif_types/Create.index",array("data"=> json_encode($role)));
    }
	/**
	 * Update the specified notiftype in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$notiftype = Notiftype::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Notiftype::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$notiftype->update($data);

		return Redirect::route('notiftypes.index');
	}

	/**
	 * Remove the specified notiftype from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $role = DB::table('notif_type')->where('notif_type_id', $id)->first();
        if($role!=null) {
            DB::table('notif_type')->where('notif_type_id', $id)->delete();
            $role = DB::table('notif_type')->where('notif_type_id', $id)->first();
            if ($role == null)
                return View::make('notif_types/Delete.index', array("data" => '1'));
            else
                return View::make('notif_types/Delete.index', array("data" => '0'));
        }
        else
            return View::make('notif_types/Delete.index', array("data" => '0'));

    }
}

<?php

class RoleTasksController extends \BaseController {

	/**
	 * Display a listing of roletasks
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$roletasks = Roletask::all();

        return View::make('role_tasks.index',array("data"=> json_encode($roletasks)));
	}

	/**
	 * Show the form for creating a new roletask
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('roletasks.create');
	}

	/**
	 * Store a newly created roletask in storage.
	 *
	 * @return Response
	 */
    public function store($role_id,$task_id,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by,$is_allowed,$is_insert_allowed,$is_update_allowed,$is_select_allowed,$is_delete_allowed)
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
        DB::table('role_tasks')
            ->insert(array('role_id'=> $role_id,'task_id'=>$task_id,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by,'is_allowed'=>$is_allowed,'is_insert_allowed'=>$is_insert_allowed,'is_update_allowed'=>$is_update_allowed,'is_select_allowed'=>$is_select_allowed,'is_delete_allowed'=>$is_delete_allowed));

        $role = DB::table('role_tasks')->where('role_id', $role_id)->first();
        return View::make("role_tasks/Create.index",array("data"=> json_encode($role)));
    }


	/**
	 * Display the specified roletask.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $role = DB::table('role_tasks')->where('sr_no', $id)->first();

        return View::make('role_tasks.index', array("data"=> json_encode($role)));
	}

	/**
	 * Show the form for editing the specified roletask.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$role_id,$task_id,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by,$is_allowed,$is_insert_allowed,$is_update_allowed,$is_select_allowed,$is_delete_allowed)
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
        DB::table('role_tasks')
            ->where('sr_no',$sr_no)
            ->update(array('role_id'=> $role_id,'task_id'=>$task_id,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by,'is_allowed'=>$is_allowed,'is_insert_allowed'=>$is_insert_allowed,'is_update_allowed'=>$is_update_allowed,'is_select_allowed'=>$is_select_allowed,'is_delete_allowed'=>$is_delete_allowed));

        $role = DB::table('role_tasks')->where('sr_no', $sr_no)->first();
        return View::make("role_tasks/Create.index",array("data"=> json_encode($role)));
    }


	/**
	 * Update the specified roletask in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$roletask = Roletask::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Roletask::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$roletask->update($data);

		return Redirect::route('roletasks.index');
	}

	/**
	 * Remove the specified roletask from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $role = DB::table('role_tasks')->where('sr_no', $id)->first();
        if($role!=null) {
            DB::table('role_tasks')->where('sr_no', $id)->delete();
            $role = DB::table('role_tasks')->where('sr_no', $id)->first();
            if ($role == null)
                return View::make('role_tasks/Delete.index', array("data" => '1'));
            else
                return View::make('role_tasks/Delete.index', array("data" => '0'));
        }
        else
            return View::make('role_tasks/Delete.index', array("data" => '0'));

    }

}

<?php

class RolesController extends \BaseController {

	/**
	 * Display a listing of roles
	 *
	 * @return Response
	 */
    public $restful = true;
    public function index()
    {
		$roles = Role::all();
        return View::make('Roles.index',array("data"=> json_encode($roles)));
	}

	/**
	 * Show the form for creating a new role
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('roles.create');
	}

	/**
	 * Store a newly created role in storage.
	 *
	 * @return Response
	 */
    public function store($roleID,$role_desc,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
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
        DB::table('roles')
            ->insert(array('role_id'=> $roleID,'role_desc'=>$role_desc,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $role = DB::table('roles')->where('role_id', $roleID)->first();
        return View::make("Roles/Create.index",array("data"=> json_encode($role)));
    }
	/**
	 * Display the specified role.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $role = DB::table('roles')->where('role_id', $id)->first();

        return View::make('Roles.index', array("data"=> json_encode($role)));
	}

	/**
	 * Show the form for editing the specified role.
	 *
	 * @param  int  $id
	 * @return Response
	 */

    public function edit($roleID,$role_desc,$is_active,$created_on,$created_by,$last_updated_on,$last_updated_by)
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
        DB::table('roles')
            ->where('role_id',$roleID)
            ->update(array('role_id'=> $roleID,'role_desc'=>$role_desc,'is_active'=>$is_active,'created_on'=>$created_on,'created_by'=>$created_by,'last_updated_on'=>$last_updated_on,
                'last_updated_by'=>$last_updated_by));

        $role = DB::table('roles')->where('role_id', $roleID)->first();
        return View::make("Roles/Update.index",array("data"=> json_encode($role)));
    }

	/**
	 * Update the specified role in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$role = Role::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Role::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$role->update($data);

		return Redirect::route('roles.index');
	}

	/**
	 * Remove the specified role from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $role = DB::table('roles')->where('role_id', $id)->first();
        if($role!=null) {
            DB::table('roles')->where('role_id', $id)->delete();
            $role = DB::table('roles')->where('role_id', $id)->first();
            if ($role == null)
                return View::make('Roles/Delete.index', array("data" => '1'));
            else
                return View::make('Roles/Delete.index', array("data" => '0'));
        }
        else
            return View::make('Roles/Delete.index', array("data" => '0'));

    }

}

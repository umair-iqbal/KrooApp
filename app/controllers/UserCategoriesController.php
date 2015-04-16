<?php

class UserCategoriesController extends \BaseController {

	/**
	 * Display a listing of usercategories
	 *
	 * @return Response
	 */
    public $restful = true;
	public function index()
	{
		$usercategories = Usercategory::all();

        return View::make('user_categories.index',array("data"=> json_encode($usercategories)));
	}

	/**
	 * Show the form for creating a new usercategory
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('usercategories.create');
	}

	/**
	 * Store a newly created usercategory in storage.
	 *
	 * @return Response
	 */
    public function store($user_category,$category_name,$is_active,$created_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }



        //$user->save();
        DB::table('user_categories')
            ->insert(array('user_category'=> $user_category,'category_name'=>$category_name,'is_active'=>$is_active,'created_on'=>$created_on));

        $role = DB::table('user_categories')->where('user_category', $user_category)->first();
        return View::make("user_categories/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Display the specified usercategory.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $role = DB::table('user_categories')->where('sr_no', $id)->first();

        return View::make('user_categories.index', array("data"=> json_encode($role)));
	}

	/**
	 * Show the form for editing the specified usercategory.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($sr_no,$user_category,$category_name,$is_active,$created_on)
    {
        if($created_on!="")
        {
            $created_on =new DateTime($created_on);
        }



        //$user->save();
        DB::table('user_categories')
            ->where('sr_no',$sr_no)
            ->update(array('user_category'=> $user_category,'category_name'=>$category_name,'is_active'=>$is_active,'created_on'=>$created_on));

        $role = DB::table('user_categories')->where('sr_no', $sr_no)->first();
        return View::make("user_categories/Create.index",array("data"=> json_encode($role)));
    }

	/**
	 * Update the specified usercategory in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$usercategory = Usercategory::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Usercategory::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$usercategory->update($data);

		return Redirect::route('usercategories.index');
	}

	/**
	 * Remove the specified usercategory from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $role = DB::table('user_categories')->where('sr_no', $id)->first();
        if($role!=null) {
            DB::table('user_categories')->where('sr_no', $id)->delete();
            $role = DB::table('user_categories')->where('sr_no', $id)->first();
            if ($role == null)
                return View::make('user_categories/Delete.index', array("data" => '1'));
            else
                return View::make('user_categories/Delete.index', array("data" => '0'));
        }
        else
            return View::make('user_categories/Delete.index', array("data" => '0'));

    }

}

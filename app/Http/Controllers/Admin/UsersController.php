<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Integer;
use Spatie\Permission\Models\Role;


class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasAnyPermission(['create user', 'edit user', 'delete user', 'active user', 'set admin'])) {
            $users = User::all();
            return view('admin.users.index', compact('users'));
        } else {
            abort(403, 'دسترسی به این صفحه برای شما محدود شده');
            return redirect('/home');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (auth()->user()->hasAnyPermission(['edit user', 'set admin']) || auth()->user()->id == $user->id) {
            $roles = Role::orderBy('name', 'ASC')->pluck('name', 'id');
            return view('admin.users.edit', compact('roles', 'user'));
        } else {
            abort(403, 'دسترسی به این صفحه برای شما محدود شده');
            return redirect('/home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $refererUrl= $request->headers->get('referer');
        $refererArray=explode('/',$refererUrl);
        $referer =end($refererArray);
        if (auth()->user()->hasAnyPermission(['edit user', 'set admin'])) {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'phone' => 'required|regex:/(09)[0-9]{9}/|unique:users,phone,' . $user->id,
            ], [
                'name.required' => 'Enter Name',
                'email.required' => 'Enter Email',
                'email.unique' => "Email already exist",
                'phone.required' => 'Enter Phone number',
                'phone.unique' => 'Phone already exist'
            ]);
        } else {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'phone' => 'required|regex:/(09)[0-9]{9}/|unique:users,phone,' . $user->id,
            ], [
                'name.required' => 'Enter Name',
                'phone.required' => 'Enter Phone number',
                'phone.unique' => 'Phone already exist'
            ]);
        }


        if (isset($request->avatar)) {
            $fileNameWithExt = $request->avatar->getClientOriginalName();
            // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just file extension
            $fileExt = $request->avatar->getClientOriginalExtension();
            // Get file name to store
            $fileNameToStore = $fileName . time() . '_' . $fileExt;
        } else {
            $fileNameToStore = $user->avatar;
        }
        if (isset($request->skills)) {
            $user->skills()->sync($request->skills);
        }
        if (isset($request->city_id)) {
            $user->city()->sync($request->city_id);
        }
        if (isset($request->education)) {
            $user->education=$request->education;
        }
        if (isset($request->location)) {
            $user->location=$request->location  ;
        }
        //$post->categories()->sync($request->category_id);
        $user->name = $request->name;
        $user->avatar = $fileNameToStore;
        $user->phone = $request->phone;
        if (auth()->user()->hasAnyPermission(['edit user', 'set admin'])) {
            $user->email = $request->email;
        }
        if (isset($request->role_id)) {
            $role = Role::findById($request->role_id);
            $user = User::where('id', $user->id)->first();
            $user->syncRoles($role);
        }
        $save = $user->save();
        if ($save) {
            if (isset($request->avatar)) {
                $request->avatar->storeAs('public/avatar', $fileNameToStore);
            }
        }
        Session::flash('success', 'User updated successfully');
        if ($referer=='dashboard'){
            return redirect()->back();
        }
        else if (auth()->user()->hasAnyPermission(['edit user', 'set admin'])) {

            return redirect()->route('users.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->user()->hasAnyPermission(['delete user', 'set admin'])) {

            $user->delete();
            Session::flash('success', 'User deleted successfully');
            return redirect()->route('users.index');
        } else {
            abort(403, 'دسترسی به این صفحه برای شما محدود شده');
            return redirect('/home');
        }
    }

    public function getPassword()
    {
        return view('admin.users.password');
    }

    public function postPassword(Request $request)
    {
        $this->validate($request, [
            'newpassword' => 'required|min:6|max:30|confirmed'
        ]);
        $user = auth()->user();

        $user->update([
            'password' => bcrypt($request->newpassword)
        ]);

        return redirect()->back()->with("success", "Password has been Changed Successfully");
    }

    public function dashboard()
    {

        $user = auth()->user();
        $skills = Skill::orderBy('name', 'ASC')->pluck('name', 'id');
        $provinces=Province::orderBy('name','ASC')->pluck('name','id');

        return view('admin.users.dashboard', compact('user', 'skills','provinces'));
    }

    public function storeSkill(Request $request)
    {
        $inventory_skill = Skill::where('id', $request->name)->first();
        if (!$inventory_skill) {
            $this->validate($request, [
                "name" => 'required|unique:skills|bad_words',
            ], [
                    'name.required' => 'Enter Skill',
                    'name.unique' => "Skill already exist",

                ]
            );
            $skill = new Skill();
            $skill->name = $request->name;
            $skill->slug = str_slug($request->name);
            $skill->user_id=auth()->user()->id;
            $skill->save();
            $response['status'] = 'added';
            $response['name'] = $skill->name;
            $response['id'] = $skill->id;
            echo json_encode($response);
        } else {
            $response['status'] = 'exist';
            $response['name'] = $inventory_skill->name;
            $response['id'] = $inventory_skill->id;
            echo json_encode($response);
        }
    }

    public function getCities(Request $request)
    {
        $cities=Province::findById($request->name);
        $result="";
        foreach ($cities->cities as $city){
            $result.="<option value='".$city->id."'>".$city->name."</option>";
        }

        return json_encode($result);
    }

}

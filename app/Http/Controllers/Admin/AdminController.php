<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role_or_permission:مدیر|set admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }


    // ROLE FUNCTIONS

    public function roleIndex()
    {
        $role_permissions = Role::with('permissions')->get();
        return view('admin.users.roles.index',compact('role_permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function roleCreate()
    {
        return view('admin.users.roles.create');
    }

    public function roleStore(Request $request)
    {

        $this->validate($request, [
            "name" => 'required|unique:roles',
        ], [
                'title.required' => 'Enter Name',
                'title.unique' => "Role already exist",
            ]
        );

        Role::create(['name'=>$request->name]);
        Session::flash('success', 'Role created successfully');
        return redirect()->route('role.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function roleEdit($id)
    {
        $permissions = Permission::orderBy('name', 'ASC')->pluck('name', 'id');
        $role=Role::findById($id);
        return view('admin.users.roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Role $role
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function roleUpdate(Request $request, $id)
    {
        $role=Role::findById($request->id);
        $role->syncPermissions($request->permission_id);
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $id . ',id',//ignore this id
        ],
            [
                'title.required' => 'Enter role name',
                'title.unique' => "Role name already exist",
            ]);

        $role->name = $request->name;
        $role->save();

        Session::flash('success', 'Post updated successfully');
        return redirect()->route('role.index');
    }

    public function roleDestroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        Session::flash('success', 'Role deleted successfully');
        return redirect()->route('role.index');
    }

    // PERMISSION FUNCTIONS

    public function permissionIndex()
    {
        $role_permissions = Permission::with('roles')->get();
        return view('admin.users.permissions.index',compact('role_permissions'));
    }

    public function details()
    {
        if(auth()->user()->hasRole(['مدیر'])){
            $details=SiteDetail::first();
            return view('admin.site_details.edit',compact('details'));
        }else{
            abort(403, 'شما مجوز دسترسی به این صفحه را ندارید');
            return redirect('/home');
        }
    }

    public function detailsUpdate(Request $request)
    {
        $details=SiteDetail::first();

        if (isset($request->logo)) {
            $fileNameWithExt = $request->logo->getClientOriginalName();
            // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just file extension
            $fileExt=$request->logo->getClientOriginalExtension();
            // Get file name to store
            $fileNameToStore=$fileName.time().'_'.$fileExt;
            $details->logo=$fileNameToStore;
        }
        if (isset($request->site_name)){
            $details->site_name=$request->site_name;
        }
        if (isset($request->phone1)){
            $details->phone1=$request->phone1;
        }
        if (isset($request->phone2)){
            $details->phone2=$request->phone2;
        }
        if (isset($request->phone3)){
            $details->phone3=$request->phone3;
        }
        if (isset($request->phone4)){
            $details->phone4=$request->phone4;
        }
        if (isset($request->address1)){
            $details->address1=$request->address1;
        }
        if (isset($request->address2)){
            $details->address2=$request->address2;
        }
        if (isset($request->owner)){
            $details->owner=$request->owner;
        }

        $save=$details->save();
        if ($save) {
            if (isset($request->logo)) {
                $request->logo->storeAs('public/logo', $fileNameToStore);
            }
        }
        Session::flash('success', 'Details updated successfully');
        return redirect()->back();
        
    }

}

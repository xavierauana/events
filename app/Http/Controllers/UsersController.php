<?php

namespace App\Http\Controllers;

use App\User;
use App\Validators\UserValidator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Xavierau\RoleBaseAuthentication\Contracts\RoleInterface;

class UsersController extends Controller
{

    private $user;
    /**
     * @var \Xavierau\RoleBaseAuthentication\Contracts\RoleInterface
     */
    private $role;

    /**
     * UsersController constructor.
     *
     * @param \App\User                                                $user
     * @param \Xavierau\RoleBaseAuthentication\Contracts\RoleInterface $role
     */
    public function __construct(User $user, RoleInterface $role)
    {
        $this->user = $user;
        $this->role = $role;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->user->with("roles")->get();
        $users = $this->hideDeveloperIfItIsNot($users);
        return view("back.users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roleList = $this->fetchRoleList();
        return view("back.users.create", compact("roleList"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request                      $request
     * @param \App\Validators\UserValidator $validator
     *
     * @return \App\Http\Controllers\Response
     */
    public function store(Request $request, UserValidator $validator)
    {
        $rules = $validator->getBasicRules($request->role);

        $this->validate($request,$rules);

        $newUser = $this->user->createNewUser($request->all());

        $newUser->roles()->sync($request->role);

        return redirect()->route("admin.users.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->user->with("roles")->findOrFail($id);

        $roleList = $this->fetchRoleList();

        return view("back.users.edit",compact('user', 'roleList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id, UserValidator $validator)
    {
        $user = $this->user->findOrFail($id);

        $rules = $validator->getBasicRules($request->get("role"), $user);

        $this->validate($request, $rules);

        $data = $request->all();
        if(!$data["password"]){
            unset($data["password"]);
        }
        $user->updateUser($data);

        $user->roles()->sync($request->get('role'));

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            $user = $this->user->findOrFail($id);
            $user->delete();
            return ["response"=>"completed", "user"=>$user];
        }
    }

    public function profile()
    {
        $roleList = $this->fetchRoleList();
        return view("back.users.profile",compact("roleList"));
    }

    public function updateProfile(Request $request, UserValidator $validator)
    {
        $user = Auth::user();
        $rules = $validator->getBasicRules($user->roles()->lists("id")->toArray(), $user);
        $data = $request->all();
        if(!$data["password"]){
            unset($data["password"]);
        }
        $this->validate($request, $rules);
        return view("back.users.dashboard");
    }

    /**
     * @param $users
     *
     * @return mixed
     */
    private function hideDeveloperIfItIsNot($users)
    {
        if (!Auth::user()->hasRole(["developer"])) {
            $users = $users->reject(function ($user) {
                if ($user->hasRole(["developer"])) return true;
            });

            return $users;
        }

        return $users;
    }

    /**
     * @return array
     */
    private function fetchRoleList()
    {
        $roles    = $this->role->all();
        $roleList = [];
        foreach ($roles as $role) {
            $roleList[$role->id] = $role->display;
        }
        if (!Auth::user()->hasRole(["developer"])) {
            foreach ($roles as $role) {
                if ($role->code == "developer") {
                    unset($roleList[$role->id]);
                }
            }

            return $roleList;
        }

        return $roleList;
    }
}

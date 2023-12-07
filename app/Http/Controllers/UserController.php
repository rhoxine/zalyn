<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Medhistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //
    public function index()
    {
        $data['users'] = User::all();
        $data['page_open'] = 'users';
        $data['page_title'] = 'users';
        $data['user'] = Auth::user();

        return view('admin.users', $data);
    }

    public function getallusers()
    {
        $users = User::with('roles')->get();

        $response['data'] = $users;

        return response()->json($response);
    }

    public function getallroles()
    {
        $roles = Role::all()->pluck('name');

        $response['roles'] = $roles;

        return response()->json($response);
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required|unique:users,email",
                "password" => "required",
            ]);

            if ($validate->fails()) {
                return response()->json(['status' => 400, 'error' => $validate->getMessageBag()]);
            } else {
                try {
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);

                    $user->assignRole('User');

                    if ($user) {
                        return response()->json(['status' => 200, 'msg' => 'Inserted Succesfully'], 200);
                    } else {
                        return response()->json(['status' => 500, 'msg' => 'Invalid query.'], 500);
                    }
                } catch (\Exception $e) {
                    abort(500, 'Something Went Wrong');
                }
            }
        } catch (\Exception $e) {
            abort(500, 'Something Went Wrong');
        }
    }

    public function edit(Request $request)
    {
        try {
            $id = $request->id;

            $res['user'] = User::where('id', $id)->with('roles')->get()[0];
            $res['roles'] = Role::all();

            return response()->json($res, 200);
        } catch (\Exception $e) {

            return response()->json(['msg' => 'Bad request. ID is not found.'], 400);
        }
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        try {
            $validate = Validator::make($request->all(), [
                "id" => "required",
                "name" => "required",
                "email" => "required|unique:users,email," . $request->id,
                "role" => "required",
            ]);

            if ($validate->fails()) {
                return response()->json(['status' => 400, 'error' => $validate->getMessageBag()]);
            } else {
                try {
                    $id = $request->id;

                    if ($id == 1) {
                        abort(401, 'Unauthorized request!');
                    }

                    $user = User::where('id', $id)->get()[0];
                    $user->syncRoles($request->role);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    if ($request->password != null) {
                        $user->password = Hash::make($request->password);
                    }
                    $user->save();

                    if ($user) {
                        return response()->json(['status' => 200, 'msg' => 'Updated Succesfully', 'data' => $request->all()]);
                    } else {
                        return response()->json(['status' => 500, 'msg' => 'Invalid query.'], 500);
                    }
                } catch (\Exception $e) {
                    abort(500, 'Something Went Wrong' . $e);
                }
            }
        } catch (\Exception $e) {
            abort(500, 'Something Went Wrong');
        }
    }

    public function select(Request $request)
    {
        $id = $request->id;
        $user = User::where('id', $id)->get();

        if (count($user)) {
            $data['id'] = $id;
            $data['data'] = $user;
            return response()->json($data, 200);
        } else {
            return response()->json(['msg' => 'Bad request. ID is not found.'], 400);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $user = User::where('id', $id)->get();

        if (count($user) > 0) {
            $user = User::where('id', $id)->delete();
            if ($user) {
                return response()->json(['msg' => 'Success'], 200);
            } else {
                return response()->json(['msg' => 'Invalid Query'], 500);
            }
        } else {
            return response()->json(['msg' => 'Bad request. ID is not found.'], 400);
        }
    }
    public function view($id)
{
    $user = User::find($id);

    if (!$user) {
        // Handle case when user with given ID is not found
        abort(404);
    }

    $medHistory = Medhistory::with('questions')->where('user_id', $id)->get();

    return view('admin.patient_list', ['user' => $user, 'medHistory' => $medHistory]);
}

    
    


}

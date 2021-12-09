<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;
class UserController extends Controller
{
    //
    public function index()
    {
        $users = UserModel::all();
        $results = [
            "data" => $users,
            "code" => 200,
            "message" => "listing users successfully!"
        ];

        return response()->json($results);
    }

    //storing new user
    public function store_user(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'bail|required|max:100',
            'address' => 'required|max:255',
            'mobile_number' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validatedData) {
            $fullname = $request->name;
            $email = $request->email;
            $address = $request->address;
            $mobile_number = $request->mobile_number;
            $password = bcrypt($request->password);
            $user = new UserModel;
            $user->name = $fullname;
            $user->email = $email;
            $user->address = $address;
            $user->mobile_number = $mobile_number;
            $user->password = $password;
            $user->save();

            $results = [
                "data" => $user,
                "code" => 200,
                "message" => "New User Inserted successfully"

            ];
            return response()->json($results);
        }
    }


    // User Update
    public function update(Request $request, $id)
    {
        if ($id) {
            $fullname = $request->name;
            $address = $request->address;
            $mobile_number = $request->mobile_number;
            $email = $request->email;

            $user = UserModel::findOrFail($id);
            $user->name = $fullname;
            $user->address = $address;
            $user->mobile_number = $mobile_number;
            $user->email = $email;
            $user->save();

            $results = [
                "data" => $user,
                "code" => 200,
                "mesage" => "User Updated Successfully"
            ];
            return response()->json($results);
        }
    }

    // User delete query
    public function destroy ($id){
        if ($id){
            $user = UserModel::findOrFail($id);
            $user->delete();
            $user = UserModel::all();
            return response()->json($user);
        }
    }
}


<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
     //changePasswordPage
     public function changePasswordPage () {
        return view('admin.account.changePassword');
    }

    // change Password
    public function changePassword (Request $request) {
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword =$user->password;  //hash value

        if(Hash::check($request->oldPassword,$dbPassword)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);

            Auth::logout();
            return redirect()->route('auth#loginPage');
        }
        return back()->with(['notMatch' => 'The Old Password not Match. Try Again!']);

    }

    // direct admin info
    public function details (){
        return view('admin.account.details_info');
    }

    //account info edit
    public function edit (){
        Auth::user()->id;
        return view('admin.account.edit');
    }

    // admin info update
    public function update ($id,Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess' => 'Admin Account Updated']);
    }

    // admin list
    public function list (){
        $admin = User::when(request('key'),function($query){
                $query->orWhere('name','like','%'.request('key').'%')
                      ->orWhere('email','like','%'.request('key').'%')
                      ->orWhere('address','like','%'.request('key').'%')
                      ->orWhere('gender','like','%'.request('key').'%')
                      ->orWhere('phone','like','%'.request('key').'%');
                  })
                      ->where('role','admin')
                      ->paginate(3);
        return view ('admin.account.list',compact('admin'));
    }

    // admin account delete
    public function delete ($id){
        $admin = User::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Delete Account Success']);
    }

    // admin account role change
    public function role($id){
        $account = User::where('id',$id)->first();
         return view ('admin.account.adminRole',compact('account'));
    }

    // admin account role update
    public function roleUpdate ($id,Request $request){
        $data = $this->requestUpdateData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    // admin change user role
    public function useList (){
        $user = User::where('role','user')->get();
        return view ('admin.account.userList',compact('user'));
    }

    // admin account request data
    private function requestUpdateData ($request){
        return [
            'role'  => $request->role,
        ];
    }

    //admin update data check
    private function getUserData ($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'created_at' => Carbon::now()
        ];
    }

    // admin account validator check
    private function accountValidationCheck ($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'image' => 'mimes:png,jpg,jpeg,jfif|file',
            'address' => 'required'


        ])->validate();
    }


    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|max:10' ,
            'newPassword' => 'required|min:6|max:10' ,
            're-newPassword' => 'required|min:6|max:10|same:newPassword'
        ])->validate();
    }
}

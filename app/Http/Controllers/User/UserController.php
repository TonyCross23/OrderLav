<?php

namespace App\Http\Controllers\User;

use view;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    // User Home Page
    public function home (){
        $user = User::get();
        $category = Category::get();
        $product = Product::orderBy('created_at','desc')->get();
        return view('user.main.home',compact('user','category','product'));
    }

    // direct password change page
    public function passwordChangePage () {
        return view ('user.account.password');
    }

    // user password change
    public function passwordChange (Request $request){
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword =$user->password;  //hash value

        if(Hash::check($request->oldPassword,$dbPassword)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            return back()->with(['changePassword' => 'Change Password Success!']);
        }
        return back()->with(['notMatch' => 'The Old Password not Match. Try Again!']);
    }

    // profile update page
    public function updatePage (){
        return view ('user.profile.edit');
    }

    // profile account update
    public function update ($id,Request $request) {
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

    // pizza details
    public function detailsPage ($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view ('user.main.details',compact('pizza','pizzaList'));
    }

        //user update data check
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

        // filter list
        public function filter ($categoryId){

            $category = Category::get();
            $product = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
            return view('user.main.home',compact('category','product'));
        }

        // user account validator check
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

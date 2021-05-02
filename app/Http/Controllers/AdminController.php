<?php

namespace App\Http\Controllers;

use App\Suggestion;
use App\Brand;
use App\Type;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{

    /**
     * Method responsible for rendering admin area dashboard if user is logged in.
     * Returns the view or redirects the user to the login page
     */
    public function main(){
        if(Auth::check()){

            $user = Auth::user();
            $userId = $user->id;

            $types = DB::table('types')->get();
            $brands = DB::table('brands')->get();
            $mySuggestions = (new Suggestion())->query()->where('user_id', $userId)->get();

            return view('admin.main', ['types' => $types, 'brands' => $brands, 'mySuggestions' => $mySuggestions]);
        }

        return redirect()->route('admin.login');
    }

    /**
     * Method responsible for rendering login page.
     */
    public function loginForm(){
        return view('login');
    }

    /**
     * Method responsible for attempt user login
     * Redirects to the route responsible for guiding user to admin area or an error if attempt is not successfull
     */
    public function loginUser(Request $request){
        $email = filter_var($request->email, FILTER_VALIDATE_EMAIL);
        $password = filter_var($request->password, FILTER_SANITIZE_STRIPPED);

        $credentials = ['email' => $email, 'password' => $password];
        if(Auth::attempt($credentials)){
            return redirect()->route('admin.main');
        }

        return redirect()->back()->withInput(['email'])->withErrors(['Os dados informados não conferem']);
    }

    /**
     * Method responsible for logout the user.
     * Redirects user to route
     */
    public function logoutUser(){
        Auth::logout();
        return redirect()->route('home');
    }

    /**
     * Method responsible for processing the suggestion.
     * Returns the view or redirects the user to admin page
     */
    public function createSuggestion(Request $request){
        $inputs = $request->except(['_token']);
        $inputsFiltered = filter_var_array($inputs, FILTER_SANITIZE_STRIPPED);
        
        $suggestion = new Suggestion();
        $user = Auth::user();
        $suggestion->user_id = $user->id;
        $suggestion->brand_id = $inputsFiltered['brand'];
        $suggestion->type_id = $inputsFiltered['type'];
        $suggestion->suggestion = $inputsFiltered['suggestion'];
        $suggestion->version = $inputsFiltered['version'];
        $suggestion->model = $inputsFiltered['model'];
        $suggestion->save();
        return redirect()->route('admin.main');
    }
}

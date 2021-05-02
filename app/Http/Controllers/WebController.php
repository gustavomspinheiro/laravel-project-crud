<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Suggestion;

class WebController extends Controller
{
    protected $types;
    protected $brands;

    public function __construct()
    {
        $this->types = DB::table('types')->get();
        $this->brands = DB::table('brands')->get(); 
    }

    /**
     * Method responsible for rendering home page with expected parameters
     */
    public function home(){

        
        $suggestions = (new Suggestion())->query()->get();
        return view('home', ['types' => $this->types, 'brands' => $this->brands, 'suggestions' => $suggestions]);
    }

    /**
     * Method responsible for filtering suggestion result in home page.
     * Returns the home view.
     */
    public function filter(Request $request){
        
        $inputs = $request->except(['_token']);
        $filteredInputs = filter_var_array($inputs, FILTER_SANITIZE_STRIPPED);
        
        $conditions = [];
        $typeCondition = (!empty($filteredInputs['type']) ? ['type_id', '=', $filteredInputs['type']] : "");
        $brandCondition = (!empty($filteredInputs['brand']) ? ['brand_id', '=', $filteredInputs['brand']] : "");
        $modelCondition = (!empty($filteredInputs['modelFilter']) ? ['model', 'like', '%'.$filteredInputs['modelFilter'].'%'] : '');
        $versionCondition = (!empty($filteredInputs['versionFilter']) ? ['version', 'like', '%'.$filteredInputs['versionFilter'].'%'] : "");
        
        if(!empty($typeCondition)){
            array_push($conditions, $typeCondition);
        }

        if(!empty($brandCondition)){
            array_push($conditions, $brandCondition);
        }

        if(!empty($modelCondition)){
            array_push($conditions, $modelCondition);
        }

        if(!empty($versionCondition)){
            array_push($conditions, $versionCondition);
        }

        $filteredSuggestions = (new Suggestion())->query()->where($conditions)->get();
        return view('home', ['types' => $this->types, 'brands' => $this->brands, 'suggestions' => $filteredSuggestions]);
    }
}

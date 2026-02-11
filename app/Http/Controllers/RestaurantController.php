<?php
namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index(){
        $restaurants=Restaurant::all();
        return view('restaurant.index',compact('restaurants'));
    }  
    public function create(){
        return view('restaurant.create');
    }
    public function store(Request $request){
        if(Auth::user()->role != 'restaurateur'){
            return back()->with('error','Accès refusé');
        }
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'ville' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
            'cuisine' => 'required|string'
        ]);
        $data['user_id'] = Auth::id();
        Restaurant::create($data);
        return back()->with('success','Restaurant créé avec succès');
    }
    public function edit($id){
        $restaurant=Restaurant::findOrFail($id);
        if($restaurant->user_id !== auth()->user->id()){
            return redirect()->route('restaurant.index')->with('error','Accès refusé');
        }
        return view('restaurant.edit',compact('restaurant'));
    }
    public function update(Request $request,$id){
        $restaurant=Restaurant::findorFail($id);
        if($restaurant->user_id !== auth()->user->id()){
            return redirect()->route('restaurant.index')->with('error','Accès refusé');
        }
         $data = $request->validate([
            'name' => 'required|string|max:255',
            'ville' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
            'cuisine' => 'required|string'
        ]);
        $restaurant->update($data);
        return redirect()->route('restaurant.index')->with('success', 'Restaurant mis à jour !');
    }
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);

    if ($restaurant->user_id !== auth()->user->id) {
        return back()->with('error', 'Ceci ne vous appartient pas !');
    }
    $restaurant->delete();

    return redirect()->route('restaurant.index')->with('success', 'Restaurant supprimé avec succès.');
    }
    public function details($id){
        $restaurant=Restaurant::findorfail($id);
        return view('restaurant.details',compact('restaurant'));
    }
    public function search(Request $request){
        $search=$request->input('search');
        $restaurant=Restaurant::when(request('ville'),function($q){
            $q->where('ville','like','%'.request('ville').'%');
        
            })
        ->when(request('cuisine'),function($q){
            $q->where('cuisine','like','%'.request('cuisine').'%');
        })
        ->paginate(request('per_page,10'));
    }
    public function countrestaurants(){
        $nb_restaurants=Restaurant::count();
        return view('admin.dashboard',compact('nb_restaurants'));
    }
    

}
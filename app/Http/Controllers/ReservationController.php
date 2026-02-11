<?php
namespace App\Http\Controllers;
use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Auth;
class ReservationController extends Controller {
    use AuthorizesRequests;
    public function create_reservation(){
        return view("reservations.create");
    }
    public function store_reservation(Request $request){
        $data=$request->validate([
            'date_reservation'  => 'required|date|after_or_equal:today',
        'heure_reservation' => 'required|date_format:H:i',
        'nombre_personnes'  => 'required|integer|min:1|max:20',
        'restaurant_id'     => 'required|exists:restaurants,id',
            
        ]);
        $alreadyBooked = Reservation::where('user_id', Auth::id())
        ->where('date_reservation', $data['date_reservation'])
        ->where('heure_reservation', $data['heure_reservation'])
        ->exists();

    if ($alreadyBooked) {
        return back()->withErrors(['error' => 'You already have a reservation at this time.']);
    }


    $reservation = Reservation::create([
        'date_reservation'  => $data['date_reservation'],
        'heure_reservation' => $data['heure_reservation'],
        'nombre_personnes'  => $data['nombre_personnes'],
        'restaurant_id'     => $data['restaurant_id'],
        'user_id'           => Auth::id(),
        'status'            => 'en_attente',
    ]);

    return redirect()->route('reservations.show', $reservation->id)
                     ->with('success', 'Reservation requested!');
    }

    
    public function reservationbyrestaurant($id)
    {
        $restaurant=Restaurant::findOrFail($id);
        $reservations=$restaurant->reservations;
        return view('admin.reservation.index', compact('restaurant','reservations'));
    }
    public function show(Reservation $reservation)
    {
    $this->authorize('view', $reservation); 
    return view('reservations.show', compact('reservation'));
    }
}
<?php
namespace App\Http\Controllers;
use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
class ReservationController extends Controller {
    use AuthorizesRequests;
    public function index(){
        $reservations = Reservation::all();
        return view('reservations.indexres',compact('reservations'));
    }
    public function create(){
        $restaurants=Restaurant::all();
        return view("reservations.createres", compact('restaurants'));
    }
    public function store_reservation(Request $request) 
{
    $data = $request->validate([
        
        'date_reservation'  => 'required|date|after:today', 
        'heure_reservation' => 'required|date_format:H:i',
        'nombre_personnes'  => 'required|integer|min:1|max:20',
        'restaurant_id'     => 'required|exists:restaurants,id',
    ]);

    $alreadyBooked = Reservation::where('user_id', Auth::id())
        ->where('date_reservation', $data['date_reservation'])
        ->where('heure_reservation', $data['heure_reservation'])
        ->exists();

    if ($alreadyBooked) {
        return back()->withErrors(['error' => 'Vous avez déjà une réservation à ce créneau.']);
    }

    $this->authorize('create', Reservation::class);

    $reservation = Reservation::create([
        'date_reservation'  => $data['date_reservation'],
        'heure_reservation' => $data['heure_reservation'],
        'nombre_personnes'  => $data['nombre_personnes'],
        'restaurant_id'     => $data['restaurant_id'],
        'user_id'           => Auth::id(),
        'status'            => 'en_attente',
    ]);

    return redirect()->route('reservations.index') // Rediriger vers la liste est souvent plus simple
                     ->with('success', 'Réservation demandée avec succès !');
}
    public function edit(Reservation $reservation){
        $this->authorize('update', $reservation);
        return view('reservations.editres', compact('reservation'));
    }
    public function update(Request $request, Reservation $reservation){
    $this->authorize('update', $reservation);
    $validated = $request->validate([
        'reservation_time' => 'required|date',
        'guests' => 'required|integer|min:1',
        'status' => 'nullable|string',
    ]);
    $reservation->update($validated);
    /** @var \App\Models\User $user */
    $user = Auth::user();
    if ($request->has('status') && !$user->hasRole('restaurant_owner')) {
    abort(403, 'Only owners can change the reservation status.');
    }
    return redirect()->route('reservations.indexres')
                     ->with('success', 'Reservation updated successfully!');
    }
    public function delete(Reservation $reservation)
    {
        $this->authorize('delete', $reservation);
        $reservation->delete();
        return redirect()->route('reservations.indexres')
                         ->with('success', 'Reservation deleted successfully!');
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
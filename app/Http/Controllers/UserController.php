<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('addresses')->paginate(10);
        return response()->json($users);
    }
    public function show($id)
    {
        $book = User::with('addresses')->find($id);
        return response()->json($book);
    }


    public function search(Request $request)
    {
        $users = new User();
        if ($request->filled('query')) {
            $users = $users->where('first_name', 'like', '%' . $request->input('query') . '%')
                ->orWhere('last_name', 'like', '%' . $request->input('query') . '%');
        }
        if ($request->filled('_from')) {
            // whereBetween('birthday', [$minDate, $maxDate])
            $Date = Carbon::today()->subYears($request->input('_from'));
            $users = $users->whereDate('birthdate', '<=', $Date);
        }
        if ($request->filled('_to')) {
            $Date = Carbon::today()->subYears($request->input('_to'))->endOfDay();
            $users = $users->whereDate('birthdate', '>=', $Date);
        }



        if ($request->filled('city')) {
            $users = $users->whereHas('addresses', function($query) use($request){
                $query->where('city', 'like', '%' . $request->input('city') . '%');
            });
        }


        $users = $users->with('addresses')->paginate(10);;
        // $users = $users->toSql();

        return response()->json($users);
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'required|unique:users,mobile_number,' . $id . '|digits:10',
            'addresses' => 'required|array|min:1',
            'addresses.*.address_line_1' => 'required',
            'addresses.*.city' => 'required',
            'addresses.*.state' => 'required',
            'addresses.*.type' => 'required',
            'addresses.*.zip_code' => 'required|digits_between:4,6'
        ]);


        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->email = $validatedData['email'];
        $user->mobile_number = $validatedData['mobile_number'];
        $user->save();

        $user->addresses()->delete();

        foreach ($validatedData['addresses'] as $addressData) {
            $address = new Address();
            $address->address_line_1 = $addressData['address_line_1'];
            $address->address_line_2 = $request['address_line_2'];
            $address->type = $addressData['type'];
            $address->city = $addressData['city'];
            $address->state = $addressData['state'];
            $address->zip_code = $addressData['zip_code'];
            $address->user_id = $user->id;
            $address->save();
        }

        return response()->json($user);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();


        return response()->json('User has been deleted!');
    }
}

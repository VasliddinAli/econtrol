<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CEO;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CEOController extends Controller
{
    public function ceoView()
    {
        $ceos = CEO::where('status', 'active')->get();
        return view('backend.ceo.ceo_view', compact('ceos'));
    }

    public function ceoStore(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'phone' => 'required|unique:c_e_o_s',
                'password' => 'required',
            ],
            [
                'name.required' => 'CEO nomini kiriting',
                'phone.required' => 'Telefonni kiriting',
                'phone.unique' => 'Telefon mavjud',
                'password.required' => 'Parolni kiriting',
            ]
        );
        $phone = Str::after($request->phone, '+');
        $password = Hash::make($request->password);

        CEO::insert([
            'name' => $request->name,
            'phone' => $phone,
            'password' => $password,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'CEO muvaffaqiyatli qo\'shildi!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ceoEdit($ceo_id)
    {
        $ceo = CEO::findOrFail($ceo_id);
        return view('backend.ceo.ceo_edit', compact('ceo'));
    }

    public function ceoUpdate(Request $request, $ceo_id)
    {

        $request->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'CEO nomini kiriting',
            ]
        );
        $ceo = CEO::where('id', $ceo_id)->first();
        $phone = Str::after($request->phone, '+');
        $ceo->update([
            'name' => $request->name,
            'phone' => $phone,
        ]);

        $notification = array(
            'message' => 'CEO muvaffaqiyatli o\'zgartirildi!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.ceo')->with($notification);
    }

    public function ceoDelete($ceo_id)
    {

        $ceo = CEO::findOrFail($ceo_id);
        $ceo->update([
            'status' => 'deleted'
        ]);
        $notification = array(
            'message' => 'CEO muvaffaqiyatli o\'chirildi!',
            'alert-type' => 'info'
        );
        return redirect()->route('all.ceo')->with($notification);
    }

    public function ceoShow($ceo_id)
    {
        $ceo = CEO::findOrFail($ceo_id);
        return view('backend.ceo.ceo_detail', compact('ceo'));
    }

    public function ceoUpdateLogin(Request $request, $ceo_id)
    {
        $request->validate(
            [
                'phone' => 'required',
                'password' => 'required',
            ],
            [
                'phone.required' => 'Telefon kiriting',
                'password.required' => 'Parolni kiriting',
            ]
        );
        $password = Hash::make($request->password);
        $phone = Str::after($request->phone, '+');

        $ceo = CEO::where('id', $ceo_id)->first();

        $ceo->update([
            'phone' => $phone,
            'password' => $password,
        ]);

        $notification = array(
            'message' => 'CEO logini muvaffaqiyatli o\'zgartirildi!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}

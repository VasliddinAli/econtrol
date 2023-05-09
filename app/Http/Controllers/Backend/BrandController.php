<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BrandController extends Controller
{
    public function brandView()
    {
        $brands = Brand::where('status', 'active')->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    public function brandStore(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'phone' => 'required|unique:brands',
                'password' => 'required',
            ],
            [
                'name.required' => 'CEO nomini kiriting',
                'phone.required' => 'Telefonni kiriting',
                'phone.unique' => 'Telefon mavjud',
                'password.required' => 'Parolni kiriting',
            ]
        );
        $password = Hash::make($request->password);

        Brand::insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => $password,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'CEO muvaffaqiyatli qo\'shildi!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function brandEdit($brand_id)
    {
        $brand = Brand::findOrFail($brand_id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function brandUpdate(Request $request, $brand_id)
    {

        $request->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'CEO nomini kiriting',
            ]
        );
        $brand = Brand::where('id', $brand_id)->first();
        $brand->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        $notification = array(
            'message' => 'CEO muvaffaqiyatli o\'zgartirildi!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.brand')->with($notification);
    }

    public function brandDelete($brand_id)
    {

        $brand = Brand::findOrFail($brand_id);
        $brand->update([
            'status' => 'deleted'
        ]);
        $notification = array(
            'message' => 'CEO muvaffaqiyatli o\'chirildi!',
            'alert-type' => 'info'
        );
        return redirect()->route('all.brand')->with($notification);
    }

    public function brandShow($brand_id)
    {
        $brand = Brand::findOrFail($brand_id);
        $regions = Region::get();
        return view('backend.brand.brand_detail', compact('brand', 'regions'));
    }

    public function brandUpdateLogin(Request $request, $brand_id)
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

        $brand = Brand::where('id', $brand_id)->first();

        $brand->update([
            'phone' => $request->phone,
            'password' => $password,
        ]);

        $notification = array(
            'message' => 'CEO logini muvaffaqiyatli o\'zgartirildi!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Purpose;
use Illuminate\Http\Request;

class PurposeController extends Controller
{
    public function purposeView()
    {
        $purposes = Purpose::get();
        return view('backend.purpose.purpose_view', compact('purposes'));
    }

    public function purposeStore(Request $request)
    {
        $request->validate(
            [
                'purpose' => 'required',
            ],
            [
                'purpose.required' => 'Purpose kiriting',
            ]
        );

        Purpose::insert([
            'purpose' => $request->purpose,
        ]);

        $notification = array(
            'message' => 'Purpose muvaffaqiyatli qo\'shildi!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function purposeEdit($purpose_id)
    {
        $purpose = Purpose::findOrFail($purpose_id);
        return view('backend.purpose.purpose_edit', compact('purpose'));
    }

    public function purposeUpdate(Request $request, $purpose_id)
    {
        $purpose = Purpose::where('id', $purpose_id)->first();
        $purpose->update([
            'purpose' => $request->purpose,
        ]);

        $notification = array(
            'message' => 'Purpose muvaffaqiyatli o\'zgartirildi!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.purpose')->with($notification);
    }

    public function purposeDelete($purpose_id)
    {
        $purpose = Purpose::where('id', $purpose_id)->first();
        $purpose->delete();
        $notification = array(
            'message' => 'Purpose muvaffaqiyatli o\'chirildi!',
            'alert-type' => 'info'
        );
        return redirect()->route('all.purpose')->with($notification);
    }
}

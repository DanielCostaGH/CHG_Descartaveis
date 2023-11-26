<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FooterController extends Controller
{


    public function getFooter()
    {
        $footer = Footer::all();
        return response()->json($footer);
    }

    public function updateFooter(Request $request)
    {
        $footer = Footer::find(1) ?? new Footer();

        $footer->whatsapp_num = $request->whatsapp_num;
        $footer->call_num = $request->call_num;
        $footer->instagram = $request->instagram;
        $footer->email = $request->email;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/footer'), $filename);

            $footer->image = $filename;
        }

        $footer->save();

        return response()->json(['message' => 'Footer updated successfully!']);
    }
}

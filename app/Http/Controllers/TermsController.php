<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        return view('dashboard.config.condition-terms');
    }


    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);
        $termId = $request->input('termId');

        $termo = Term::updateOrCreate(
            ['id' => $termId],
            ['content' => $request->content]
        );

        return response()->json(['message' => 'Termo salvo com sucesso!']);
    }

    public function getServiceTerms()
    {

        $termo = Term::getServiceTerms();

        if ($termo) {
            return response()->json($termo);
        } else {
            return response()->json(['content' => '', 'message' => 'Termo não encontrado!']);
        }
    }

}

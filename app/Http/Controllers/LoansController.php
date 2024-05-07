<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loans;

class LoansController extends Controller
{
   
    public function index(Request $request)
    {
        if($request->has('sum')) {
            $loan=Loans::where('sum', $request->sum)->get();
            return response()->json($loan);;
        }
        if($request->has('data')) {
            $loan=Loans::where('created_at', $request->data)->get();
            return response()->json($loan);;
        }
        $loans=Loans::all();
        return response()->json($loans);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'sum' => 'required'
        ]);

        $loan = Loans::create($request->all());
        return response()->json($loan, 201);
    }

    public function show($id)
    {
        return response()->json(Loans::find($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'sum' => 'required'
        ]);

        $loan = Loans::findOrFail($id);
        $loan->update($request->all());
        return response('Loan updated', 200);
    }

    public function destroy($id)
    {
        Loans::findOrFail($id)->delete();
        return response('Loan deleted', 200);
    }
}

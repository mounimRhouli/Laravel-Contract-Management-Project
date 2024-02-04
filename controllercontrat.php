<?php

namespace App\Http\Controllers;

use App\contrats;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use Carbon\Carbon;
use PDF;



class controllercontrat extends Controller
{
    public function __construct()
    {
            $this->middleware('auth');
    }
    public function index() {
    $data=contrats::all();
        return view('admin.contrats.index')->with($data);
    }
    public function create() {
        $data = [

       ];
       return view('admin.contrats.create')->with($data);
   }

   public function store(Request $request) {
       $this->validate($request,[
           'id'=>'required',
           'debut' => 'required',
           'fin' => 'required',
           'tiers' => 'required',
           'mantant' => 'required',
       ]);

       $contratsdetails = [
           'id' => $request->id,
           'debut' => $request->debut,
           'fin' => $request->fin,
           'tiers' => $request->tiers,
           'typecontrat_id' => $request->typecontrat_id,
           'designation' => $request->designation,
           'departement_id' => $request->departement_id,
           'responsable_id' => $request->responsable_id,
            'montant'=>$request->montant,
       ];

       $contrats=contrats::create($contratsdetails);

       $request->session()->flash('success', "Contrat ajouté avec succès");
        return redirect()->route('admin.contrats.edit', $contrats->id);
       return back();
   }
   public function edit($id)
{
    $contrat = Contrats::findOrFail($id); // Get the contract with the specified ID

    // You can fetch any additional data needed for the edit view here if required

    return view('admin.contrats.edit', compact('contrat'));
}
public function update(Request $request, $id)
{
    $contrat = Contrats::findOrFail($id);

    $this->validate($request, [
        'id'=>'required',
           'debut' => 'required',
           'fin' => 'required',
           'tiers' => 'required',
           'mantant' => 'required',
    ]);


    $contrat->update([
        'debut' => $request->debut,
        'fin' => $request->fin,
        'tiers' => $request->tiers,
        'typecontrat_id' => $request->typecontrat_id,
        'designation' => $request->designation,
        'departement_id' => $request->departement_id,
        'responsable_id' => $request->responsable_id,
         'montant'=>$request->montant,
    ]);

    $request->session()->flash('success', "Contrat mis à jour avec succès");
    return redirect()->route('admin.contrats.edit', $contrat->id);
}



    public function destroycontrat($contrat_id) {
        $contrat = contrats::findOrFail($contrat_id);

        $contrat->delete();
         return response()->json(['ok' => 'ok']);
    }
}

// ...


<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Response;

use App\Http\Controllers\Controller;

use App\contrats;
use App\Department;
use App\TypeContrat;
use App\User;

use App\Role;

use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class contratController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'data' => contrats::where('deleted', 0)->get(),
        ];

        return view('admin.contrats.index')->with($data);
    }


    public function create()
    {
        $data = [
            'typecontrats' => TypeContrat::all(),
            'departement' => Department::all(),
            'responsable' => User::all(),
        ];
        return view('admin.contrats.create')->with($data);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'debut' => 'required',
            'fin' => 'required|date|after:debut',
            'typecontrat_id' => 'required',
            'departement_id' => 'required',
            'user_id' => 'required',
            'montant' => 'required',
            'tiers' => 'required',

        ]);

        $contratsdetails = [
            'debut' => $request->debut,
            'fin' => $request->fin,
            'tiers' => $request->tiers,
            'typecontrat_id' => $request->typecontrat_id,
            'user_id' => $request->user_id,
            'departement_id' => $request->departement_id,
            'montant' => $request->montant,
            'designation' => $request->designation,

        ];


        $contrat = contrats::create($contratsdetails);

        $request->session()->flash('success', "contrat ajouté avec succès");
        return redirect()->route('admin.contrats.edit', $contrat->id);
        return back();
    }

    public function edit($contrat_id)
    {

        $data = [
            'contrats' => contrats::findOrFail($contrat_id),
            'typecontrats' => TypeContrat::all(),
            'departement' => Department::all(),
            'responsable' => User::all(),
        ];

        return view('admin.contrats.edit')->with($data);
    }


    public function update(Request $request)
    {
        $data = contrats::find($request->id);
        $this->validate($request, [
            'debut' => 'required|date',
            'fin' => 'required|date|after:debut',
            'typecontrat_id' => 'required',
            'departement_id' => 'required',
            'user_id' => 'required',
            'montant' => 'required',
            'tiers' => 'required',
        ]);

        $data->debut = $request->debut;
        $data->fin = $request->fin;
        $data->tiers = $request->tiers;
        $data->typecontrat_id = $request->typecontrat_id;
        $data->user_id = $request->user_id;
        $data->departement_id = $request->departement_id;
        $data->designation = $request->designation;
        $data->montant = $request->montant;
        $data->save();

        // Si vous souhaitez modifier le fichier actuel, le précédent restera dans le dossier 'contrats'.

        // if($request->file('pdf_url')!=null && $request->file('pdf_url')!="")
        // {
        //         if ($file = $request->file('pdf_url'))
        //          {

        //         $destinationPath = public_path('/contrats/');
        //         $mfile = $file->getClientOriginalName();
        //         $file->move($destinationPath, $data->id.'_'.$mfile);

        //         $data->pdf_url=$data->id.'_'.$mfile;
        //         $data->save();
        //  }
        // }

        // Si vous modifiez le fichier, l'ancien fichier sera supprimé
        if ($request->file('pdf_url') != null && $request->file('pdf_url') != "") {
            if ($file = $request->file('pdf_url')) {
                $destinationPath = public_path('/contrats/');
                $mfile = $file->getClientOriginalName();

                // Delete old file if it exists
                if ($data->pdf_url && file_exists($destinationPath . $data->pdf_url)) {
                    unlink($destinationPath . $data->pdf_url);
                }

                $file->move($destinationPath, $data->id . '_' . $mfile);

                $data->pdf_url = $data->id . '_' . $mfile;
                $data->save();
            }
        }


        return redirect('admin/contrats/liste-contrats');
    }

    public function destroycontrat($contrat_id)
    {
        $contrats = contrats::findOrFail($contrat_id);
        $contrats->update(['deleted' => 1]);


        return redirect('admin/contrats/liste-contrats');
    }


    public function downloadPDF($id)
    {
        // Get the Contrat data based on the given ID or use any other method to retrieve the data
        $contrats = Contrats::find($id);
        $data = ['contrats' => $contrats];

        // Load the view to generate the PDF
        $pdf = PDF::loadView('admin.contrats.contrat', $data); // Assuming you have a view file called 'pdf.contrat'

        // Generate the PDF content
        $pdfContent = $pdf->output();

        // Set the appropriate headers for PDF download
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="contrats.pdf"',
        ];

        // Return the response with PDF content
        return Response::make($pdfContent, 200, $headers);
    }


    // Prenez les données qui ont été utilisées sur la page d'analyse des données
    public function graph()
    {
        // the first and secand garaph graph
        $contractsData = Contrats::select('typecontrat_id')->where('deleted', 0)
            ->selectRaw('typecontrat_id, sum(montant) as total_amount, count(*) as contract_count')
            ->groupBy('typecontrat_id')
            ->get();

        $contractTypes = TypeContrat::pluck('designation', 'id')->toArray();

        $labels = array_values($contractTypes);
        $totalAmounts = [];
        $contractCounts = [];

        foreach ($contractTypes as $typeId => $typeName) {
            $contractsOfType = $contractsData->where('typecontrat_id', $typeId)->first();
            if ($contractsOfType) {
                $totalAmounts[] = $contractsOfType->total_amount;
                $contractCounts[] = $contractsOfType->contract_count;
            } else {
                $totalAmounts[] = 0;
                $contractCounts[] = 0;
            }
        }

        // table of date fin
        $expiredContracts = Contrats::where('fin', '<', now())->get();

        //   porsantage  contart by department
        $contractsByDepartment = Contrats::select('departement_id')->where('deleted', 0)
            ->selectRaw('departement_id, COUNT(*) as contract_count')
            ->groupBy('departement_id')
            ->pluck('contract_count', 'departement_id')
            ->toArray();
        $condition = contrats::where('deleted', 0)->pluck('departement_id');
        $departmentIds = $condition->toArray();
        $departments = Department::whereIn('id', $departmentIds)->get();
        $departmentLabels = [];

        foreach ($departments as $department) {
            $departmentLabels[$department->id] = $department->name;
        }

        //tiers

        $contractsByTiersAndTypes = Contrats::select('tiers')->where('deleted', 0)
            ->selectRaw('tiers, typecontrat_id, count(*) as contract_count')
            ->groupBy('tiers', 'typecontrat_id')
            ->get();

        $contractsByTiers = [];
        foreach ($contractsByTiersAndTypes as $contract) {
            $contractsByTiers[$contract->tiers][$contract->typecontrat_id] = $contract->contract_count;
        }

        return view('admin.contrats.graph', [
            'labels' => $labels,
            'totalAmounts' => $totalAmounts,
            'contractCounts' => $contractCounts,
            'contractTypes' => $contractTypes,
            'contractsData' => $contractsData,
            'expiredContracts' => $expiredContracts,
            'contractsByTiers' => $contractsByTiers,
            'departmentLabels' => $departmentLabels,
            'contractsByDepartment' => $contractsByDepartment,

        ]);
    }
    public  function details($id)
    {

        $contrat = contrats::findOrFail($id);
        return view('admin.contrats.details', compact('contrat'));
    }
}




 // public function Masque( Request $request){

    //     $data = contrats::find($request->id);
    //     $this->validate($request, [
    //         'debut' => 'required|date',
    //         'fin' => 'required|date|after:debut',
    //         'typecontrat_id' => 'required',
    //         'departement_id' => 'required',
    //         'user_id' => 'required',
    //         'montant' => 'required',
    //     ]);

    //     $data->debut = $request->debut;
    //     $data->fin = $request->fin;
    //     $data->tiers = $request->tiers;
    //     $data->typecontrat_id = $request->typecontrat_id;
    //     $data->user_id = $request->user_id;
    //     $data->departement_id = $request->departement_id;
    //     $data->designation = $request->designation;
    //     $data->montant = $request->montant;
    //     $data->deleted=1;

    //     $data->save();
    // }

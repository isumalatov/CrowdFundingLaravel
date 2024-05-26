<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contribution;
use App\Models\Project;
use App\Models\Reward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContributionController extends Controller
{
    public function index()
    {
        $contribution = Contribution::paginate(100);
        return view('contributions.index',['contributions'=>$contribution]);
        
    }
    

    public function search(Request $request)
    {
        $precioUsuario = $request->input('precio');
        $proyectoUsuario = $request->input('proyecto');
    
        if ($precioUsuario !== null) {
            $contributions = Contribution::where('amount', $precioUsuario)->get();
        } elseif ($proyectoUsuario !== null) {
            $contributions = Contribution::whereHas('project', function ($query) use ($proyectoUsuario) {
                $query->where('title', 'like', '%' . $proyectoUsuario . '%');
            })->get();
        } else {
            // En caso de que no se haya proporcionado ni precio ni proyecto
            $contributions = Contribution::all();
        }
    
        return view('contributions.search', [
            'contributions' => $contributions,
        ]);
    }

    public function create($project_id)
    {
        return view('contributions.create', [
            'project_id' => $project_id,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'amount' => 'required|numeric',
        ]);

        // Obtener el ID del usuario autenticado
        //$user_id = Auth::id();
        //Reemplazo mientras no esta hecho
        //$user_id = 1;

        DB::transaction(function () use ($request) {
            // Creamos la contribución
            $contribution = new Contribution();
            $contribution->amount = $request->input('amount');
            $contribution->project_id = $request->input('project_id');
            $contribution->user_id = Auth::id();
            $contribution->contribution_date = now();
            $contribution->save();

            // Actualizamos stock y vinculamos al user
            $rewards = $contribution->project->rewards()
                ->where('required_funds', '<=', $contribution->amount)
                ->where('stock', '>', 0)
                ->get();

            foreach ($rewards as $reward) {
                if ($reward->stock > 0) {
                    $reward->stock--;
                    $reward->save();
                    // Vinculamos en la nueva tabla
                    DB::table('reward_user')->insert([
                        'reward_id' => $reward->id,
                        'user_id' => Auth::id(),
                        'amount' => $contribution->amount,
                        'contribution_date' => now(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        });

        return redirect()->route('projects.show', $request->project_id)->with('success', 'Contribución creada exitosamente');
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contribution;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showPaymentForm(Request $request)
    {
        $project_id = $request->query('project_id');
        $amount = $request->query('amount');
        
        return view('payment.form', compact('project_id', 'amount'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'amount' => 'required|numeric',
        ]);

        // Simular la lógica de pago aquí
        // En un entorno real, aquí es donde llamarías a la API de un proveedor de pagos
        
        // Crear la contribución
        $contribution = new Contribution();
        $contribution->amount = $request->input('amount');
        $contribution->project_id = $request->input('project_id');
        $contribution->user_id = Auth::id();
        $contribution->contribution_date = now();
        $contribution->save();

        return redirect()->route('projects.show', $request->input('project_id'))->with('success', 'Contribución realizada con éxito');
    }
}

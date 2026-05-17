<?php

namespace App\Http\Controllers\Nutritionist;

use App\Http\Controllers\Controller;
use App\Models\Client;

class DashboardController extends Controller
{
    public function index()
    {
        $clients = Client::where('nutritionist_id', auth()->id())->get();

        $activeClients = $clients->count();
        $pendingMessages = 12;
        $nextConsultation = 'Putri Amanda';

        return view('nutritionist.dashboard', compact(
            'clients',
            'activeClients',
            'pendingMessages',
            'nextConsultation'
        ));
    }
}
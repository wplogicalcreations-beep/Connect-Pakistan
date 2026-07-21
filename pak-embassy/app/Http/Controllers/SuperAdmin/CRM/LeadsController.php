<?php

namespace App\Http\Controllers\SuperAdmin\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class LeadsController extends Controller
{
     public function index(Request $request) {
        $perPage = $request->get('per_page', 10);
        $leadsQuery = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['customer', 'organization_admin']);
        })->with('work_domain')->orderBy('id', 'desc');
        if ($request->filled('from')) {
            $from = Carbon::createFromFormat('d-m-Y', $request->from)->startOfDay();
        }
        if ($request->filled('to')) {
            $to = Carbon::createFromFormat('d-m-Y', $request->to)->endOfDay();
        }
        if (!empty($from) && !empty($to)) {
            $leadsQuery->whereBetween('created_at', [$from, $to]);
        } elseif (!empty($from)) {
            $leadsQuery->where('created_at', '>=', $from);
        } elseif (!empty($to)) {
            $leadsQuery->where('created_at', '<=', $to);
        }

        $leadsUsers = $leadsQuery->paginate($perPage);
        if ($request->ajax()) {
            return response()->json([
                'leadsUsers' => view('super-admin.crm.dashboard.lead_row', compact('leadsUsers'))->render(),
                'pagination' => (string) $leadsUsers->links(),
            ]);
        }

        return view('super-admin.crm.dashboard.details', compact('leadsUsers'));
    }
}

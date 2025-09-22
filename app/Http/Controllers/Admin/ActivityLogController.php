<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'super') {
            abort(403, 'Unauthorized');
        }
        $query = ActivityLog::with('user');
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('action', 'like', "%$search%")
                  ->orWhere('model_type', 'like', "%$search%")
                  ->orWhere('model_id', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%")
                  ->orWhere('ip_address', 'like', "%$search%")
                  ->orWhereHas('user', function($uq) use ($search) {
                      $uq->where('given_name', 'like', "%$search%")
                         ->orWhere('surname', 'like', "%$search%")
                         ->orWhere('email', 'like', "%$search%")
                         ;
                  });
            });
        }
        $logs = $query->orderByDesc('created_at')->paginate(50)->appends($request->all());
        return view('admin.activitylog', compact('logs'));
    }
}

<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Epresence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\InsertPresenceRequest;

class PresenceController extends Controller
{
    public function insert(InsertPresenceRequest $request)
    {
        $dt = Carbon::create($request->waktu);
        $id_users = Auth::id();

        $check = Epresence::where('id_users', $id_users)
            ->where('type', $request->type)
            ->where('waktu', '>=', $dt->toDateString())
            ->where('waktu', '<', $dt->addDay()->toDateString())
            ->get();

        $checkIN = Epresence::where('id_users', $id_users)
            ->where('type', 'IN')
            ->where('waktu', '>=', $dt->subDay()->toDateString())
            ->where('waktu', '<', $dt->addDay()->toDateString())
            ->get();

        if (count($check) != 0) {
            return response()->json([
                'success' => false,
                'message' => "you have presence {$request->type} this date"
            ], 400);
        }

        if ($request->type == 'OUT' && count($checkIN) == 0) {
            return response()->json([
                'success' => false,
                'message' => "cannot presence OUT before presence IN"
            ], 400);
        }

        Epresence::insert([
            'id_users' => $id_users,
            'type' => $request->type,
            'is_approve' => false,
            'waktu' => $request->waktu
        ]);

        return response()->json([
            'success' => true,
            'message' => "success presence {$request->type} date {$request->waktu}"
        ], 201);
    }
}

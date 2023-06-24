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
    public function index(Request $request)
    {
        $data = [];
        $queryIN = Epresence::where('id_users', Auth::id())->where('type', 'IN')->get();
        $queryOUT = Epresence::where('id_users', Auth::id())->where('type', 'OUT')->get();

        if (count($queryIN) != 0) {
            foreach ($queryIN as $itemIN) {
                $tmp = [];
                $dateIN = date('Y-m-d', strtotime($itemIN->waktu));

                $tmp['id_user'] = $itemIN->id_users;
                $tmp['nama_user'] = Auth::user()->nama;
                $tmp['tanggal'] = $dateIN;
                $tmp['waktu_masuk'] = substr($itemIN->waktu, 11);
                $tmp['waktu_pulang'] = null;
                $tmp['status_masuk'] = $itemIN->is_approve ? 'APPROVE' : 'REJECT';
                $tmp['status_pulang'] = null;

                foreach ($queryOUT as $itemOUT) {
                    $dateOUT = date('Y-m-d', strtotime($itemOUT->waktu));

                    if ($dateIN == $dateOUT) {
                        $tmp['waktu_pulang'] = substr($itemOUT->waktu, 11);
                        $tmp['status_pulang'] = $itemOUT->is_approve ? 'APPROVE' : 'REJECT';
                    }
                }

                array_push($data, $tmp);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'success get all data user',
            'data' => $data
        ], 200);
    }

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

    public function approve(Request $request, int $presenceId)
    {
        if (Auth::user()->npp_supervisor) {
            return response()->json([
                'success' => false,
                'message' => 'you dont have permission to access this route'
            ], 403);
        }

        $data = Epresence::find($presenceId);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => "presence with id {$presenceId} not found"
            ], 404);
        }

        if ($data->is_approve) {
            return response()->json([
                'success' => false,
                'message' => "presence with id {$presenceId} already approved"
            ], 400);
        }

        $data->update(['is_approve' => true]);

        return response()->json([
            'success' => true,
            'message' => 'success approving presence',
            'data' => $data
        ], 200);
    }
}

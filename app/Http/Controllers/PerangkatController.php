<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perangkat;
use Carbon\Carbon;

class PerangkatController extends Controller
{
    public function index()
    {

        $cutoff = now()->subSeconds(3);

        $perangkatList = Perangkat::where('updated_at', '<', $cutoff)
            ->where('status', 'aktif')
            ->get();

        foreach ($perangkatList as $perangkat) {
            $perangkat->status = 'tidak aktif';
            $perangkat->save();


        }

        $perangkats = Perangkat::latest()->get();
        return view('perangkat.index', compact('perangkats'));
    }


    public function getData()
    {
        $perangkats = Perangkat::latest()->get();

        return response()->json($perangkats);
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string',
            ]);

            // Dapatkan ID perangkat
            $deviceId = $request->id;

            // Cari apakah perangkat sudah ada
            $perangkat = Perangkat::find($deviceId);

            if ($perangkat) {
                // Update status dan waktu terakhir dilihat
                $perangkat->update([
                    'status' => 'aktif',
                    'last_seen' => Carbon::now(),
                ]);
            } else {
                // Buat perangkat baru
                $perangkat = Perangkat::create([
                    'id' => $deviceId,
                    'no_referensi' => 'REF-' . strtoupper(uniqid()),
                    'status' => 'aktif',
                    'kondisi' => 'baik',
                    'last_seen' => Carbon::now(),
                ]);
            }

            return response()->json([
                'message' => 'Perangkat berhasil terdaftar atau diperbarui',
                'data' => $perangkat,
            ], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // =====================
    // GET ALL SERVICES
    // =====================
    public function index()
    {
        $services = Service::all();

        return response()->json([
            'message' => 'List service',
            'data' => $services
        ]);
    }

    // =====================
    // CREATE SERVICE
    // =====================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0'
        ]);

        $service = Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        return response()->json([
            'message' => 'Service berhasil dibuat',
            'data' => $service
        ], 201);
    }

    // =====================
    // SHOW SERVICE BY ID
    // =====================
    public function show($id)
    {
        $service = Service::find($id);

        if (! $service) {
            return response()->json([
                'message' => 'Service tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'data' => $service
        ]);
    }

    // =====================
    // UPDATE SERVICE
    // =====================
    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (! $service) {
            return response()->json([
                'message' => 'Service tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0'
        ]);

        $service->update($request->all());

        return response()->json([
            'message' => 'Service berhasil diupdate',
            'data' => $service
        ]);
    }

    // =====================
    // DELETE SERVICE
    // =====================
    public function destroy($id)
    {
        $service = Service::find($id);

        if (! $service) {
            return response()->json([
                'message' => 'Service tidak ditemukan'
            ], 404);
        }

        $service->delete();

        return response()->json([
            'message' => 'Service berhasil dihapus'
        ]);
    }
}

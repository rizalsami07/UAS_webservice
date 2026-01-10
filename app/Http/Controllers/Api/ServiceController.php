<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // GET /api/services
    public function index()
    {
        return response()->json(Service::all());
    }

    // POST /api/services
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric'
        ]);

        $service = Service::create($request->all());

        return response()->json([
            'message' => 'Service berhasil ditambahkan',
            'data' => $service
        ], 201);
    }

    // GET /api/services/{id}
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service);
    }

    // PUT /api/services/{id}
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric'
        ]);

        $service->update($request->all());

        return response()->json([
            'message' => 'Service berhasil diupdate',
            'data' => $service
        ]);
    }

    // DELETE /api/services/{id}
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return response()->json([
            'message' => 'Service berhasil dihapus'
        ]);
    }
}
    
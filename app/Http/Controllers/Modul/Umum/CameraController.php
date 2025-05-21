<?php

namespace App\Http\Controllers\Modul\Umum;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modul\Umum\CameraRequest;
use App\Models\Modul\Branch\Branch;
use App\Models\Modul\Umum\Camera;
use App\Services\Modul\Umum\CameraService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CameraController extends Controller
{
    /**
     * @var CameraService
     */
    protected $cameraService;

    /**
     * Create a new controller instance.
     *
     * @param CameraService $cameraService
     */
    public function __construct(CameraService $cameraService)
    {
        $this->cameraService = $cameraService;
        // $this->middleware('permission:view-cameras')->only(['index', 'show']);
        // $this->middleware('permission:create-cameras')->only(['create', 'store']);
        // $this->middleware('permission:edit-cameras')->only(['edit', 'update']);
        // $this->middleware('permission:delete-cameras')->only(['destroy']);
    }

    /**
     * Display a listing of cameras.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $filters = $request->only(['location', 'status', 'branch_id', 'is_active']);
        $cameras = $this->cameraService->getAllCameras($filters);
        $branches = Branch::all();

        return view('modul.umum.cctv.index', compact('cameras', 'branches', 'filters'));
    }

    /**
     * Show the form for creating a new camera.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $branches = Branch::all();
        return view('modul.umum.cctv.create', compact('branches'));
    }

    /**
     * Store a newly created camera in storage.
     *
     * @param CameraRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CameraRequest $request)
    {
        $camera = $this->cameraService->createCamera($request->validated());
        
        // Log the access
        $this->cameraService->logCameraAccess(
            $camera->id,
            Auth::id(),
            'created',
            $request
        );

        return redirect()->route('cameras.index')
            ->with('success', 'Camera created successfully.');
    }

    /**
     * Display the specified camera.
     *
     * @param string $id
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function show(string $id, Request $request)
    {
        $camera = $this->cameraService->getCameraById($id);
        
        if (!$camera) {
            return redirect()->route('cameras.index')
                ->with('error', 'Camera not found.');
        }
        
        // Log the access
        $this->cameraService->logCameraAccess(
            $camera->id,
            Auth::id(),
            'viewed',
            $request
        );

        return view('modul.umum.cctv.show', compact('camera'));
    }

    /**
     * Show the form for editing the specified camera.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $camera = $this->cameraService->getCameraById($id);
        
        if (!$camera) {
            return redirect()->route('cameras.index')
                ->with('error', 'Camera not found.');
        }
        
        $branches = Branch::all();

        return view('modul.umum.cctv.edit', compact('camera', 'branches'));
    }

    /**
     * Update the specified camera in storage.
     *
     * @param CameraRequest $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CameraRequest $request, string $id)
    {
        $success = $this->cameraService->updateCamera($id, $request->validated());
        
        if (!$success) {
            return redirect()->route('cameras.index')
                ->with('error', 'Camera not found or could not be updated.');
        }
        
        // Log the access
        $this->cameraService->logCameraAccess(
            $id,
            Auth::id(),
            'updated',
            $request
        );

        return redirect()->route('cameras.index')
            ->with('success', 'Camera updated successfully.');
    }

    /**
     * Remove the specified camera from storage.
     *
     * @param string $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id, Request $request)
    {
        $success = $this->cameraService->deleteCamera($id);
        
        if (!$success) {
            return redirect()->route('cameras.index')
                ->with('error', 'Camera not found or could not be deleted.');
        }
        
        // Log the access
        $this->cameraService->logCameraAccess(
            $id,
            Auth::id(),
            'deleted',
            $request
        );

        return redirect()->route('cameras.index')
            ->with('success', 'Camera deleted successfully.');
    }

    /**
     * Check the connection status of a specific camera.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkConnection(string $id)
    {
        $camera = $this->cameraService->getCameraById($id);
        
        if (!$camera) {
            return response()->json(['error' => 'Camera not found'], 404);
        }
        
        $isOnline = $this->cameraService->checkCameraConnection($camera);
        
        return response()->json([
            'id' => $camera->id,
            'name' => $camera->name,
            'status' => $camera->status,
            'is_online' => $isOnline,
        ]);
    }

    /**
     * Check the connection status of all active cameras.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAllConnections()
    {
        $results = $this->cameraService->checkAllCamerasConnection();
        
        return response()->json([
            'success' => true,
            'results' => $results
        ]);
    }
}

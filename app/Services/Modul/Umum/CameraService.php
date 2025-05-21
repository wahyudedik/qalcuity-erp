<?php

namespace App\Services\Modul\Umum;

use Exception;
use Illuminate\Http\Request;
use App\Models\Modul\Umum\Camera;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Modul\Umum\CameraRepository;

class CameraService
{
    /**
     * @var CameraRepository
     */
    protected $cameraRepository;

    /**
     * Create a new service instance.
     *
     * @param CameraRepository $cameraRepository
     */
    public function __construct(CameraRepository $cameraRepository)
    {
        $this->cameraRepository = $cameraRepository;
    }

    /**
     * Get all cameras with filtering.
     *
     * @param array $filters
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllCameras(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        return $this->cameraRepository->getAllCameras($filters, $perPage);
    }

    /**
     * Get camera by ID.
     *
     * @param string $id
     * @return Camera|null
     */
    public function getCameraById(string $id): ?Camera
    {
        return $this->cameraRepository->findById($id);
    }

    /**
     * Create a new camera.
     *
     * @param array $data
     * @return Camera
     */
    public function createCamera(array $data): Camera
    {
        // Additional business logic before creating
        if (!isset($data['status'])) {
            $data['status'] = 'offline';
        }

        $camera = $this->cameraRepository->create($data);

        // Try to check if camera is online
        $this->checkCameraConnection($camera);

        return $camera;
    }

    /**
     * Update an existing camera.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function updateCamera(string $id, array $data): bool
    {
        $camera = $this->cameraRepository->findById($id);
        
        if (!$camera) {
            return false;
        }
        
        // If credentials or IP/port changed, we should check connection again
        $connectionChanged = 
            $data['ip_address'] !== $camera->ip_address || 
            $data['port'] !== $camera->port || 
            $data['username'] !== $camera->username || 
            $data['password'] !== $camera->password;
            
        $result = $this->cameraRepository->update($camera, $data);
        
        if ($result && $connectionChanged) {
            $this->checkCameraConnection($camera->fresh());
        }
        
        return $result;
    }

    /**
     * Delete a camera.
     *
     * @param string $id
     * @return bool
     */
    public function deleteCamera(string $id): bool
    {
        $camera = $this->cameraRepository->findById($id);
        
        if (!$camera) {
            return false;
        }
        
        return $this->cameraRepository->delete($camera);
    }

    /**
     * Log access to a camera.
     *
     * @param string $cameraId
     * @param string $userId
     * @param string $action
     * @param Request $request
     * @return void
     */
    public function logCameraAccess(string $cameraId, string $userId, string $action, Request $request): void
    {
        $this->cameraRepository->logAccess(
            $cameraId,
            $userId,
            $action,
            $request->ip(),
            $request->userAgent()
        );
    }

    /**
     * Check camera connection and update status.
     *
     * @param Camera $camera
     * @return bool
     */
    public function checkCameraConnection(Camera $camera): bool
    {
        try {
            $url = "http://{$camera->ip_address}:{$camera->port}";
            
            $response = Http::timeout(5)
                ->withBasicAuth($camera->username, $camera->password)
                ->get($url);
            
            $isOnline = $response->successful();
            
            $this->cameraRepository->updateCameraStatus(
                $camera->id,
                $isOnline ? 'online' : 'offline'
            );
            
            return $isOnline;
        } catch (Exception $e) {
            Log::error('Camera connection check failed', [
                'camera_id' => $camera->id,
                'error' => $e->getMessage()
            ]);
            
            $this->cameraRepository->updateCameraStatus($camera->id, 'offline');
            return false;
        }
    }

    /**
     * Batch check all active cameras connection status.
     *
     * @return array Results of connection checks
     */
    public function checkAllCamerasConnection(): array
    {
        $cameras = Camera::where('is_active', true)->get();
        $results = [];
        
        foreach ($cameras as $camera) {
            $results[$camera->id] = [
                'name' => $camera->name,
                'previous_status' => $camera->status,
                'current_status' => $this->checkCameraConnection($camera) ? 'online' : 'offline'
            ];
        }
        
        return $results;
    }

    /**
     * Get streaming URL with authentication for a camera.
     *
     * @param Camera $camera
     * @return string
     */
    public function getSecureStreamingUrl(Camera $camera): string
    {
        // Handle different streaming URL formats based on camera type
        $streamingUrl = $camera->streaming_url;
        
        // If camera requires basic auth, add it to the URL if not already present
        if ($camera->username && $camera->password && 
            !str_contains($streamingUrl, '@')) {
            
            $urlParts = parse_url($streamingUrl);
            $scheme = $urlParts['scheme'] ?? 'http';
            $host = $urlParts['host'] ?? '';
            $port = isset($urlParts['port']) ? ":{$urlParts['port']}" : '';
            $path = $urlParts['path'] ?? '';
            $query = isset($urlParts['query']) ? "?{$urlParts['query']}" : '';
            
            return "{$scheme}://{$camera->username}:{$camera->password}@{$host}{$port}{$path}{$query}";
        }
        
        return $streamingUrl;
    }
}
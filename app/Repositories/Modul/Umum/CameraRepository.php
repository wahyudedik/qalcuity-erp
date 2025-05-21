<?php

namespace App\Repositories\Modul\Umum;

use Illuminate\Support\Collection;
use App\Models\Modul\Umum\Camera;
use App\Models\Modul\Umum\CameraAccessLog;
use Illuminate\Pagination\LengthAwarePaginator;

class CameraRepository
{
    /**
     * Get all cameras with optional filtering.
     *
     * @param array $filters
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllCameras(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        $query = Camera::query();

        // Apply filters
        if (isset($filters['location'])) {
            $query->where('location', 'like', '%' . $filters['location'] . '%');
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['branch_id'])) {
            $query->where('branch_id', $filters['branch_id']);
        }

        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }

        // Eager load branch relation to avoid N+1 problem
        return $query->with('branch')->latest()->paginate($perPage);
    }

    /**
     * Find a camera by ID.
     *
     * @param string $id
     * @return Camera|null
     */
    public function findById(string $id): ?Camera
    {
        return Camera::with(['branch', 'recordings' => function ($query) {
            $query->latest()->take(5);
        }])->find($id);
    }

    /**
     * Create a new camera.
     *
     * @param array $data
     * @return Camera
     */
    public function create(array $data): Camera
    {
        return Camera::create($data);
    }

    /**
     * Update an existing camera.
     *
     * @param Camera $camera
     * @param array $data
     * @return bool
     */
    public function update(Camera $camera, array $data): bool
    {
        return $camera->update($data);
    }

    /**
     * Delete a camera.
     *
     * @param Camera $camera
     * @return bool
     */
    public function delete(Camera $camera): bool
    {
        return $camera->delete();
    }

    /**
     * Get online cameras.
     *
     * @return Collection
     */
    public function getOnlineCameras(): Collection
    {
        return Camera::where('status', 'online')
            ->where('is_active', true)
            ->get();
    }

    /**
     * Log camera access.
     *
     * @param string $cameraId
     * @param string $userId
     * @param string $action
     * @param string|null $ipAddress
     * @param string|null $userAgent
     * @return CameraAccessLog
     */
    public function logAccess(
        string $cameraId,
        string $userId,
        string $action,
        ?string $ipAddress = null,
        ?string $userAgent = null
    ): CameraAccessLog {
        return CameraAccessLog::create([
            'camera_id' => $cameraId,
            'user_id' => $userId,
            'accessed_at' => now(),
            'action' => $action,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);
    }

    /**
     * Update camera status.
     *
     * @param string $cameraId
     * @param string $status
     * @return bool
     */
    public function updateCameraStatus(string $cameraId, string $status): bool
    {
        $camera = Camera::find($cameraId);
        if (!$camera) {
            return false;
        }

        return $camera->update(['status' => $status]);
    }
}
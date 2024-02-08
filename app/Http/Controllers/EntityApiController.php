<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EntityResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\EntityService;
use App\Http\Requests\{GetEntityRequest, SaveEntityRequest, UpdateEntityRequest};

class EntityApiController extends Controller
{
    private $entityService;

    public function __construct()
    {
        $this->entityService = new EntityService();
    }
    
    public function save(SaveEntityRequest $request): JsonResponse
    {
        $result = $this->entityService->saveEntity($request->validated());

        return response()->json([

            'message' => $result['message'],
                        
        ], $result['code']);
    }

    public function update(int $id, UpdateEntityRequest $request): JsonResponse
    {
        $result = $this->entityService->updateEntity($id, $request->validated());

        return response()->json([

            'message' => $result['message'],
                        
        ], $result['code']);
    }

    public function get(int $id, GetEntityRequest $request): JsonResponse
    {
        $entity = $this->entityService->getEntity($id);

        return response()->json([

            new EntityResource($entity)
                        
        ], Response::HTTP_OK);
    }

    public function delete(int $id, GetEntityRequest $request): JsonResponse
    {
        $status = $this->entityService->deleteEntity($id);

        return response()->json([

            'message' => 'Entity deleted',
                        
        ], Response::HTTP_OK);
    }
}

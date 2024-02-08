<?php

namespace App\Services;

use App\Models\Entity;
use App\Http\Resources\EntityResource;
use App\Repositories\EntityRepository;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EntityService
{
    private $entityRepository;

    public function __construct()
    {
        $this->entityRepository = new EntityRepository();
    }

    public function saveEntity($data): array
    {
        $status = $this->entityRepository->insertEntity($data);

        if($status)
        {
            return [
                'message' => 'Entity saved',
                'code' => Response::HTTP_CREATED    
            ];
        }

        return [
            'message' => 'Unable to save the data',
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY            
        ];
    }

    public function getEntities(int $paginate = 10): LengthAwarePaginator
    {
        return $this->entityRepository->getEntities($paginate);
    }

    public function getEntity(int $id): ?Entity
    {
        return $this->entityRepository->getEntityById($id);
    }

    public function updateEntity(int $id, array $data): array
    {
        $status = $this->entityRepository->updateEntityById($id, $data);

        if($status)
        {
            return [
                'message' => 'Entity updated',
                'code' =>   Response::HTTP_CREATED      
            ];
        }

        return [
            'message' => 'Unable to update the entity',
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY    
        ] ;
    }

    public function deleteEntity(int $id): bool
    {
        return $this->entityRepository->deleteEntityById($id);
    }
}
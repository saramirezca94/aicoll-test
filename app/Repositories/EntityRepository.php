<?php

namespace App\Repositories;

use Exception;
use App\Models\Entity;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EntityRepository
{
    public function insertEntity(array $data): bool
    {
        try {

            $entity = new Entity();

            $entity->name = $data['name'];
            $entity->nit = $data['nit'];
            $entity->phone = $data['phone'];
            $entity->address = $data['address'];
            $entity->save();

            return true;

        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            return false;
        }
    }

    public function getEntityById(int $id): ?Entity
    {
       return Entity::whereId($id)->first();
    }

    public function getEntities(int $paginate = 10): LengthAwarePaginator
    {
        return Entity::paginate($paginate);
    }

    public function updateEntityById(int $id, array $data): bool
    {
        $entity = $this->getEntityById($id);

        try {
            $entity->name = $data['name'];
            $entity->address = $data['address'];
            $entity->phone = $data['phone'];
    
            $entity->push();
    
            return true;

        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            return false;
        }
    }

    public function deleteEntityById(int $id)
    {
        try {
            $entity = $this->getEntityById($id);
            $entity->delete();

            return true;
        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            return false;
        } 
    }
}
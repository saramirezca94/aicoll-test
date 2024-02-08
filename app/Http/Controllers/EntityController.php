<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Services\EntityService;

class EntityController extends Controller
{
    private $entityService;

    public function __construct()
    {
        $this->entityService = new EntityService();
    }

    public function index(): View
    {
        $entities = $this->entityService->getEntities(2);

        return view('entity.index', compact('entities'));
    }

    public function create(): View
    {
        return view('entity.create');
    }

    public function show(int $id): View
    {
        return view('entity.show', compact('id'));
    }

}

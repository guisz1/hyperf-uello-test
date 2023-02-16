<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Freight;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class FreightController extends AbstractController
{

    public function index(): PsrResponseInterface
    {
        $freightage =  Freight::get();
        return $this->response->json($freightage);
    }

    public function show(int $id): PsrResponseInterface
    {
        $freight = Freight::find($id);
        if(!isset($freight))
        {
            return $this->response->raw('')->withStatus(204);    
        }
        return $this->response->json($freight);
    }

}

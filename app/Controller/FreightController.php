<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Freight;
use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class FreightController extends AbstractController
{

    public function index(RequestInterface $request): PsrResponseInterface
    {
        $data = $request->all();
        $validator = $this->validationFactory->make(
            $data,
            [
                'limit' => 'int',
                'page' => 'int'
            ],
        );
        $validated = $validator->validated();
        $page = !empty($validated['page']) ? $validated['page'] : 1;
        $limit = !empty($validated['limit']) ? $validated['limit'] : 10;
        $freightage =  Freight::limit($limit)
            ->offset(($page - 1) * $limit)
            ->get();
        return $this->response->json($freightage);
    }

    public function show(int $id): PsrResponseInterface
    {
        $freight = Freight::find($id);
        if (!isset($freight)) {
            return $this->response->raw('')->withStatus(204);    
        }
        return $this->response->json($freight);
    }

}

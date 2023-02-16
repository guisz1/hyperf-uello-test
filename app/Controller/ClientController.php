<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Client;
use Hyperf\DbConnection\Db;
use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class ClientController extends AbstractController
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
        $clients =  Client::limit($limit)
        ->offset(($page - 1) * $limit)
        ->get();
        return $this->response->json($clients);
    }

    public function show(int $id): PsrResponseInterface
    {
        $client = Client::find($id);
        if (!isset($client)) {
            return $this->response->raw('')->withStatus(204);    
        }
        return $this->response->json($client);
        
    }

    public function store(RequestInterface $request): PsrResponseInterface
    {
        $data = $request->all();
        $validator = $this->validationFactory->make(
            $data,
            [
                'name' => 'required|string|max:255',
            ],
            [
                'name.required' => 'necessario um nome',
            ]
        );
        if (!$validator->fails()) {
            Client::create($validator->validated());
            return $this->response->raw('');
        } else {
            $error = $validator->errors()->first();
            $result = [
                "message"=>$error
            ];
            return $this->response->json($result)->withStatus(400);
        }
    }

    public function delete(int $id): PsrResponseInterface
    {
        Client::destroy($id);
        return $this->response->raw('');
    }

    public function getFreights(RequestInterface $request, int $id): PsrResponseInterface
    {
        $client = Client::find($id);
        if (!isset($client)) {
            return $this->response->raw('')->withStatus(204);    
        }
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
        
        $freights = Db::table('freights as f')
            ->join('freights_clients as fc','fc.freight_id','=','f.id')
            ->join('clients as c','c.id','=','fc.client_id')
            ->where('c.id',$client['id'])
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->select('client_id','freight_id','from_weight','to_weight','from_postcode','to_postcode','cost')
            ->get();
        
        return $this->response->json($freights);
    }
}

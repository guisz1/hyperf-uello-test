<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Client;
use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class ClientController extends AbstractController
{

    public function index(): PsrResponseInterface
    {
        $clients =  Client::get();
        return $this->response->json($clients);
    }

    public function show(int $id): PsrResponseInterface
    {
        $client = Client::find($id);
        if(!isset($client))
        {
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
        if (!$validator->fails())
        {
            Client::create($validator->validated());
            return $this->response->raw('');
        }
        else{
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
}

<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
class UploadController extends AbstractController
{

    public function upload(): PsrResponseInterface
    {
        $data = $this->request->file('data');
        $body = $this->request->all();
        $validator = $this->validationFactory->make(
            $body,
            [
                'client_id' => 'required|int|exists:clients,id',
            ],
            [
                'client_id.required' => 'necessario ter um client id',
                'client_id.exists' => 'Id não é valido',
                'client_id.int' => 'necessario ser um inteiro',
            ]
        );
        if ($validator->fails()){
            $error = $validator->errors()->first();
            $result = [
                "message"=>$error
            ];
            return $this->response->json($result)->withStatus(400);
        }
        return $this->response->raw('')->withStatus(200);
    }


}

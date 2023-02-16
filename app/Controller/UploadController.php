<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Freight;
use App\Model\FreightsClient;
use Hyperf\HttpMessage\Upload\UploadedFile;
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
        if ($validator->fails() || is_null($data))
        {
            $error = $validator->errors()->first();
            $result = [
                "message"=> is_null($data) ? 'Não foi encontrado arquivo' : $error 
            ];
            return $this->response->json($result)->withStatus(400);
        }
        $user = $validator->validated();
        $clientId = (int) $user['client_id'];
        go(function() use ($data, $clientId) 
        {
            $this->process($data, $clientId);
        });
        
        return $this->response->raw('')->withStatus(200);
    }

    private function process(UploadedFile $data, int $clientId): void
    {
        
        $stream = $data->getPath()."/".$data->getBasename();
        $fp = fopen($stream,'r');
        $isSetHeader = false;
        $header = [];
        while (($line = fgetcsv($fp,null,';')) !== FALSE) 
        {
            if($isSetHeader == false)
            {
                $header = $line;
                $isSetHeader = true;
                continue;
            }
            $cleaned = $this->cleanupBody($line);
            $merged = $this->mergeHeaderWithBody($header, $cleaned);
            $invalid = $this->validateData($merged);
            if(!$invalid)
            {
                $this->save($merged, $clientId);
            }
        }
        fclose($fp); 
        
    }

    private function cleanupBody(array $body): array
    {
        $cleaned = [];
        foreach($body as $element){
            $cleaned[]= str_replace(",",".", str_replace(".","",$element));
        }
        return $cleaned;
    }
    private function mergeHeaderWithBody(array $header, array $body): array
    {
        return array_combine($header, $body);
    }

    private function validateData(array $body): bool
    {
        $validator = $this->validationFactory->make(
            $body,
            [
                'from_postcode' => 'required|regex:/^[0-9]{5}-[0-9]{3}$/',
                'to_postcode' => 'required|regex:/^[0-9]{5}-[0-9]{3}$/',
                'from_weight' => 'required|numeric',
                'to_weight' => 'required|numeric',
                'cost' => 'required|numeric',
            ],
        );
        return $validator->fails();
    }
    private function save(array $data, int $clientId): void
    {
        $saved = Freight::create($data);
        FreightsClient::create(
            [
                'freight_id' => $saved['id'],
                'client_id' => $clientId,
            ]);
    }

}

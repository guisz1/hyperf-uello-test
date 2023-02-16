<?php declare(strict_types=1);

namespace App\Model;

class FreightsClient extends Model
{
    public string $keyType = 'int';

    protected array $fillable = ['client_id', 'freight_id', 'created_at', 'updated_at'];

    public function client()
    {
        return $this->hasOne(Client::class, 'client_id', 'id');
    }
    public function freight()
    {
        return $this->hasOne(Freight::class, 'freight_id', 'id');
    }
}
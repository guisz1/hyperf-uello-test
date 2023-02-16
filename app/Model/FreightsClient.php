<?php declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\Relations\HasOne;

class FreightsClient extends Model
{
    public string $keyType = 'int';

    protected array $fillable = ['client_id', 'freight_id', 'created_at', 'updated_at'];

    public function client(): HasOne
    {
        return $this->hasOne(Client::class, 'client_id', 'id');
    }
    public function freight(): HasOne
    {
        return $this->hasOne(Freight::class, 'freight_id', 'id');
    }
}
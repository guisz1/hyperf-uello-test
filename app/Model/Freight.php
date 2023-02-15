<?php declare(strict_types=1);

namespace App\Model;

class Freight extends Model
{
    public string $keyType = 'int';

    public bool $incrementing = true;

    protected array $fillable = ['id', 'from_postcode', 'to_postcode', 'from_weight','to_weight', 'cost', 'created_at', 'updated_at'];
}
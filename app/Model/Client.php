<?php declare(strict_types=1);

namespace App\Model;

class Client extends Model
{
    
    public string $keyType = 'int';

    public bool $incrementing = true;

    protected array $fillable = ['id', 'name', 'created_at', 'updated_at'];
}
<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use App\Controller\ClientController;
use App\Controller\FreightController;
use App\Controller\UploadController;
use Hyperf\HttpServer\Router\Router;

Router::addGroup('/clients', function () {
    Router::get('', [ClientController::class, 'index']);
    Router::get('/{id}', [ClientController::class, 'show']);
    Router::post('', [ClientController::class, 'store']);
    Router::delete('/{id}', [ClientController::class, 'delete']);
});

Router::addGroup('/freightage', function () {
    Router::get('', [FreightController::class, 'index']);
    Router::get('/{id}', [FreightController::class, 'show']);
});
Router::post('/upload',[UploadController::class, 'upload']);
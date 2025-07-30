<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    public function hosts()
    {
        return [
            $this->allSubdomainsOfApplicationUrl(),
            'localhost',
            '192.168.100.21', // Host for test/preview mobile: run with cmd php artisan serve --host=0.0.0.0 --port=*.*.*.* (8000 ?)
        ];
    }
}

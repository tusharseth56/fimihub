<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;
use Closure;

use function PHPSTORM_META\map;

class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
	{

        $request->end = microtime(true);
        $this->log($request,$response);
    }

    protected function log($request,$response)
    {
        $duration = $request->end - $request->start;
        $url = $request->fullUrl();
        $method = $request->getMethod();
        $ip = $request->getClientIp();
        $requestData =  json_encode($request->all());

        $log = "{$ip}: {$method}@{$url} - {$duration}ms \n".
        "Request : {$requestData} \n".
        "Response : {$response->getContent()} \n";
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln($log);
        Log::info($log);
    }

}

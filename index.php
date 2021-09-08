<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;


class App implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // Our application will write to session
        session_start();

        if (rand(0, 10) > 9) {
            error_log('Throwing exception'.PHP_EOL);
            throw new \RuntimeException('Random exception');
        }

        session_write_close();
        error_log('Returning normal response'.PHP_EOL);
        return new \Nyholm\Psr7\Response(200, [], 'Successful response');
    }
}

return new App();

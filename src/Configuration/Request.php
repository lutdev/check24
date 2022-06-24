<?php
declare(strict_types=1);

namespace App\Configuration;

use InvalidArgumentException;

class Request
{
    public const METHOD_POST = 'post';

    public const METHOD_GET = 'get';

    public const METHOD_PUT = 'put';

    private array $methodMapper = [
        self::METHOD_GET,
        self::METHOD_POST,
        self::METHOD_PUT,
    ];

    public function fetchParams(array $paramsConfig, string $method = self::METHOD_POST): array
    {
        $result = [];
        foreach ($paramsConfig as $paramName) {
            $result[$paramName] = $this->fetchParam(
                $paramName,
                $method
            );
        }

        return $result;
    }

    public function fetchParam(
        string $paramName,
        string $method = self::METHOD_POST,
    ): mixed {
        if (!\in_array($method, $this->methodMapper, true)) {
            throw new InvalidArgumentException('Invalid method name');
        }

        return match ($method) {
            self::METHOD_GET => $this->findInGet($paramName),
            self::METHOD_POST => $this->findInPost($paramName),
            default => $this->findInPut($paramName),
        };
    }

    private function findInGet(string $paramName)
    {
        $getString = $_SERVER['QUERY_STRING'];
        \parse_str($getString, $getArray);

        return $getArray[$paramName] ?? null;
    }

    private function findInPost(string $paramName)
    {
        return $_POST[$paramName] ?? null;
    }

    private function findInPut(string $paramName)
    {
        $params = [];

        \parse_str(\file_get_contents('php://input'), $params);

        return $params[$paramName] ?? null;
    }
}
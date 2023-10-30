<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Saloon\Http\Request;

abstract class RequestTestCase extends TestCase
{
    abstract protected function requestClass(): Request;

    abstract protected function expectedRequestMethod(): string;

    abstract protected function expectedEndpoint(): string;

    abstract protected function expectedDefaultHeaders(): array;

    public function test_request_method(): void
    {
        $property = $this->getProperty();

        $this->assertEquals($this->expectedRequestMethod(), $property);
    }

    public function test_endpoint(): void
    {
        $this->assertTrue(str_starts_with($this->requestClass()->resolveEndpoint(), $this->expectedEndpoint()));
    }

    public function test_default_headers(): void
    {
        $method = $this->getMethod('defaultHeaders');

        $this->assertEquals(
            $this->expectedDefaultHeaders(),
            array_keys($method->invoke($this->requestClass()))
        );
    }

    public function test_default_query(): void
    {
        $this->checkDefault('query');
    }

    public function test_default_body(): void
    {
        $this->checkDefault('body');
    }

    private function getMethod(string $name): \ReflectionMethod
    {
        $reflection = new \ReflectionClass($this->requestClass());
        return $reflection->getMethod($name);
    }

    private function getProperty(string $name = 'method'): string
    {
        $reflection = new \ReflectionClass($this->requestClass());
        $property = $reflection->getProperty($name);

        return $property->getValue($this->requestClass())->value;
    }

    private function checkDefault(string $suffix): void
    {
        $expectedMethodName = 'expectedDefault' . ucfirst($suffix);
        $methodName = 'default' . ucfirst($suffix);

        if (!method_exists($this, $expectedMethodName)) {
            $this->markTestSkipped("No default $suffix expected.");
        }

        $method = $this->getMethod($methodName);

        $this->assertEquals(
            $this->$expectedMethodName(),
            array_keys($method->invoke($this->requestClass()))
        );
    }
}
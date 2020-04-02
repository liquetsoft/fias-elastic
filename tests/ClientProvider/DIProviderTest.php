<?php

declare(strict_types=1);

namespace Liquetsoft\Fias\Elastic\Tests\ClientProvider;

use Elasticsearch\Client;
use Liquetsoft\Fias\Elastic\ClientProvider\DIProvider;
use Liquetsoft\Fias\Elastic\Tests\BaseCase;
use Throwable;

/**
 * Тест для провайдера клиента, который возвращает клиента, переданного через DI.
 */
class DIProviderTest extends BaseCase
{
    /**
     * Проверяет, что провайдер вернет в точности того клиента, который был ему передан через DI.
     *
     * @throws Throwable
     */
    public function testProvide()
    {
        $client = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();

        $provider = new DIProvider($client);

        $this->assertSame($client, $provider->provide());
    }
}

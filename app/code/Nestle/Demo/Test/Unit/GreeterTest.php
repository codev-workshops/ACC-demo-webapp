<?php
/**
 * Copyright © Nestlé S.A. All rights reserved.
 */

declare(strict_types=1);

namespace Nestle\Demo\Test\Unit;

use Nestle\Demo\Model\Greeter;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

/**
 * Unit tests for the Greeter model.
 */
class GreeterTest extends TestCase
{
    /**
     * A named customer should be embedded in the greeting.
     *
     * @return void
     */
    public function testReturnsPersonalizedGreeting(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $greeter = new Greeter($logger);

        $this->assertSame('Welcome to Nestlé, Marie!', $greeter->getGreeting('Marie'));
    }

    /**
     * A blank name should fall back to "Guest".
     *
     * @return void
     */
    public function testFallsBackToGuestForBlankName(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $greeter = new Greeter($logger);

        $this->assertSame('Welcome to Nestlé, Guest!', $greeter->getGreeting('   '));
    }
}

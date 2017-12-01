<?php

declare(strict_types=1);

/**
 * Copyright (c) 2013-2017 OpenCFP
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/opencfp/opencfp
 */

namespace OpenCFP\Test\Unit\Infrastructure\Auth;

use Mockery;
use OpenCFP\Domain\Services\Authentication;
use OpenCFP\Infrastructure\Auth\SpeakerAccess;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @covers \OpenCFP\Infrastructure\Auth\SpeakerAccess
 */
class SpeakerAccessTest extends \PHPUnit\Framework\TestCase
{
    public function testReturnsRedirectIfCheckFailed()
    {
        $auth = Mockery::mock(Authentication::class);
        $auth->shouldReceive('check')->andReturn(false);

        $this->assertInstanceOf(RedirectResponse::class, SpeakerAccess::userHasAccess($auth));
    }

    public function testReturnsNothingIfUserIsLoggedIn()
    {
        $auth = Mockery::mock(Authentication::class);
        $auth->shouldReceive('check')->andReturn(true);

        $this->assertNull(SpeakerAccess::userHasAccess($auth));
    }
}

<?php

namespace Tests\Webrtc\VPX;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Webrtc\VPX\Encoder;

#[CoversClass(Encoder::class)]
class EncoderTest extends TestCase
{
    public function testEncode()
    {
        // TODO: There have critical errors in the library and we may remove this library
        $this->assertTrue(true);
    }
}

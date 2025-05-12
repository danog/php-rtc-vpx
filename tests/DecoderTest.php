<?php

namespace Tests\Webrtc\VPX;

use FFI;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;
use Webrtc\VPX\Context;
use Webrtc\VPX\Decoder;
use Webrtc\VPX\Enum\BriefInterface;
use Webrtc\VPX\Vpx;

#[UsesClass(Context::class)]
#[UsesClass(Vpx::class)]
#[CoversClass(Decoder::class)]
class DecoderTest extends TestCase
{
    private Decoder $decoder;

    protected function setUp(): void
    {
        parent::setUp();
        Vpx::init();
        $this->decoder = new Decoder(new Context, BriefInterface::VP8Decoder);
    }

    public function testDecode()
    {
        $data = file_get_contents(__DIR__ . '/fixture/encoded_frame.vp8');
        $expectedDecodedData = file_get_contents(__DIR__ . '/fixture/decoded_frame.vp8');

        $images = iterator_to_array($this->decoder->decode($data));

        for ($p = 0; $p < 3; $p++) {
            $decodedData = FFI::String($images[0]->planes[$p], $images[0]->stride[$p]);
        }

        $this->assertEquals($expectedDecodedData, $decodedData);
        $this->assertEquals(318, $images[0]->d_w);
        $this->assertEquals(238, $images[0]->d_h);
        $this->assertEquals(258, $images[0]->fmt); // VPX_IMG_FMT_I420 = 258
    }
}


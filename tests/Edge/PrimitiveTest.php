<?php

namespace PhpGraphs\Tests\Edge;

use PhpGraphs\Edge\Primitive;
use PhpGraphs\Vertex\VertexInterface;
use PHPUnit\Framework\TestCase;

class PrimitiveTest extends TestCase
{
    public function testInvert()
    {
        $origin = $this->createMock(VertexInterface::class);
        $target = $this->createMock(VertexInterface::class);

        $edge = new Primitive($origin, $target);

        $invert = $edge->invert();

        $this->assertSame($origin, $invert->getTarget());
        $this->assertSame($target, $invert->getOrigin());
    }
}

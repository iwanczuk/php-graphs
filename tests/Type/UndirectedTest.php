<?php

namespace PhpGraphs\Tests\Type;

use PhpGraphs\Type\Undirected;
use PhpGraphs\Vertex\VertexInterface;
use PhpGraphs\Edge\EdgeInterface;
use PHPUnit\Framework\TestCase;

class UndirectedTest extends TestCase
{
    public function testAddVertex()
    {
        $vertex = $this->createMock(VertexInterface::class);

        $graph = new Undirected();

        $this->assertFalse($graph->isVertex($vertex));
        $this->assertTrue($graph->addVertex($vertex));
        $this->assertTrue($graph->isVertex($vertex));
        $this->assertFalse($graph->addVertex($vertex));
    }

    public function testRemoveVertex()
    {
        $vertex = $this->createMock(VertexInterface::class);

        $graph = new Undirected();

        $this->assertFalse($graph->removeVertex($vertex));
        $this->assertTrue($graph->addVertex($vertex));
        $this->assertTrue($graph->isVertex($vertex));
        $this->assertTrue($graph->removeVertex($vertex));
    }

    public function testAddEdge()
    {
        $origin = $this->createMock(VertexInterface::class);
        $target = $this->createMock(VertexInterface::class);

        $edgeWithoutVertices = $this->createMock(EdgeInterface::class);

        $edgeWithoutOrigin = $this->createMock(EdgeInterface::class);
        $edgeWithoutOrigin->method('getTarget')
            ->willReturn($target);

        $edgeWithoutTarget = $this->createMock(EdgeInterface::class);
        $edgeWithoutTarget->method('getOrigin')
            ->willReturn($origin);

        $edgeWithSameVertices = $this->createMock(EdgeInterface::class);
        $edgeWithSameVertices->method('getOrigin')
            ->willReturn($origin);

        $edgeWithSameVertices->method('getTarget')
            ->willReturn($origin);

        $edgeWithVertices = $this->createMock(EdgeInterface::class);
        $edgeWithVertices->method('getOrigin')
            ->willReturn($origin);

        $edgeWithVertices->method('getTarget')
            ->willReturn($target);

        $invert = $this->createMock(EdgeInterface::class);
        $invert->method('getOrigin')
            ->willReturn($target);

        $invert->method('getTarget')
            ->willReturn($origin);

        $edgeWithVertices->method('invert')
            ->willReturn($invert);

        $graph = new Undirected();

        $this->assertFalse($graph->addEdge($edgeWithoutVertices));
        $this->assertFalse($graph->addEdge($edgeWithoutOrigin));
        $this->assertFalse($graph->addEdge($edgeWithoutTarget));
        $this->assertFalse($graph->addEdge($edgeWithSameVertices));
        $this->assertFalse($graph->addEdge($edgeWithVertices));

        $graph->addVertex($origin);
        $graph->addVertex($target);

        $this->assertTrue($graph->addEdge($edgeWithVertices));
    }

    public function testRemoveEdge()
    {
        $origin = $this->createMock(VertexInterface::class);
        $target = $this->createMock(VertexInterface::class);

        $edgeWithVertices = $this->createMock(EdgeInterface::class);
        $edgeWithVertices->method('getOrigin')
            ->willReturn($origin);

        $edgeWithVertices->method('getTarget')
            ->willReturn($target);

        $invert = $this->createMock(EdgeInterface::class);
        $invert->method('getOrigin')
            ->willReturn($target);

        $invert->method('getTarget')
            ->willReturn($origin);

        $edgeWithVertices->method('invert')
            ->willReturn($invert);

        $graph = new Undirected();

        $graph->addVertex($origin);
        $graph->addVertex($target);

        $this->assertTrue($graph->addEdge($edgeWithVertices));
        $this->assertTrue($graph->removeEdge($edgeWithVertices));
        $this->assertFalse($graph->removeEdge($edgeWithVertices));
    }

    public function testGetEdges()
    {
        $origin = $this->createMock(VertexInterface::class);
        $target = $this->createMock(VertexInterface::class);

        $edgeWithVertices = $this->createMock(EdgeInterface::class);
        $edgeWithVertices->method('getOrigin')
            ->willReturn($origin);

        $edgeWithVertices->method('getTarget')
            ->willReturn($target);

        $invert = $this->createMock(EdgeInterface::class);
        $invert->method('getOrigin')
            ->willReturn($target);

        $invert->method('getTarget')
            ->willReturn($origin);

        $edgeWithVertices->method('invert')
            ->willReturn($invert);

        $graph = new Undirected();

        $graph->addVertex($origin);
        $graph->addVertex($target);

        $graph->addEdge($edgeWithVertices);

        $this->assertSame([$edgeWithVertices], $graph->getEdges($origin));
        $this->assertSame([$invert], $graph->getEdges($target));
    }
}

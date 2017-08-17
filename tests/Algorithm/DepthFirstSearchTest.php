<?php

namespace PhpGraphs\Tests\Algorithm;

use PhpGraphs\Edge\EdgeInterface;
use PhpGraphs\Vertex\VertexInterface;
use PhpGraphs\Algorithm\DepthFirstSearch;
use PhpGraphs\Type\Undirected;
use PHPUnit\Framework\TestCase;

class DepthFirstSearchTest extends TestCase
{
    public function testFind()
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

        $algorithm = new DepthFirstSearch();

        $this->assertSame([], $algorithm->find($graph, $origin, $target));
        $this->assertSame([], $algorithm->find($graph, $target, $origin));

        $graph->addEdge($edgeWithVertices);

        $this->assertSame([$origin, $target], $algorithm->find($graph, $origin, $target));
        $this->assertSame([$target, $origin], $algorithm->find($graph, $target, $origin));
    }
}

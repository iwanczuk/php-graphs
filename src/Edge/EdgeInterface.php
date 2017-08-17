<?php

namespace PhpGraphs\Edge;

interface EdgeInterface
{
    /**
     * @return \PhpGraphs\Vertex\VertexInterface
     */
    public function getOrigin(): \PhpGraphs\Vertex\VertexInterface;

    /**
     * @return \PhpGraphs\Vertex\VertexInterface
     */
    public function getTarget(): \PhpGraphs\Vertex\VertexInterface;

    /**
     * @return \PhpGraphs\Edge\EdgeInterface
     */
    public function invert(): \PhpGraphs\Edge\EdgeInterface;
}

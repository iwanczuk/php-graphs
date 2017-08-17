<?php

namespace PhpGraphs\Edge;

class Primitive implements EdgeInterface
{
    /**
     * @var \PhpGraphs\Vertex\VertexInterface
     */
    private $origin;

    /**
     * @var \PhpGraphs\Vertex\VertexInterface
     */
    private $target;

    /**
     * @param \PhpGraphs\Vertex\VertexInterface $origin
     * @param \PhpGraphs\Vertex\VertexInterface $target
     */
    public function __construct(
        \PhpGraphs\Vertex\VertexInterface $origin,
        \PhpGraphs\Vertex\VertexInterface $target
    ) {
        $this->origin = $origin;
        $this->target = $target;
    }

    /**
     * @return \PhpGraphs\Vertex\VertexInterface
     */
    public final function getOrigin(): \PhpGraphs\Vertex\VertexInterface
    {
        return $this->origin;
    }

    /**
     * @return \PhpGraphs\Vertex\VertexInterface
     */
    public final function getTarget(): \PhpGraphs\Vertex\VertexInterface
    {
        return $this->target;
    }

    /**
     * @return \PhpGraphs\Edge\EdgeInterface
     */
    public final function invert(): \PhpGraphs\Edge\EdgeInterface
    {
        return new static($this->getTarget(), $this->getOrigin());
    }
}

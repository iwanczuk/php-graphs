<?php

namespace PhpGraphs\Type;

use PhpGraphs\Vertex\VertexInterface;
use PhpGraphs\Edge\EdgeInterface;

interface TypeInterface
{
    /**
     * @param \PhpGraphs\Vertex\VertexInterface $vertex
     * @return bool
     */
    public function addVertex(VertexInterface $vertex): bool;

    /**
     * @param \PhpGraphs\Vertex\VertexInterface $vertex
     * @return bool
     */
    public function removeVertex(VertexInterface $vertex): bool;

    /**
     * @param \PhpGraphs\Vertex\VertexInterface $vertex
     * @return bool
     */
    public function isVertex(VertexInterface $vertex): bool;

    /**
     * @param \PhpGraphs\Edge\EdgeInterface $edge
     * @return bool
     */
    public function addEdge(EdgeInterface $edge): bool;

    /**
     * @param \PhpGraphs\Edge\EdgeInterface $edge
     * @return bool
     */
    public function removeEdge(EdgeInterface $edge): bool;

    /**
     * @param \PhpGraphs\Vertex\VertexInterface $vertex
     * @return \PhpGraphs\Edge\EdgeInterface[]
     */
    public function getEdges(VertexInterface $vertex): array;
}

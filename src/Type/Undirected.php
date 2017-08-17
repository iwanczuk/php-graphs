<?php

namespace PhpGraphs\Type;

use PhpGraphs\Vertex\VertexInterface;
use PhpGraphs\Edge\EdgeInterface;

class Undirected implements TypeInterface
{
    /**
     * @var \SplObjectStorage
     */
    private $vertices;

    /**
     * @var \SplObjectStorage
     */
    private $edges;

    public function __construct()
    {
        $this->vertices = new \SplObjectStorage();
        $this->edges = new \SplObjectStorage();
    }

    /**
     * @param \PhpGraphs\Vertex\VertexInterface $vertex
     * @return bool
     */
    public function addVertex(VertexInterface $vertex): bool
    {
        if ($this->isVertex($vertex)) {
            return false;
        }

        $this->vertices->attach($vertex, new \SplObjectStorage());

        return true;
    }

    /**
     * @param \PhpGraphs\Vertex\VertexInterface $vertex
     * @return bool
     */
    public function removeVertex(VertexInterface $vertex): bool
    {
        if (!$this->isVertex($vertex)) {
            return false;
        }

        foreach ($this->vertices[$vertex] as $edge) {
            $invert = $this->edges[$edge];

            $this->edges->detach($edge);
            $this->edges->detach($invert);
        }

        $this->vertices->detach($vertex);

        return true;
    }

    /**
     * @param \PhpGraphs\Vertex\VertexInterface $vertex
     * @return bool
     */
    public function isVertex(VertexInterface $vertex): bool
    {
        return $this->vertices->contains($vertex);
    }

    /**
     * @param \PhpGraphs\Edge\EdgeInterface $edge
     * @return bool
     */
    public function addEdge(EdgeInterface $edge): bool
    {
        if ($this->edges->contains($edge)) {
            return false;
        }

        if (!$this->isVertex($edge->getOrigin())) {
            return false;
        }

        if (!$this->isVertex($edge->getTarget())) {
            return false;
        }

        if ($edge->getOrigin() === $edge->getTarget()) {
            return false;
        }

        $invert = $edge->invert();

        $this->edges->attach($edge, $invert);
        $this->edges->attach($invert, $edge);

        $this->vertices[$edge->getOrigin()]->attach($edge);
        $this->vertices[$invert->getOrigin()]->attach($invert);

        return true;
    }

    /**
     * @param \PhpGraphs\Edge\EdgeInterface $edge
     * @return bool
     */
    public function removeEdge(EdgeInterface $edge): bool
    {
        if (!$this->edges->contains($edge)) {
            return false;
        }

        $invert = $this->edges[$edge];

        $this->edges->detach($edge);
        $this->edges->detach($invert);

        $this->vertices[$edge->getOrigin()]->detach($edge);
        $this->vertices[$invert->getOrigin()]->detach($invert);

        return true;
    }

    /**
     * @param \PhpGraphs\Vertex\VertexInterface $vertex
     * @return \PhpGraphs\Edge\EdgeInterface[]
     */
    public function getEdges(VertexInterface $vertex): array
    {
        $edges = [];

        if ($this->isVertex($vertex)) {
            foreach ($this->vertices[$vertex] as $edge) {
                $edges[] = $edge;
            }
        }

        return $edges;
    }
}

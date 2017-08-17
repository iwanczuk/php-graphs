<?php

namespace PhpGraphs\Algorithm;

use PhpGraphs\Type\TypeInterface;
use PhpGraphs\Vertex\VertexInterface;

interface AlgorithmInterface
{
    /**
     * @param \PhpGraphs\Type\TypeInterface $graph
     * @param \PhpGraphs\Vertex\VertexInterface $origin
     * @param \PhpGraphs\Vertex\VertexInterface $target
     * @return \PhpGraphs\Vertex\VertexInterface[]
     */
    public function find(TypeInterface $graph, VertexInterface $origin, VertexInterface $target): array;
}

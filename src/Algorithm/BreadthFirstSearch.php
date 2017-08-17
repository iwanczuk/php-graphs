<?php

namespace PhpGraphs\Algorithm;

use PhpGraphs\Type\TypeInterface;
use PhpGraphs\Vertex\VertexInterface;

class BreadthFirstSearch implements AlgorithmInterface
{
    /**
     * @param \PhpGraphs\Type\TypeInterface $graph
     * @param \PhpGraphs\Vertex\VertexInterface $origin
     * @param \PhpGraphs\Vertex\VertexInterface $target
     * @return \PhpGraphs\Vertex\VertexInterface[]
     */
    public function find(TypeInterface $graph, VertexInterface $origin, VertexInterface $target): array
    {
        $queue = new \SplQueue();
        $visited = new \SplObjectStorage();
        $vertex = $origin;

        $queue->enqueue($origin);
        $visited->attach($origin);

        while (!$queue->isEmpty()) {
            $vertex = $queue->dequeue();

            if ($vertex === $target) {
                break;
            }

            foreach ($graph->getEdges($vertex) as $edge) {
                if (!$visited->contains($edge->getTarget())) {
                    $visited->attach($edge->getTarget(), $edge);
                    $queue->enqueue($edge->getTarget());
                }
            }
        }

        $route = [];

        if ($vertex === $target) {
            while ($vertex !== $origin) {
                array_unshift($route, $vertex);

                $vertex = $visited[$vertex]->getOrigin();
            }

            array_unshift($route, $origin);
        }

        return $route;
    }
}

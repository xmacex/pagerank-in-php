<?php
/**
 * PageRank algorithm
 *
 * From Connolly + Hoar: "Fundamenals of Web Development", 20.4. The book
 * appears to contain an error.
 * 
 * @author Mace Ojala <spt864@alumni.ku.dk>
 * @license GPL3
 */
class Graph {
	public $nodes;
	public $edges;
	public $pageranks;

	/** 
	 * Constructor
	 *
	 * @param array $nodes List of nodes
	 * @param array $edges List of 2-element lists representing edges
	 */
	public function __construct($nodes, $edges) {
		$this->nodes = $nodes;
		$this->edges = $edges;
		$this->pageranks = $this->initranks($nodes);
	}

	private function initranks($nodes) {
		$ranks = array();
		foreach($nodes as $node) {
			$ranks[$node] = 1 / count($nodes);
		}
		return $ranks;
	}

	private function pagerank($node) {
		$pr = 0;
		foreach($this->backlinks($node) as $bl) {
			$pr += $this->pageranks[$bl] / $this->outdegree($bl);
		}
		return $pr;
	}

	private function backlinks($node) {
		$bl = array();
		foreach($this->edges as $edge) {
			if($edge[1] == $node) {
				$bl[] = $edge[0];
			}
		}
		return $bl;
	}

	private function outdegree($node) {
		$od = 0;
		foreach($this->edges as $edge) {
			if ($edge[0] == $node) {
				$od += 1;
			}
		}
		return $od;
	}

	/**
	 * Calculate PageRank for all nodes.
	 *
	 * @param int resolution How many iterations to perform
	 * @param int iter Current iteration, used for recursion
	 */
	public function calculate_pageranks($resolution = 2, $iter = 0) {
		if($iter < $resolution) {
			$newranks = $this->initranks($this->nodes);
			foreach($this->pageranks as $node => $rank) {
				$newranks[$node] = $this->pagerank($node);
			}
			$this->pageranks = $newranks;
			$this->calculate_pageranks($resolution = $resolution, $iter = $iter + 1);
		}
	}
}

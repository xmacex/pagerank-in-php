<?php

/**
 * A little test of PageRank.
 *
 * @author Mace Ojala
 */

spl_autoload_register(function ($class_name) {
	include $class_name . '.php';
});

// A graph
$internet = new Graph(
	['facebook', 'buzzfeed', 'unicornkittens'],
	[
		['facebook', 'buzzfeed'],
		['facebook', 'unicornkittens'],
		['unicornkittens', 'facebook'],
		['buzzfeed', 'unicornkittens']]);
$internet->calculate_pageranks($resolution = 0);
print_r($internet->pageranks);

// Another graph
$g = new Graph(
	['a', 'b', 'c', 'd'],
	[
		['a', 'b'],
		['b', 'a'],
		['b', 'd'],
		['c', 'a'],
		['c', 'b'],
		['c', 'd'],
		['d', 'a'],
		['d', 'c']]);
$g->calculate_pageranks($resolution = 2);
print_r($g->pageranks);

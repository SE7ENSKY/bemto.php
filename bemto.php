<?php

$__bem_inline_tags = array('a', 'abbr', 'acronym', 'b', 'br', 'code', 'em', 'font', 'i', 'img', 'ins', 'kbd', 'map', 'samp', 'small', 'span', 'strong', 'sub', 'sup', 'label', 'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6');
$__bem_single_tags = array('area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'keygen', 'link', 'menuitem', 'meta', 'param', 'source', 'track', 'wbr');

function mixin__b($block = null, $attributes = null, $tag = null, $isElement = false) {
	global $__bem_chain;
	global $__bem_chain_contexts;
	global $__bem_inline_tags;
	if (!$__bem_chain) $__bem_chain = array();
	if (!$__bem_chain_contexts) $__bem_chain_contexts = array();
	if (!$tag) {
		if (count($__bem_chain_contexts) > 0) {
			switch ($__bem_chain_contexts[count($__bem_chain_contexts) - 1]) {
				case "list": $tag = 'li'; break;
				case "inline": $tag = 'span'; break;
				case "block": $tag = 'div'; break;
			}
		} else {
			$tag = "div";
		}
	}
	$newContext = 'block';
	if ($tag == 'ul' || $tag == 'ol') {
		$newContext = 'list';
	} elseif (in_array($tag, $__bem_inline_tags)) {
		$newContext = 'inline';
	}
	array_push($__bem_chain_contexts, $newContext);
	$blockAttrs = array();
	$name = null;
	if ($attributes) {
		foreach ($attributes as $key => $value) {
			if ($key == 'class') {
				$classes = is_array($value) ? $value : explode(" ", $value);
				$name = array_shift($classes);
				if ($isElement) {
					$name = $__bem_chain[count($__bem_chain) - 1] . '__' . $name;
				} else {
					array_push($__bem_chain, $name);
				}
				foreach ($classes as &$class) {
					if (preg_match('/^_[^_].+$/', $class)) {
						$class = $name . $class;
					}
				}
				array_unshift($classes, $name);
				$blockAttrs['class'] = $classes;
			} else {
				$blockAttrs[$key] = $value;
			}
		}
	}
	echo '<' . $tag;
	attrs($blockAttrs);
	echo '>';
	if (is_callable($block)) $block();
	echo '</' . $tag . '>';
	if (!$isElement) array_pop($__bem_chain);
}

function mixin__e($block = null, $attributes = null, $tag = null) {
	mixin__b($block, $attributes, $tag, true);
}

function mixin__i($block = null, $attributes = null) {
	$dataArgs = array_slice(func_get_args(), 2);
	echo "[INCLUDE HERE]";
}

include 'breadcrumbs.php';

?>

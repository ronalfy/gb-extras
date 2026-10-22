<?php
// This file is generated. Do not modify it manually.
return array(
	'pattern-importer' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'title' => 'Pattern Inserter',
		'apiVersion' => 3,
		'name' => 'mediaron/mrshortcuts-pattern-inserter',
		'category' => 'generateblocks',
		'icon' => '',
		'description' => 'Paste in a pattern and it will be inserted for you, remote images downloaded, and unique IDs re-generated.',
		'keywords' => array(
			'generateblocks',
			'pattern',
			'inserter'
		),
		'version' => '1.0.0',
		'textdomain' => 'mediaron-block-shortcuts-for-gb',
		'attributes' => array(
			'preview' => array(
				'type' => 'boolean',
				'default' => false
			)
		),
		'example' => array(
			'attributes' => array(
				'preview' => true
			)
		),
		'editorScript' => 'mrshortcuts-gb-pattern-inserter-block',
		'editorStyle' => 'mrshortcuts-gb-pattern-inserter-block-css'
	)
);

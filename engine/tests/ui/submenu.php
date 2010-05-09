<?php
/**
 * 1.8 submenu test.
 *
 * Submenu needs to be able to support being added out of order.
 * Children can be added before parents.
 * 	Children of parents never defined are never shown.
 *
 * Test against:
 * 	different contexts
 * 	different groups
 * 	old add_submenu_item() wrapper.
 *
 */

require_once('../../start.php');

$url = "{$CONFIG->url}engine/tests/ui/submenu.php";

$items = array(
	array(
		'text' => 'Upper level 1',
		'url' => "$url?upper_level_1",
		'id' => 'ul1'
	),
		array(
			'text' => 'CD (No link)',
			'parent_id' => 'cup',
			'id' => 'cd',
		),
			array(
				'text' => 'Sub CD',
				'url' => "$url?sub_cd",
				'parent_id' => 'cd'
			),
	array(
		'text' => 'Cup',
		'url' => "$url?cup",
		'id' => 'cup'
	),
		array(
			'text' => 'Phone',
			'url' => "$url?phone",
			'id' => 'phone',
			'parent_id' => 'cup'
		),
			array(
				'text' => 'Wallet',
				'url' => "$url?wallet",
				'id' => 'wallet',
				'parent_id' => 'phone'
			),
	array(
		'text' => 'Upper level',
		'url' => "$url?upper_level",
		'id' => 'ul'
	),
		array(
			'text' => 'Sub Upper level',
			'url' => "$url?sub_upper_level",
			'parent_id' => 'ul'
		),
	array(
		'text' => 'Root',
		'url' => $url,
	),

	array(
		'text' => 'I am an orphan',
		'url' => 'http://google.com',
		'parent_id' => 'missing_parent'
	),

	array(
		'text' => 'JS Test',
		'url' => 'http://elgg.org',
		'vars' => array('js' => 'onclick="alert(\'Link to \' + $(this).attr(\'href\') + \'!\'); return false;"')
	)
);

foreach ($items as $item) {
	elgg_add_submenu_item($item, 'main');
}

add_submenu_item('Old Onclick Test', 'http://elgg.com', NULL, TRUE);
add_submenu_item('Old Selected Test', 'http://elgg.com', NULL, '', TRUE);


elgg_add_submenu_item(array('text' => 'Not Main Test', 'url' => "$url?not_main_test"), 'not_main', 'new_menu');
elgg_add_submenu_item(array('text' => 'Not Main C Test', 'url' => "$url?not_main_c_test"), 'not_main', 'new_menu');

elgg_add_submenu_item(array('text' => 'All test', 'url' => "$url?all"), 'all');

//set_context('not_main');

$body = elgg_view_layout('one_column_with_sidebar', 'Look right.');
page_draw('Submenu Test', $body);
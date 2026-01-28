<?php
/**
 * p2y2-rbac-users/i18n/config.php
 *
 * @author Pedro Plowman
 * @copyright Copyright © Pedro Plowman, 2025
 * @link https://github.com/p2made
 * @license MIT
 */

return [
	'sourcePath'     => '@vendor/p2made/p2y2-rbac-users',
	'translator'     => ['\Yii::t', 'Yii::t'],
	'sourceLanguage' => 'en',
	'format'         => 'php',
	'sort'           => true,
	'overwrite'      => true,
	'removeUnused'   => false,
	'markUnused'     => true,
	'only'           => ['*.php'],
	'except' => [
		'/i18n/',
		'/messages/',
		'/test/',
		'/tests/',
		'/z_gitignore/',
	],
	'ignoreCategories' => [
		'usuario',
	],
];

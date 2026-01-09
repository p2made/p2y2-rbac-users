<?php
/**
 * i18n/config.php
 *
 * @author Pedro Plowman
 * @copyright Copyright &copy; Pedro Plowman, 2025
 * @link https://github.com/p2made
 * @license MIT
 *
 * @package p2made/p2y2-rbac-users
 */

return [
	'sourcePath' => __DIR__ . '/../../../User',
	'messagePath' => __DIR__,
	'languages' => [
		'ca',
		'da',
		'de',
		'de-DU',
		'es',
		'et',
		'fa-IR',
		'fi',
		'fr',
		'hr',
		'hu',
		'it',
		'kk',
		'lt',
		'nl',
		'pl',
		'pt-BR',
		'pt-PT',
		'ro',
		'ru',
		'th',
		'tr-TR',
		'uk',
		'vi',
		'zh-CN',
	],
	'translator' => 'Yii::t',
	'sort' => false,
	'overwrite' => true,
	'removeUnused' => false,
	'only' => ['*.php'],
	'except' => [
		'.svn',
		'.git',
		'.gitignore',
		'.gitkeep',
		'.hgignore',
		'.hgkeep',
	],
	'format' => 'php',
];

<?php
/**
 * P2GravatarHelper.php
 *
 * @author Pedro Plowman
 * @copyright Copyright © Pedro Plowman, 2025
 * @link https://github.com/p2made
 * @license MIT
 *
 * @package p2made/p2y2-rbac-users
 * @class \p2m\rbac\helpers\P2GravatarHelper
 */

/**
 * Usage:
 * use p2m\rbac\helpers\P2GravatarHelper;
 * P2GravatarHelper::img(object $user, array $options = [], int $size = 200, string $default = 'mp')
 * P2GravatarHelper::imgByEmail(string $email, array $options = [], int $size = 64, string $default = 'mp')
 */

namespace p2m\rbac\helpers;

use Yii;
use yii\bootstrap5\Html;

final class P2GravatarHelper
{
	public static function gravatarUrl(string $email, int $size = 200, string $default = 'mp'): string
	{
		$hash = md5(strtolower(trim($email)));
		return "https://www.gravatar.com/avatar/{$hash}?s={$size}&d={$default}";
	}

	/**
	 * @param object $user Expected to have ->email and optionally ->profile?->gravatar_email
	 */
	public static function userEmail(object $user): ?string
	{
		return $user->profile?->gravatar_email
			?? $user->email
			?? null;
	}

	/**
	 * @param object $user Expected to have ->username for alt text.
	 */
	public static function img(object $user, array $options = [], int $size = 200, string $default = 'mp'): string
	{
		$email = self::userEmail($user);

		if ($email === null)
		{
			return '';
		}

		$username = $user->username ?? Yii::t('p2m.rbac.a11y', 'User');

		$defaults = [
			'class' => 'img-fluid rounded-circle',
			'alt' => Yii::t(
				'p2m.rbac.a11y',
				'Profile photo of {username}',
				['username' => $username]
			),
		];

		return Html::img(
			self::gravatarUrl($email, $size, $default),
			array_merge($defaults, $options)
		);
	}

	public static function imgByEmail(string $email, array $options = [], int $size = 64, string $default = 'mp'): string
	{
		$defaults = [
			'alt' => Yii::t('p2m.rbac.a11y', 'User avatar'),
		];

		return Html::img(
			self::gravatarUrl($email, $size, $default),
			array_merge($defaults, $options)
		);
	}
}

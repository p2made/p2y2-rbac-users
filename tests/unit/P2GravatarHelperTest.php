<?php

declare(strict_types=1);

namespace tests\unit;

use PHPUnit\Framework\TestCase;
use p2m\rbac\helpers\P2GravatarHelper;

final class P2GravatarHelperTest extends TestCase
{
	public function testGravatarUrlBuildsExpectedUrl(): void
	{
		$email = 'Test@Example.com ';
		// md5 of strtolower(trim(email)) => 'test@example.com'
		$hash = md5('test@example.com');

		$url = P2GravatarHelper::gravatarUrl($email, 128, 'identicon');

		$this->assertSame(
			"https://www.gravatar.com/avatar/{$hash}?s=128&d=identicon",
			$url
		);
	}

	public function testImgByEmailRendersImgTagWithOptions(): void
	{
		$email = 'a@example.com';
		$hash = md5('a@example.com');

		$html = P2GravatarHelper::imgByEmail($email, [
			'class' => 'rounded-circle',
			'data-x' => '1',
		], 64, 'mp');

		$this->assertStringContainsString('<img', $html);
		$this->assertStringContainsString("https://www.gravatar.com/avatar/{$hash}?s=64&d=mp", $html);
		$this->assertStringContainsString('class="rounded-circle"', $html);
		$this->assertStringContainsString('data-x="1"', $html);
	}

	public function testImgReturnsEmptyStringWhenNoEmail(): void
	{
		$user = (object)[
			'username' => 'pedro',
			'email' => null,
			'profile' => null,
		];

		$this->assertSame('', P2GravatarHelper::img($user));
	}

	public function testImgUsesProfileGravatarEmailOverUserEmail(): void
	{
		$user = (object)[
			'username' => 'pedro',
			'email' => 'account@example.com',
			'profile' => (object)[
				'gravatar_email' => 'gravatar@example.com',
			],
		];

		$hash = md5('gravatar@example.com');
		$html = P2GravatarHelper::img($user, [], 80, 'mp');

		$this->assertStringContainsString("https://www.gravatar.com/avatar/{$hash}?s=80&d=mp", $html);
	}

	public function testImgAltContainsUsernameWhenAvailable(): void
	{
		$user = (object)[
			'username' => 'chinggis',
			'email' => 'x@example.com',
			'profile' => null,
		];

		$html = P2GravatarHelper::img($user);

		// We can't reliably assert the translated sentence without bootstrapping i18n,
		// but we can assert the username appears in the alt attribute.
		$this->assertMatchesRegularExpression('/alt="[^"]*chinggis[^"]*"/', $html);
	}
}

<?php

namespace Quotations;

class Quotations implements \Dxw\Iguana\Registerable
{
	public const QUOTES = [
		'To be or not to be, that is the question.',
		'I have a dream.',
		'Life is what happens to you while you\'re busy making other plans.',
		'I wandered lonely as a cloud.'
	];

	public function register(): void
	{
		add_action('init', [$this, 'addShortcode']);
	}

	public function addShortcode(): void
	{
		add_shortcode('quote-of-the-day', [$this, 'output']);
	}

	public function output(): string
	{
		$key = array_rand(self::QUOTES);
		$quote = self::QUOTES[$key];
		return sprintf('<blockquote>%s</blockquote>', $quote);
	}
}
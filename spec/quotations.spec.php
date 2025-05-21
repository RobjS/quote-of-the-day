<?php

describe(\Quotations\Quotations::class, function () {
	beforeEach(function () {
		$this->quotations = new \Quotations\Quotations();
	});

	it('implements the registerable interface', function () {
		expect($this->quotations)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds the action', function () {
			allow('add_action')->toBeCalled();
			expect('add_action')->toBeCalled()->once()->with('init', [$this->quotations, 'addShortcode']);

			$this->quotations->register();
		});
	});

	describe('->addShortcode()', function () {
		it('calls add shortcode', function () {
			allow('add_shortcode')->toBeCalled();
			expect('add_shortcode')->toBeCalled()->once()->with('quote-of-the-day', [$this->quotations, 'output']);

			$this->quotations->addShortcode();
		});
	});

	describe('->output()', function () {
		it('outputs a single quote', function () {
			for($i=0; $i<5; $i++) {
				$output = $this->quotations->output();
				$output = str_replace('<blockquote>', '', $output);
				$output = str_replace('</blockquote>', '', $output);
				expect(\Quotations\Quotations::QUOTES)->toContain($output);
			}
		});
	});
});
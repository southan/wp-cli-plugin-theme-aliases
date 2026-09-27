<?php

namespace WP_CLI_Plugin_Theme_Aliases;

use WP_CLI\Exception;

class Alias {

	public string $name;
	public ?string $slug = null;
	public ?string $src = null;

	public function __construct( string $name, array $args ) {
		$this->name = $name;
		$this->slug = $args['slug'] ?? null;
		$this->src  = $args['src'] ?? null;

		if ( ! $this->src && ( ! $this->slug || $this->slug === $this->name ) ) {
			throw new Exception( "Alias '$this->name' needs at least src or alternate slug." );
		}
	}

	public function to_array() : array {
		return \get_object_vars( $this );
	}

	public function to_config() : array {
		return \array_filter([
			'slug' => $this->slug,
			'src' => $this->src,
		]);
	}
}

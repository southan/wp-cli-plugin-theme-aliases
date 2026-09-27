<?php

namespace WP_CLI_Plugin_Theme_Aliases;

use WP_CLI;
use WP_CLI\Formatter;

abstract class Command {

	public function __construct(
		public Aliases $aliases
	) {}

	public function set( array $args, array $assoc_args ) : void {
		$name = \array_shift( $args );

		$alias = new Alias( $name, $assoc_args );

		$this->aliases->save( $alias, $assoc_args['config'] ?? null );

		WP_CLI::success( "Set '$name' {$this->aliases->type} alias." );
	}

	public function delete( array $args, array $assoc_args ) : void {
		foreach ( $args as $name ) {
			try {
				$this->aliases->delete( $name, $assoc_args['config'] ?? null );

				WP_CLI::success( "Deleted '$name' {$this->aliases->type} alias." );

			} catch ( \Exception $error ) {
				WP_CLI::error( $error->getMessage(), false );
			}
		}
	}

	public function list( array $args, array $assoc_args ) : void {
		$aliases = $this->aliases->all();

		$aliases = \array_map( fn ( $alias ) => $alias->to_array(), $aliases );

		if ( ! $aliases ) {
			return;
		}

		$fields = \array_keys( \current( $aliases ) );

		$formatter = new Formatter( $assoc_args, $fields );

		$formatter->display_items( $aliases );
	}
}

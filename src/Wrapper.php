<?php

namespace WP_CLI_Plugin_Theme_Aliases;

use Closure;
use WP_CLI\Dispatcher\Subcommand;

class Wrapper extends Subcommand {

	private Closure $original_when_invoked;

	public function __construct(
		private Aliases $aliases,
		Subcommand $subcommand
	) {
		$r = new \ReflectionObject( $subcommand );

		/** @var Closure */
		$when_invoked = $r->getProperty( 'when_invoked' )->getValue( $subcommand );

		$this->original_when_invoked = $when_invoked;

		parent::__construct(
			$subcommand->parent,
			$subcommand->name,
			$subcommand->docparser,
			[ $this, 'resolve_args_and_invoke' ]
		);
	}

	public function resolve_args_and_invoke( array $args, array $assoc_args ) : void {
		$args = \array_map( [ $this, 'resolve_arg' ], $args );

		($this->original_when_invoked)( $args, $assoc_args );
	}

	public function resolve_arg( string $arg ) : string {
		$alias = $this->aliases->find( $arg );

		if ( ! $alias ) {
			return $arg;
		}

		if ( \in_array( $this->get_name(), [ 'install' ] ) ) {
			return $alias->src ?? $alias->slug ?? $arg;
		}

		return $alias->slug ?? $arg;
	}
}

<?php

namespace WP_CLI_Plugin_Theme_Aliases;

use WP_CLI;
use WP_CLI\Dispatcher\Subcommand;
use WP_CLI\Exception;

if ( ! class_exists( WP_CLI::class ) ) {
	return;
}

function init() : void {
	register( new Plugin_Command() );
	register( new Theme_Command() );
}

WP_CLI::add_hook( 'before_registering_contexts', __NAMESPACE__ . '\\init' );

function register( Command $command ) : void {
	$type = $command->aliases->type;

	$args = [ $type ];

	$original = WP_CLI::get_root_command()->find_subcommand( $args );

	if ( ! $original ) {
		throw new Exception( "Command '$type' not found." );
	}

	foreach ( $original->get_subcommands() as $name => $subcommand ) {
		if ( $subcommand instanceof Subcommand ) {
			WP_CLI::debug( "Wrapping $type $name", 'plugin-theme-aliases' );

			$original->add_subcommand(
				$name,
				new Wrapper( $command->aliases, $subcommand ),
				override: true
			);
		}
	}

	WP_CLI::add_command( "$type alias", $command );
}

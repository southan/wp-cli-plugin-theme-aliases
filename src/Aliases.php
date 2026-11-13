<?php

namespace WP_CLI_Plugin_Theme_Aliases;

use WP_CLI;
use WP_CLI\Config;
use WP_CLI\Exception;

class Aliases {

	public function __construct(
		public string $type
	) {}

	public function get_key() : string {
		return "$this->type aliases";
	}

	/**
	 * @return array<string, string[]>
	 */
	public function get() : array {
		return (array) ( WP_CLI::get_runner()->extra_config[ $this->get_key() ] ?? null );
	}

	/**
	 * @return array<string, Alias>
	 */
	public function all() : array {
		$aliases = [];

		foreach ( $this->get() as $name => $args ) {
			try {
				$alias = new Alias( $name, $args );

				$aliases[ $name ] = $alias;

			} catch ( Exception $error ) {
				WP_CLI::warning( "Alias '$name' is invalid. " . $error->getMessage() );
			}
		}

		return $aliases;
	}

	public function find( string $name ) : ?Alias {
		$aliases = $this->get();

		if ( ! isset( $aliases[ $name ] ) ) {
			return null;
		}

		return new Alias( $name, $aliases[ $name ] );
	}

	public function save( Alias $alias, ?string $type = null ) : void {
		$key = $this->get_key();

		$config = Config::from( $type );

		$aliases = $config[ $key ] ?? [];

		if ( ! \is_array( $aliases ) ) {
			$aliases = [ $aliases ];
		}

		$aliases[ $alias->name ] = $alias->to_config();

		$config[ $key ] = $aliases;

		$config->save();
	}

	public function delete( string $name, ?string $type = null ) : void {
		$key = $this->get_key();

		$type ??= [ 'project', 'global' ];

		$found = false;

		foreach ( (array) $type as $config_type ) {
			$config = Config::from( $config_type );

			$aliases = $config[ $key ] ?? null;

			if ( ! \is_array( $aliases ) || ! isset( $aliases[ $name ] ) ) {
				continue;
			}

			$found = true;

			unset( $aliases[ $name ] );

			if ( $aliases ) {
				$config[ $key ] = $aliases;
			} else {
				unset( $config[ $key ] );
			}

			$config->save();
		}

		if ( ! $found ) {
			throw new Exception( "Alias '$name' does not exist." );
		}
	}
}

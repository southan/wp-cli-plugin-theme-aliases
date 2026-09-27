<?php

namespace WP_CLI_Plugin_Theme_Aliases;

/**
 * Manage WP-CLI plugin aliases.
 *
 * You can use plugin aliases in any other `wp plugin ...` command.
 *
 * ## EXAMPLES
 *
 *     # Set custom source.
 *     $ wp plugin alias set my-plugin --src='https://s3.amazonaws.com/bucketname/my-plugin.zip?AWSAccessKeyId=123&Expires=456&Signature=abcdef'
 *     Success: Set 'my-plugin' plugin alias.
 *
 *     # Set shorthand slug.
 *     $ wp plugin alias set wc --slug=woocommerce
 *     Success: Set 'wc' plugin alias.
 *
 *     $ wp plugin install my-plugin
 *     Downloading installation package from https://s3.amazonaws.com/bucketname/my-plugin.zip?AWSAccessKeyId=123&Expires=456&Signature=abcdef
 *     Unpacking the package...
 *     Installing the plugin...
 *     Plugin installed successfully.
 *     Success: Installed 1 of 1 plugins.
 *
 *     $ wp plugin activate wc
 *     Plugin 'woocommerce' activated.
 *     Success: Activated 1 of 1 plugins.
 *
 * @when before_wp_load
 */
class Plugin_Command extends Command {

	public function __construct() {
		parent::__construct( new Aliases( 'plugin' ) );
	}

	/**
	 * Set plugin alias.
	 *
	 * ## OPTIONS
	 *
	 * <alias>
	 * : Plugin alias.
	 *
	 * [--src=<src>]
	 * : URL or path to plugin package.
	 *
	 * [--slug=<slug>]
	 * : Plugin slug (if different to alias).
	 *
	 * [--config=<config>]
	 * : Use specific config file.
	 * ---
	 * default: global
	 * options:
	 *   - global
	 *   - project
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     # Set global plugin alias.
	 *     $ wp plugin alias set wc --slug=woocommerce
	 *     Success: Set 'wc' plugin alias.
	 *
	 *     # Set project plugin alias.
	 *     $ wp plugin alias set my-plugin --config=project --src='https://s3.amazonaws.com/bucketname/my-plugin.zip?AWSAccessKeyId=123&Expires=456&Signature=abcdef'
	 *     Success: Set 'my-plugin' plugin alias.
	 */
	public function set( array $args, array $assoc_args ) : void {
		parent::set( $args, $assoc_args );
	}

	/**
	 * List plugin aliases.
	 *
	 * ## OPTIONS
	 *
	 * [--field=<field>]
	 * : Display the value of a single field.
	 *
	 * [--fields=<fields>]
	 * : Limit the output to specific fields.
	 *
	 * [--format=<format>]
	 * : Render output in a particular format.
	 * ---
	 * default: table
	 * options:
	 *   - table
	 *   - json
	 *   - yaml
	 *   - csv
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     # List plugin aliases.
	 *     $ wp plugin alias list
	 *     +-----------+-------------+----------------------------------------+
	 *     | name      | slug        | src                                    |
	 *     +-----------+-------------+----------------------------------------+
	 *     | my-plugin |             | https://s3.amazonaws.com/bucketname... |
	 *     | wc        | woocommerce |                                        |
	 *     +-----------+-------------+----------------------------------------+
	 */
	public function list( array $args, array $assoc_args ) : void {
		parent::list( $args, $assoc_args );
	}

	/**
	 * Delete plugin alias.
	 *
	 * ## OPTIONS
	 *
	 * <alias>...
	 * : Plugin alias(es).
	 *
	 * [--config=<config>]
	 * : Use specific config file.
	 * ---
	 * default: global
	 * options:
	 *   - global
	 *   - project
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     # Delete global plugin alias.
	 *     $ wp plugin alias delete wc
	 *     Success: Deleted 'wc' plugin alias.
	 *
	 *     # Delete project plugin alias.
	 *     $ wp plugin alias delete my-plugin --config=project
	 *     Success: Deleted 'my-plugin' plugin alias.
	 */
	public function delete( array $args, array $assoc_args ) : void {
		parent::delete( $args, $assoc_args );
	}
}

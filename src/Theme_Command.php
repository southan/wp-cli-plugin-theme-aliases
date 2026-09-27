<?php

namespace WP_CLI_Plugin_Theme_Aliases;

/**
 * Manage WP-CLI theme aliases.
 *
 * You can use theme aliases in any other `wp theme ...` command.
 *
 * ## EXAMPLES
 *
 *     # Set custom source.
 *     $ wp theme alias set my-theme --src='https://s3.amazonaws.com/bucketname/my-theme.zip?AWSAccessKeyId=123&Expires=456&Signature=abcdef'
 *     Success: Set 'my-theme' theme alias.
 *
 *     # Set shorthand slug.
 *     $ wp theme alias set 2025 --slug=twentytwentyfive
 *     Success: Set '2025' theme alias.
 *
 *     $ wp theme install my-theme
 *     Downloading installation package from https://s3.amazonaws.com/bucketname/my-theme.zip?AWSAccessKeyId=123&Expires=456&Signature=abcdef...
 *     Unpacking the package...
 *     Installing the theme...
 *     Theme installed successfully.
 *     Success: Installed 1 of 1 themes.
 *
 *     $ wp theme activate 2025
 *     Success: Switched to 'Twenty Twenty-Five' theme.
 *
 * @when before_wp_load
 */
class Theme_Command extends Command {

	public function __construct() {
		parent::__construct( new Aliases( 'theme' ) );
	}

	/**
	 * Set theme alias.
	 *
	 * ## OPTIONS
	 *
	 * <alias>
	 * : Theme alias.
	 *
	 * [--src=<src>]
	 * : URL or path to theme package.
	 *
	 * [--slug=<slug>]
	 * : Theme slug (if different to alias).
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
	 *     # Set custom package source.
	 *     $ wp theme alias set my-theme --src='https://s3.amazonaws.com/bucketname/my-theme.zip?AWSAccessKeyId=123&Expires=456&Signature=abcdef'
	 *     Success: Set 'my-theme' theme alias.
	 *
	 *     # Set shorthand slug.
	 *     $ wp theme alias set 2025 --slug=twentytwentyfive
	 *     Success: Set '2025' theme alias.
	 */
	public function set( array $args, array $assoc_args ) : void {
		parent::set( $args, $assoc_args );
	}

	/**
	 * List theme aliases.
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
	 *     # List theme aliases.
	 *     $ wp theme alias list
	 *     +----------+------------------+------------------------------------+
	 *     | name     | slug             | src                                |
	 *     +----------+------------------+------------------------------------+
	 *     | my-theme |                  | https://s3.amazonaws.com/bucket... |
	 *     | 2025     | twentytwentyfive |                                    |
	 *     +----------+------------------+------------------------------------+
	 */
	public function list( array $args, array $assoc_args ) : void {
		parent::list( $args, $assoc_args );
	}

	/**
	 * Delete theme alias.
	 *
	 * ## OPTIONS
	 *
	 * <alias>...
	 * : Theme alias(es).
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
	 *     # Delete global theme alias.
	 *     $ wp theme alias delete 2025
	 *     Success: Deleted '2025' theme alias.
	 *
	 *     # Delete project theme alias.
	 *     $ wp theme alias delete my-theme --config=project
	 *     Success: Deleted 'my-theme' theme alias.
	 */
	public function delete( array $args, array $assoc_args ) : void {
		parent::delete( $args, $assoc_args );
	}
}

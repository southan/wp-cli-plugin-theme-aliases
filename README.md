southan/wp-cli-plugin-theme-aliases
===================================

Manage plugin & theme aliases for easy reuse in WP-CLI commands.



Quick links: [Using](#using) | [Installing](#installing) | [Contributing](#contributing) | [Support](#support)

## Using

This package implements the following commands:

### wp plugin alias

Manage WP-CLI plugin aliases.

~~~
wp plugin alias
~~~

You can use plugin aliases in any other `wp plugin ...` command.

**EXAMPLES**

    # Set custom source.
    $ wp plugin alias set my-plugin --src='https://s3.amazonaws.com/bucketname/my-plugin.zip?AWSAccessKeyId=123&Expires=456&Signature=abcdef'
    Success: Set 'my-plugin' plugin alias.

    # Set shorthand slug.
    $ wp plugin alias set wc --slug=woocommerce
    Success: Set 'wc' plugin alias.

    $ wp plugin install my-plugin
    Downloading installation package from https://s3.amazonaws.com/bucketname/my-plugin.zip?AWSAccessKeyId=123&Expires=456&Signature=abcdef
    Unpacking the package...
    Installing the plugin...
    Plugin installed successfully.
    Success: Installed 1 of 1 plugins.

    $ wp plugin activate wc
    Plugin 'woocommerce' activated.
    Success: Activated 1 of 1 plugins.





### wp plugin alias set

Set plugin alias.

~~~
wp plugin alias set <alias> [--src=<src>] [--slug=<slug>] [--config=<config>]
~~~

**OPTIONS**

	<alias>
		Plugin alias.

	[--src=<src>]
		URL or path to plugin package.

	[--slug=<slug>]
		Plugin slug (if different to alias).

	[--config=<config>]
		Use specific config file.
		---
		default: global
		options:
		  - global
		  - project
		---

**EXAMPLES**

    # Set global plugin alias.
    $ wp plugin alias set wc --slug=woocommerce
    Success: Set 'wc' plugin alias.

    # Set project plugin alias.
    $ wp plugin alias set my-plugin --config=project --src='https://s3.amazonaws.com/bucketname/my-plugin.zip?AWSAccessKeyId=123&Expires=456&Signature=abcdef'
    Success: Set 'my-plugin' plugin alias.



### wp plugin alias list

List plugin aliases.

~~~
wp plugin alias list [--field=<field>] [--fields=<fields>] [--format=<format>]
~~~

**OPTIONS**

	[--field=<field>]
		Display the value of a single field.

	[--fields=<fields>]
		Limit the output to specific fields.

	[--format=<format>]
		Render output in a particular format.
		---
		default: table
		options:
		  - table
		  - json
		  - yaml
		  - csv
		---

**EXAMPLES**

    # List plugin aliases.
    $ wp plugin alias list
    +-----------+-------------+----------------------------------------+
    | name      | slug        | src                                    |
    +-----------+-------------+----------------------------------------+
    | my-plugin |             | https://s3.amazonaws.com/bucketname... |
    | wc        | woocommerce |                                        |
    +-----------+-------------+----------------------------------------+



### wp plugin alias delete

Delete plugin alias.

~~~
wp plugin alias delete <alias>... [--config=<config>]
~~~

**OPTIONS**

	<alias>...
		Plugin alias(es).

	[--config=<config>]
		Use specific config file.
		---
		default: global
		options:
		  - global
		  - project
		---

**EXAMPLES**

    # Delete global plugin alias.
    $ wp plugin alias delete wc
    Success: Deleted 'wc' plugin alias.

    # Delete project plugin alias.
    $ wp plugin alias delete my-plugin --config=project
    Success: Deleted 'my-plugin' plugin alias.



### wp theme alias

Manage WP-CLI theme aliases.

~~~
wp theme alias
~~~

You can use theme aliases in any other `wp theme ...` command.

**EXAMPLES**

    # Set custom source.
    $ wp theme alias set my-theme --src='https://s3.amazonaws.com/bucketname/my-theme.zip?AWSAccessKeyId=123&Expires=456&Signature=abcdef'
    Success: Set 'my-theme' theme alias.

    # Set shorthand slug.
    $ wp theme alias set 2025 --slug=twentytwentyfive
    Success: Set '2025' theme alias.

    $ wp theme install my-theme
    Downloading installation package from https://s3.amazonaws.com/bucketname/my-theme.zip?AWSAccessKeyId=123&Expires=456&Signature=abcdef...
    Unpacking the package...
    Installing the theme...
    Theme installed successfully.
    Success: Installed 1 of 1 themes.

    $ wp theme activate 2025
    Success: Switched to 'Twenty Twenty-Five' theme.





### wp theme alias set

Set theme alias.

~~~
wp theme alias set <alias> [--src=<src>] [--slug=<slug>] [--config=<config>]
~~~

**OPTIONS**

	<alias>
		Theme alias.

	[--src=<src>]
		URL or path to theme package.

	[--slug=<slug>]
		Theme slug (if different to alias).

	[--config=<config>]
		Use specific config file.
		---
		default: global
		options:
		  - global
		  - project
		---

**EXAMPLES**

    # Set custom package source.
    $ wp theme alias set my-theme --src='https://s3.amazonaws.com/bucketname/my-theme.zip?AWSAccessKeyId=123&Expires=456&Signature=abcdef'
    Success: Set 'my-theme' theme alias.

    # Set shorthand slug.
    $ wp theme alias set 2025 --slug=twentytwentyfive
    Success: Set '2025' theme alias.



### wp theme alias list

List theme aliases.

~~~
wp theme alias list [--field=<field>] [--fields=<fields>] [--format=<format>]
~~~

**OPTIONS**

	[--field=<field>]
		Display the value of a single field.

	[--fields=<fields>]
		Limit the output to specific fields.

	[--format=<format>]
		Render output in a particular format.
		---
		default: table
		options:
		  - table
		  - json
		  - yaml
		  - csv
		---

**EXAMPLES**

    # List theme aliases.
    $ wp theme alias list
    +----------+------------------+------------------------------------+
    | name     | slug             | src                                |
    +----------+------------------+------------------------------------+
    | my-theme |                  | https://s3.amazonaws.com/bucket... |
    | 2025     | twentytwentyfive |                                    |
    +----------+------------------+------------------------------------+



### wp theme alias delete

Delete theme alias.

~~~
wp theme alias delete <alias>... [--config=<config>]
~~~

**OPTIONS**

	<alias>...
		Theme alias(es).

	[--config=<config>]
		Use specific config file.
		---
		default: global
		options:
		  - global
		  - project
		---

**EXAMPLES**

    # Delete global theme alias.
    $ wp theme alias delete 2025
    Success: Deleted '2025' theme alias.

    # Delete project theme alias.
    $ wp theme alias delete my-theme --config=project
    Success: Deleted 'my-theme' theme alias.

## Installing

Installing this package requires WP-CLI v2.12 or greater. Update to the latest stable release with `wp cli update`.

Once you've done so, you can install the latest stable version of this package with:

```bash
wp package install southan/wp-cli-plugin-theme-aliases:@stable
```

To install the latest development version of this package, use the following command instead:

```bash
wp package install southan/wp-cli-plugin-theme-aliases:dev-main
```

## Contributing

We appreciate you taking the initiative to contribute to this project.

Contributing isn’t limited to just code. We encourage you to contribute in the way that best fits your abilities, by writing tutorials, giving a demo at your local meetup, helping other users with their support questions, or revising our documentation.

For a more thorough introduction, [check out WP-CLI's guide to contributing](https://make.wordpress.org/cli/handbook/contributing/). This package follows those policy and guidelines.

### Reporting a bug

Think you’ve found a bug? We’d love for you to help us get it fixed.

Before you create a new issue, you should [search existing issues](https://github.com/southan/wp-cli-plugin-theme-aliases/issues?q=label%3Abug%20) to see if there’s an existing resolution to it, or if it’s already been fixed in a newer version.

Once you’ve done a bit of searching and discovered there isn’t an open or fixed issue for your bug, please [create a new issue](https://github.com/southan/wp-cli-plugin-theme-aliases/issues/new). Include as much detail as you can, and clear steps to reproduce if possible. For more guidance, [review our bug report documentation](https://make.wordpress.org/cli/handbook/bug-reports/).

### Creating a pull request

Want to contribute a new feature? Please first [open a new issue](https://github.com/southan/wp-cli-plugin-theme-aliases/issues/new) to discuss whether the feature is a good fit for the project.

Once you've decided to commit the time to seeing your pull request through, [please follow our guidelines for creating a pull request](https://make.wordpress.org/cli/handbook/pull-requests/) to make sure it's a pleasant experience. See "[Setting up](https://make.wordpress.org/cli/handbook/pull-requests/#setting-up)" for details specific to working on this package locally.

## Support

GitHub issues aren't for general support questions, but there are other venues you can try: https://wp-cli.org/#support


*This README.md is generated dynamically from the project's codebase using `wp scaffold package-readme` ([doc](https://github.com/wp-cli/scaffold-package-command#wp-scaffold-package-readme)). To suggest changes, please submit a pull request against the corresponding part of the codebase.*

# Wordpress Settings Builder

An abstraction of the Wordpress settings API for use as an included library.

The included `plugin.php` file provides a usage example and may be activated as a Wordpress plugin for testing.

## Usage

```php
require __DIR__ . '/vendor/autoload.php';
$settings = new vena\WordpressSettingsBuilder\Builder( 'Test Settings Title', 'Testing Menu', 'manage_options', 'my-settings', 9999 );
$section  = $settings->addSection( 'My/Section', 'My Section' );
$section->addField( [
	'type'        => 'text',
	'id'          => 'my/section/textfield',
	'title'       => 'Test text field',
	'option_name' => 'test_text_field',
	'args'        => [ 'test', 'required', 'style' => 'width: 500px' ],
] );
```

Pages must have at least 1 section. Multiple sections added to a single settings page generates a tabbed view.

The built-in field types are simply addField defaults for input types and render callbacks.

### Array-based option name support

This library supports storing multi-dimensional arrays within a single database row for distinct fields. For example:

```php
$section->addField( [
	'type'        => 'checkbox',
	'id'          => 'my/section3/checkbox1',
	'title'       => 'Test checkbox 1',
	'option_name' => 'option_array[checkbox1]',
] );

$section->addField( [
	'type'        => 'checkbox',
	'id'          => 'my/section3/checkbox2',
	'title'       => 'Test checkbox 2',
	'option_name' => 'option_array[checkbox2]',
] );
```

Will store the set values as a serialized array under a single option with the base name, "option_array". The values in the
brackets (e.g. "checkbox1", "checkbox2") are the keys to that array. When the fields are displayed on the settings page,
each field will display only the value of its keyed data within the array.

When accessing the option directly using `get_option()`, note that you must use the base name to retrieve
the full array value, and handle key access yourself.
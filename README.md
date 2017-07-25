# WP Asciinema

This is a WordPress plugin to host Asciicasts created with [Asciinema](https://asciinema.org) from your WordPress site.

Note: If you are simply wanting to show Asciicasts directly from Asciinema.org then you don't need this plugin. There are numerous ways to embed Asciicasts on the [Sharing and Embedding](https://asciinema.org/docs/embedding) page.

## Usage

This plugin does a few things when activated:

* Creates a folder in the WordPress uploads folder to hold asciicasts (default: `uploads/asciicasts`)
* Registers the `asciinema` shortcode

### Quick Workflow

In order to make use of these features you must upload an asciicast created by Asciinema to the asciicasts folder of your WordPress installation and reference it with the shortcode in WordPress.

This workflow might looks something like in the terminal:

```
# Create the Asciicast -- not part of this plugin see asciinema.org
$ asciinema rec my-terminal-session.json
# do stuff while recording
# <ctrl-d> to stop the recording
# Now upload your asciicast to the WordPress site
$ scp my-terminal-session.json user@your-server.com:public_html/wp-content/uploads/asciicasts/
```

Now in WordPress, display the above asciicast by inserting `[asciinema src="my-terminal-session.json"]` into a post.

## Details

### Shortcode : asciinema

The shortcode takes a subset of properties described in the [Asciinema Player element attributes](https://github.com/asciinema/asciinema-player#asciinema-player-element-attributes) documentation. Specifically:

* `src` -- **Required** The filename of the asciicast to display
* `theme` -- The player theme: default of 'asciinema' other themes include: `tango` `solarized-dark` `solarized-light` `monokai`
* `rows` -- The number of rows the player should use (Doesn't affect the rows of the underlying asciicast)
* `cols` -- The number of columns the player should use (Doesn't affect the columns of the underlying asciicast)
* `speed` -- The playback speed of the asciicast
* `loop` -- Should the asciicast loop?
* `autoplay` -- Should the asciicast autoplay?

The default values used can be changed by using the `wp_asciinema_player_defaults` filter. For example:


```
function my_app_custom_asciicasts_player( $defaults ) {
	// These are the current defaults -- change them as needed
	$defaults = array(
		'src'      => '',
		'theme'    => 'asciinema',
		'rows'     => 24,
		'cols'     => 80,
		'speed'    => 1,
		'loop'     => false,
		'autoplay' => false,
	);
	return $defaults;
}
add_action('wp_asciinema_asciicasts_folder', 'my_app_custom_asciicasts_player');
```

### Asciicasts Folder

The default folder that this plugin creates is `uploads/asciicasts` but this can be changed using the `wp_asciinema_asciicasts_folder` filter. For example:

```
function my_app_custom_asciicasts_folder( $folder ) {
	return 'custom-folder-name';
}
add_action('wp_asciinema_asciicasts_folder', 'my_app_custom_asciicasts_folder');
```

This will now make the plugin look within `uploads/custom-folder-name` when looking for asciicasts. Note that this doesn't update the location of existing asciicasts, you might need to manually copy old asciicasts to the new directory if the location is changed.


# CakePHP + jQuery TODO list

A simple TODO application written in CakePHP 2.+ with jQuery to make it faster (AJAX) and Bootstrap to make it look decent. The app lets you prioritize (low, medium, high) and custom-sort your TODO.

If PHP is not your thing, there is [Rails version of the app](https://github.com/forkintheroad/rails-todo-list) too.

## Demo

You can find a working demo hosted on [PhpFog](http://todoly.phpfogapp.com/). You can use the following details to log in and try the app without registering:

* email: demo@demo.com
* password: demo123

*The hosted version is not a commercial service and as such is used for showcase purposes only*

## Usage

This is a really simple TODO application:

* You can set the priority by prepending `m` or `h` (to set `medium` and `high` priority). Alternatively, you can end the item with `.` or `!`. By default all items are set to `low` priority.
* Use your mouse to reorder items manually.
* Use the icons next to the "Add item" button to sort the list based on `priority`, `custom order` and `date of entry`.

### How it works

The app is basically 2 files:

* `/App/webroot/js/todoly.js` which contains the fancy jQuery stuff (AJAX calls and output using mustache.js)
* `/App/Model/Item.php` which sets the priority / order and removes the junk

## Contributing

Fork, fix and send a pull request. Or [open an issue](https://github.com/forkintheroad/cakephp-todo-list/issues/new) and I'll get on it. Or email me: berofx/gmail.

### Roadmap

Random list of things to improve

* Better server-side validation
* Use JsonView instead of json_encode
* Use asset compression to minify all CSS and JS
* Use a plugin for User features

## Changelog

* 10/27/2012 - Initial release

## License

MIT License. Dedicated to all the cat lovers across the Universe.
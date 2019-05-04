# PHP Pagination
 A lightweight PHP pagination class to output pagination links.

This class is written to be chain-able so to create a logically fluent and easily readable way to create a set of pagination links.

It simplifies the paging of results and outputs Bootstrap 4 compatible navigation HTML.

It has been fully tested to work with PHP 5.5+, including **PHP 7+**

# Installation via Composer
You can now install this class via composer.

	$ composer require benhall14/php-pagination
	
**Remember** to add the composer autoloader before using the class and use the correct namespace.

	require 'vendor/autoload.php';

	use benhall14\PHPPagination\Pagination as Pagination;

# Usage
Please make sure you have added the required classes.

In its simplest form, you can use the following to set up the paginator.

```php
$pagination = new Pagination();
$pagination->total(100)->output();
```

You can use the following chainable methods to customise the final pagination links.
```php
# sets the total number of items in the collection - e.g. 100
$pagination->total(number);

# sets the current page. By default, the class looks for the page value in the GET query string.
$pagination->page(number);

# sets the number of items to show per page. Default = 20
$pagination->perPage(number);

# sets the separator (if using). Default '...'
$pagination->separator(text);

# sets the screen reader class. Default 'true', but you may need to set it to false if you are using your own custom css.
$pagination->screenReader(bool);

# sets the Bootstrap 4 pagination link class to small
$pagination->small();

# sets the Bootstrap 4 pagination link class to medium
$pagination->medium();

# sets the Bootstrap 4 pagination link class to large
$pagination->large();

# sets the Bootstrap 4 alignment class to left
$pagination->alignLeft();

# sets the Bootstrap 4 alignment class to center
$pagination->alignCenter();

# sets the Bootstrap 4 alignment class to right
$pagination->alignRight();

# sets the flag to show the separator
$pagination->showSeparator();

# sets the flag to hide the separator
$pagination->hideSeparator();

# sets the next text string - Default: 'Next'
$pagination->nextText(text);

# sets the previous text string - Default: 'Previous'
$pagination->previousText(text);

# hides the 'Next' link
$pagination->hideNext();

# shows the 'Next' link
$pagination->showNext();

# hides the 'Previous' link
$pagination->hidePrevious();

# shows the 'Previous' link
$pagination->showPrevious();

# sets a prefix text for each page link: {prefix} {page number} {suffix}
$pagination->pagePrefix(text);

# sets a suffix text for each page link: {prefix} {page number} {suffix}
$pagination->pageSuffix(text);

# sets the flag to retain the query string for each page link.
$pagination->retainQueryString();

# sets the flag to ignore the query string when building the links
$pagination->dismissQueryString();

# sets the number of pages BEFORE the separator
$pagination->pagesBeforeSeparator(number);

# sets the number of pages AROUND the active page
$pagination->pagesAroundActive(number);

# sets the URL pattern - Default $pattern: ?page=(:num)- $replacement: (:num)
$pagination->pattern($pattern, $replacement);
# The class will replace the $replacement token in the $pattern with the actual page number
```

# Requirements

**Works with PHP 5.5, PHP 5.6, and PHP 7+**

# License
Copyright (c) 2016-2019 Benjamin Hall, ben@conobe.co.uk
https://conobe.co.uk

Licensed under the MIT license

# Donate?

If you find this project helpful or useful in any way, please consider getting me a cup of coffee - It's really appreciated :)

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://paypal.me/benhall14)

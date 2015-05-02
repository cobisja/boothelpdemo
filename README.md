# BootHelpDemo

Demo application about **[BootHelp]** using.

## About
This demo app is designed to show you how **[BootHelp]** classes can be used to easily generate HTML code
formatted according to [Bootstrap] specifications without to write down a lot of complicated HTML code.

Two simple games has been implemented:

* Guess the hidden word.
* Guess the hidden number.

Both games show how to define and use the following **[BootHelp]** components:

* [Alert box].
* [Navbar].
* [Modal].
* [Button].
* [Button group].
* [Dropdown] (within navbar).
* [Icon].
* [Progress bar].
* [Panel].
* [Panel row].
* [Content tag].
* [Link To].

The games are just an excuse to help you to get an idea about how you can use **[BootHelp]** classes in your
own projects.

Check the source code and you'll see the amount of HTML code used is the minimun. **No more boring HTML code!**

## Requirements

* Any flavour of PHP 5.4+
* [jQuery] 1.9
* [Bootstrap] 3.3.4

Remember that **[BootHelp]** just generates HTML code acording Bootstrap specifications v3.3.4.

## Getting started

### Setting up the environment
[Composer] is the PHP's package manager and is the recommended way to get packages for your projects. It's also able to build automatically ***autoloaders*** if you wrote down your code using PSR-0 and/or PSR-4 standards, avoiding you headaches about everything related to loading classes.

1. Install Composer:
	```
    curl -s https://getcomposer.org/installer | php
	```

2. Get inside **BootHelpDemo** root folder and execute:
	```
    php composer.phar init
    ```

3.  Copy the followings files into specified locations:

	```
    cp path/to/bootstrap.min.css html/css
    cp path/to/bootstrap/fonts/* html/fonts
    cp path/to/bootstrap.min.js html/js
    cp path/to/jquery.min.js html/js
    ```
  
4. Load in your browser root script **index.php** and enjoy!!!.

## Author
[Jorge Cobis]

By the way, I'm from Bolivarian Republic of Venezuela :-D

## Contributing
Feel free to contribute!!!. Welcome aboard!!!

## Misc
### Version history

**0.1.0** (Friday, 1st May 2015)

* Initial public release.


## License
Copyright (c) 2015 Jorge Cobis (<jcobis@gmail.com>)

MIT License

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

[boothelp]:https://github.com/cobisja/boothelp
[bootstrap]:http://getbootstrap.com/
[bootstrap requirements]:http://getbootstrap.com/getting-started/
[jQuery]:http://jquery.com
[Jorge Cobis]:mailto:jcobis@gmail.com
[alert box]:https://github.com/cobisja/boothelp/blob/master/src/AlertBox.php
[navbar]:https://github.com/cobisja/boothelp/blob/master/src/Navbar.php
[modal]:https://github.com/cobisja/boothelp/blob/master/src/Modal.php
[button]:https://github.com/cobisja/boothelp/blob/master/src/Button.php
[button group]:https://github.com/cobisja/boothelp/blob/master/src/ButtonGroup.php
[dropdown]:https://github.com/cobisja/boothelp/blob/master/src/Dropdown.php
[icon]:https://github.com/cobisja/boothelp/blob/master/src/Icon.php
[progress bar]:https://github.com/cobisja/boothelp/blob/master/src/ProgressBar.php
[panel]:https://github.com/cobisja/boothelp/blob/master/src/Panel.php
[panel row]:https://github.com/cobisja/boothelp/blob/master/src/PanelRow.php
[content tag]:https://github.com/cobisja/boothelp/blob/master/src/Helpers/ContentTag.php
[link to]:https://github.com/cobisja/boothelp/blob/master/src/Helpers/LinkTo.php

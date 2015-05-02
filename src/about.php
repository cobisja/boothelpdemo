<?php
/*
 * BootHelpDemo
 *
 * (The MIT License)
 *
 * Copyright (c) 2015 Jorge Cobis <jcobis@gmail.com / http://twitter.com/cobisja>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

require '../vendor/autoload.php';

use cobisja\BootHelp\BootHelp;


$about_text = <<<EOT
<p><strong>BootHelp</strong> is a set of classed designed to avoiding you to write a lot
of complicated and boring HTML code to get all the power of Bootstrap's components.</p>
EOT;

$about_link = BootHelp::content_tag('p', function(){
    return [
        'Get more info about <strong>BootHelp</strong>: ',
        BootHelp::icon('ok-circle'),
        BootHelp::link_to(
            'BootHelp at phpclases.org',
            ['href'=>'http://www.phpclasses.org/package/9115-PHP-Generate-HTML-pages-programatically-with-Bootstrap.html']
        ),
        BootHelp::icon('ok-circle'),
        BootHelp::link_to('BootHelp at github', ['href'=>'https://github.com/cobisja/boothelp'])
    ];
});

$modal_about = BootHelp::modal(
    ['title'=>'About BootHelp', 'id'=>'about-modal', 'button'=>['class'=>'navbar-btn', 'style'=>'display:none']],
    function() use ($about_text, $about_link) {
    return
        BootHelp::content_tag('div', [$about_text, $about_link], ['class'=>'modal-body']) .
        BootHelp::content_tag('div', ['class'=>'modal-footer'], function(){
            return [
                BootHelp::icon('thumbs-up'),
                '<strong>Easy than ever to coding using Bootstrap and PHP!</strong>'
            ];
        });
    }
);

echo BootHelp::content_tag('div', $modal_about, ['id'=>'about']);

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

use cobisja\BootHelp\BootHelp;

$intro_text = <<<EOT
    Welcome to this simple <strong>BootHelp</strong> Demo. This demo app is designed to show you how you can
    use <stong>BootHelp classes</stong> to easily generate HTML code formatted according
    to <strong>Bootstrap</strong> specifications without to write down a lot of complicated HTML code.
EOT;

echo BootHelp::content_tag('div', ['class'=>'demo-info row'], function() use ($intro_text) {
    return [
        BootHelp::content_tag('h1', 'Introduction'),
        BootHelp::content_tag('p', $intro_text),
        BootHelp::content_tag('p', 'Check the source code and you\'ll see the amount of HTML code used '
            . 'is the minimun. <strong>No more boring HTML code!</strong>'),
        BootHelp::content_tag('p', 'This demo include 2 simple games:'),
        BootHelp::panel_row(['column_class'=>'col-sm-6'], function(){
            return [
                BootHelp::panel(['title'=>'Guess the word', 'context'=>'primary'], function(){
                    return [BootHelp::icon('hand-right'), ' Guess the hidden word selected randomly.'];
                }),
                BootHelp::panel(['title'=>'Guess the number', 'context'=>'success'], function(){
                    return [BootHelp::icon('hand-right'), ' Guess a number picked randomly between 0 and 100.'];
                })
            ];
        })
    ];
});

echo BootHelp::content_tag('div', ['class'=>'demo-info row'], function(){
    return [
        BootHelp::content_tag('p', 'General information about how <strong>BootHelp</strong> components were used to built this demo:'),
        BootHelp::panel_row(['column_class'=>'col-sm-6'], function(){
            return[
                BootHelp::panel(['title'=>'BootHelp components list used', 'context'=>'warning'], function(){
                    return
                        '<ul>
                            <li>Alert box</li>
                            <li>Navbar</li>
                            <li>Modal</li>
                            <li>Button</li>
                            <li>Dropdown (within navbar)</li>
                            <li>Icon</li>
                            <li>Progress bar</li>
                            <li>Panel</li>
                            <li>Panel row</li>
                            <li>Content tag</li>
                            <li>Link to</li>
                        </ul>
                    ';
                }),
                BootHelp::panel(['title'=>'List of classes/scripts where you can find BootHelp components definitions', 'context'=>'danger'], function(){
                    return [
                        BootHelp::content_tag('p', 'All classes are under <strong>BootHelpDemo</strong> namespace'),
                        BootHelp::content_tag('p', 'Classes:'),
                        '<ul>
                            <li>Game (Button, Icon, Panel, Modal, Content Tag, Progress Bar and Alert Box).</li>
                            <li>GuessNumberGame (Content Tag, Progress bar).</li>
                            <li>GuessWordGame (Button, Button group).</li>
                        </ul>',
                        BootHelp::content_tag('p', 'Scripts:'),
                        '<ul>
                            <li>about.php (Modal, Content Tag, Icon, LinkTo).</li>
                            <li>demo_info.php (Panel, Panel row, Icon).</li>
                            <li>navbar.php (Navbar, Divider, Dropdown, LinkTo, Content Tag).</li>
                        </ul>',
                    ];
                })
            ];
        })
    ];
});

echo BootHelp::content_tag('div', ['class'=>'row'], function(){
    return BootHelp::content_tag('h3', 'Bootstrap + PHP = <strong>BootHelp</strong> :-D', ['class'=>'pull-right']);
});

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


$about_text = <<<EOT
<strong>BootHelp</strong> is a set of classes designed to avoiding you to write a lot
of complicated and boring HTML code to get all the power of Bootstrap.
EOT;

$sub_menu = Boothelp::dropdown('Games', ['into_navbar'=>true], function(){
    return [
        BootHelp::link_to('Guess the word', ['class'=>'game-item', 'href'=>'src/play_game.php?game_id=GuessWord']),
        BootHelp::divider(),
        BootHelp::link_to('Guess the number', ['class'=>'game-item', 'href'=>'src/play_game.php?game_id=GuessNumber'])
    ];
});

$main_navbar = BootHelp::navbar(['fluid'=>true], function() use ($sub_menu) {
    return [
        BootHelp::vertical(function(){
            return BootHelp::link_to('BootHelpDemo', ['href'=>'index.php']);
        }),
        BootHelp::horizontal(function() use ($sub_menu) {
            return [
                $sub_menu,
                BootHelp::nav(function(){ return BootHelp::link_to('About', ['id'=>'about-link', 'data-target'=>'#about', 'data-remote'=>true, 'href'=>'src/about.php']); })
            ];
        })
    ];
});

echo BootHelp::content_tag('div', $main_navbar, ['id'=>'main-nav', 'class'=>'row']);

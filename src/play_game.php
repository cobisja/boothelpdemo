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

use BootHelpDemo\Game;
use cobisja\BootHelp\BootHelp;


session_start();

$_SESSION = [];
$game_id = filter_input(INPUT_GET, 'game_id');

$_SESSION['selected_game'] = $game_klass = 'BootHelpDemo\\' . $game_id . 'Game';

!isset($_SESSION['started_game']) ? $_SESSION['started_game'] = true : null;
!isset($_SESSION['real_data']) ? $_SESSION['real_data'] = null : null;
!isset($_SESSION['hidden_data']) ? $_SESSION['hidden_data'] = null : null;
!isset($_SESSION['previous_data']) ? $_SESSION['previous_data'] = '' : null;
!isset($_SESSION['attempts']) ? $_SESSION['attempts'] = ['total'=>0, 'good'=>0] : null;

$game = new Game(new $game_klass($_SESSION['real_data'], $_SESSION['hidden_data']), $_SESSION['attempts'], $_SESSION['previous_data']);

$_SESSION['real_data'] = $game->get_real_data();
$_SESSION['hidden_data'] = $game->get_hidden_data();

echo BootHelp::content_tag('div', $game->show_description(), ['id'=>'game-description', 'class'=>'row']);
echo BootHelp::content_tag('div', $game->run(), ['id'=>'game', 'class'=>'row']);
echo BootHelp::content_tag('div', '', ['id'=>'game-progress', 'class'=>'row']);

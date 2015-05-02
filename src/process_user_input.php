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


session_start();

$data = filter_input(INPUT_GET, 'value');

$game_klass = $_SESSION['selected_game'];
$game = new Game(
    new $game_klass($_SESSION['real_data'], $_SESSION['hidden_data']),
    $_SESSION['attempts'], $_SESSION['previous_data']
);

$_SESSION['attempts']['good'] = $game->process_user_input($data);
$_SESSION['attempts']['total'] = $game->increase_attemps();
$_SESSION['previous_data'] = $game->get_previous_data_list();

$response['winner'] = false;
$response['progress'] = $game->show_progress();

if (!$game->is_there_a_winner()) {
    $_SESSION['hidden_data'] = $game->get_hidden_data();
    $response['game'] = $game->display();
    $response['prev_items_list'] = $_SESSION['previous_data'];
} else {
    $response['winner'] = true;
    $response['game'] = $game->show_winner_message();
    $_SESSION['started_game'] = [];

    session_destroy();
}

echo json_encode($response);

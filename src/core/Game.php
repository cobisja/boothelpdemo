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

namespace BootHelpDemo;

use cobisja\BootHelp\BootHelp;


class Game {
    private $attempts;
    private $game_instance;
    private $previous_data_list;


    public function __construct($game_instance, array $attempts, $previous_data) {
        $this->game_instance = $game_instance;
        $this->attempts = $attempts;
        $this->previous_data_list = $previous_data;
    }

    public function get_description() {
        return $this->game_instance->get_description();
    }

    public function get_real_data() {
        return $this->game_instance->get_real_data();
    }

    public function get_hidden_data() {
        return $this->game_instance->get_hidden_data();
    }

    public function get_progress() {
        return $this->game_instance->get_progress();
    }

    public function get_attempts() {
        return $this->attempts['total'];
    }

    public function get_previous_data_list() {
        return $this->previous_data_list;
    }

    public function display() {
        return $this->game_instance->display();
    }

    public function process_user_input($data) {
        $data = trim($data);

        if ($this->game_instance->process_user_input($data)) {
            $this->attempts['good']++;
        }

        $this->update_previous_data_list($data);
        return $this->attempts['good'];
    }

    public function is_there_a_winner() {
        return $this->game_instance->is_data_guessed();
    }

    public function run(){
        return (string) BootHelp::panel(['title'=>'Game running', 'context'=>'warning'], function(){
            return [
                BootHelp::content_tag('div', $this->display(), ['id'=>'game-action', 'class'=>'col-md-5']),
                $this->show_data_form(),
                BootHelp::content_tag('div', ['class'=>'desc-actions'], function(){
                    return [
                        $this->show_hide_description_button(),
                        $this->show_previous_entries_button()
                    ];
                })
            ];
        });
    }

    public function show_progress() {
        $stats = $this->get_statistics();

        $progress_bar = BootHelp::progress_bar(['percentage'=>  $this->get_progress(), 'label'=>true, 'context'=>'success']);
        $stats_bar = BootHelp::progress_bar([
            ['percentage'=>$stats['good_pct'], 'context'=>'success', 'animated'=>true, 'label'=>true],
            ['percentage'=>$stats['not_good_pct'], 'context'=>'danger', 'label'=>true]
        ]);

        $progress_panel = BootHelp::content_tag('div', function() use ($stats, $progress_bar, $stats_bar) {
            return
                BootHelp::panel(['title'=>'Game statistics'], function() use ($stats, $progress_bar, $stats_bar) {
                    $attempts_types_string = sprintf(
                        "Total attempts: %d (Good: %d / Not good: %d)",
                        $stats['total'], $stats['good'], $stats['not_good']
                    );
                    return [
                        BootHelp::content_tag('p', 'Progress', ['class'=>'comment']),
                        $progress_bar,
                        BootHelp::content_tag('p', $attempts_types_string, ['class'=>'comment']),
                        $stats_bar
                    ];
                });
        });

        return $progress_panel->to_string();
    }

    public function show_winner_message() {
        return (string) (BootHelp::alert_box(['dismissible'=>true, 'context'=>'success'], function(){
            $winner_message = 'We have a winner. What you were looking for was <strong>' . $this->get_hidden_data() . '</strong>. Congratulations!!!';
            return [BootHelp::icon('ok-sign'), $winner_message];
        }));
    }

    public function show_description() {
        return BootHelp::panel(['title'=>'Game description', 'context'=>'primary'], function(){
            return [
                $this->get_description(),
                BootHelp::content_tag('p', 'You can check your previous choices by clicking the <strong>Previous entries</strong> button'),
                BootHelp::content_tag('h3', 'Enjoy the game ;-)', ['class'=>'pull-right'])
            ];
        });
    }

    public function increase_attemps() {
        return ++$this->attempts['total'];
    }

    private function update_previous_data_list($data) {
        $this->previous_data_list = join(', ', array_filter(array_unique(array_merge(explode(', ', $this->previous_data_list), [strtoupper($data)])), 'strlen'));
    }

    private function show_data_form() {
        $form = BootHelp::content_tag('form', ['method'=>'get', 'class'=>'form-inline', 'action'=>'src/process_user_input.php'], function(){
            return [
                BootHelp::content_tag('div', ['class'=>'form-group'], function(){
                    return BootHelp::content_tag(
                        'input',
                        '',
                        ['placeholder'=>'Type something...', 'type'=>'text', 'name'=>'ud', 'class'=>'form-control', 'id'=>'user-entry']);
                }),
                BootHelp::button('Check input', ['type'=>'submit', 'context'=>'primary']),
            ];
        });

        return BootHelp::content_tag('div', $form, ['class'=>'col-md-4 text-center']);
    }

    private function show_previous_entries_button() {
        return BootHelp::content_tag('div', ['class'=>'col-md-2'], function(){
            return BootHelp::modal(
                $this->previous_data_list,
                ['title'=>'Previous data list', 'id'=>'modal-prev-entries', 'button'=>['id'=>'prev-items', 'class'=>'disabled', 'caption'=>'Prev entries']]
            );
        });
    }

    private function show_hide_description_button() {
        return BootHelp::button('Hide desc', ['class'=>'toggle-desc col-md-1' ]);
    }

    private function get_statistics() {
        $attempts = $this->get_attempts();
        $good_attempts = $this->attempts['good'];
        $not_good_attempts = $attempts - $good_attempts;

        $good_percentage = (int)(100*($good_attempts/$attempts));
        $not_good_percentage = 100 - $good_percentage;

        $stats = [
            'good'=>$good_attempts,
            'not_good'=>$not_good_attempts,
            'total'=>$attempts,
            'good_pct'=>$good_percentage,
            'not_good_pct'=>$not_good_percentage
        ];

        return $stats;
    }
}

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

use BootHelpDemo\GameInterface;
use cobisja\BootHelp\BootHelp;

class GuessNumberGame implements GameInterface {
    const MIN_NUMBER = 0;
    const MAX_NUMBER = 100;

    const COLD_GAP = 40;
    const WARM_GAP = 20;
    const HOT_GAP = 5;

    const COLD_CLASS = 'info';
    const WARM_CLASS = 'warning';
    const HOT_CLASS = 'danger';

    private $range;
    private $range_class;
    private $selected_number;
    private $user_number;


    public function __construct($number=null, $hidden_number=null) {
        $this->set_selected_number($number);
        $this->range_class = self::COLD_CLASS;
        $this->range = array_fill_keys(
            ['cold_lower', 'cold_upper', 'warm_lower', 'warm_upper', 'hot_lower', 'hot_upper'], 0
        );
        $this->get_accuracy_range();
    }

    public function get_description() {
        $descriptions = [
            'Guess the hidden number by typing numbers until you discoverd the hidden one. '
            . 'You will get some clues about how near or far you are from the number you have to discover: ',
            '<strong>Cold zone gauge</strong>: Indicates your number selection is far from the hidden number '
            . 'generated. It is a light blue bar.',
            '<strong>Warm zone gauge</strong>: Indicates your number selection is getting closer from the hidden '
            . 'number generated. It is a yellow bar.',
            '<strong>Hot zone gauge</strong>: Indicates your number selection is very close from the hidden number '
            . 'generated. It is a red bar.',
            'Attempts within <strong>WARM or HOT zones</strong> are considered <strong>GOOD</strong> ones. '
            . 'Those within <strong>COLD zone</strong> are considered <strong>BAD</strong> ones (Not good).'
        ];

        return join(
            array_map(function($description){
                return BootHelp::content_tag('p', [BootHelp::icon('star-empty'), $description]);
            }, $descriptions)
        );
    }

    public function get_hidden_data() {
        return $this->selected_number;
    }

    public function get_progress() {
        return 100;
    }

    public function get_real_data() {
        return $this->selected_number;
    }

    public function set_selected_number($number=null) {
        $this->selected_number = is_null($number) ? $this->pick_a_number() : $number;
    }

    public function process_user_input($data) {
        $this->user_number = $data = (int)$data;
        $range = $this->range;

        if ($data >= $range['hot_lower'] && $data <= $range['hot_upper']) {
            $range_class = self::HOT_CLASS;
        } elseif (($data >= $range['warm_lower'] && $data < $range['hot_lower']) ||
                  ($data > $range['hot_upper'] && $data <= $range['warm_upper'])) {
            $range_class = self::WARM_CLASS;
        } else {
            $range_class = self::COLD_CLASS;
        }

        $this->set_range_class($range_class);

        return self::HOT_CLASS === $range_class || self::WARM_CLASS === $range_class;
    }

    public function is_data_guessed() {
        return $this->selected_number === $this->user_number;
    }

    public function display() {
        $temperature_gauge = BootHelp::progress_bar(
            ['label'=>$this->get_accuracy_message(), 'percentage'=>100, 'context'=>$this->range_class],
            ['class'=>'accuracy-gauge']
        );

        return $temperature_gauge->to_string();
    }

    private function set_range_class($class) {
        $this->range_class = $class;
    }

    private function pick_a_number() {
         return mt_rand(self::MIN_NUMBER, self::MAX_NUMBER);
    }

    public function get_accuracy_range() {
        $range = $this->range;

        $this->normalize_range($range['cold_lower'], $range['cold_upper'], self::COLD_GAP);
        $this->normalize_range($range['warm_lower'], $range['warm_upper'], self::WARM_GAP);
        $this->normalize_range($range['hot_lower'], $range['hot_upper'], self::HOT_GAP);

        $this->range = $range;
    }

    private function get_accuracy_message() {
        if (self::COLD_CLASS === $this->range_class) {
            $message = "Cold --- Brrrrr, So far away!!!!! --- Push harder";
        } elseif (self::WARM_CLASS == $this->range_class) {
            $message = "Warming up --- You're doing good. Go for it!!!";
        } else {
            $message = "Hot, Hot, Hot --- You're really hot!!!. Getting closer. You're almost there";
        }

        return $message;
    }

    private function normalize_range(&$lower_limit, &$upper_limit, $gap) {
        $lower_limit = $this->selected_number - $gap;
        $upper_limit = $this->selected_number + $gap;

        self::MIN_NUMBER > $lower_limit ? $lower_limit = self::MIN_NUMBER : null;
        self::MAX_NUMBER < $upper_limit ? $upper_limit = self::MAX_NUMBER : null;
    }
}

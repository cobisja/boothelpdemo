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

$(function(){
    $("#about-link").click(function(event){
        event.preventDefault();
        var url = $(this).attr("href").replace(/.+?\?(.*)$/, "$1");

        $.ajax({
            type: "get",
            url: url,
            success: function(response) {
                $("#about").length > 0 ? null : $("#main").append(response);
            }
        }).done(function(){
            $("button[data-target='#about-modal']").click();
        });
    });
    $("a.game-item").click(function(event){
        event.preventDefault();
        $("#main-nav").siblings().remove();
        
        var url = $(this).attr("href");

        $.ajax({
            type: "get",
            url: url,
            success: function(response) {
                $("#demo-info").remove();
                $("#main").append(response);
            }
        }).done(function(){
            $("#user-entry").focus();
        });        
    });    
    $(document).on('click', '#game form button[type=submit]', function(e) {        
        var letter = { 'value': $('input[name=ud]').val().trim() };
        var url = $("#game form").attr("action").replace(/.+?\?(.*)$/, "$1");
        
        e.preventDefault();
        
        if (0 !== letter.value.length) {
            $.ajax({
                url: url,
                data: letter,
                type: "get",
                datatype: "json",
                encode: true
            }).done(function(response){
                    response = JSON.parse(response); 
                    if (!response.winner) {
                        $("#game-action").html(response.game);
                        $("#user-entry").val("").focus();
                        $("#prev-items").removeClass("disabled");
                        $("#modal-prev-entries div.modal-body").text(response.prev_items_list);
                    } else {
                        $("#game").html(response.game);
                    }
                    $("#game-progress").html(response.progress);
                });
        }
    });
    $(document).on('click', "button.toggle-desc", function(){
        $("#game-description").slideToggle();
        $("button.toggle-desc").text(function(){
            return "Hide desc" === $(this).text() ? "Show desc" : "Hide desc";;
        });
    });
});

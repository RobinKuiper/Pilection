/**
 * Created by robin on 25-4-14.
 */

$(function () {
    /*
     * Ratings
     */
    $('#rating').raty({
        half: true,
        path: '/js/raty',
        readOnly: function(){
            return $(this).attr('data-voted');
        },
        score: function(){
            return $(this).attr('data-score');
        },
        click: function(score, e) {
            var id = $(this).attr('id'), type = $(this).attr('data-type');
            $.get( '/ajax/getRating', { id: id, score: score, type: type }, function( data ) {
                $('#rating_callback').html('Thanks, your vote is saved!').fadeIn(1000);
            });
        }
    });

    /*
     * Share Button
     */
    new Share('.share', {
        title: $('.share').attr('data-title'),
        text: $('.share').attr('data-text'),
        image: 'http://pilection.eu/' + $(this).attr('data-image'),
        ui: {
            flyout: 'bottom center'
        }
    });

});


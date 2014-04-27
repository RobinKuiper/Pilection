/*
 * Created by robin on 25-4-14.
 */

/*
 * Tagcloud
 */
$.fn.tagcloud.defaults = {
    size: {start: 12, end: 17, unit: 'px'},
    color: {start: '#428bca', end: '#222222'}
};

$(function () {
    $('#tags a').tagcloud();

    /*
     * SlideUp/Down item info
     */
    $('#MixIt .item').on('click', function(e){
        if(e.target.localName == 'div'){
            var __this = $(this).next('.item-body');
            $('.item-body').not(__this).slideUp();
            $(this).next('.item-body').slideToggle();
        }
    });

    /*
     * MixItUp Filters
     */
    $('#MixIt .item').addClass('mix');
    $('#items').removeClass('col-md-12');
    $('#items').addClass('col-md-10');

    $('#filters').show();
    $('#changeLayout').show();

    $('#MixIt').mixItUp({
        animation: {
            enable: true,
        },
        controls: {
            toggleFilterButtons: true,
            toggleLogic: 'and'
        },
        load: {
            filter: filter
        }
    });

    $('.filter').click(function(){
        return false;
    });

    /*
     * Ratings
     */
    $('.rating').raty({
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
                $('#' + id).fadeOut(500, function(){
                    $(this).html('Thanks!').fadeIn(1000);
                });
            });
        }
    });

});
/*
 * Created by robin on 25-4-14.
 */

/*
 * Analytics
 */
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-47889610-7', 'pilection.eu');
ga('require', 'displayfeatures');
ga('send', 'pageview');

$(function(){

    /*
     * Nice Remember me checkbox
     */
    $( "#search" ).autocomplete({
        source: '/ajax/getTags',
        minLength: 2,
        select: function( event, ui ){
            window.location.replace("/" + ui.item.type + "/" + ui.item.slug);
            //console.log("/" + ui.item.type + "/" + ui.item.value);
        }
    });

});
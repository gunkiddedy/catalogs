///////////////// fixed menu on scroll for desktop
// if ($(window).width() > 992) {
//     $(window).scroll(function(){  
//         if ($(this).scrollTop() > 50) {
//             $('.navbar').addClass("fixed-top");
//             // add padding top to show content behind navbar
//             $('body').css('padding-top', $('.navbar').outerHeight() + 'px');
//         }else{
//             $('.navbar').removeClass("fixed-top");
//             // remove padding top from body
//             $('body').css('padding-top', '0');
//         }   
//     });
// }

// hide show navbar when scroll up
// var lastScrollTop = 0;
// $(window).scroll(function(){
//     var st = $(this).scrollTop();
//     var banner = $('.banner');
//     setTimeout(function(){
//         if (st > lastScrollTop){
//             banner.addClass('hide');
//         } else {
//             banner.removeClass('hide');
//         }
//         lastScrollTop = st;
//     }, 100);
// });

$(document).ready(function(){


    filter_data('');

    function filter_data(query=''){
        var search=JSON.stringify(query);
        // var price =JSON.stringify($('#pricerange').val());
        var category = JSON.stringify(get_filter('category')); 
        var subcategory = JSON.stringify(get_filter('subcategory'));
        $.ajax({
            url:'product/filter',
            method:'GET',
            data:{
                query:search,
                category:category,
                subcategory:subcategory,
            },
            dataType:'json',
            success:function(data)
            {
                $('#productsfilter').html(data.view_data);
            }
        })
    }

    function get_filter(class_name)
    {
        var filter=[];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        // alert(filter);
        return filter;
    }

    $(document).on('keyup','#search',function(){
        var query = $(this).val();
        filter_data(query);
    });

    $('.selector').click(function(){
        var query = $('#search').val();
        filter_data(query);
    });

    // $(document).on('input','#pricerange',function(){
    //     var range = $(this).val();
    //     $('#currentrange').html(range);
    // });

    // $(document).on('change','#size-dropdown',function(){
    //     var size = $(this).val();
    //     document.cookie="shoes_size="+size+";"+"path=/";
    //     $('#add-to-cart').removeClass('disabled');
    // });

});

$(document).ready(function(){

    $(document).on('click', '.load_more', function(){

        var targetContainer = $('.navigation_ajax_container'),  //  Контейнер, в котором хранятся элементы
            url =  $('.load_more').attr('data-url');    //  URL, из которого будем брать элементы

        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function(data){

                    //  Удаляем старую навигацию
                    $('.pagination_with_ajax').remove();

                    var elements = $(data).find('.ajax_element'),  //  Ищем элементы
                        pagination = $(data).find('.pagination_with_ajax'); //  Ищем навигацию

                    targetContainer.append(elements);   //  Добавляем посты в конец контейнера
					targetContainer.parent().append(pagination); //  добавляем навигацию следом
					

                }
            })
        }

    });

});
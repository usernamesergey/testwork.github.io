(function($){
    $('.slider-block__item').on('click', '.slider-block__header__text', (evt) => {
        $('.slider-block__item').removeClass('active');
        let parent = $(evt.currentTarget).parents('.slider-block__item');
        $('.slider-block__item').each(function(){
            if(this !== $(evt.currentTarget).parents('.slider-block__item')[0]){
                $(this).find('.slider-block__animate').slideUp();
            }
            else{
                $(this).find('.slider-block__animate').slideDown(() => {
                    $(this).addClass('active');
                });
            }
        });
    });

    $('.slider-block__text__form__reset').on('click', (evt) => {
        $(evt.currentTarget).parent().find('[type=text]').prop('value', '');
    });
})(jQuery);
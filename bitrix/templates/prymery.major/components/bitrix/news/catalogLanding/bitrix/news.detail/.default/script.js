$(document).ready(function () {
    var share = Ya.share2('socialShare', {
        theme: {
            services: 'vkontakte,facebook,odnoklassniki,twitter,whatsapp,viber',
            lang: 'uk',
            limit: 6,
            size: 'm',
            bare: false
        },
        content: {
            url: linkNews,
            title: nameNews
        }
    });
})
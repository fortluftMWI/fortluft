document.addEventListener('DOMContentLoaded', function () {
    let lazyItems = [].slice.call(document.querySelectorAll("img[data-src]"));
    let active = false;

    const lazyLoad = function() {
        if (active === false) {
            active = true;

            setTimeout(function() {
                lazyItems.forEach(function(lazyItem) {
                    if ((lazyItem.getBoundingClientRect().top <= window.innerHeight && lazyItem.getBoundingClientRect().bottom >= 0) && getComputedStyle(lazyItem).display !== "none") {
                        lazyItem.src = lazyItem.dataset.src;
                        lazyItems = lazyItems.filter(function(image) {
                            return image !== lazyItem;
                        });

                        if (lazyItems.length === 0) {
                            document.removeEventListener("scroll", lazyLoad);
                            window.removeEventListener("resize", lazyLoad);
                            window.removeEventListener("orientationchange", lazyLoad);
                        }
                    }
                });

                active = false;
            }, 200);
        }
    };

    document.addEventListener("scroll", lazyLoad);
    window.addEventListener("resize", lazyLoad);
    window.addEventListener("orientationchange", lazyLoad);
})
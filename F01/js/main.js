{
    class Details {
        constructor() {
            this.dom = {};

            const detailsTmpl = `
            <div class="details__bg details__bg--down">
                <button class="details__close"><i class="fas fa-2x fa-times icon--cross tm-fa-close"></i></button>
                <div class="details__description"></div>
            </div>						
            `;

            this.dom.details = document.createElement('div');
            this.dom.details.className = 'details';
            this.dom.details.innerHTML = detailsTmpl;
            document.getElementById('tm-wrap').appendChild(this.dom.details);
            this.init();
        }
        init() {
            this.dom.bgDown = this.dom.details.querySelector('.details__bg--down');
            this.dom.description = this.dom.details.querySelector('.details__description');
            this.dom.close = this.dom.details.querySelector('.details__close');

            this.initEvents();
        }
        initEvents() {
            document.body.addEventListener('click', () => this.close());
            this.dom.bgDown.addEventListener('click', function (event) {
                event.stopPropagation();
            });
            this.dom.close.addEventListener('click', () => this.close());
        }
        fill(info) {
            this.dom.description.innerHTML = info.description;
        }
        getProductDetailsRect() {
            let productBgRect = 0;
            let detailsBgRect = 0;

            try {
                productBgRect = this.dom.productBg.getBoundingClientRect();
                detailsBgRect = this.dom.bgDown.getBoundingClientRect();
            } catch (e) { }

            return {
                productBgRect,
                detailsBgRect
            };
        }
        open(data) {
            if (this.isAnimating) return false;
            this.isAnimating = true;

            this.dom.details.style.display = 'block';

            this.dom.details.classList.add('details--open');

            this.dom.productBg = data.productBg;

            this.dom.productBg.style.opacity = 0;

            const rect = this.getProductDetailsRect();

            this.dom.bgDown.style.transform = `translateX(${rect.productBgRect.left - rect.detailsBgRect.left}px) translateY(${rect.productBgRect.top - rect.detailsBgRect.top}px) scaleX(${rect.productBgRect.width / rect.detailsBgRect.width}) scaleY(${rect.productBgRect.height / rect.detailsBgRect.height})`;
            this.dom.bgDown.style.opacity = 1;

            anime({
                targets: [this.dom.bgDown],
                duration: (target, index) => index ? 800 : 250,
                easing: (target, index) => index ? 'easeOutElastic' : 'easeOutSine',
                elasticity: 250,
                translateX: 0,
                translateY: 0,
                scaleX: 1,
                scaleY: 1,
                complete: () => this.isAnimating = false
            });

            anime({
                targets: [this.dom.description],
                duration: 1000,
                easing: 'easeOutExpo',
                translateY: ['100%', 0],
                opacity: 1
            });

            anime({
                targets: this.dom.close,
                duration: 250,
                easing: 'easeOutSine',
                translateY: ['100%', 0],
                opacity: 1
            });

            this.setCarousel();

            window.addEventListener("resize", this.setCarousel);
        }
        close() {
            if (this.isAnimating) return false;
            this.isAnimating = true;

            this.dom.details.classList.remove('details--open');

            anime({
                targets: this.dom.close,
                duration: 250,
                easing: 'easeOutSine',
                translateY: '100%',
                opacity: 0
            });

            anime({
                targets: [this.dom.description],
                duration: 20,
                easing: 'linear',
                opacity: 0
            });

            const rect = this.getProductDetailsRect();
            anime({
                targets: [this.dom.bgDown],
                duration: 250,
                easing: 'easeOutSine',
                translateX: (target, index) => {
                    return index ? rect.productImgRect.left - rect.detailsImgRect.left : rect.productBgRect.left - rect.detailsBgRect.left;
                },
                translateY: (target, index) => {
                    return index ? rect.productImgRect.top - rect.detailsImgRect.top : rect.productBgRect.top - rect.detailsBgRect.top;
                },
                scaleX: (target, index) => {
                    return index ? rect.productImgRect.width / rect.detailsImgRect.width : rect.productBgRect.width / rect.detailsBgRect.width;
                },
                scaleY: (target, index) => {
                    return index ? rect.productImgRect.height / rect.detailsImgRect.height : rect.productBgRect.height / rect.detailsBgRect.height;
                },
                complete: () => {
                    this.dom.bgDown.style.opacity = 0;
                    this.dom.bgDown.style.transform = 'none';
                    this.dom.productBg.style.opacity = 1;
                    this.dom.details.style.display = 'none';
                    this.isAnimating = false;
                }
            });
        }
        setCarousel() {
            const slider = $('.details .tm-img-slider');

            if (slider.length) { // check if slider exist

                if (slider.hasClass('slick-initialized')) {
                    slider.slick('destroy');
                }

                if ($(window).width() > 767) {
                    slider.slick({
                        dots: true,
                        infinite: true,
                        slidesToShow: 4,
                        slidesToScroll: 3
                    });
                } else {
                    slider.slick({
                        dots: true,
                        infinite: true,
                        slidesToShow: 2,
                        slidesToScroll: 1
                    });
                }
            }
        }
    }

    class Item {
        constructor(el) {
            this.dom = {};
            this.dom.el = el;
            this.dom.product = this.dom.el.querySelector('.product');
            this.dom.productBg = this.dom.product.querySelector('.product__bg');

            this.info = {
                description: this.dom.product.querySelector('.product__description').innerHTML
            };

            this.initEvents();
        }
        initEvents() {
            this.dom.product.addEventListener('click', () => this.open());
        }
        open() {
            dom.details.fill(this.info);
            dom.details.open({
                productBg: this.dom.productBg
            });
        }
    }

    const dom = {};
    dom.grid = document.querySelector('.grid');
    dom.content = dom.grid.parentNode;
    dom.gridItems = Array.from(dom.grid.querySelectorAll('.grid__item'));
    const items = [];
    dom.gridItems.forEach(item => items.push(new Item(item)));

    dom.details = new Details();
}

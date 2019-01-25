import $ from 'jquery';

class FaveSlider {
    constructor() {
        $('.vertical-center').slick({
            centerMode: true,
            variableWidth: true,
            slidesToShow: 3,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        slidesToShow: 1
                    }
                }
            ]
        });
    }
}

export default FaveSlider;


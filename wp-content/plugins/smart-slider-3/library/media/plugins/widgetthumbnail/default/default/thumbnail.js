N2Require('SmartSliderWidgetThumbnailDefault', [], [], function ($, scope, undefined) {
    "use strict";

    function SmartSliderWidgetThumbnailDefault(id, parameters) {

        this.slider = window[id];

        this.slider.started($.proxy(this.start, this, id, parameters));
    };


    SmartSliderWidgetThumbnailDefault.prototype.start = function (id, parameters) {

        if (this.slider.sliderElement.data('thumbnail')) {
            return false;
        }
        this.slider.sliderElement.data('thumbnail', this);

        this.parameters = $.extend({captionSize: 0, minimumThumbnailCount: 1.5, invertGroupDirection: 0}, parameters);

        this.ratio = 1;
        this.hidden = false;
        this.forceHidden = false;
        this.forceHiddenCB = null;
        this.group = 2;
        this.itemPerPane = 1;
        this.currentI = 0;
        this.offset = 0;
        this.horizontal = {
            prop: 'width',
            Prop: 'Width',
            sideProp: nextend.rtl.left,
            invProp: 'height'
        };
        this.vertical = {
            prop: 'height',
            Prop: 'Height',
            sideProp: 'top',
            invProp: 'width'
        };

        this.group = parseInt(parameters.group);
        this.orientation = parameters.orientation;
        if (this.orientation == 'vertical') {
            this.goToDot = this._goToDot;
        }

        this.outerBar = this.slider.sliderElement.find('.nextend-thumbnail-default');
        this.bar = this.outerBar.find('.nextend-thumbnail-inner');
        this.scroller = this.bar.find('.nextend-thumbnail-scroller');

        var event = 'universalclick';
        if (parameters.action == 'mouseenter') {
            event = 'mouseenter';
        }
        this.dots = this.scroller.find('> div').on(event, $.proxy(this.onDotClick, this));
        this.images = this.dots.find('.n2-ss-thumb-image');

        if (!nextend.rtl.isRtl) {
            this.previous = this.outerBar.find('.nextend-thumbnail-previous').on('click', $.proxy(this.previousPane, this));
            this.next = this.outerBar.find('.nextend-thumbnail-next').on('click', $.proxy(this.nextPane, this));
        } else {
            this.previous = this.outerBar.find('.nextend-thumbnail-next').on('click', $.proxy(this.previousPane, this));
            this.next = this.outerBar.find('.nextend-thumbnail-previous').on('click', $.proxy(this.nextPane, this));
        }

        if (this.slider.isShuffled) {
            for (var i = 0; i < this.slider.realSlides.length; i++) {
                var slide = this.slider.realSlides[i];
                this.dots.eq(slide.originalIndex).appendTo(this.scroller);
            }
            this.dots = this.scroller.find('> div');
        }

        this.thumbnailDimension = {
            width: this.dots.outerWidth(true),
            height: this.dots.outerHeight(true)
        };

        this.thumbnailDimension.widthMargin = this.thumbnailDimension.width - this.dots.outerWidth();
        this.thumbnailDimension.heightMargin = this.thumbnailDimension.height - this.dots.outerHeight();

        this.imageDimension = {
            width: this.images.outerWidth(true),
            height: this.images.outerHeight(true)
        };

        this.sideDimension = this.thumbnailDimension[this[this.orientation].prop] * 0.25;

        if (this.orientation == 'horizontal') {
            this.scroller.height(this.thumbnailDimension.height * this.group);
            this.bar.height(this.scroller.outerHeight(true));
        } else {
            this.scroller.width(this.thumbnailDimension.width * this.group);
            this.bar.width(this.scroller.outerWidth(true));
        }

        this.slider.sliderElement.on({
            BeforeVisible: $.proxy(this.onReady, this),
            sliderSwitchTo: $.proxy(this.onSlideSwitch, this)
        });
        this.slider.firstSlideReady.done($.proxy(this.onFirstSlideSet, this));

        if (parameters.overlay == 0) {
            var side = false;
            switch (parameters.area) {
                case 1:
                    side = 'Top';
                    break;
                case 12:
                    side = 'Bottom';
                    break;
                case 5:
                    side = 'Left';
                    break;
                case 8:
                    side = 'Right';
                    break;
            }
            if (side) {
                this.offset = parseFloat(this.outerBar.data('offset'));
                this.slider.responsive.addStaticMargin(side, this);
            }
        }
    };

    SmartSliderWidgetThumbnailDefault.prototype.onFirstSlideSet = function (slide) {

        this.activateDots(slide.index);
        this.goToDot(slide.index);
    };

    SmartSliderWidgetThumbnailDefault.prototype.onReady = function () {
        this.slider.sliderElement.on('SliderResize', $.proxy(this.onSliderResize, this));
        this.onSliderResize();
    };


    SmartSliderWidgetThumbnailDefault.prototype.onSliderResize = function () {
        if (this.forceHiddenCB !== null) {
            this.forceHiddenCB.call(this);
        }
        this.adjustScrollerSize();

        var currentSlideIndex = this.slider.currentSlide.index;

        this.activateDots(currentSlideIndex);

        this.goToDot(currentSlideIndex);
    };

    SmartSliderWidgetThumbnailDefault.prototype.adjustScrollerSize = function () {
        var prop = this[this.orientation].prop,
            size = Math.ceil(this.dots.length / this.group) * this.thumbnailDimension[prop] * this.ratio,
            diff = this.scroller['outer' + this[this.orientation].Prop]() - this.scroller[prop](),
            barDimension = this.slider.dimensions['thumbnail' + prop];
        if (size + diff <= barDimension) {
            this.scroller[prop](barDimension - diff);
        } else {
            this.scroller[prop](size);
        }


        if (this.orientation == 'horizontal') {
            this.scroller.height(this.dots.outerHeight(true) * this.group);
        } else {
            this.scroller.width(this.dots.outerWidth(true) * this.group);
        }

    };

    SmartSliderWidgetThumbnailDefault.prototype.onDotClick = function (e) {
        this.slider.directionalChangeToReal(this.dots.index(e.currentTarget));
    };

    SmartSliderWidgetThumbnailDefault.prototype.onSlideSwitch = function (e, targetSlideIndex, realTargetSlideIndex) {

        this.activateDots(targetSlideIndex);

        this.goToDot(realTargetSlideIndex);

    };

    SmartSliderWidgetThumbnailDefault.prototype.activateDots = function (currentSlideIndex) {
        this.dots.filter('.n2-active').removeClass('n2-active');

        var slides = this.slider.slides[currentSlideIndex].slides;
        for (var i = 0; i < slides.length; i++) {
            this.dots.eq(slides[i].index).addClass('n2-active');
        }
    };

    SmartSliderWidgetThumbnailDefault.prototype.previousPane = function () {
        this.goToDot(this.currentI - this.itemPerPane * this.group);
    };

    SmartSliderWidgetThumbnailDefault.prototype.nextPane = function () {
        this.goToDot(this.currentI + this.itemPerPane * this.group);
    };

    SmartSliderWidgetThumbnailDefault.prototype.goToDot = function (i) {

        var variables = this[this.orientation],
            ratio = 1,
            barDimension = this.slider.dimensions['thumbnail' + variables.prop],
            sideDimension = this.sideDimension,
            availableBarDimension = barDimension - sideDimension * 2,
            itemPerPane = availableBarDimension / this.thumbnailDimension[variables.prop];
        if (itemPerPane <= this.parameters.minimumThumbnailCount) {
            sideDimension = barDimension * 0.1;
            availableBarDimension = barDimension - sideDimension * 2;
            ratio = availableBarDimension / (this.parameters.minimumThumbnailCount * this.thumbnailDimension[variables.prop]);
            itemPerPane = availableBarDimension / (this.thumbnailDimension[variables.prop] * ratio);
        }

        if (this.ratio != ratio) {
            var css = {};
            css[variables.prop] = parseInt(this.thumbnailDimension[variables.prop] * ratio - this.thumbnailDimension[variables.prop + 'Margin']);
            var scrollerDimension = css[variables.invProp] = parseInt((this.thumbnailDimension[variables.invProp] - this.parameters['captionSize'] - this.thumbnailDimension[variables.prop + 'Margin']) * ratio + this.parameters['captionSize']);
            this.dots.css(css);
            css = {};
            css[variables.prop] = parseInt(this.imageDimension[variables.prop] * ratio);
            css[variables.invProp] = parseInt(this.imageDimension[variables.invProp] * ratio);
            this.images.css(css);

            this.bar.css(variables.invProp, 'auto');
            this.ratio = ratio;
            this.slider.responsive.doNormalizedResize();
            this.adjustScrollerSize();
        }

        itemPerPane = Math.floor(itemPerPane);
        i = Math.max(0, Math.min(this.dots.length - 1, i));
        var currentPane,
            to = {};

        if (this.parameters.invertGroupDirection) {
            currentPane = Math.floor((i % Math.ceil(this.dots.length / this.group)) / itemPerPane);
        } else {
            currentPane = Math.floor(i / this.group / itemPerPane);
        }


        var min = -(this.scroller['outer' + variables.Prop]() - barDimension);

        if (currentPane == Math.floor((this.dots.length - 1) / this.group / itemPerPane)) {
            to[variables.sideProp] = -(currentPane * itemPerPane * this.thumbnailDimension[variables.prop] * ratio);
            if (currentPane == 0) {
                this.previous.removeClass('n2-active');
            } else {
                this.previous.addClass('n2-active');
            }
            this.next.removeClass('n2-active');
        } else if (currentPane > 0) {
            to[variables.sideProp] = -(currentPane * itemPerPane * this.thumbnailDimension[variables.prop] * ratio - sideDimension);
            this.previous.addClass('n2-active');
            this.next.addClass('n2-active');
        } else {
            to[variables.sideProp] = 0;
            this.previous.removeClass('n2-active');
            this.next.addClass('n2-active');
        }
        if (min >= to[variables.sideProp]) {
            to[variables.sideProp] = min;
            this.next.removeClass('n2-active');
        }
        NextendTween.to(this.scroller, 0.5, to).play();


        this.currentI = i;
        this.itemPerPane = itemPerPane;

    };

    SmartSliderWidgetThumbnailDefault.prototype._goToDot = function (i) {
        if (this.forceHidden) {
            return;
        }
        var variables = this[this.orientation];
        var barDimension = this.slider.dimensions['thumbnail' + variables.prop];


        var itemPerPane = (barDimension - this.sideDimension * 2) / this.thumbnailDimension[variables.prop];
        if (barDimension != 0 && itemPerPane < this.parameters.minimumThumbnailCount - 0.5) {
            if (!this.hidden) {
                if (this.orientation == 'horizontal') {
                    this.outerBar.css('height', 0);
                } else {
                    this.outerBar.css('width', 0);
                }
                this.hidden = true;
                this.forceHidden = true;
                setTimeout($.proxy(function () {
                    this.forceHiddenCB = function () {
                        this.forceHiddenCB = null;
                        this.forceHidden = false;
                    };
                }, this), 300);
                this.slider.responsive.doNormalizedResize();
            }
        } else if (this.hidden) {
            if (itemPerPane >= this.parameters.minimumThumbnailCount + 0.5) {
                this.hidden = false;
                if (this.orientation == 'horizontal') {
                    this.outerBar.css('height', '');
                } else {
                    this.outerBar.css('width', '');
                }
                this.slider.responsive.doNormalizedResize();
            }
        }

        if (!this.hidden) {
            itemPerPane = Math.floor(itemPerPane);
            i = Math.max(0, Math.min(this.dots.length - 1, i));

            var currentPane,
                to = {};

            if (this.parameters.invertGroupDirection) {
                currentPane = Math.floor((i % Math.ceil(this.dots.length / this.group)) / itemPerPane);
            } else {
                currentPane = Math.floor(i / this.group / itemPerPane);
            }

            var min = -(this.scroller['outer' + variables.Prop]() - barDimension);

            if (currentPane == Math.floor((this.dots.length - 1) / this.group / itemPerPane)) {
                to[variables.sideProp] = -(currentPane * itemPerPane * this.thumbnailDimension[variables.prop]);
                if (currentPane == 0) {
                    this.previous.removeClass('n2-active');
                } else {
                    this.previous.addClass('n2-active');
                }
                this.next.removeClass('n2-active');
            } else if (currentPane > 0) {
                to[variables.sideProp] = -(currentPane * itemPerPane * this.thumbnailDimension[variables.prop] - this.sideDimension);
                this.previous.addClass('n2-active');
                this.next.addClass('n2-active');
            } else {
                to[variables.sideProp] = 0;
                this.previous.removeClass('n2-active');
                this.next.addClass('n2-active');
            }
            if (min >= to[variables.sideProp]) {
                to[variables.sideProp] = min;
                this.next.removeClass('n2-active');
            }
            NextendTween.to(this.scroller, 0.5, to).play();
        }


        this.currentI = i;
        this.itemPerPane = itemPerPane;
    };

    SmartSliderWidgetThumbnailDefault.prototype.isVisible = function () {
        return this.outerBar.is(':visible');
    };

    SmartSliderWidgetThumbnailDefault.prototype.getSize = function () {
        if (this.orientation == 'horizontal') {
            return this.outerBar.height() + this.offset;
        }
        return this.outerBar.width() + this.offset;
    };

    return SmartSliderWidgetThumbnailDefault;
});
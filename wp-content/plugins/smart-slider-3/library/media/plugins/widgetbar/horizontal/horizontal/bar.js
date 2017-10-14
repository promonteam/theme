N2Require('SmartSliderWidgetBarHorizontal', [], [], function ($, scope, undefined) {
    "use strict";

    function SmartSliderWidgetBarHorizontal(id, bars, parameters) {
        this.slider = window[id];

        this.slider.started($.proxy(this.start, this, id, bars, parameters));
    };

    SmartSliderWidgetBarHorizontal.prototype.start = function (id, bars, parameters) {
        if (this.slider.sliderElement.data('bar')) {
            return false;
        }
        this.slider.sliderElement.data('bar', this);

        this.offset = 0;
        this.tween = null;


        if (this.slider.isShuffled) {
            var _bars = [];
            for (var i = 0; i < this.slider.realSlides.length; i++) {
                var slide = this.slider.realSlides[i];
                _bars.push(bars[slide.originalIndex]);
            }

            bars = _bars;
        }

        this.originalBars = this.bars = bars;

        this.bar = this.slider.sliderElement.find('.nextend-bar');
        this.innerBar = this.bar.find('> div');

        this.slider.sliderElement.on({
            slideCountChanged: $.proxy(this.onSlideCountChanged, this)
        });

        this.slider.firstSlideReady.done($.proxy(this.onFirstSlideSet, this));

        if (parameters.animate) {
            this.slider.sliderElement.on('mainAnimationStart', $.proxy(this.onSliderSwitchToAnimateStart, this));
        } else {
            this.slider.sliderElement.on('sliderSwitchTo', $.proxy(this.onSliderSwitchTo, this));
        }


        if (parameters.overlay == 0) {
            var side = false;
            switch (parameters.area) {
                case 1:
                    side = 'Top';
                    break;
                case 12:
                    side = 'Bottom';
                    break;
            }
            if (side) {
                this.offset = parseFloat(this.bar.data('offset'));
                this.slider.responsive.addStaticMargin(side, this);
            }
        }

        var event = 'click';
        if (this.slider.parameters.controls.touch != '0' && this.slider.parameters.controls.touch) {
            event = 'n2click';
        }

        this.bar.on('click', $.proxy(function (e) {
            this.slider.sliderElement.find('.n2-ss-slide-active .n2-ss-layers-container').trigger(event);
        }, this));
    };

    SmartSliderWidgetBarHorizontal.prototype.onFirstSlideSet = function (slide) {

        this.onSliderSwitchTo(null, slide.index);
    };

    SmartSliderWidgetBarHorizontal.prototype.onSliderSwitchTo = function (e, targetSlideIndex) {
        this.innerBar.html(this.bars[targetSlideIndex].html);
        this.setCursor(this.bars[targetSlideIndex].hasLink);
    };

    SmartSliderWidgetBarHorizontal.prototype.onSliderSwitchToAnimateStart = function () {
        var deferred = $.Deferred();
        this.slider.sliderElement.on('mainAnimationComplete.n2Bar', $.proxy(this.onSliderSwitchToAnimateEnd, this, deferred));
        if (this.tween) {
            this.tween.pause();
        }
        NextendTween.to(this.innerBar, 0.3, {
            opacity: 0,
            onComplete: function () {
                deferred.resolve();
            }
        }).play();
    };

    SmartSliderWidgetBarHorizontal.prototype.onSliderSwitchToAnimateEnd = function (deferred, e, animation, currentSlideIndex, targetSlideIndex) {
        this.slider.sliderElement.off('.n2Bar');
        deferred.done($.proxy(function () {
            var innerBar = this.innerBar.clone();
            this.innerBar.remove();
            this.innerBar = innerBar.css('opacity', 0)
                .html(this.bars[targetSlideIndex].html)
                .appendTo(this.bar);

            this.setCursor(this.bars[targetSlideIndex].hasLink);

            this.tween = NextendTween.to(this.innerBar, 0.3, {
                opacity: 1
            }).play();
        }, this));
    };

    SmartSliderWidgetBarHorizontal.prototype.setCursor = function (hasLink) {
        if (hasLink) {
            this.innerBar.css('cursor', 'pointer');
        } else {
            this.innerBar.css('cursor', 'inherit');
        }
    };

    SmartSliderWidgetBarHorizontal.prototype.isVisible = function () {
        return this.bar.is(':visible');
    };

    SmartSliderWidgetBarHorizontal.prototype.getSize = function () {
        return this.bar.height() + this.offset;
    };

    SmartSliderWidgetBarHorizontal.prototype.onSlideCountChanged = function (e, newCount, slidesInGroup) {
        this.bars = [];
        for (var i = 0; i < this.originalBars.length; i++) {
            if (i % slidesInGroup == 0) {
                this.bars.push(this.originalBars[i]);
            }
        }
    };

    return SmartSliderWidgetBarHorizontal;
});
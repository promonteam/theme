<?php

N2Loader::import('libraries.slider.slides.slide.itemFactory', 'smartslider');

class N2SSItemYouTube extends N2SSItemAbstract {

    protected $type = 'youtube';

    public function render() {
        $slide  = $this->layer->getSlide();
        $slider = $slide->getSlider();
        /**
         * @var $this ->data N2Data
         */
        $this->data->fillDefault(array(
            'image'    => '',
            'start'    => 0,
            'volume'   => -1,
            'autoplay' => 0,
            'controls' => 1,
            'center'   => 0,
            'loop'     => 0,
            'reset'    => 0,
            'theme'    => 'dark',
            'related'  => 0,
            'vq'       => 'default'
        ));

        $rawYTUrl = $slide->fill($this->data->get('youtubeurl', ''));

        $url_parts = parse_url($rawYTUrl);
        if (!empty($url_parts['query'])) {
            parse_str($url_parts['query'], $query);
            if (isset($query['v'])) {
                unset($query['v']);
            }
            $this->data->set("query", $query);
        }

        $youTubeUrl = $this->parseYoutubeUrl($rawYTUrl);

        $start = $slide->fill($this->data->get('start', ''));
        $this->data->set("youtubecode", $youTubeUrl);
        $this->data->set("start", $start);

        $style = '';

        $hasImage = 0;
        $image    = $slide->fill($this->data->get('image'));

        $playImage = '';
        if (!empty($image)) {
            $style    = 'cursor:pointer; background: URL(' . N2ImageHelper::fixed($image) . ') no-repeat 50% 50%; background-size: cover';
            $hasImage = 1;

            if ($this->data->get('playbutton', 1) == 1) {

                $playWidth  = intval($this->data->get('playbuttonwidth', '48'));
                $playHeight = intval($this->data->get('playbuttonheight', '48'));
                if ($playWidth > 0 && $playHeight > 0) {

                    $attributes = array(
                        'class' => 'n2-video-play n2-ow',
                        'style' => ''
                    );

                    $attributes['style'] .= 'width:' . $playWidth . 'px;';
                    $attributes['style'] .= 'height:' . $playHeight . 'px;';
                    $attributes['style'] .= 'margin-left:' . ($playWidth / -2) . 'px;';
                    $attributes['style'] .= 'margin-top:' . ($playHeight / -2) . 'px;';

                    $playButtonImage = $this->data->get('playbuttonimage', '');
                    if (!empty($playButtonImage)) {
                        $src = N2ImageHelper::fixed($this->data->get('playbuttonimage', ''));
                    } else {
                        $src = N2ImageHelperAbstract::SVGToBase64('$ss$/images/play.svg');
                    }

                    $playImage = N2Html::image($src, 'Play', $attributes);
                }
            }
        }

        N2JS::addInline('window["' . $slider->elementId . '"].ready(function(){
            new N2Classes.FrontendItemYouTube(this, "' . $this->id . '", ' . $this->data->toJSON() . ', ' . $hasImage . ');
        });');

        return N2Html::tag('div', array(
            'id'    => $this->id,
            'class' => 'n2-ow',
            'style' => 'position: absolute; top: 0; left: 0; width: 100%; height: 100%;' . $style
        ), $playImage);
    }

    public function _renderAdmin() {
        $slide = $this->layer->getSlide();

        $image = $slide->fill($this->data->get('image'));
        $this->data->set('image', $image);

        return N2Html::tag('div', array(
            'class' => 'n2-ow',
            "style" => 'width: 100%; height: 100%; background: URL(' . N2ImageHelper::fixed($this->data->getIfEmpty('image', '$system$/images/placeholder/video.png')) . ') no-repeat 50% 50%; background-size: cover;'
        ), $this->data->get('playbutton', 1) ? '<img class="n2-video-play n2-ow" alt="" src="' . N2ImageHelperAbstract::SVGToBase64('$ss$/images/play.svg') . '"/>' : '');

    }

    private function parseYoutubeUrl($youTubeUrl) {
        preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $youTubeUrl, $matches);

        if ($matches && isset($matches[7]) && strlen($matches[7]) == 11) {
            return $matches[7];
        }

        return $youTubeUrl;
    }

    public function needSize() {
        return true;
    }
}
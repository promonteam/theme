<?php

class N2SmartSliderSlide {

    /**
     * @var N2SmartSliderAbstract
     */
    protected $sliderObject;
    public $id = 0, $slider = 0, $publish_up, $publish_down, $published = 1, $first = 0, $slide = '', $ordering = 0, $generator_id = 0;

    protected $title = '', $description = '', $thumbnail = '';

    public $parameters, $background = '';

    protected $isProcessedFirst = false;

    protected $html = '';

    protected $visible = 1;

    public $underEdit = false;

    public $hasLink = false;

    /**
     * @var bool|N2SmartSliderSlidesGenerator
     */
    protected $generator = false;
    protected $variables = array();

    /**
     * @var N2SmartSliderLayerRenderContext
     */
    protected $context;

    public $index = -1;

    public $attributes = array(), $containerAttributes = array(
        'class'             => 'n2-ss-layers-container n2-ow',
        'data-csstextalign' => 'center',
        'style'             => ''
    ), $classes = '', $style = '';

    public $nextCacheRefresh = 2145916800; // 2038

    public function __construct($slider, $data) {
        $this->parameters = new N2Data($data['params'], true);
        unset($data['params']);
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        $this->slide = json_decode($this->slide, true);

        if ($this->parameters->get('version') == '') {

            self::fixOldZIndexes($this->slide);

        }

        $this->sliderObject = $slider;
        $this->onCreate();

    }

    private static function fixOldZIndexes(&$layers) {
        /**
         * If we do not have version info for the slide, we should do the check for the old zIndexed storage and sort the layers to the new structure.
         */
        for ($i = 0; $i < count($layers); $i++) {
            if (!isset($layers[$i]['zIndex'])) {
                if (isset($layers[$i]['style']) && preg_match('/z\-index:[ ]*([0-9]+);/', $layers[$i]['style'], $matches)) {
                    $layers[$i]['zIndex'] = intval($matches[1]);
                } else {
                    $layers[$i]['zIndex'] = 0;
                }
            }

            if (isset($layers[$i]['type']) && $layers[$i]['type'] == 'group') {
                self::fixOldZIndexes($layers[$i]['layers']);
            }
        }

        if (isset($layers[0]['zIndex'])) {
            usort($layers, "N2SSSlidePlacementAbsolute::sortOldZIndex");
        }
    }

    public function __clone() {
        $this->parameters = clone $this->parameters;
    }

    protected function onCreate() {
        N2Pluggable::doAction('ssSlide', array($this));
    }

    public function initGenerator($extend = array()) {
        if ($this->generator_id > 0) {
            N2Loader::import('libraries.slider.generator.generator', 'smartslider');
            $this->generator = new N2SmartSliderSlidesGenerator($this, $this->sliderObject, $extend);
        }
    }

    public function hasGenerator() {
        return !!$this->generator;
    }

    /**
     * @return N2SmartSliderSlide[]
     */
    public function expandSlide() {
        return $this->generator->getSlides();
    }

    public function expandSlideAdmin() {
        return $this->generator->getSlidesAdmin();
    }

    public function fillSample() {
        if ($this->hasGenerator()) {
            $this->generator->fillSample();
        }
    }

    public function setVariables($variables) {
        $this->variables = array_merge($this->variables, (array)$variables);
    }

    public function isFirst() {
        return !!$this->first;
    }

    public function isProcessedFirst() {
        return $this->isProcessedFirst;
    }

    public function isCurrentlyEdited() {
        return N2Request::getInt('slideid') == $this->id;
    }

    public function setIndex($index) {
        $this->index = $index;
    }

    public function setFirst() {
        //$this->classes .= ' n2-ss-slide-active';
        $this->isProcessedFirst = true;

        $this->attributes['data-first'] = '1';
    }

    public function prepare() {
        $this->variables['slide'] = array(
            'name'        => $this->getTitle(),
            'description' => $this->getDescription()
        );
    }

    public function setSlidesParams() {

        $this->background = $this->sliderObject->features->makeBackground($this);

        $this->addSlideLink();

        $this->attributes['data-slide-duration'] = n2_floatval($this->parameters->get('slide-duration', 0) / 1000);
        $this->attributes['data-id']             = $this->id;

        $this->classes .= ' n2-ss-slide-' . $this->id;

        $this->sliderObject->features->makeSlide($this);

        $this->renderHtml();
    }

    protected function addSlideLink() {
        list($url, $target) = (array)N2Parse::parse($this->parameters->getIfEmpty('link', '|*|'));

        if (!empty($url) && $url != '#') {

            if (empty($target)) {
                $target = '_self';
            }

            $url = N2ImageHelper::fixed($this->fill($url));

            $this->containerAttributes['onclick'] = '';
            if (strpos($url, 'javascript:') === 0) {
                $this->containerAttributes['onclick'] = $url;
            } else {

                N2Loader::import('libraries.link.link');
                $url = N2LinkParser::parse($url, $this->containerAttributes);

                $this->containerAttributes['data-href'] = (N2Platform::$isJoomla ? JRoute::_($url, false) : $url);
                if (empty($this->containerAttributes['onclick'])) {
                    if ($target == '_blank') {
                        $this->containerAttributes['data-n2click'] = "window.open(this.getAttribute('data-href'),'_blank');";
                    } else {
                        $this->containerAttributes['data-n2click'] = "window.location=this.getAttribute('data-href')";
                    }
                    $this->containerAttributes['data-n2middleclick'] = "window.open(this.getAttribute('data-href'),'_blank');";
                }
            }
            $this->containerAttributes['style'] .= 'cursor:pointer;';
            $this->hasLink = true;
        }
    }

    public function getRawLink() {
        return $this->parameters->getIfEmpty('link', '|*|');
    }

    public function getSlider() {
        return $this->sliderObject;
    }

    protected function renderHtml() {
        if (empty($this->html)) {

            N2SSSlideComponent::$isAdmin = $this->sliderObject->isAdmin;

            $mainContainer = new N2SSSlideComponentMain($this, $this->slide);
            if ($this->sliderObject->isAdmin) {
                $mainContainer->admin();
            }

            $this->html = N2Html::tag('div', $this->containerAttributes, $mainContainer->render());
        }
    }

    public function getHTML() {
        return $this->html;
    }

    public function getAsStatic() {
        $mainContainer = new N2SSSlideComponentMain($this, $this->slide);
        if ($this->sliderObject->isAdmin) {
            $mainContainer->admin();
        }

        return N2Html::tag('div', array(
            'class'             => 'n2-ss-static-slide n2-ow' . $this->classes,
            'data-csstextalign' => 'center'
        ), $mainContainer->render());
    }

    public function isStatic() {
        if ($this->parameters->get('static-slide', 0)) {
            return true;
        }

        return false;
    }

    private static function splitTokens($input) {
        $tokens       = array();
        $currentToken = "";
        $nestingLevel = 0;
        for ($i = 0; $i < strlen($input); $i++) {
            $currentChar = $input[$i];
            if ($currentChar === "," && $nestingLevel === 0) {
                $tokens[]     = $currentToken;
                $currentToken = "";
            } else {
                $currentToken .= $currentChar;
                if ($currentChar === "(") {
                    $nestingLevel++;
                } else if ($currentChar === ")") {
                    $nestingLevel--;
                }
            }
        }
        if (strlen($currentToken)) {
            $tokens[] = $currentToken;
        }

        return $tokens;
    }

    public function fill($value) {
        if (!empty($this->variables)) {
            return preg_replace_callback('/{((([a-z]+)\(([^}]+)\))|([a-zA-Z0-9][a-zA-Z0-9_\/]*))}/', array(
                $this,
                'parseFunction'
            ), $value);
        }

        return $value;
    }

    private function parseFunction($match) {
        if (!isset($match[5])) {
            $args = self::splitTokens($match[4]);
            for ($i = 0; $i < count($args); $i++) {
                $args[$i] = $this->parseVariable($args[$i]);
            }

            return call_user_func_array(array(
                $this,
                '_' . $match[3]
            ), $args);

        } else {
            return $this->parseVariable($match[5]);
        }
    }

    private function parseVariable($variable) {
        preg_match('/^("|\')(.*)("|\')$/', $variable, $match);
        if (!empty($match)) {
            return $match[2];
        }

        preg_match('/((([a-z]+)\(([^}]+)\)))/', $variable, $match);
        if (!empty($match)) {
            return call_user_func(array(
                $this,
                'parseFunction'
            ), $match);
        } else {
            preg_match('/([a-zA-Z][0-9a-zA-Z_]*)(\/([0-9a-z]+))?/', $variable, $match);
            if ($match) {
                $index = empty($match[3]) ? 0 : $match[3];
                if (is_numeric($index)) {
                    $index = max(1, intval($index)) - 1;
                }

                if (isset($this->variables[$index]) && isset($this->variables[$index][$match[1]])) {
                    return $this->variables[$index][$match[1]];
                } else {
                    return '';
                }
            }

            return $variable;
        }
    }

    private function _fallback($s, $def) {
        if (empty($s)) {
            return $def;
        }

        return $s;
    }

    private function _cleanhtml($s) {
        return strip_tags($s, '<p><a><b><br><br/><i>');
    }

    private function _removehtml($s) {
        return strip_tags($s);
    }

    private function _splitbychars($s, $start = 0, $length = null) {
        return N2String::substr($s, $start, $length);
    }

    private function _splitbywords($s, $start, $length) {
        $len      = N2String::strlen($s);
        $posStart = max(0, $start == 0 ? 0 : N2String::strpos($s, ' ', $start));
        $posEnd   = max(0, $length > $len ? $len : N2String::strpos($s, ' ', $length));
        if ($posEnd == 0 && $length <= $len) $posEnd = $len;

        return N2String::substr($s, $posStart, $posEnd);
    }

    private function _findimage($s, $index) {
        $index = isset($index) ? intval($index) - 1 : 0;
        preg_match_all('/(<img.*?src=[\'"](.*?)[\'"][^>]*>)|(background(-image)??\s*?:.*?url\((["|\']?)?(.+?)(["|\']?)?\))/i', $s, $r);
        if (isset($r[2]) && !empty($r[2][$index])) {
            $s = $r[2][$index];
        } else if (isset($r[6]) && !empty($r[6][$index])) {
            $s = trim($r[6][$index], "'\" \t\n\r\0\x0B");
        } else {
            $s = '';
        }

        return $s;
    }

    private function _findlink($s, $index) {
        $index = isset($index) ? intval($index) - 1 : 0;
        preg_match_all('/href=["\']?([^"\'>]+)["\']?/i', $s, $r);
        if (isset($r[1]) && !empty($r[1][$index])) {
            $s = $r[1][$index];
        } else {
            $s = '';
        }

        return $s;
    }

    private function _removevarlink($s) {
        return preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', '', $s);
    }

    public function getTitle() {
        return $this->fill($this->title);
    }

    public function getDescription() {
        return $this->fill($this->description);
    }

    public function getRawTitle() {
        return $this->title;
    }

    public function getRawDescription() {
        return $this->description;
    }

    public function getBackgroundImage() {
        return $this->fill($this->parameters->get('backgroundImage'));
    }

    public function getThumbnail() {
        $image = $this->thumbnail;
        if (empty($image)) {
            $image = $this->parameters->get('backgroundImage');
        }

        return N2ImageHelper::fixed($this->fill($image));
    }

    public function getThumbnailTypeHTML() {
        $type = $this->parameters->get('thumbnailType', 'default');

        if ($type == 'default') {
            return '';
        }

        return '<img class="n2-ss-thumbnail-type n2-ow" src="' . N2ImageHelperAbstract::SVGToBase64('$ss$/images/thumbnail-types/' . $type . '.svg') . '"/>';
    }

    public function getLightboxImage() {
        $image = $this->fill($this->parameters->get('ligthboxImage'));
        if (empty($image)) {
            return $this->getBackgroundImage();
        }

        return $image;
    }

    public function getRow() {
        $this->fillParameters();

        return array(
            'title'        => $this->getTitle(),
            'slide'        => $this->getFilledSlide(),
            'description'  => $this->getDescription(),
            'thumbnail'    => N2ImageHelper::dynamic($this->getThumbnail()),
            'published'    => $this->published,
            'publish_up'   => $this->publish_up,
            'publish_down' => $this->publish_down,
            'first'        => $this->first,
            'params'       => $this->parameters->toJSON(),
            'slider'       => $this->slider,
            'ordering'     => $this->ordering,
            'generator_id' => 0
        );
    }

    public function fillParameters() {
        $this->parameters->set('backgroundImage', $this->fill($this->parameters->get('backgroundImage')));
        $this->parameters->set('backgroundAlt', $this->fill($this->parameters->get('backgroundAlt')));
        $this->parameters->set('backgroundTitle', $this->fill($this->parameters->get('backgroundTitle')));
        $this->parameters->set('backgroundVideoMp4', $this->fill($this->parameters->get('backgroundVideoMp4')));
        $this->parameters->set('link', $this->fill($this->parameters->get('link')));
    }

    public function getFilledSlide() {
        $children = $this->slide;
        if (!$this->underEdit) {
            $children = N2SSSlideComponentLayer::translateIds($children);
        }

        $this->fillLayers($children);

        return json_encode($children);
    }

    public function fillLayers(&$layers) {
        for ($i = 0; $i < count($layers); $i++) {
            if (isset($layers[$i]['type'])) {
                switch ($layers[$i]['type']) {
                    case 'content':
                        N2SSSlideComponentContent::getFilled($this, $layers[$i]);
                        break;
                    case 'row':
                        N2SSSlideComponentRow::getFilled($this, $layers[$i]);
                        break;
                    case 'col':
                        N2SSSlideComponentCol::getFilled($this, $layers[$i]);
                        break;
                    case 'group':
                        N2SSSlideComponentGroup::getFilled($this, $layers[$i]);
                        break;
                    default:
                        N2SSSlideComponentLayer::getFilled($this, $layers[$i]);
                }
            } else {
                N2SSSlideComponentLayer::getFilled($this, $layers[$i]);
            }
        }
    }

    public function setNextCacheRefresh($time) {
        $this->nextCacheRefresh = min($this->nextCacheRefresh, $time);
    }

    public function setVisibility($visibility) {
        $this->visible = $visibility;
    }

    public function isVisible() {

        if (!$this->visible) {
            return false;
        }

        $time = N2Platform::getTime();

        $publish_up   = strtotime($this->publish_up);
        $publish_down = strtotime($this->publish_down);

        if ($publish_down) {
            if ($publish_down > $time) {
                $this->setNextCacheRefresh($publish_down);
            } else {
                return false;
            }
        }

        if ($publish_up) {
            if ($publish_up > $time) {
                $this->setNextCacheRefresh($publish_up);

                return false;
            }
        }

        return true;
    }

    public function getSlideCount() {
        if ($this->hasGenerator()) {
            return $this->generator->getSlideCount();
        }

        return 1;
    }

    public function getSlideStat() {
        if ($this->hasGenerator()) {
            return $this->generator->getSlideStat();
        }

        return '1/1';
    }
}

class N2SmartSliderSlideHelper {

    public $data = array(
        'id'                     => '',
        'title'                  => '',
        'publishdates'           => '|*|',
        'published'              => 1,
        'first'                  => 0,
        'slide'                  => array(),
        'description'            => '',
        'thumbnail'              => '',
        'ordering'               => 0,
        'generator_id'           => 0,
        "static-slide"           => 0,
        "backgroundColor"        => "ffffff00",
        "backgroundImage"        => "",
        "backgroundImageOpacity" => 100,
        "backgroundAlt"          => "",
        "backgroundTitle"        => "",
        "backgroundMode"         => "default",
        "backgroundVideoMp4"     => "",
        "backgroundVideoMuted"   => 1,
        "backgroundVideoLoop"    => 1,
        "backgroundVideoMode"    => "fill",
        "link"                   => "|*|_self",
        "slide-duration"         => 0
    );

    public function __construct($properties = array()) {
        foreach ($properties as $k => $v) {
            $this->data[$k] = $v;
        }
    }

    public function set($key, $value) {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * @param $layer N2SmartSliderLayerHelper
     */
    public function addLayer($layer) {
        array_unshift($this->data['slide'], $layer->data);
    }

    public function toArray() {
        return $this->data;
    }
}
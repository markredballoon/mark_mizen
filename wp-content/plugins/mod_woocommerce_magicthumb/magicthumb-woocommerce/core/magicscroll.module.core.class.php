<?php

if(!defined('MagicScrollModuleCoreClassLoaded')) {

    define('MagicScrollModuleCoreClassLoaded', true);

    require_once(dirname(__FILE__) . '/magictoolbox.params.class.php');

    class MagicScrollModuleCoreClass {
        var $params;
        var $general;//initial parameters

        // set module type
        var $type = 'category';

        //MagicScroll module or just addon for selectors
        var $mainMode = false;

        function MagicScrollModuleCoreClass() {
            // init params
            $this->params = new MagicToolboxParamsClass();
            $this->general = new MagicToolboxParamsClass();
            // load default params
            $this->_paramDefaults();
        }

        function headers($jsPath = '', $cssPath = null, $notCheck = false) {

            //to prevent multiple displaying of headers
            if(!defined('MagicScrollModuleHeaders')) {
                define('MagicScrollModuleHeaders', true);
            } else {
                return '';
            }
            if($cssPath == null) {
                $cssPath = $jsPath;
            }
            $headers = array();
            // add module version
            $headers[] = '<!-- Magic Thumb WooCommerce module version v5.12.24 [v1.4.21:v2.0.69] -->';
            // add style link
            $headers[] = '<link type="text/css" href="' . $cssPath . '/magicscroll.css" rel="stylesheet" media="screen" />';
            // add script link
            $headers[] = '<script type="text/javascript" src="' . $jsPath . '/magicscroll.js"></script>';
            // add options
            $headers[] = '<script type="text/javascript">MagicScroll.options = {' . implode(',', $this->options()) . '}</script>';
            return implode("\r\n", $headers);

        }

        function _options($params = null) {

        }

        function options($params = null, $general = null) {

            if($params == null) {
                $params = $this->params;
            }

            // check params width 'auto' value
            if($params->checkValue('width', 0)) {
                $params->set('width', 'auto');
            }
            if($params->checkValue('height', 0)) {
                $params->set('height', 'auto');
            }
            if($params->checkValue('item-width', 0)) {
                $params->set('item-width', 'auto');
            }
            if($params->checkValue('item-height', 0)) {
                $params->set('item-height', 'auto');
            }

            $options = array();
            foreach($params->getArray() as $param) {
                if(isset($param['scope']) && ($this->mainMode && $param['scope'] == 'tool' || $param['scope'] == 'MagicScroll')) {
                    if(!isset($param['value'])) {
                        $param['value'] = $param['default'];
                    }
                    if($general && (!$general->get($param['id']) || $general->checkValue($param['id'], $param['value']))) {
                        continue;
//                    } else {
//                        print_r($general->get($param['id']));
//                        echo $param['id'], " 2 ", $param['value'], " 3 ", $general->getValue($param['id']);
//                        die();
                    }

                    /* NOTE: why do not display all params in headers!? */
                    /*
                    if(!$general && $param['value'] == $param['default']) {
                        continue;
                    }
                    */

                    $value = $param['value'];
                    switch($param['type']) {
                        case 'float':
                        case 'num':
                            if($value != 'auto') break;
                        case 'text':
                        default:
                            if($value != 'false') {
                                $value = '\'' . $param['value'] . '\'';
                            }
                    }
                    $options[] = '\'' . $param['id'] . '\': ' . $value;
                }
            }

            if($params->exists('item-tag')) {
                $options[] = '\'item-tag\': \'' . $params->getValue('item-tag') . '\'';
            }

            return $options;
        }

        function template($data, $params = array()) {

            $html = array();

            extract($params);

            // check for width/height
            if(!isset($width) || empty($width)) {
                $width = "";
            } else {
                $width = " width=\"{$width}\"";
            }
            if(!isset($height) || empty($height)) {
                $height = "";
            } else {
                $height = " height=\"{$height}\"";
            }

            // check ID
            if(!isset($id) || empty($id)) {
                $id = '';
            } else {
                // add personal options
                $html[] = $this->getPersonalOptions($id);
                $id = ' id="' . addslashes($id) . '"';
            }

            // add div with tool className
            $additionalClasses = array(
                'default' => '',
                'with-borders' => 'msborder'
            );
            $additionalClass = $additionalClasses[$this->params->getValue('scroll-style')];
            if(!empty($additionalClass)) $additionalClass = ' ' . $additionalClass;
            $html[] = '<div' . $id . ' class="MagicScroll' . $additionalClass . '"' . $width . $height . '>';

            // add items
            foreach($data as $item) {
                extract($item);

                // check item link
                if(!isset($link) || empty($link)) {
                    $link = '';
                } else {
                    // check target
                    if(isset($target) && !empty($target)) {
                        $target = ' target="' . $target . '"';
                    } else {
                        $target = '';
                    }
                    $link = $target . ' href="' . addslashes($link) . '"';
                }

                // check item alt tag
                if(!isset($alt) || empty($alt)) {
                    $alt = '';
                } else {
                    $alt = htmlspecialchars(htmlspecialchars_decode($alt, ENT_QUOTES));
                }

                // check big image
                if(!isset($img) || empty($img)) {
                    //return false;
                    $img = '';
                } else {
                    //$img = ' rel="' . $img . '"';
                }

                if(isset($medium)) {
                    $thumb = $medium;
                }

                // check thumbnail
                if(!empty($img) || !isset($thumb) || empty($thumb)) {
                    $thumb = $img;
                }

                // check title
                if(!isset($title) || empty($title)) {
                    $title = '';
                } else {
                    $title = htmlspecialchars(htmlspecialchars_decode($title, ENT_QUOTES));
                    if(empty($alt)) {
                        $alt = $title;
                    }
                    //$title = " title=\"{$title}\"";
                    if($this->params->checkValue('show-image-title', 'No')) {
                        $title = '';
                    }
                }

                // check description
                if(!isset($description) || empty($description)) {
                    $description = '';
                } else {
                    //$description = preg_replace("/<(\/?)a([^>]*)>/is", "[$1a$2]", $description);
                    $description = "<span>{$description}</span>";
                }

                // check item width
                if(!isset($width) || empty($width)) {
                    $width = "";
                } else {
                    $width = " width=\"{$width}\"";
                }

                // check item height
                if(!isset($height) || empty($height)) {
                    $height = "";
                } else {
                    $height = " height=\"{$height}\"";
                }

                // add item
                $html[] = "<a{$link}><img{$width}{$height} src=\"{$thumb}\" alt=\"{$alt}\" />{$title}{$description}</a>";
                unset ($alt); //temp FIX
            }

            // close core div
            $html[] = '</div>';

            // create HTML string
            $html = implode('', $html);

            // return result
            return $html;
        }

        function subTemplate() {
            $args = func_get_args();
            call_user_func_array(array($this, 'template'), $args);
        }

        function getPersonalOptions($id) {
            if(defined('MagicToolboxOptionsLoaded')) {
                return '<script type="text/javascript">MagicScroll.extraOptions.' . $id . ' = {' . $this->params->serialize(null, true) . '};</script>';
            }
            $options = array();
            /*if(count($this->general->params)) {
                foreach($this->general->params as $name => $param) {
                    if($this->params->checkValue($name, $param['value'])) continue;
                    switch($name) {
                        case 'speed':
                            $options[] = '\'speed\': ' . $this->params->getValue('speed');
                            break;
                        case 'duration':
                            $options[] = '\'duration\': ' . $this->params->getValue('duration');
                            break;
                        case 'loop':
                            $options[] = '\'loop\': \'' . $this->params->getValue('loop') . '\'';
                            break;
                        case 'width':
                            if($this->params->checkValue('width', 0)) {
                                $options[] = '\'width\': \'auto\'';
                            } else {
                                $options[] = '\'width\': ' . $this->params->getValue('width');
                            }
                            break;
                        case 'height':
                            if($this->params->checkValue('height', 0)) {
                                $options[] = '\'height\': \'auto\'';
                            } else {
                                $options[] = '\'height\': ' . $this->params->getValue('height');
                            }
                            break;
                        case 'item-width':
                            if($this->params->checkValue('item-width', 0)) {
                                $options[] = '\'item-width\': \'auto\'';
                            } else {
                                $options[] = '\'item-width\': ' . $this->params->getValue('item-width');
                            }
                            break;
                        case 'item-height':
                            if($this->params->checkValue('item-height', 0)) {
                                $options[] = '\'item-height\': \'auto\'';
                            } else {
                                $options[] = '\'item-height\': ' . $this->params->getValue('item-height');
                            }
                            break;
                        case 'items':
                            $options[] = '\'items\': ' . $this->params->getValue('items');
                            break;
                        case 'step':
                            $options[] = '\'step\': ' . $this->params->getValue('step');
                            break;
                        case 'arrows':
                            if($this->params->checkValue('arrows', 'false')) {
                                $options[] = '\'arrows\': false';
                            } else {
                                $options[] = '\'arrows\': \'' . $this->params->getValue('arrows') . '\'';
                            }
                            break;
                        case 'arrows-opacity':
                            $options[] = '\'arrows-opacity\': ' . $this->params->getValue('arrows-opacity');
                            break;
                        case 'arrows-hover-opacity':
                            $options[] = '\'arrows-hover-opacity\': ' . $this->params->getValue('arrows-hover-opacity');
                            break;
                        case 'direction':
                            $options[] = '\'direction\': \'' . $this->params->getValue('direction') . '\'';
                            break;
                        case 'slider':
                            if($this->params->checkValue('slider', 'false')) {
                                $options[] = '\'slider\': false';
                            } else {
                                $options[] = '\'slider\': \'' . $this->params->getValue('slider') . '\'';
                            }
                            break;
                        case 'slider-size':
                            $options[] = '\'slider-size\': \'' . $this->params->getValue('slider-size') . '\'';
                            break;
                    }
                }
            }*/
            $options = $this->options($this->params, $this->general);
            if(count($options)) {
                $options = '<script type="text/javascript">MagicScroll.extraOptions.' . $id . ' = {' . implode(',', $options) . '};</script>';
            } else {
                $options = '';
            }
            return $options;
        }

        function _paramDefaults() {
            $params = array("template"=>array("id"=>"template","group"=>"General","order"=>"20","default"=>"bottom","label"=>"Which template to use","type"=>"array","subType"=>"select","values"=>array("bottom","left","right","top"),"scope"=>"profile"),"magicscroll"=>array("id"=>"magicscroll","group"=>"General","order"=>"22","default"=>"No","label"=>"Scroll thumbnails","description"=>"(Does not work with keep-selectors-position:yes) Powered by the versatile <a href=\"http://www.magictoolbox.com/magicscroll/examples/\">Magic Scroll</a>™. Normally $49, yours is discounted to $39. <a href=\"https://www.magictoolbox.com/buy/magicscroll/\">Buy a license</a> and upload magicscroll.js to your server. <a href=\"http://www.magictoolbox.com/contact/\">Contact us</a> for help.","type"=>"array","subType"=>"select","values"=>array("Yes","No"),"scope"=>"profile"),"thumb-max-width"=>array("id"=>"thumb-max-width","group"=>"Positioning and Geometry","order"=>"100","default"=>"200","label"=>"Maximum width of thumbnail (in pixels)","type"=>"num"),"thumb-max-height"=>array("id"=>"thumb-max-height","group"=>"Positioning and Geometry","order"=>"110","default"=>"200","label"=>"Maximum height of thumbnail (in pixels)","type"=>"num"),"category-thumb-max-width"=>array("id"=>"category-thumb-max-width","group"=>"Positioning and Geometry","order"=>"120","default"=>"150","label"=>"Maximum width of thumbnails on category page (in pixels)","type"=>"num"),"category-thumb-max-height"=>array("id"=>"category-thumb-max-height","group"=>"Positioning and Geometry","order"=>"130","default"=>"150","label"=>"Maximum height of thumbnails on category page (in pixels)","type"=>"num"),"selector-max-width"=>array("id"=>"selector-max-width","group"=>"Positioning and Geometry","order"=>"135","default"=>"90","label"=>"Maximum width of selector (in pixels)","type"=>"num"),"selector-max-height"=>array("id"=>"selector-max-height","group"=>"Positioning and Geometry","order"=>"137","default"=>"90","label"=>"Maximum height of selector (in pixels)","type"=>"num"),"image-size"=>array("id"=>"image-size","group"=>"Positioning and Geometry","order"=>"210","default"=>"fit-screen","label"=>"Size of the enlarged image","type"=>"array","subType"=>"select","values"=>array("original","fit-screen"),"scope"=>"tool"),"expand-position"=>array("id"=>"expand-position","advanced"=>"1","group"=>"Positioning and Geometry","order"=>"220","default"=>"center","label"=>"Position of enlarged window","type"=>"text","description"=>"The value can be 'center' or coordinates (e.g. 'top:0, left:0' or 'bottom:100, left:100')","scope"=>"tool"),"expand-align"=>array("id"=>"expand-align","group"=>"Positioning and Geometry","order"=>"230","default"=>"screen","label"=>"Align expanded image relative to screen or small image","type"=>"array","subType"=>"select","values"=>array("screen","image"),"scope"=>"tool"),"square-images"=>array("id"=>"square-images","group"=>"Positioning and Geometry","order"=>"310","default"=>"disable","label"=>"Create square images","description"=>"The white/transparent padding will be added around the image or the image will be cropped.","type"=>"array","subType"=>"radio","values"=>array("extend","crop","disable"),"scope"=>"profile"),"expand-effect"=>array("id"=>"expand-effect","group"=>"Effects","order"=>"10","default"=>"linear","label"=>"Effect while enlarging image","type"=>"array","subType"=>"select","values"=>array("linear","cubic","back","elastic","bounce"),"scope"=>"tool"),"restore-effect"=>array("id"=>"restore-effect","group"=>"Effects","order"=>"20","default"=>"linear","label"=>"Effect while restoring enlarged image to small state","type"=>"array","subType"=>"select","values"=>array("linear","cubic","back","elastic","bounce"),"scope"=>"tool"),"expand-speed"=>array("id"=>"expand-speed","group"=>"Effects","order"=>"30","default"=>"500","label"=>"Duration when enlarging image (milliseconds)","description"=>"0-10000, e.g. 2000 = 2 seconds","type"=>"num","scope"=>"tool"),"restore-speed"=>array("id"=>"restore-speed","group"=>"Effects","order"=>"40","default"=>"-1","label"=>"Duration when restoring enlarged image (milliseconds)","description"=>"0-10000, e.g. 2000 = 2 seconds. Use same value as enlarging duration = -1","type"=>"num","scope"=>"tool"),"expand-trigger"=>array("id"=>"expand-trigger","group"=>"Effects","order"=>"50","default"=>"click","label"=>"How to trigger enlarge effect","type"=>"array","subType"=>"select","values"=>array("click","mouseover"),"scope"=>"tool"),"expand-trigger-delay"=>array("id"=>"expand-trigger-delay","advanced"=>"1","group"=>"Effects","order"=>"60","default"=>"500","label"=>"Delay before mouseover triggers expand effect (milliseconds)","description"=>"0 or larger  e.g. 0 = instant; 400 = 0.4 seconds","type"=>"num","scope"=>"tool"),"restore-trigger"=>array("id"=>"restore-trigger","advanced"=>"1","group"=>"Effects","order"=>"70","default"=>"auto","label"=>"How to restore enlarged image to small state","type"=>"array","subType"=>"select","values"=>array("auto","click","mouseout"),"scope"=>"tool"),"keep-thumbnail"=>array("id"=>"keep-thumbnail","advanced"=>"1","group"=>"Effects","order"=>"80","default"=>"Yes","label"=>"Show/hide image on web page when enlarged","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"tool"),"selectors-margin"=>array("id"=>"selectors-margin","group"=>"Multiple images","order"=>"40","default"=>"5","label"=>"Margin between selectors and main image (in pixels)","type"=>"num"),"use-selectors"=>array("id"=>"use-selectors","advanced"=>"1","group"=>"Multiple images","order"=>"200","default"=>"Yes","label"=>"Use thumbnails to change main image","type"=>"array","subType"=>"radio","values"=>array("Yes","No")),"swap-image"=>array("id"=>"swap-image","group"=>"Multiple images","order"=>"210","default"=>"click","label"=>"Method to switch between multiple images","type"=>"array","subType"=>"radio","values"=>array("click","mouseover"),"scope"=>"tool"),"swap-image-delay"=>array("id"=>"swap-image-delay","advanced"=>"1","group"=>"Multiple images","order"=>"220","default"=>"100","label"=>"Delay before switching thumbnails (milliseconds)","description"=>"0 or larger e.g. 0 = instant; 100 = 0.1 seconds","type"=>"num","scope"=>"tool"),"click-to-initialize"=>array("id"=>"click-to-initialize","group"=>"Initialization","order"=>"10","default"=>"No","label"=>"Click to download large image","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"tool"),"show-loading"=>array("id"=>"show-loading","group"=>"Initialization","order"=>"20","default"=>"Yes","label"=>"Loading message appears when zoom tool begins","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"tool"),"loading-msg"=>array("id"=>"loading-msg","advanced"=>"1","group"=>"Initialization","order"=>"30","default"=>"Loading","label"=>"Text to appear as Loading message","type"=>"text","scope"=>"tool"),"loading-opacity"=>array("id"=>"loading-opacity","advanced"=>"1","group"=>"Initialization","order"=>"40","default"=>"75","label"=>"Loading message opacity (0-100)","description"=>"0 = transparent, 100 = solid color","type"=>"num","scope"=>"tool"),"show-caption"=>array("id"=>"show-caption","group"=>"Title and Caption","order"=>"20","default"=>"Yes","label"=>"Show caption","type"=>"array","subType"=>"radio","values"=>array("Yes","No")),"caption-source"=>array("id"=>"caption-source","group"=>"Title and Caption","order"=>"30","default"=>"Title","label"=>"Caption source","type"=>"text","values"=>array("Title","Description","Additional description","All")),"caption-width"=>array("id"=>"caption-width","advanced"=>"1","group"=>"Title and Caption","order"=>"40","default"=>"300","label"=>"Max width of bottom caption (pixels: 0 or larger)","type"=>"num","scope"=>"tool"),"caption-height"=>array("id"=>"caption-height","advanced"=>"1","group"=>"Title and Caption","order"=>"50","default"=>"300","label"=>"Max height of bottom caption (pixels: 0 or larger)","type"=>"num","scope"=>"tool"),"caption-position"=>array("id"=>"caption-position","group"=>"Title and Caption","order"=>"60","default"=>"bottom","label"=>"Position caption appears","type"=>"array","subType"=>"select","values"=>array("bottom","right","left"),"scope"=>"tool"),"caption-speed"=>array("id"=>"caption-speed","advanced"=>"1","group"=>"Title and Caption","order"=>"70","default"=>"250","label"=>"Duration caption appears (milliseconds)","description"=>"e.g. 0 = instant; 250 = 0.25 seconds","type"=>"num","scope"=>"tool"),"use-effect-on-product-page"=>array("id"=>"use-effect-on-product-page","group"=>"Miscellaneous","order"=>"10","default"=>"Yes","label"=>"Use effect on product page","type"=>"array","subType"=>"select","values"=>array("Yes","No")),"use-effect-on-category-page"=>array("id"=>"use-effect-on-category-page","group"=>"Miscellaneous","order"=>"20","default"=>"No","label"=>"Use effect on category page","type"=>"array","subType"=>"select","values"=>array("Yes","No")),"create-main-image-selector"=>array("id"=>"create-main-image-selector","group"=>"Miscellaneous","order"=>"40","default"=>"No","label"=>"Create additional selector of main image","type"=>"array","subType"=>"select","values"=>array("Yes","No")),"link-to-product-page"=>array("id"=>"link-to-product-page","group"=>"Miscellaneous","order"=>"40","default"=>"Yes","label"=>"Link enlarged image to the product page","type"=>"array","subType"=>"select","values"=>array("Yes","No")),"show-message"=>array("id"=>"show-message","group"=>"Miscellaneous","order"=>"500","default"=>"Yes","label"=>"Show message under image?","type"=>"array","subType"=>"radio","values"=>array("Yes","No")),"message"=>array("id"=>"message","group"=>"Miscellaneous","order"=>"510","default"=>"Click to enlarge","label"=>"Enter message to appear under images","type"=>"text"),"imagemagick"=>array("id"=>"imagemagick","advanced"=>"1","group"=>"Miscellaneous","order"=>"550","default"=>"auto","label"=>"Path to ImageMagick binaries (convert tool)","description"=>"You can set 'auto' to automatically detect ImageMagick location or 'off' to disable ImageMagick and use php GD lib instead","type"=>"text","scope"=>"profile"),"image-quality"=>array("id"=>"image-quality","group"=>"Miscellaneous","order"=>"560","default"=>"100","label"=>"Quality of thumbnails and watermarked images (1-100)","description"=>"1 = worse quality / 100 = best quality","type"=>"num","scope"=>"profile"),"background-opacity"=>array("id"=>"background-opacity","group"=>"Background","order"=>"10","default"=>"0","label"=>"Background opacity (0-100)","description"=>"0 = transparent, 100 = solid color","type"=>"num","scope"=>"tool"),"background-color"=>array("id"=>"background-color","group"=>"Background","order"=>"20","default"=>"#000000","label"=>"Background color (#RGB)","description"=>"#000000 = black","type"=>"text","scope"=>"tool"),"background-speed"=>array("id"=>"background-speed","advanced"=>"1","group"=>"Background","order"=>"30","default"=>"200","label"=>"Duration of fade (milliseconds)","description"=>"e.g. 0 = instant; 200 = 0.2 seconds","type"=>"num","scope"=>"tool"),"buttons"=>array("id"=>"buttons","group"=>"Buttons","order"=>"10","default"=>"show","label"=>"Display navigation buttons","type"=>"array","subType"=>"select","values"=>array("show","hide","autohide"),"scope"=>"tool"),"buttons-display"=>array("id"=>"buttons-display","group"=>"Buttons","order"=>"20","default"=>"previous, next, close","label"=>"Navigation button text","type"=>"text","description"=>"Show all three buttons or just one or two. E.g. 'previous, next' or 'close, next'","scope"=>"tool"),"buttons-position"=>array("id"=>"buttons-position","advanced"=>"1","group"=>"Buttons","order"=>"30","default"=>"auto","label"=>"Position of navigation buttons","type"=>"array","subType"=>"select","values"=>array("auto","top left","top right","bottom left","bottom right"),"scope"=>"tool"),"slideshow-effect"=>array("id"=>"slideshow-effect","group"=>"Expand mode","order"=>"10","default"=>"dissolve","label"=>"Effect when switching images","type"=>"array","subType"=>"select","values"=>array("dissolve","fade","expand"),"scope"=>"tool"),"slideshow-loop"=>array("id"=>"slideshow-loop","advanced"=>"1","group"=>"Expand mode","order"=>"20","default"=>"Yes","label"=>"Restart slideshow after last image","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"tool"),"slideshow-speed"=>array("id"=>"slideshow-speed","advanced"=>"1","group"=>"Expand mode","order"=>"30","default"=>"800","label"=>"Duration when changing images (milliseconds)","description"=>"0 or larger e.g. 0 = instant; 800 = 0.8 seconds","type"=>"num","scope"=>"tool"),"z-index"=>array("id"=>"z-index","advanced"=>"1","group"=>"Expand mode","order"=>"40","default"=>"10001","label"=>"The z-index for the enlarged image","type"=>"num","scope"=>"tool"),"keyboard"=>array("id"=>"keyboard","advanced"=>"1","group"=>"Expand mode","order"=>"50","default"=>"Yes","label"=>"Use keyboard arrows to move between images","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"tool"),"keyboard-ctrl"=>array("id"=>"keyboard-ctrl","advanced"=>"1","group"=>"Expand mode","order"=>"60","default"=>"No","label"=>"Use CTRL key with keyboard arrows","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"tool"),"watermark"=>array("id"=>"watermark","group"=>"Watermark","order"=>"10","default"=>"","label"=>"Watermark image path","description"=>"Enter location of watermark image on your server. Leave field empty to disable watermark","type"=>"text","scope"=>"profile"),"watermark-max-width"=>array("id"=>"watermark-max-width","group"=>"Watermark","order"=>"20","default"=>"50%","label"=>"Maximum width of watermark image","description"=>"pixels = fixed size (e.g. 50) / percent = relative for image size (e.g. 50%)","type"=>"text","scope"=>"profile"),"watermark-max-height"=>array("id"=>"watermark-max-height","group"=>"Watermark","order"=>"21","default"=>"50%","label"=>"Maximum height of watermark image","description"=>"pixels = fixed size (e.g. 50) / percent = relative for image size (e.g. 50%)","type"=>"text","scope"=>"profile"),"watermark-opacity"=>array("id"=>"watermark-opacity","group"=>"Watermark","order"=>"40","default"=>"50","label"=>"Watermark image opacity (1-100)","description"=>"0 = transparent, 100 = solid color","type"=>"num","scope"=>"profile"),"watermark-position"=>array("id"=>"watermark-position","group"=>"Watermark","order"=>"50","default"=>"center","label"=>"Watermark position","description"=>"Watermark size settings will be ignored when watermark position is set to 'stretch'","type"=>"array","subType"=>"select","values"=>array("top","right","bottom","left","top-left","bottom-left","top-right","bottom-right","center","stretch"),"scope"=>"profile"),"watermark-offset-x"=>array("id"=>"watermark-offset-x","advanced"=>"1","group"=>"Watermark","order"=>"60","default"=>"0","label"=>"Watermark horizontal offset","description"=>"Offset from left and/or right image borders. Pixels = fixed size (e.g. 20) / percent = relative for image size (e.g. 20%). Offset will disable if 'watermark position' set to 'center'","type"=>"text","scope"=>"profile"),"watermark-offset-y"=>array("id"=>"watermark-offset-y","advanced"=>"1","group"=>"Watermark","order"=>"70","default"=>"0","label"=>"Watermark vertical offset","description"=>"Offset from top and/or bottom image borders. Pixels = fixed size (e.g. 20) / percent = relative for image size (e.g. 20%). Offset will disable if 'watermark position' set to 'center'","type"=>"text","scope"=>"profile"),"scroll-style"=>array("id"=>"scroll-style","group"=>"Scroll","order"=>"5","default"=>"default","label"=>"Style","type"=>"array","subType"=>"select","values"=>array("default","with-borders"),"scope"=>"profile"),"show-image-title"=>array("id"=>"show-image-title","group"=>"Scroll","order"=>"6","default"=>"Yes","label"=>"Show image title under images","type"=>"array","subType"=>"radio","values"=>array("Yes","No")),"loop"=>array("id"=>"loop","group"=>"Scroll","order"=>"10","default"=>"continue","label"=>"Restart scroll after last image","description"=>"After last item, continue or go back to beginning","type"=>"array","subType"=>"radio","values"=>array("continue","restart"),"scope"=>"MagicScroll"),"speed"=>array("id"=>"speed","group"=>"Scroll","order"=>"20","default"=>"0","label"=>"Duration item displayed (milliseconds)","description"=>"0 = manual scroll; 5000 = 5 seconds","type"=>"num","scope"=>"MagicScroll"),"width"=>array("id"=>"width","group"=>"Scroll","order"=>"30","default"=>"0","label"=>"Scroll width (pixels)","description"=>"0 - auto","type"=>"num","scope"=>"MagicScroll"),"height"=>array("id"=>"height","group"=>"Scroll","order"=>"40","default"=>"0","label"=>"Scroll height (pixels)","description"=>"0 - auto","type"=>"num","scope"=>"MagicScroll"),"item-width"=>array("id"=>"item-width","group"=>"Scroll","order"=>"50","default"=>"0","label"=>"Width of entire scroll area (pixels)","description"=>"0 - auto","type"=>"num","scope"=>"MagicScroll"),"item-height"=>array("id"=>"item-height","group"=>"Scroll","order"=>"60","default"=>"0","label"=>"Height of entire scroll area (pixels)","description"=>"0 - auto","type"=>"num","scope"=>"MagicScroll"),"step"=>array("id"=>"step","group"=>"Scroll","order"=>"70","default"=>"3","label"=>"Number of items moved on each scroll","type"=>"num","scope"=>"MagicScroll"),"items"=>array("id"=>"items","group"=>"Scroll","order"=>"80","default"=>"3","label"=>"Items to show","description"=>"0 - manual","type"=>"num","scope"=>"MagicScroll"),"arrows"=>array("id"=>"arrows","group"=>"Scroll Arrows","order"=>"10","default"=>"outside","label"=>"Show arrows","label"=>"Where arrows should be placed","type"=>"array","subType"=>"radio","values"=>array("outside","inside","false"),"scope"=>"MagicScroll"),"arrows-opacity"=>array("id"=>"arrows-opacity","advanced"=>"1","group"=>"Scroll Arrows","order"=>"20","default"=>"60","label"=>"Arrows opacity (0-100)","description"=>"0 = transparent, 100 = solid color","type"=>"num","scope"=>"MagicScroll"),"arrows-hover-opacity"=>array("id"=>"arrows-hover-opacity","advanced"=>"1","group"=>"Scroll Arrows","order"=>"30","default"=>"100","label"=>"Arrows opacity on mouse over (0-100)","description"=>"0 = transparent, 100 = solid color","type"=>"num","scope"=>"MagicScroll"),"slider-size"=>array("id"=>"slider-size","group"=>"Scroll Slider","order"=>"10","default"=>"10%","label"=>"Slider size (numeric or percent)","type"=>"text","scope"=>"MagicScroll"),"slider"=>array("id"=>"slider","group"=>"Scroll Slider","order"=>"20","default"=>"false","label"=>"Slider postion","type"=>"array","subType"=>"select","values"=>array("top","right","bottom","left","false"),"scope"=>"MagicScroll"),"direction"=>array("id"=>"direction","group"=>"Scroll effect","order"=>"10","default"=>"right","value"=>"bottom","label"=>"Scroll direction","description"=>"bottom = scroll moves from bottom to top","type"=>"array","subType"=>"select","values"=>array("top","right","bottom","left"),"scope"=>"MagicScroll"),"duration"=>array("id"=>"duration","group"=>"Scroll effect","order"=>"20","default"=>"1000","label"=>"Duration of each scroll (milliseconds)","description"=>"e.g. 0 = instant; 1000 = 1 second","type"=>"num","scope"=>"MagicScroll"));
            $this->params->appendArray($params);
        }
    }

}
?>

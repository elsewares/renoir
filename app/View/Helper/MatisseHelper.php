<?php
    App::uses('AppHelper', 'View/Helper');

    class MatisseHelper extends AppHelper {
      
      function submitButton($value = '', $classes = array()){
        $xclass = '';
        foreach ($classes as $class) $xclass .= " " . $class;
        
        echo '<input type="submit" class="btn matisse' . $xclass . '" value="' . $value . '" />';
        
      }
      
      function partialSubmitButton($value = '', $classes = array()){
        $xclass = '';
        foreach ($classes as $class) $xclass .= " " . $class;
        
        echo '<input type="submit" class="btn partial_matisse' . $xclass . '" value="' . $value . '" />';
      }
      
      function modalButton($rel = '', $text = ''){
        
        echo sprintf('<button class="btn redirect" rel="%s">%s</button>', $rel, $text);
        
      }
      
      // Note: A dimension string looks like this: h1:w1:d1	
      function renderDimensions($dimS = ''){
        
        $h = substr($dimS, strpos($dimS, "h"), strpos($dimS, ":") - 1);
        $w = substr($dimS, strpos($dimS, "w"), strrpos($dimS, ":") - 1);
        $d = substr($dimS, strpos($dimS, "d"));
        
        $twod = (intval($d) >= 1)? false : true;
        
        if ($twod){
            return sprintf("%s x %s", $h, $w);
        } else {
            return sprintf("%s x %s x %s", $h, $w, $d);   
        }
      }
      
      function displayDimensions($dimS){
        $html = '';
        $tmp = '<li>%s: %s inches</li>';
        $_dim = $this->regexDimensions($dimS, false);
        
        $html .= sprintf($tmp, 'Height', $_dim[0]);
        $html .= sprintf($tmp, 'Width', $_dim[1]);
        $html .= (count($_dim) <= 2)? '' : sprintf($tmp, 'Depth', $_dim[2]);

        return $html;
      }
      
      function regexDimensions($dimS = '', $doString = true){
        $regex = "/(\d*)/";
        $str = '';
        $out = array();
        preg_match_all($regex, $dimS, $match);
        foreach($match[0] as $d){
            if ($d !== ''){
                array_push($out, $d);
            }
        }
        if(count($out) == 2){
            $str = sprintf("%s in  x  %s in", $out[0], $out[1]);
        } else {
            $str = sprintf("%s in  x  %s in  x  %s in", $out[0], $out[1], $out[2]);   
        }
        
        return ($doString)? $str : $out;
        
      }
      
      function addIcon($icon = '', $invert = true){
        if ($invert){
            $i = '<i class="icon-%s icon-white"></i> ';
        } else {
            $i = '<i class="icon-%s"></i> ';
        }
        return sprintf($i, $icon);
      }
      
      function wpLink($rel){
		return Configure::read('Matisse.front') . $rel;
      }
      
      function wpHashLink($rel, $hash){
        return Configure::read('Matisse.front') . $rel . "/#matisse:" . $hash;
      }
      
      function httpUri($uri){
        return Configure::read('Matisse.front') . $uri;
      }
      
      function popover($artwork){
        $tpl = 'rel="qtip" data-content="%s" data-original-title="%s"';
        $ct = sprintf('<p>%s</p>', $artwork['Artwork']['description']);
        $ct .= sprintf('<p>%s</p>', $this->regexDimensions($artwork['Artwork']['dimensions'], true));
        $ct .= sprintf('<h4>$%s</h4>', $artwork['Artwork']['price']);

        $ti = '<h2 class=\'red\'>' . $artwork['Artwork']['title'] . '</h2>';
        
        return sprintf($tpl, $ct, $ti);
      }
      
      function galleryLink($id, $url, $rnt = '', $buy = ''){
        $tpl = '<img id="artwork_id_%s" class="artwork_%s gallery_image qtip_me span3" src="%s"  width="240"/>';
        $ret = $rnt . $buy . sprintf($tpl, $id, $id, $url);
		return $ret;
      }
      
      function thumbHeight($w, $h){
        $r = 240/$w;
        return floor($h * $r); 
      }
      
      function prependInput($char, $input = array(), $div = array()){
        $tpl = "<div class='controls input-prepend'><span class='add-on'>%s</span><input class='%s' name='%s' id='%s' /></div>";
        $dtpl = "<div class='%s input'><div class='controls input-prepend'><span class='add-on'>%s</span><input class= '%s' name='%s' id='%s' /></div></div>";

        $classes = '';
        foreach($input['class'] as $val) $classes .= " " . $val;
        $dclasses = '';
        foreach($div['class'] as $val) $dclasses .= " " . $val;
        
        if(!empty($div)){
            return sprintf($tpl, $char, $classes, $input['name'], $input['id']);
        } else {
            return sprintf($dtpl, $dclasses, $char, $classes, $input['name'], $input['id']);
        }
      }
      
    }

?>
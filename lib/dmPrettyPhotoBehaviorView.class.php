<?php
/*
 * @author TheCelavi
 */
class dmPrettyPhotoBehaviorView extends dmBehaviorBaseView {
    
    public function filterBehaviorVars(array $vars = array()) {
        $vars = parent::filterBehaviorVars($vars);
        $vars['opacity'] = (isset($vars['opacity'])) ? round($vars['opacity']/100, 2) : 0.80;
        return $vars;
    }


    public function getJavascripts() {
        return array(
            'dmPrettyPhotoBehaviorPlugin.prettyPhoto',
            'dmPrettyPhotoBehaviorPlugin.behavior'
        );
    }
    
    public function getStylesheets() {
        return array(
            'dmPrettyPhotoBehaviorPlugin.prettyPhoto'
        );
    }
    
}


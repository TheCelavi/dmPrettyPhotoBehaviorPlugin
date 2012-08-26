<?php
/*
 * @author TheCelavi
 */
class dmPrettyPhotoBehaviorForm extends dmBehaviorBaseForm {
    
    protected $animation_speed = array(
        'fast'=>'Fast',
        'slow'=>'Slow',
        'normal'=>'Normal'
    );
    protected $theme = array(
        'pp_default'=>'Default',
        'light_rounded'=>'Light rounded',
        'dark_rounded'=>'Dark rounded',
        'light_square'=>'Light square',
        'dark_square'=>'Dark square',
        'facebook'=>'Facebook'
    );
    protected $wmode = array(
        'window'=>'window',
        'direct'=>'direct',
        'opaque'=>'opaque',
        'transparent'=>'transparent',
        'gpu'=>'gpu'
    );
    
    public function configure() {
        $this->widgetSchema['inner_target'] = new sfWidgetFormInputText();
        $this->validatorSchema['inner_target'] = new sfValidatorString(array(
            'required' => false
        ));
        
        $this->widgetSchema['gallery_name'] = new sfWidgetFormInputText();
        $this->validatorSchema['gallery_name'] = new sfValidatorString(array(
            'required'=>true
        ));
        
        $this->widgetSchema['animation_speed'] = new sfWidgetFormChoice(
                array('choices'=>$this->getI18n()->translateArray($this->animation_speed))
        );
        $this->validatorSchema['animation_speed'] = new sfValidatorChoice(
                array('choices'=>  array_keys($this->animation_speed))
        );
        
        $this->widgetSchema['autoplay_slideshow'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['autoplay_slideshow'] = new sfValidatorBoolean();
        
        $this->widgetSchema['slideshow'] = new sfWidgetFormInputText();
        $this->validatorSchema['slideshow'] = new sfValidatorInteger(array(
            'min'=>0,
            'required'=>false
        ));
        
        $this->widgetSchema['opacity'] = new sfWidgetFormInputText();
        $this->validatorSchema['opacity'] = new sfValidatorInteger(array(
            'min'=>0,
            'max'=>100,
            'required'=>true
        ));
      
        $this->widgetSchema['show_title'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['show_title'] = new sfValidatorBoolean();
        
        $this->widgetSchema['allow_resize'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['allow_resize'] = new sfValidatorBoolean();
        
        $this->widgetSchema['default_width'] = new sfWidgetFormInputText();
        $this->validatorSchema['default_width'] = new sfValidatorInteger(array(
            'min'=>300,
            'max'=>2000,
            'required'=>true
        ));
        
        $this->widgetSchema['default_height'] = new sfWidgetFormInputText();
        $this->validatorSchema['default_height'] = new sfValidatorInteger(array(
            'min'=>150,
            'max'=>2000,
            'required'=>true
        ));
        
        $this->widgetSchema['counter_separator_label'] = new sfWidgetFormInputText();
        $this->validatorSchema['counter_separator_label'] = new sfValidatorString(array(
            'required'=>true
        ));
        
        $this->widgetSchema['theme'] = new sfWidgetFormChoice(
                array('choices'=>$this->getI18n()->translateArray($this->theme))
        );
        $this->validatorSchema['theme'] = new sfValidatorChoice(
                array('choices'=>  array_keys($this->theme))
        );
        
        $this->widgetSchema['horizontal_padding'] = new sfWidgetFormInputText();
        $this->validatorSchema['horizontal_padding'] = new sfValidatorInteger(array(
            'min'=>0,
            'max'=>100,
            'required'=>true
        ));
        
        $this->widgetSchema['hideflash'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['hideflash'] = new sfValidatorBoolean();
        
        $this->widgetSchema['wmode'] = new sfWidgetFormChoice(
                array('choices'=>$this->getI18n()->translateArray($this->wmode))
        );
        $this->validatorSchema['wmode'] = new sfValidatorChoice(
                array('choices'=>  array_keys($this->wmode))
        );
        
        $this->widgetSchema['autoplay'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['autoplay'] = new sfValidatorBoolean();
        
        $this->widgetSchema['modal'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['modal'] = new sfValidatorBoolean();
        
        $this->widgetSchema['deeplinking'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['deeplinking'] = new sfValidatorBoolean();
        
        $this->widgetSchema['overlay_gallery'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['overlay_gallery'] = new sfValidatorBoolean();
        
        $this->widgetSchema['keyboard_shortcuts'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['keyboard_shortcuts'] = new sfValidatorBoolean();
        
        $this->widgetSchema['twitter'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['twitter'] = new sfValidatorBoolean();
        
        $this->widgetSchema['facebook'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['facebook'] = new sfValidatorBoolean();
        
        $this->getWidgetSchema()->setLabels(array(
            'autoplay_slideshow' => 'Slide show',
            'slideshow' => 'Slide show speed',
            'hideflash' => 'Hide flash',
            'autoplay' => 'Auto play video'
        ));
        
        if (is_null($this->getDefault('inner_target'))) $this->setDefault ('inner_target', 'a');
        if (is_null($this->getDefault('gallery_name'))) $this->setDefault ('gallery_name', 'PpGallery_'.dmString::random());
        if (is_null($this->getDefault('animation_speed'))) $this->setDefault ('animation_speed', 'normal');
        if (is_null($this->getDefault('autoplay_slideshow'))) $this->setDefault ('autoplay_slideshow', false);
        if (is_null($this->getDefault('slideshow'))) $this->setDefault ('slideshow', 5000);
        if (is_null($this->getDefault('opacity'))) $this->setDefault ('opacity', 80);
        if (is_null($this->getDefault('show_title'))) $this->setDefault ('show_title', true);
        if (is_null($this->getDefault('allow_resize'))) $this->setDefault ('allow_resize', true);
        if (is_null($this->getDefault('default_width'))) $this->setDefault ('default_width', 500);
        if (is_null($this->getDefault('default_height'))) $this->setDefault ('default_height', 350);
        if (is_null($this->getDefault('counter_separator_label'))) $this->setDefault ('counter_separator_label', '/');
        if (is_null($this->getDefault('theme'))) $this->setDefault ('theme', 'pp_default');
        if (is_null($this->getDefault('horizontal_padding'))) $this->setDefault ('horizontal_padding', 20);
        if (is_null($this->getDefault('hideflash'))) $this->setDefault ('hideflash', false);
        if (is_null($this->getDefault('wmode'))) $this->setDefault ('wmode', 'opaque');
        if (is_null($this->getDefault('autoplay'))) $this->setDefault ('autoplay', true);
        if (is_null($this->getDefault('modal'))) $this->setDefault ('modal', false);
        if (is_null($this->getDefault('deeplinking'))) $this->setDefault ('deeplinking', true);
        if (is_null($this->getDefault('overlay_gallery'))) $this->setDefault ('overlay_gallery', true);
        if (is_null($this->getDefault('keyboard_shortcuts'))) $this->setDefault ('keyboard_shortcuts', true);
        if (is_null($this->getDefault('twitter'))) $this->setDefault ('twitter', true);
        if (is_null($this->getDefault('facebook'))) $this->setDefault ('facebook', true);
        parent::configure();
    }
    
}


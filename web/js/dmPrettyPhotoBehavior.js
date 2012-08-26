(function($) {    
    
    var methods = {        
        init: function(behavior) {                       
            var $this = $(this), data = $this.not('.dm').data('dmPrettyPhoto');
            if (data && behavior.dm_behavior_id != data.dm_behavior_id) { // There is attached the same, so we must report it
                alert('You can not attach Pretty Photo to same content'); // TODO TheCelavi - adminsitration mechanizm for this? Reporting error
            };
            $this.not('.dm').data('dmPrettyPhoto', behavior);
        },
        
        start: function(behavior) {
            var $self = $(this);
            $.each($self.not('.dm'), function(){
                var $this = $(this);
                var $copy = $this.clone(true, true);
                $this = $this.replaceWith($copy);
                $copy.data('dmPrettyPhotoPreviousDOOM', $this);
                $copy.attr('rel', 'prettyPhoto[' + behavior.gallery_name + ']');
                if ($copy.attr('data-dm-multimedia-metadata')) {                    
                    if (!$copy.attr('data-dm-multimedia-url')) $copy.attr('data-dm-multimedia-url', $copy.prop('href'));
                    switch($copy.attr('data-dm-multimedia-metadata')) {
                        case 'embedded_video': {
                                $copy.attr('href', methods._generateURL($copy, 'renderText'));
                        }break;
                        case 'audio_player': {
                                $copy.attr('href', methods._generateURL($copy, 'renderText'));
                        }break;
                        case 'flash_player': {
                                $copy.attr('href', methods._generateURL($copy, 'renderText'));
                        }break;
                        case 'video_player': {
                                $copy.attr('href', methods._generateURL($copy, 'renderIFrame'));
                        }break;
                        case 'image': {
                                $copy.attr('href', methods._generateURL($copy, 'renderText'));
                        }break;
                    };
                };
            });
        },
        _generateURL: function($link, action) {
            var uri = '/+/dmMultimedia/' + action + '?';
            for (var i = 0; i<$link[0].attributes.length; i++) {
                var attrName = $link[0].attributes[i].nodeName;
                if (/data-dm-multimedia-*/im.test(attrName)) {
                    uri += $link[0].attributes[i].nodeName.replace('data-dm-multimedia-', '') + "=" + $link[0].attributes[i].nodeValue + "&";                  
                }
            }
            switch(action) {
                case 'renderText':uri += 'ajax=true';break;
                case 'renderIFrame':uri += 'iframe=true';break;
            }
            return uri;
        },
        stop: function(behavior) {
            var $self = $(this);
            $.each($self.not('.dm'), function(){
                var $this = $(this);
                $this.replaceWith($this.data('dmPrettyPhotoPreviousDOOM'));
            });
            // Force removal of pretty photo
            $('.pp_overlay').remove();
            $('.pp_pic_holder').remove();
            $('#twttrHubFrame').remove();              
        },
        destroy: function(behavior) {            
            var $this = $(this);
            $this.not('.dm').data('dmPrettyPhoto', null).data('dmPrettyPhotoPreviousDOOM', null);            
        }
    };
    
    $.fn.dmPrettyPhotoBehavior = function(method, behavior){
        
        return this.each(function() {
            if ( methods[method] ) {
                return methods[ method ].apply( this, [behavior]);
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply( this, [method] );
            } else {
                $.error( 'Method ' +  method + ' does not exist on jQuery.dmPrettyPhotoBehavior' );
            }  
        });
    };

    $.extend($.dm.behaviors, {        
        dmPrettyPhotoBehavior: {
            init: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior, true) + ' ' + behavior.inner_target).dmPrettyPhotoBehavior('init', behavior);
            },
            start: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior, true) + ' ' + behavior.inner_target).dmPrettyPhotoBehavior('start', behavior);
                $("a[rel^='prettyPhoto[" + behavior.gallery_name + "]']").prettyPhoto(behavior);
            },
            stop: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior, true) + ' ' + behavior.inner_target).dmPrettyPhotoBehavior('stop', behavior);
            },
            destroy: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior, true) + ' ' + behavior.inner_target).dmPrettyPhotoBehavior('destroy', behavior);
            }
        }
    });
    
})(jQuery);
var BASE_URL = "http://[ROOT_URL]/matisse/";
var POST_URL = "http://[ROOT_URL]/matisse";
var WP_URL = "http://[ROOT_URL]/wp";
var JSON_URL = "http://[ROOT_URL]/api";

var MAP_HASH = {
        "/artists/view/" : "artist-profile/",
        "/artists/edit/" : "edit-artist-profile/",
        "/artworks/edit/" : "edit-artwork/",
        "/artworks/remove/" : "remove-artwork/",
        "/artworks/view/" : "view-artwork/",
        "/artworks/submission/" : "artwork-submission/",
        "/orders/review/" : "order-review/",
        "/clients/view/" : "client-profile/",
        "/clients/edit/" : "edit-client-profile/",
        "/locations/add/" : "add-client-location/",
        "/locations/edit/" : "edit-client-location/",
        "/locations/delete/" : "remove-client-location/"
    };

var HASH_MAP = {
        "gallery": "artworks/index/"                
    };

var App = function (site) {
    this.BASE_URL = site;
    this.WP_URL = WP_URL;
    this.POST_URL = POST_URL;
    this.TAG = "div.matisse.get";
    this.GET = 'div.content';
    this.AJAX_KEY = '091j210dj120d9j102dj1029jd';
    this.MAP_HASH = MAP_HASH;
    this.HASH_MAP = HASH_MAP;
    this.SELF = this;
    this.PAGE = '';
    this.VIEW = '';
    this.DATA = '';

    this.load = function(data, func){
        var that = this;
        $('div.matisse.got').html(data);
        //this.initArtSubForms();
        func();
    }
    
    this.reload = function (data, context){
        $(context).html(data);
    }
    
    this.login = function (data){
        $('div.login_matisse').html(data);
    }
    
    this.redirect = function (data){
        var url = this.WP_URL + $('div.from_matisse').find("div.redirect_matisse").attr('rel');
        window.location = url;
    }
    
    this.after = function (data, element){
        $(element).after(data).hide();
    }
    
    this.dispatch = function(data, $form){
        
        if(this.detectJSON(data)){
            this.dispatchJSON(data, $form);
        }
        
        if(data.indexOf('modal_matisse') !== -1){
            $('div.hidden_matisse').html(data);
            $('div.hidden_matisse').modal('show');
            return true;
        }
        
        if (data.indexOf('redirect_matisse') !== -1){
            $('div.hidden_matisse').html(data);
            this.redirect(data);
            return true;
        }
        
        if (data.indexOf('authMessage') !== -1){
            $('div.hidden_matisse').html(data);
            alert($('div.hidden_matisse div#authMessage.message').text());
        }
        
        if(data.indexOf('from_matisse') !== -1){
            this.load(data, function(){PICASSO.process()});
            console.log('Loaded view from Matisse.');
            return true;
        }
        
        return false;

    }
    
    this.dispatchJSON = function(data, $form){
        data = $.parseJSON(data);
        
        if(data.type == "rental-assign"){
            $('input[type="submit"]', $form).addClass('btn-success').removeClass('btn-danger').val('Assigned!').attr('disabled', true);
            if(this.checkPartials()){
                window.location = WP_URL + $('div.partials_complete').attr('rel');
            }
        }
    }
    
    this.detectJSON = function(data){
        try{
            if(typeof($.parseJSON(data) == 'object')) return true;
        } catch(e) {
            return false;
        }
        
        return false;
    }
    
    this.checkPartials = function(){
        var r = true;
        $('form', 'div.from_matisse').each(function(){
            if(!$(this).hasClass('submitted')) r = false;
        });
        return r;
    }
    
    this.process = function(){
        this.popovers('from_matisse');
        this.gallerySashes();
    }
    
    this.popovers = function(el){
        $('img.qtip_me').each(function(){
            var $img = $(this);
            var text = $img.parents('a').siblings('div[rel="qtip"]').attr('data-content');
            var title = $img.parents('a').siblings('div[rel="qtip"]').attr('data-original-title');
            var hold = '';
            $img.qtip({
                content: {
                   text: text,
                   title: title
                },
                position: {
                   my: 'center left',
                   at: 'center right'
                },
                style: {
                    classes: 'ui-tooltip-bootstrap'
                }
        })});
    }
    
    this.gallerySashes = function(){
        if($('img.sash').length){
            $('img.sash').each(function(){
                //$(this).css('z-index', 1);
                //$(this).siblings('a.gallery_image_link').children('img').css('position', 'relative').css('top', "-120px");
                //$(this).siblings('div.gallery_info').css('position', 'relative').css('top', '-120px').css('margin-bottom', '-120px');
                if($(this).hasClass('rented_sash')){
                    $(this).parents('a').siblings('div.gallery_info').children('div.gallery_actions').children('a.rental').attr('disabled', 'disabled');
                } else {
                    $(this).parents('a').siblings('div.gallery_info').children('div.gallery_actions').children('a.rental').attr('disabled', 'disabled');
                    $(this).parents('a').siblings('div.gallery_info').children('div.gallery_actions').children('a.purchase').attr('disabled', 'disabled');
                }
            });
        }
    }
    
    this.checkURLHash = function(url){
        return this.MAP_HASH[url];
    }
    
    this.detectHash = function(url){
        if(typeof(location.hash) == 'string' && location.hash.indexOf('matisse:') !== -1){
            var hash = location.hash;
            hash = hash.slice(hash.indexOf(':') + 1);
            //location.hash = '';
            return url + '/' + hash;
        } 
        
        if(typeof(location.hash) == 'string' && location.hash.indexOf('page:') !== -1){
            var hash = location.hash;
            var _url = this.paginationMap(window.location) + hash;
            this.hashGet(_url);
        }
        
        return url;
    }
    
    this.checkLoginStatus = function(){
            var url = this.BASE_URL + 'users/ui_user';
            var that = this;
            $.ajax({url: url, dataType: 'json', type: 'GET', success: function(data){ that.setUiUser(data); }});   
    }
    
    
    this.setUiUser = function(data){
        if(data.username){
            $('li#menu-item-128 a').first().attr('href', this.WP_URL + 'my-account/').addClass('logged').text(data.username);
        }
    }
    
    this.checkCart = function(){
        var url = this.BASE_URL + 'carts/ui_cart';
        var that = this;
        $.ajax({url: url, dataType: 'json', type: 'GET', success: function(data){ that.showCartDisplay(data); that.updateGalleryUI(data); }});
    }
    
    this.showCartDisplay = function(d){
        if(d.cnt !== undefined || d.cnt == 0){
            if(d.cnt > 0){
                $('span.items', 'a.cart_display').text(d.cnt);
                $('div.cart_display').show();
            }
        } else {
            //$('div.cart_display').hide();            
        }

        return true;
    }
    
    this.updateGalleryUI = function(d){
        if(d.cnt !== undefined && d.cnt > 0){
            $.each(d.cart.item, function(id, type){
                $('a.artwork-' + id + '.' + type).addClass('added btn-danger').siblings('a').attr('disabled', true);
            });
        }
        
        return true;
    }

    this.incrementCart = function(data){
        var $d = $('div.cart_display');
        if (data.cnt == 0){
            //$d.hide();
            return true;
        } else {
            $('span.items', 'a.cart_display').text(data.cnt);
            $d.show();
            return true;
        }
    }
    
    this.popoverPopulate = function(el){
        return $(el).next('div.popover_content').html();
    }
    
    this.replaceMatisseDiv = function(data){
        var $parent = $('div.from_matisse').parent('div');
        $parent.hide().empty().html(data).fadeIn('fast').trigger('checkPagination');
        //alert('Your selection has been added to your cart.');
        return true;
    }
    
    this.paginationHash = function(){
        if($('div.paging').length){
            location.hash = 'page:' + $('div.paging span.current').text();
        }
        return true;
    }
    
    this.paginationMap = function(location){
        if(location.indexOf('gallery') !== -1){
            return this.BASE_URL + this.HASH_MAP.gallery;
        }
        return true;
    }
    
    this.hashGet = function(url){
        $.ajax({url: url, dataType: 'html', success: function(data){ this.replaceMatisseDiv(data) }, error: function(){ return false }});
        return true;
    }
    
    this.checkPartials = function(){
        if($('form').length){
            
        }
    }
    
}

$(document).ready(function(){
    
    var MATISSE = new App(BASE_URL);
    
    if($('body').hasClass('home')){
        $featured = $('div.slidershell');
        var url = MATISSE.BASE_URL + 'artworks/featured';
        $.ajax({url: url, dataType: 'html', type: 'POST', success: function(data){
            $featured.fadeOut().empty().addClass('featured').html(data);
            //$('div.artwork.featured').equalHeights();
            $featured.fadeIn('slow');
        }});
    }
    
    if(!$('body').hasClass('home')){
        $('div.cart_display').show();
    }
    
    if($(document).find('div.matisse.get')){

        var url = MATISSE.BASE_URL + $('div.matisse.get').attr('rel');
        url = MATISSE.detectHash(url);
        $('div.matisse.get').load(url + ' div.from_matisse', function(data, status){
            if(status !== 'error'){
                MATISSE.dispatch(data);
            }
        });
        
        $('div.matisse.get').removeClass('get').addClass('got');
        var title = document.title;
        title = title.substr(title.lastIndexOf('#') + 1);
        document.title = title;

    }
    
    if($('li#menu-item-128 a').length){
        MATISSE.checkLoginStatus();
        MATISSE.checkCart();
    }
    
    $('a.link_matisse').live('click', function(e){
    
        e.preventDefault();
        e.stopPropagation();
        
        var url = $(this).attr('href');
        var a = url.slice(8);
        var rte = a.slice(a.indexOf('/'), a.lastIndexOf('/') + 1);
        var hash = 'matisse:' + a.slice(a.lastIndexOf('/') + 1);
        var wprte = MATISSE.checkURLHash(rte);
        if (wprte){
            var wpurl = MATISSE.WP_URL + wprte + '#' + hash;
            window.location = wpurl;
        } else {
            window.location = MATISSE.WP_URL + 'oops/';
        }
        
        return false;
        
    });
    
    $('a.cart_matisse').live('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        var that = $(this);
        if($(that).attr('disabled')){
            alert('Only one selection per artwork, please.');
            return false;
        }
        var dat = {};
        
        if($(that).hasClass('added')){
            var id = $(that).attr('id');
	    var un = id.substr(id.lastIndexOf("_" + 1));

		dat.undo = un;
        }
        
        var url = $(that).attr('href');
        $.ajax({url : JSON_URL + url, data: dat, dataType: "JSON", type: 'POST', success: function(d){
            if(d.success == false){
                alert('Oops.  Something wicked this way clicks.  Please try again in a second.');
            } else {
                if(d.undo){
                    $(that).removeClass('added').removeClass('btn-danger').siblings('a').attr('disabled', false);
                    MATISSE.incrementCart(d);
                    MATISSE.updateGalleryUI(d);
                    alert("Selection removed from your cart.");
                } else {
                    MATISSE.incrementCart(d);
                    MATISSE.updateGalleryUI(d);
                    alert("Selection added to your cart.");
                }
            }
        }});
        
        return false;
    });
    
    $('input[type="submit"]', 'div.from_matisse').live('click', function(e){
        
        e.preventDefault();
        e.stopPropagation();
        
        var $form = $(this).parents('form');
        $form.addClass('submitted');
        var fdata = $form.serialize();
        var url = MATISSE.POST_URL + $form.attr('action');
        
        $.ajax({url: url, type:'POST', dataType: 'html', data: fdata, success: function(data, status){
            if(status !== 'error'){
                MATISSE.dispatch(data, $form);
            } else {
                alert(status);
            }
        }});
    });
    
    $('button', 'div.modal_matisse').live('click', function(e){
        
        e.preventDefault();
        e.stopPropagation();
        
        var act = $(this).attr('rel');
        
        switch(act){
            
            case '#':
            $(document).remove('div.modal_matisse');
            return true;
        
            default:
            var url = this.WP_URL + $(data).find("div.modal_matisse").attr('rel');
            window.location = url;
            return true;
        }
    });
    
    $('button', 'form.login_matisse').live('click', function(e){
    
        e.preventDefault();
        e.stopPropagation();
        
        var url = MATISSE.BASE_URL + 'users/login';
        var dat = $('form.login_matisse').serialize();
        $.ajax({url: url, data: dat, dataType: 'html', type: 'POST', success: function(data){ MATISSE.dispatch(data); }})
    });
    
    $('input.search_matisse').live('click', function(e){
       e.preventDefault();
       e.stopPropagation();
       var hash = $(this).siblings('input#ArtworkKeywords').val().replace(/\s/g, "-");
       var url = MATISSE.WP_URL + 'search/#matisse:' + hash;
       window.location = url;
    });
    
    $('input.artsubform[type="submit"]').live('click', function(e){
            
            e.stopPropagation();
            e.preventDefault();
            var $form = $(this).parents('form#ArtworkSubmissionForm');
            var url = MATISSE.BASE_URL + 'artworks/submission';
            var dat = $form.serialize();
            $.ajax({url: url, data: dat, dataType: 'html', type: 'POST', success: function(data){ MATISSE.after(data, 'form.current_form'); }});
            
    });
    
    $('iframe[name="submissions"]').ready(function(){
        $('iframe').contents().find('form.artwork_submission').hide().first().show();
        $('input[type="submit"]', 'iframe').on('click', function(e){
           e.stopPropagation();
           e.preventDefault();
           
            var $form = $('form#ArtworkSubmissionForm', 'iframe');
            var url = MATISSE.BASE_URL + 'artworks/submission';
            var dat = $form.serialize();
            $.ajax({url: url, data: dat, dataType: 'html', type: 'POST', success: function(data){ MATISSE.after(data, 'form.current_form'); }});
           
        });
    });
    
    $('input#newpass_1, input#newpass_2').on('focus', function(){
       $('span.bad_checkpass').remove(); 
    });
    
    $('button.change_pass').live('click', function(e){
        e.stopPropagation();
        e.preventDefault();
        
        var p1 = $('input#newpass_1').val();
        var p2 = $('input#newpass_2').val();
        if (p1 !== p2){
            $('input#newpass_2').after('<p class="red bad_checkpass">Passwords do not match!</p>');
        } else {
            var url = MATISSE.BASE_URL + 'users/change_password/';
            var dat = $('form').serialize();
            $.ajax({url: url, data: dat, dataType: 'html', type: 'POST', success: function(data){ MATISSE.after(data, 'form.password_reset_matisse'); }});
 
        }
    });
    
    $('input.check_pass_first').live('click', (function(e){
       e.stopPropagation();
       e.preventDefault();
       
       var p1 = $('input#password_1').val();
       var p2 = $('input#password_2').val();
       if(p1 !== p2){
            $('input#password_2').after('<p class="red bad_checkpass">Passwords do not match!</p>');
            return false;
       } else {
            var $form = $('form#UserAddForm');
            var url = $form.attr('action');
            var dat = $form.serialize();
            $.ajax({url: url, data: dat, dataType: 'html', type: 'POST', success: function(data){ MATISSE.dispatch(data); }});
       }
       return false;
    }));
    
    if($('div.paging'.length)){
        
        $('a', 'div.paging').live('click', function(e){
           e.stopPropagation();
           e.preventDefault();
           MATISSE.paginationHash();
           var url = $(this).attr('href');
           $.ajax({url:url, dataType: 'html', type: 'GET', success: function(data){ MATISSE.replaceMatisseDiv(data); }});
           
        });
    }
    
    $('input#client_location_same').live('change', function(e){
        $location = $('fieldset.location');
        $client = $('fieldset.client');
        
        if($(this).attr('checked') == 'checked'){
            $('input.alias', $location).val('Default');
            $('input.addr1', $location).val($('input.addr1', $client).val());
            $('input.addr2', $location).val($('input.addr2', $client).val());
            $('input.city', $location).val($('input.city', $client).val());
            $('input.state', $location).val($('input.state', $client).val());
            $('input.zip', $location).val($('input.zip', $client).val());
        } else {
            $('input[type="text"]', $location).val('');
        }
    });
    
    if($('div#home-blog-feed').length){
        var $feed = $('div#home-blog-feed');
        var url = MATISSE.WP_URL + $feed.attr('id');
        $.ajax({url: url, dataType: "html", type: "GET", success: function(data){
            $feed.hide().empty().html(data).fadeIn();
        }});
    }
    
    $('div.paging').on('load', null, $('div.paging span.current').text(), MATISSE.paginationHash());
    
    if($('img.sash').length){

    }
    
});

var PICASSO = new App(BASE_URL);

/*-------------------------------------------------------------------- 
 * JQuery Plugin: "EqualHeights" & "EqualWidths"
 * by:	Scott Jehl, Todd Parker, Maggie Costello Wachs (http://www.filamentgroup.com)
 *
 * Copyright (c) 2007 Filament Group
 * Licensed under GPL (http://www.opensource.org/licenses/gpl-license.php)
 --------------------------------------------------------------------*/

$.fn.equalHeights = function(px) {
	$(this).each(function(){
		var currentTallest = 0;
		$(this).children().each(function(i){
			if ($(this).height() > currentTallest) { currentTallest = $(this).height(); }
		});
		// for ie6, set height since min-height isn't supported
		if ($.browser.msie && $.browser.version == 6.0) { $(this).children().css({'height': currentTallest}); }
		$(this).children().css({'min-height': currentTallest}); 
	});
	return this;
};

// just in case you need it...
$.fn.equalWidths = function(px) {
	$(this).each(function(){
		var currentWidest = 0;
		$(this).children().each(function(i){
				if($(this).width() > currentWidest) { currentWidest = $(this).width(); }
		});
		// for ie6, set width since min-width isn't supported
		if ($.browser.msie && $.browser.version == 6.0) { $(this).children().css({'width': currentWidest}); }
		$(this).children().css({'min-width': currentWidest}); 
	});
	return this;
};


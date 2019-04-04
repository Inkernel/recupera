// JavaScript Document
var r = jQuery.noConflict();
r(function(){
	r('#mInicio>li').hover(
		function(){
		r('.submenu',this).stop(true,true).slideDown();
		},
		function(){
		r('.submenu',this).slideUp();
		}
	);
 
});

r(function(){
	r('#mInicio>li>ul>li').hover(
		function(){
		r('.submenu2',this).stop(true,true).slideDown();
		},
		function(){
		r('.submenu2',this).slideUp();
		}
	);
 
});

r(function(){
	r('#mInicio>li>ul>li>ul>li').hover(
		function(){
		r('.submenu3',this).stop(true,true).slideDown();
		},
		function(){
		r('.submenu3',this).slideUp();
		}
	);
 
});

//--------------- MENU CONF ----------------------------
r(function(){
	r('#setup>li').hover(
		function(){
		r('.submenuSetup',this).stop(true,true).slideDown();
		},
		function(){
		r('.submenuSetup',this).slideUp();
		}
	);
 
});


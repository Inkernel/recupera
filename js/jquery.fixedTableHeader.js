/*
 * jQuery fixedTableHeader 1.2
 * 
 * [fixedTableHeader]
 * 
 * NO COPYRIGHTS OR LICENSES. DO WHAT YOU LIKE.
 * 
 * http://digital-epiphany-designs.com
 * 
 * File generated: Tue Oct 27 14:25 EST 2010
 */
(function($){
      
  $.fn.fixedTableHeader = function (instanceSettings) {
	  
	/*START SETUP */
	
	//settings
	var defaultSettings = {
      fadeIn:            true,
	  fadeOut:           true,
	  copyClick:         true,
	  copyMouseDown:     true,
	  copyMouseUp:       true,
	  copyMouseOver:     true,
	  copyMouseOut:      true
    };
  
    // get the defaults or any user set options
	var settings = $.extend(defaultSettings, instanceSettings);
  	
	var currentTable = this.attr('id');
	var div_clone_id = 'div_'+currentTable+'_cloneheader';
	var table_clone_id = 'table_'+currentTable+'_cloneheader';
	
	//create the div table header
	this.parent().prepend('<div id="'+div_clone_id+'"></div>');
		
	//clone the current tables header with classes and assign it to the clone
	$('#'+div_clone_id).html('<table id="'+table_clone_id+'" class="'+this.attr("class")+'" style="margin:0; padding:0;"><thead>'+this.children('thead').html()+'</thead></table>');
				
	//for tables with fluid widths, caputre the heading cols width
	var col = new Array();
	var i=0;
	this.find('thead th').each(function(){
	  col[i] = $(this).width();
	  i++;
	});
	//now apply the widths to the cloned table
	var i=0;
	$('#'+table_clone_id).find('thead th').each(function(){
	  $(this).width(col[i]);
	  i++;
	});
	
	//set the cloned table header position
	$('#'+div_clone_id).css({
	    'position'  :  'fixed',
		'top'       :  0,
		'left'      :  this.offset().left,
		'margin'    :  0,
		'padding'   :  0,
		'display'   :  'none'
	});
	
	//copy the click functionality
	if (settings.copyClick) {
	  var i=1;
	  $('#'+table_clone_id).find('thead th').each(function(){
		var n = i;
		$(this).bind('click', function () {
		  $('#'+currentTable+' thead th:nth-child('+n+')').click();
		  setTimeout(function(){setClass();},100);
		});
	    i++;
	  });
	}
	
	//copy the mousedown functionality
	if (settings.copyMouseDown) {
	  var i=1;
	  $('#'+table_clone_id).find('thead th').each(function(){
		var n = i;
		$(this).bind('mousedown', function () {
		  $('#'+currentTable+' thead th:nth-child('+n+')').mousedown();
		  setTimeout(function(){setClass();},100);
		});
	    i++;
	  });
	}
	
	//copy the mouseup functionality
	if (settings.copyMouseUp) {
	  var i=1;
	  $('#'+table_clone_id).find('thead th').each(function(){
		var n = i;
		$(this).bind('mouseup', function () {
		  $('#'+currentTable+' thead th:nth-child('+n+')').mouseup();
		  setTimeout(function(){setClass();},100);
		});
	    i++;
	  });
	}
	
	//copy the mouseover functionality
	if (settings.copyMouseOver) {
	  var i=1;
	  $('#'+table_clone_id).find('thead th').each(function(){
		var n = i;
		$(this).bind('mouseover', function () {
		  $('#'+currentTable+' thead th:nth-child('+n+')').mouseover();
		  setTimeout(function(){setClass();},100);
		});
	    i++;
	  });
	}
	
	//copy the mouseout functionality
	if (settings.copyMouseOut) {
	  var i=1;
	  $('#'+table_clone_id).find('thead th').each(function(){
		var n = i;
		$(this).bind('mouseout', function () {
		  $('#'+currentTable+' thead th:nth-child('+n+')').mouseout();
		  setTimeout(function(){setClass();},100);
		});
	    i++;
	  });
	}
			
	//check the window scroll to see if the cloned table header div should appear.
	$(window).scroll(function () { 
	  if ($(window).scrollTop() > $('#'+currentTable).offset().top && (($('#'+currentTable).height()+$('#'+currentTable).offset().top) > $(window).scrollTop())) {
		
		//if the original table's th class has changed, update the clone
		setClass();
		
		if (settings.fadeIn) {
		  $('#'+div_clone_id).fadeIn('fast');
		} else {
		  $('#'+div_clone_id).show();
		}
	  } else {
	    if (settings.fadeOut) {	
		  $('#'+div_clone_id).fadeOut('fast');
		} else {
		  $('#'+div_clone_id).hide();
		}
	  }
	});
	
	function setClass() {
	  var i=1;
	  $('#'+table_clone_id).find('thead th').each(function(){
		var n = i;
		$(this).removeClass();
		$(this).addClass($('#'+currentTable+' thead th:nth-child('+n+')').attr('class'));
	    i++;
	  });
	}
	
  }
})(jQuery)
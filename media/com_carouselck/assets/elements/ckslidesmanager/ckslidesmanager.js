/**
 * @copyright	Copyright (C) 2012 Cedric KEIFLIN alias ced1870
 * https://www.joomlack.fr
 * Module Carousel CK
 * @license		GNU/GPL
 * */

function ckSelectFile(file, field) {
	if (! field) {
		alert('ERROR : no field given in the function ckSelectFile');
		return;
	}
	$ck('#'+field).val(file).trigger('change');
	ckUpdateThumbnail(file, '#'+field);
}

// pour gestion editeur d'images
function ckInsertMedia(text, editor) {
	var valeur = jQuery(text).attr('src');
	jQuery('#'+editor).val(valeur);
	ckUpdateThumbnail(valeur, '#'+editor);
}

function ckUpdateThumbnail(imgsrc, editor) {
	var slideimg = jQuery(editor).parent().parent().find('img');
	var testurl = 'http';
	if (imgsrc.toLowerCase().indexOf(testurl.toLowerCase()) != -1) {
		slideimg.attr('src', imgsrc);
	} else {
		slideimg.attr('src', CAROUSELCK.URIROOTABS + imgsrc);
	}
}

function ckAddSlide(slide) {
	if (! slide) slide = [];
	var imgname = slide['imgname'] || '';
	var imgcaption = slide['imgcaption'] || '';
	var imgthumb = slide['imgthumb'] || '';
	if (!imgthumb) {
		imgthumb = CAROUSELCK.URIROOTABS + 'media/com_carouselck/images/unknown.png';
	} else {
		imgthumb = CAROUSELCK.URIROOTABS + imgname;
	}
	var imglink = slide['imglink'] || '';
	var imgtarget = slide['imgtarget'] || '';
	var imgvideo = slide['imgvideo'] || '';
	var slideselect = slide['slideselect'] || '';
	var imgalignment = slide['imgalignment'] || '';
	var articleid = slide['slidearticleid'] || '';
	var pagebuilderckid = slide['slidepagebuilderckid'] || '';
	var imgtime = slide['imgtime'] || '';
	var articlename = slide['slidearticlename'] || '';
	var pagebuilderckname = slide['slidepagebuilderckname'] || '';
	var imgtitle = slide['imgtitle'] || '';
	var state = slide['state'] || '';
	var startdate = slide['startdate'] || '';
	var enddate = slide['enddate'] || '';
	var texttype = slide['texttype'] || 'custom';

	imgcaption = imgcaption.replace(/\|dq\|/g, "&quot;");
	if (!imglink)
		imglink = '';
	if (!imgvideo)
		imgvideo = '';
	if (!imgtarget || imgtarget == 'default') {
		imgtarget = '';
		imgtargetoption = '<option value="default" selected="selected">' + Joomla.JText._('CAROUSELCK_DEFAULT', 'default') + '</option><option value="_parent">' + Joomla.JText._('CAROUSELCK_SAMEWINDOW', 'same window') + '</option><option value="_blank">' + Joomla.JText._('CAROUSELCK_NEWWINDOW', 'new window') + '</option><option value="lightbox">' + Joomla.JText._('CAROUSELCK_LIGHTBOX', 'in a Lightbox') + '</option>';
	} else {
		if (imgtarget == '_parent') {
			imgtargetoption = '<option value="default">' + Joomla.JText._('CAROUSELCK_DEFAULT', 'default') + '</option><option value="_parent" selected="selected">' + Joomla.JText._('CAROUSELCK_SAMEWINDOW', 'same window') + '</option><option value="_blank">' + Joomla.JText._('CAROUSELCK_NEWWINDOW', 'new window') + '</option><option value="lightbox">' + Joomla.JText._('CAROUSELCK_LIGHTBOX', 'in a Lightbox') + '</option>';
		} else if (imgtarget == 'lightbox') {
			imgtargetoption = '<option value="default">' + Joomla.JText._('CAROUSELCK_DEFAULT', 'default') + '</option><option value="_parent">' + Joomla.JText._('CAROUSELCK_SAMEWINDOW', 'same window') + '</option><option value="_blank">' + Joomla.JText._('CAROUSELCK_NEWWINDOW', 'new window') + '</option><option value="lightbox" selected="selected">' + Joomla.JText._('CAROUSELCK_LIGHTBOX', 'in a Lightbox') + '</option>';
		} else {
			imgtargetoption = '<option value="default">' + Joomla.JText._('CAROUSELCK_DEFAULT', 'default') + '</option><option value="_parent">' + Joomla.JText._('CAROUSELCK_SAMEWINDOW', 'same window') + '</option><option value="_blank" selected="selected">' + Joomla.JText._('CAROUSELCK_NEWWINDOW', 'new window') + '</option><option value="lightbox">' + Joomla.JText._('CAROUSELCK_LIGHTBOX', 'in a Lightbox') + '</option>';
		}
	}
	if (!slideselect) {
		slideselect = '';
		slideselectoption = '<option value="image" selected="selected">' + Joomla.JText._('CAROUSELCK_IMAGE', 'Image') + '</option><option value="video">' + Joomla.JText._('CAROUSELCK_VIDEO', 'Video') + '</option>';
	} else {
		if (slideselect == 'image') {
			slideselectoption = '<option value="image" selected="selected">' + Joomla.JText._('CAROUSELCK_IMAGE', 'Image') + '</option><option value="video">' + Joomla.JText._('CAROUSELCK_VIDEO', 'Video') + '</option>';
		} else {
			slideselectoption = '<option value="image">' + Joomla.JText._('CAROUSELCK_IMAGE', 'Image') + '</option><option value="video" selected="selected">' + Joomla.JText._('CAROUSELCK_VIDEO', 'Video') + '</option>';
		}
	}

	if (!imgalignment) {
		imgalignment = '';
		imgdataalignmentoption = '<option value="default" selected="selected">Default</option>'
				+ '<option value="topLeft">' + Joomla.JText._('CAROUSELCK_TOPLEFT', 'top left') + '</option>'
				+ '<option value="topCenter">' + Joomla.JText._('CAROUSELCK_TOPCENTER', 'top center') + '</option>'
				+ '<option value="topRight">' + Joomla.JText._('CAROUSELCK_TOPRIGHT', 'top right') + '</option>'
				+ '<option value="centerLeft">' + Joomla.JText._('CAROUSELCK_MIDDLELEFT', 'center left') + '</option>'
				+ '<option value="center">' + Joomla.JText._('CAROUSELCK_CENTER', 'center') + '</option>'
				+ '<option value="centerRight">' + Joomla.JText._('CAROUSELCK_MIDDLERIGHT', 'center right') + '</option>'
				+ '<option value="bottomLeft">' + Joomla.JText._('CAROUSELCK_BOTTOMLEFT', 'bottom left') + '</option>'
				+ '<option value="bottomCenter">' + Joomla.JText._('CAROUSELCK_BOTTOMCENTER', 'bottom center') + '</option>'
				+ '<option value="bottomRight">' + Joomla.JText._('CAROUSELCK_BOTTOMRIGHT', 'bottom right') + '</option>';
	} else {
		if (imgalignment == 'topLeft') {
			imgdataalignmentoption = '<option value="default">Default</option>'
					+ '<option value="topLeft" selected="selected">' + Joomla.JText._('CAROUSELCK_TOPLEFT', 'top left') + '</option>'
					+ '<option value="topCenter">' + Joomla.JText._('CAROUSELCK_TOPCENTER', 'top center') + '</option>'
					+ '<option value="topRight">' + Joomla.JText._('CAROUSELCK_TOPRIGHT', 'top right') + '</option>'
					+ '<option value="centerLeft">' + Joomla.JText._('CAROUSELCK_MIDDLELEFT', 'center left') + '</option>'
					+ '<option value="center">' + Joomla.JText._('CAROUSELCK_CENTER', 'center') + '</option>'
					+ '<option value="centerRight">' + Joomla.JText._('CAROUSELCK_MIDDLERIGHT', 'center right') + '</option>'
					+ '<option value="bottomLeft">' + Joomla.JText._('CAROUSELCK_BOTTOMLEFT', 'bottom left') + '</option>'
					+ '<option value="bottomCenter">' + Joomla.JText._('CAROUSELCK_BOTTOMCENTER', 'bottom center') + '</option>'
					+ '<option value="bottomRight">' + Joomla.JText._('CAROUSELCK_BOTTOMRIGHT', 'bottom right') + '</option>';
		} else if (imgalignment == 'topCenter') {
			imgdataalignmentoption = '<option value="default">Default</option>'
					+ '<option value="topLeft">' + Joomla.JText._('CAROUSELCK_TOPLEFT', 'top left') + '</option>'
					+ '<option value="topCenter" selected="selected">' + Joomla.JText._('CAROUSELCK_TOPCENTER', 'top center') + '</option>'
					+ '<option value="topRight">' + Joomla.JText._('CAROUSELCK_TOPRIGHT', 'top right') + '</option>'
					+ '<option value="centerLeft">' + Joomla.JText._('CAROUSELCK_MIDDLELEFT', 'center left') + '</option>'
					+ '<option value="center">' + Joomla.JText._('CAROUSELCK_CENTER', 'center') + '</option>'
					+ '<option value="centerRight">' + Joomla.JText._('CAROUSELCK_MIDDLERIGHT', 'center right') + '</option>'
					+ '<option value="bottomLeft">' + Joomla.JText._('CAROUSELCK_BOTTOMLEFT', 'bottom left') + '</option>'
					+ '<option value="bottomCenter">' + Joomla.JText._('CAROUSELCK_BOTTOMCENTER', 'bottom center') + '</option>'
					+ '<option value="bottomRight">' + Joomla.JText._('CAROUSELCK_BOTTOMRIGHT', 'bottom right') + '</option>';
		} else if (imgalignment == 'topRight') {
			imgdataalignmentoption = '<option value="default">Default</option>'
					+ '<option value="topLeft">' + Joomla.JText._('CAROUSELCK_TOPLEFT', 'top left') + '</option>'
					+ '<option value="topCenter">' + Joomla.JText._('CAROUSELCK_TOPCENTER', 'top center') + '</option>'
					+ '<option value="topRight" selected="selected">' + Joomla.JText._('CAROUSELCK_TOPRIGHT', 'top right') + '</option>'
					+ '<option value="centerLeft">' + Joomla.JText._('CAROUSELCK_MIDDLELEFT', 'center left') + '</option>'
					+ '<option value="center">' + Joomla.JText._('CAROUSELCK_CENTER', 'center') + '</option>'
					+ '<option value="centerRight">' + Joomla.JText._('CAROUSELCK_MIDDLERIGHT', 'center right') + '</option>'
					+ '<option value="bottomLeft">' + Joomla.JText._('CAROUSELCK_BOTTOMLEFT', 'bottom left') + '</option>'
					+ '<option value="bottomCenter">' + Joomla.JText._('CAROUSELCK_BOTTOMCENTER', 'bottom center') + '</option>'
					+ '<option value="bottomRight">' + Joomla.JText._('CAROUSELCK_BOTTOMRIGHT', 'bottom right') + '</option>';
		} else if (imgalignment == 'centerLeft') {
			imgdataalignmentoption = '<option value="default">Default</option>'
					+ '<option value="topLeft">' + Joomla.JText._('CAROUSELCK_TOPLEFT', 'top left') + '</option>'
					+ '<option value="topCenter">' + Joomla.JText._('CAROUSELCK_TOPCENTER', 'top center') + '</option>'
					+ '<option value="topRight">' + Joomla.JText._('CAROUSELCK_TOPRIGHT', 'top right') + '</option>'
					+ '<option value="centerLeft" selected="selected">' + Joomla.JText._('CAROUSELCK_MIDDLELEFT', 'center left') + '</option>'
					+ '<option value="center">' + Joomla.JText._('CAROUSELCK_CENTER', 'center') + '</option>'
					+ '<option value="centerRight">' + Joomla.JText._('CAROUSELCK_MIDDLERIGHT', 'center right') + '</option>'
					+ '<option value="bottomLeft">' + Joomla.JText._('CAROUSELCK_BOTTOMLEFT', 'bottom left') + '</option>'
					+ '<option value="bottomCenter">' + Joomla.JText._('CAROUSELCK_BOTTOMCENTER', 'bottom center') + '</option>'
					+ '<option value="bottomRight">' + Joomla.JText._('CAROUSELCK_BOTTOMRIGHT', 'bottom right') + '</option>';
		} else if (imgalignment == 'center') {
			imgdataalignmentoption = '<option value="default">Default</option>'
					+ '<option value="topLeft">' + Joomla.JText._('CAROUSELCK_TOPLEFT', 'top left') + '</option>'
					+ '<option value="topCenter">' + Joomla.JText._('CAROUSELCK_TOPCENTER', 'top center') + '</option>'
					+ '<option value="topRight">' + Joomla.JText._('CAROUSELCK_TOPRIGHT', 'top right') + '</option>'
					+ '<option value="centerLeft">' + Joomla.JText._('CAROUSELCK_MIDDLELEFT', 'center left') + '</option>'
					+ '<option value="center" selected="selected">' + Joomla.JText._('CAROUSELCK_CENTER', 'center') + '</option>'
					+ '<option value="centerRight">' + Joomla.JText._('CAROUSELCK_MIDDLERIGHT', 'center right') + '</option>'
					+ '<option value="bottomLeft">' + Joomla.JText._('CAROUSELCK_BOTTOMLEFT', 'bottom left') + '</option>'
					+ '<option value="bottomCenter">' + Joomla.JText._('CAROUSELCK_BOTTOMCENTER', 'bottom center') + '</option>'
					+ '<option value="bottomRight">' + Joomla.JText._('CAROUSELCK_BOTTOMRIGHT', 'bottom right') + '</option>';
		} else if (imgalignment == 'centerRight') {
			imgdataalignmentoption = '<option value="default">Default</option>'
					+ '<option value="topLeft">' + Joomla.JText._('CAROUSELCK_TOPLEFT', 'top left') + '</option>'
					+ '<option value="topCenter">' + Joomla.JText._('CAROUSELCK_TOPCENTER', 'top center') + '</option>'
					+ '<option value="topRight">' + Joomla.JText._('CAROUSELCK_TOPRIGHT', 'top right') + '</option>'
					+ '<option value="centerLeft">' + Joomla.JText._('CAROUSELCK_MIDDLELEFT', 'center left') + '</option>'
					+ '<option value="center">' + Joomla.JText._('CAROUSELCK_CENTER', 'center') + '</option>'
					+ '<option value="centerRight" selected="selected">' + Joomla.JText._('CAROUSELCK_MIDDLERIGHT', 'center right') + '</option>'
					+ '<option value="bottomLeft">' + Joomla.JText._('CAROUSELCK_BOTTOMLEFT', 'bottom left') + '</option>'
					+ '<option value="bottomCenter">' + Joomla.JText._('CAROUSELCK_BOTTOMCENTER', 'bottom center') + '</option>'
					+ '<option value="bottomRight">' + Joomla.JText._('CAROUSELCK_BOTTOMRIGHT', 'bottom right') + '</option>';
		} else if (imgalignment == 'bottomLeft') {
			imgdataalignmentoption = '<option value="default">Default</option>'
					+ '<option value="topLeft">' + Joomla.JText._('CAROUSELCK_TOPLEFT', 'top left') + '</option>'
					+ '<option value="topCenter">' + Joomla.JText._('CAROUSELCK_TOPCENTER', 'top center') + '</option>'
					+ '<option value="topRight">' + Joomla.JText._('CAROUSELCK_TOPRIGHT', 'top right') + '</option>'
					+ '<option value="centerLeft">' + Joomla.JText._('CAROUSELCK_MIDDLELEFT', 'center left') + '</option>'
					+ '<option value="center">' + Joomla.JText._('CAROUSELCK_CENTER', 'center') + '</option>'
					+ '<option value="centerRight">' + Joomla.JText._('CAROUSELCK_MIDDLERIGHT', 'center right') + '</option>'
					+ '<option value="bottomLeft" selected="selected">' + Joomla.JText._('CAROUSELCK_BOTTOMLEFT', 'bottom left') + '</option>'
					+ '<option value="bottomCenter">' + Joomla.JText._('CAROUSELCK_BOTTOMCENTER', 'bottom center') + '</option>'
					+ '<option value="bottomRight">' + Joomla.JText._('CAROUSELCK_BOTTOMRIGHT', 'bottom right') + '</option>';
		} else if (imgalignment == 'bottomCenter') {
			imgdataalignmentoption = '<option value="default">Default</option>'
					+ '<option value="topLeft">' + Joomla.JText._('CAROUSELCK_TOPLEFT', 'top left') + '</option>'
					+ '<option value="topCenter">' + Joomla.JText._('CAROUSELCK_TOPCENTER', 'top center') + '</option>'
					+ '<option value="topRight">' + Joomla.JText._('CAROUSELCK_TOPRIGHT', 'top right') + '</option>'
					+ '<option value="centerLeft">' + Joomla.JText._('CAROUSELCK_MIDDLELEFT', 'center left') + '</option>'
					+ '<option value="center">' + Joomla.JText._('CAROUSELCK_CENTER', 'center') + '</option>'
					+ '<option value="centerRight">' + Joomla.JText._('CAROUSELCK_MIDDLERIGHT', 'center right') + '</option>'
					+ '<option value="bottomLeft">' + Joomla.JText._('CAROUSELCK_BOTTOMLEFT', 'bottom left') + '</option>'
					+ '<option value="bottomCenter" selected="selected">' + Joomla.JText._('CAROUSELCK_BOTTOMCENTER', 'bottom center') + '</option>'
					+ '<option value="bottomRight">' + Joomla.JText._('CAROUSELCK_BOTTOMRIGHT', 'bottom right') + '</option>';
		} else if (imgalignment == 'bottomRight') {
			imgdataalignmentoption = '<option value="default">Default</option>'
					+ '<option value="topLeft">' + Joomla.JText._('CAROUSELCK_TOPLEFT', 'top left') + '</option>'
					+ '<option value="topCenter">' + Joomla.JText._('CAROUSELCK_TOPCENTER', 'top center') + '</option>'
					+ '<option value="topRight">' + Joomla.JText._('CAROUSELCK_TOPRIGHT', 'top right') + '</option>'
					+ '<option value="centerLeft">' + Joomla.JText._('CAROUSELCK_MIDDLELEFT', 'center left') + '</option>'
					+ '<option value="center">' + Joomla.JText._('CAROUSELCK_CENTER', 'center') + '</option>'
					+ '<option value="centerRight">' + Joomla.JText._('CAROUSELCK_MIDDLERIGHT', 'center right') + '</option>'
					+ '<option value="bottomLeft">' + Joomla.JText._('CAROUSELCK_BOTTOMLEFT', 'bottom left') + '</option>'
					+ '<option value="bottomCenter">' + Joomla.JText._('CAROUSELCK_BOTTOMCENTER', 'bottom center') + '</option>'
					+ '<option value="bottomRight" selected="selected">' + Joomla.JText._('CAROUSELCK_BOTTOMRIGHT', 'bottom right') + '</option>';
		} else {
			imgdataalignmentoption = '<option value="default" selected="selected">Default</option>'
					+ '<option value="topLeft">' + Joomla.JText._('CAROUSELCK_TOPLEFT', 'top left') + '</option>'
					+ '<option value="topCenter">' + Joomla.JText._('CAROUSELCK_TOPCENTER', 'top center') + '</option>'
					+ '<option value="topRight">' + Joomla.JText._('CAROUSELCK_TOPRIGHT', 'top right') + '</option>'
					+ '<option value="centerLeft">' + Joomla.JText._('CAROUSELCK_MIDDLELEFT', 'center left') + '</option>'
					+ '<option value="center">' + Joomla.JText._('CAROUSELCK_CENTER', 'center') + '</option>'
					+ '<option value="centerRight">' + Joomla.JText._('CAROUSELCK_MIDDLERIGHT', 'center right') + '</option>'
					+ '<option value="bottomLeft">' + Joomla.JText._('CAROUSELCK_BOTTOMLEFT', 'bottom left') + '</option>'
					+ '<option value="bottomCenter">' + Joomla.JText._('CAROUSELCK_BOTTOMCENTER', 'bottom center') + '</option>'
					+ '<option value="bottomRight">' + Joomla.JText._('CAROUSELCK_BOTTOMRIGHT', 'bottom right') + '</option>';
		}
	}
	if (!state || state == '1') {
		state = '1';
		statetxt = 'ON';
	} else {
		state = '0';
		statetxt = 'OFF';
	}

	index = ckCheckIndex(0);
	var ckslide = jQuery('<li class="ckslide" id="ckslide' + index + '" />');

	ckslide.html('<div class="ckslidehandle"><div class="ckslidenumber">' + index + '</div></div>'
			+ '<div class="ckslidedelete cktip" title="' + Joomla.JText._('CAROUSELCK_REMOVE2', '') + '" onclick="javascript:ckRemoveSlide(jQuery(this).parent());"><i class="fas fa-times"></i></a></div>'
			+ '<div class="ckslidetoggle" data-state="' + state + '"><div class="ckslidetoggler">' + statetxt + '</div></div>'
			+ '<div class="ckslidecontainer">'
			+ '<div class="cksliderow"><div class="ckslideimgcontainer">'
			+ '<img src="' + imgthumb + '" width="64" height="64" onclick="ckCallImageManagerPopup(\'ckslideimgname' + index + '\')"/></div>'

			+ '<div class="ckslideimgnamewrap ckbutton-group">'
				+ '<input name="ckslideimgname' + index + '" id="ckslideimgname' + index + '" class="ckslideimgname" type="text" value="' + imgname + '" onchange="javascript:ckUpdateThumbnail(this.value, this);" />'
				+ '<a class="ckbutton cktip" onclick="ckCallImageManagerPopup(\'ckslideimgname' + index + '\')" href="javascript:void(0)" title="' + Joomla.JText._('CAROUSELCK_SELECTIMAGE', 'select image') + '"><i class="fas fa-edit"></i></a></div>'
			+ '</div>'

			+ '<div class="cksliderow2">'
			// + '<span class="ckslidelabel">' + Joomla.JText._('CAROUSELCK_USETOSHOW', 'Display') + '</span><select class="ckslideselect">' + slideselectoption + '</select>'
			+ '<span><i class="fas fa-hourglass-half cktip" title="' + Joomla.JText._('CAROUSELCK_SLIDETIME', 'enter a specific time value for this slide, else it will be the default time') + '" style="color: #555;font-size: 16px;padding: 5px;"></i><input name="ckslideimgtime' + index + '" class="ckslideimgtime" type="text" value="' + imgtime + '" style="width:25px;" /></span><span>ms</span>'
			+ '</div>'
			
			+ '<div class="cksliderow"><div id="ckslideaccordion' + index + '">'
			+ '<span class="ckbutton ckslideaccordeonbutton ckinterfacetablink" data-group="main" data-tab="tab_maintext">' + Joomla.JText._('CAROUSELCK_TEXT', 'Text') + '</span>'
			+ '<span class="ckbutton ckslideaccordeonbutton ckinterfacetablink" data-group="main" data-tab="tab_mainimage">' + Joomla.JText._('CAROUSELCK_IMAGE', 'Image') + '</span>'
			+ '<span class="ckbutton ckslideaccordeonbutton ckinterfacetablink" data-group="main" data-tab="tab_mainlink">' + Joomla.JText._('CAROUSELCK_LINK', 'Link') + '</span>'
			+ '<span class="ckbutton ckslideaccordeonbutton ckinterfacetablink" data-group="main" data-tab="tab_mainvideo">' + Joomla.JText._('CAROUSELCK_VIDEO', 'Video') + '</span>'
			+ '<span class="ckbutton ckslideaccordeonbutton ckinterfacetablink" data-group="main" data-tab="tab_maindates">' + Joomla.JText._('CAROUSELCK_DATES', 'Dates') + '</span>'
			+ '<div style="clear:both;"></div>'

			+ '<div class="ckslideaccordeoncontent ckinterfacetab" data-group="main" id="tab_maintext">'
				+ '<span class="ckbutton ckslideaccordeonbutton ckinterfacetablink ' + (texttype == 'custom' ? 'active open' : '') + '" data-allowclose="false" data-group="text" data-tab="tab_textcustom" data-value="custom">' + Joomla.JText._('CAROUSELCK_TEXT_CUSTOM', 'Custom text') + '</span>'
				+ '<span class="ckbutton ckslideaccordeonbutton ckinterfacetablink ' + (texttype == 'article' ? 'active open' : '') + '" data-allowclose="false" data-group="text" data-tab="tab_textarticle" data-value="article">' + Joomla.JText._('CAROUSELCK_ARTICLE', 'Article') + '</span>'
//				+ '<span class="ckbutton ckslideaccordeonbutton ckinterfacetablink ' + (texttype == 'pagebuilderck' ? 'active open' : '') + '" data-allowclose="false" data-group="text" data-tab="tab_textpagebuilderck" data-value="pagebuilderck">' + Joomla.JText._('CAROUSELCK_PAGEBUILDERCK', 'Page Builder CK') + '</span>'
				+ '<div style="clear:both;"></div>'
				+ '<div class="ckslideaccordeoncontent ckinterfacetab ' + (texttype == 'custom' ? 'current' : '') + '" data-group="text" id="tab_textcustom">'
					+ '<div class="cksliderow"><span class="ckslidelabel">' + Joomla.JText._('CAROUSELCK_TITLE', 'Title') + '</span><input name="ckslidetitletext' + index + '" class="ckslidetitletext" type="text" value="' + imgtitle + '" /></div>'
					+ '<div class="cksliderow"><span class="ckslidelabel">' + Joomla.JText._('CAROUSELCK_CAPTION', 'Caption') + '</span><input name="ckslidecaptiontext' + index + '" class="ckslidecaptiontext" type="text" value="' + imgcaption + '" /></div>'
				+ '</div>'
				+ '<div class="ckslideaccordeoncontent ckinterfacetab ' + (texttype == 'article' ? 'current' : '') + '" data-group="text" id="tab_textarticle">'
					+ '<div class="cksliderow ckbutton-group" id="cksliderowarticle' + index + '"><label class="ckslidelabel">' + Joomla.JText._('CAROUSELCK_ARTICLE_ID', 'Article ID') + '</label><input name="ckslidearticleid' + index + '" class="ckslidearticleid input-medium" id="ckslidearticleid' + index + '" style="width:20px" type="text" value="' + articleid + '" disabled="disabled" /><input name="ckslidearticlename' + index + '" class="ckslidearticlename input-medium" id="ckslidearticlename' + index + '" type="text" value="' + articlename + '" disabled="disabled" /><a id="ckslidearticlebuttonSelect" class="ckmodal ckbutton cktip" title="' + Joomla.JText._('CAROUSELCK_SELECT', 'Clear') + '" href="index.php?option=com_content&amp;layout=modal&amp;view=articles&amp;tmpl=component&amp;function=jSelectArticle_ckslidearticleid' + index + '&' + CAROUSELCK.TOKEN + '" rel="{handler: \'iframe\', size: {x: 800, y: 450}}"><i class="fas fa-edit"></i></a><a class="ckbutton" href="javascript:void(0)" onclick="document.getElementById(\'ckslidearticleid' + index + '\').value=\'\';document.getElementById(\'ckslidearticlename' + index + '\').value=\'\';document.getElementById(\'ckslidearticlebuttonEdit' + index + '\').style.display=\'none\';">' + Joomla.JText._('CAROUSELCK_CLEAR', 'Clear') + '</a>'
					+ '<a id="ckslidearticlebuttonEdit' + index + '" class="ckbutton" href="javascript:void(0)" onclick="ckCallArticleEditionPopup(document.getElementById(\'ckslidearticleid' + index + '\').value)" ' + (articleid != '' ? '' : 'style="display:none;"') + '>'+Joomla.JText._('CAROUSELCK_EDIT', 'Edit')+'</a>'
					+'</div>'
				+ '</div>'
//				+ '<div class="ckslideaccordeoncontent ckinterfacetab ' + (texttype == 'pagebuilderck' ? 'current' : '') + '" data-group="text" id="tab_textpagebuilderck">'
//					+ '<div class="cksliderow ckbutton-group" id="cksliderowpage' + index + '">'
//						+ '<label class="ckslidelabel">' + Joomla.JText._('CAROUSELCK_PAGEBUILERCK_PAGE_ID', 'Page ID') + '</label>'
//						+ '<input name="ckslidepagebuilderckid' + index + '" class="ckslidepagebuilderckid input-medium" id="ckslidepagebuilderckid' + index + '" style="width:20px" type="text" value="' + pagebuilderckid + '" disabled="disabled" />'
//						+ '<input name="ckslidepagebuilderckname' + index + '" class="ckslidepagebuilderckname input-medium" id="ckslidepagebuilderckname' + index + '" type="text" value="' + pagebuilderckname + '" disabled="disabled" />'
//						+ '<a id="ckslidepagebuilderckbuttonSelect" class="ckmodal ckbutton cktip" title="' + Joomla.JText._('CAROUSELCK_SELECT', 'Clear') + '" href="index.php?option=com_content&amp;layout=modal&amp;view=articles&amp;tmpl=component&amp;function=jSelectArticle_ckslidearticleid' + index + '&' + CAROUSELCK.TOKEN + '" rel="{handler: \'iframe\', size: {x: 800, y: 450}}"><i class="fas fa-edit"></i></a>'
//						+ '<a class="ckbutton" href="javascript:void(0)" onclick="document.getElementById(\'ckslidearticleid' + index + '\').value=\'\';document.getElementById(\'ckslidearticlename' + index + '\').value=\'\';">' + Joomla.JText._('CAROUSELCK_CLEAR', 'Clear') + '</a>'
//						+(pagebuilderckid != '' ? '<a id="ckslidepagebuilderckbuttonEdit" class="ckbutton" href="javascript:void(0)" onclick="ckCallPagebuilderckEditionPopup('+pagebuilderckid+')">'+Joomla.JText._('CAROUSELCK_EDIT', 'Edit')+'</a>' : '')
//					+'</div>'
//				+ '</div>'

			
			+ '</div>'
			+ '<div class="ckslideaccordeoncontent ckinterfacetab" data-group="main" id="tab_mainimage">'
			+ '<div class="cksliderow"><span class="ckslidelabel">' + Joomla.JText._('CAROUSELCK_ALIGNEMENT_LABEL', 'Image alignment') + '</span><select name="ckslidedataalignmenttext' + index + '" class="ckslidedataalignmenttext" >' + imgdataalignmentoption + '</select></div>'
			+ '</div>'
			+ '<div class="ckslideaccordeoncontent ckinterfacetab" data-group="main" id="tab_mainlink">'
				
				+ '<div class="cksliderow">'
					+ '<div class="ckbutton-group">'
					+ '<label class="ckslidelabel">' + Joomla.JText._('CAROUSELCK_LINK', 'Link url') + '</label><input id="ckslidelinktext' + index + '" name="ckslidelinktext' + index + '" class="ckslidelinktext" type="text" value="' + imglink + '" />'
					+ '<a class="ckbutton cktip" onclick="ckCallMenusSelectionPopup(\'ckslidelinktext' + index + '\')" href="javascript:void(0)" title="' + Joomla.JText._('CAROUSELCK_SELECT_LINK', 'select image') + '"><i class="fas fa-edit"></i></a>'
					+ '</div>'
				+ '</div>'
			+ '<div class="cksliderow"><span class="ckslidelabel">' + Joomla.JText._('CAROUSELCK_TARGET', 'Target') + '</span><select name="ckslidetargettext' + index + '" class="ckslidetargettext" >' + imgtargetoption + '</select></div>'
			+ '</div>'
			+ '<div class="ckslideaccordeoncontent ckinterfacetab" data-group="main" id="tab_mainvideo">'
			+ '<div class="cksliderow">'
			+ '<div class="ckbutton-group">'
			+' <label class="ckslidelabel">' + Joomla.JText._('CAROUSELCK_VIDEOURL', 'Video url') + '</label><input id="ckslidevideotext' + index + '" name="ckslidevideotext' + index + '" class="ckslidevideotext" type="text" value="' + imgvideo + '" /><a class="ckbutton cktip" title="' + Joomla.JText._('CAROUSELCK_SELECT', 'Clear') + '" href="javascript:void(0)" onclick="ckCallVideoManagerPopup(\'ckslidevideotext' + index + '\')"><i class="fas fa-edit"></i></a></div>'
			+ '</div>'
			+ '</div>'
			+ '<div class="ckslideaccordeoncontent ckinterfacetab" data-group="main" id="tab_maindates">'
			+ '<div class="cksliderow"><span class="ckslidelabel">' + Joomla.JText._('CAROUSELCK_STARTDATE', 'Start date') + '</span><input name="ckslidestartdate' + index + '" class="ckslidestartdate ckdatepicker" type="text" value="' + startdate + '" /></div>'
			+ '<div class="cksliderow"><span class="ckslidelabel">' + Joomla.JText._('CAROUSELCK_ENDDATE', 'End date') + '</span><input name="ckslideenddate' + index + '" class="ckslideenddate ckdatepicker" type="text" value="' + enddate + '" /></div>'
			+ '</div>'
			+ '</div></div>'
			+ '</div><div style="clear:both;"></div>');

	jQuery('#ckslideslist').append(ckslide);
	
	script = document.createElement("script");
	script.setAttribute('type', 'text/javascript');
	script.text = "function jSelectArticle_ckslidearticleid" + index + "(id, title, catid, object) {"
			+ "document.getElementById('ckslidearticleid" + index + "').value = id;"
			+ "document.getElementById('ckslidearticlename" + index + "').value = title;"
			+ "document.getElementById('ckslidearticlebuttonEdit" + index + "').style.display = 'inline-block';"
			+ "CKBox.close();"
			+ "}";

	document.body.appendChild(script);

	ckStoreSlides();
	ckMakeSlidesSortable();

	CKBox.assign(jQuery('#ckslide' + index + ' a.ckmodal'), {
		parse: 'rel'
	});
//	create_tabs_in_slide(jQuery('#ckslide' + index));
	ckInitTabs(jQuery('#ckslide' + index), true);
	CKApi.Tooltip(jQuery('#ckslide' + index + ' .cktip'));
	jQuery('#ckslide' + index + ' .ckdatepicker').datepicker({"dateFormat": "d MM yy"});

	// add code to toggle the slide state
	jQuery('#ckslide' + index + ' .ckslidetoggle').click(function() {
		if (jQuery(this).attr('data-state') == '0') {
			jQuery(this).attr('data-state', '1');
			jQuery(this).find('.ckslidetoggler').text('ON');
		} else {
			jQuery(this).attr('data-state', '0');
			jQuery(this).find('.ckslidetoggler').text('OFF');
		}
	});
}

function ckCheckIndex(i) {
	while (jQuery('#ckslide' + i).length)
		i++;
	return i;
}


function ckRemoveSlide(slide) {
	if (confirm(Joomla.JText._('CAROUSELCK_REMOVE', 'Remove this slide') + ' ?')) {
		jQuery(slide).remove();
		ckStoreSlides();
	}
	jQuery('.cktooltip').remove();
}

function ckStoreSlides() {
	var i = 0;
	var slides = new Array();
	jQuery('#ckslideslist .ckslide').each(function(i, el) {
		el = jQuery(el);
		slide = new Object();
		slide['imgname'] = el.find('.ckslideimgname').val();
		slide['imgcaption'] = el.find('.ckslidecaptiontext').val();
		slide['imgcaption'] = slide['imgcaption'].replace(/"/g, "|dq|");
		slide['imgtitle'] = el.find('.ckslidetitletext').val();
		slide['imgtitle'] = slide['imgtitle'].replace(/"/g, "|dq|");
		slide['imgthumb'] = el.find('img').attr('src');
		slide['imglink'] = el.find('.ckslidelinktext').val();
		slide['imglink'] = slide['imglink'].replace(/"/g, "|dq|");
		slide['imgtarget'] = el.find('.ckslidetargettext').val();
		slide['imgalignment'] = el.find('.ckslidedataalignmenttext').val();
		slide['imgvideo'] = el.find('.ckslidevideotext').val();
		// slide['slideselect'] = el.find('.ckslideselect').val();
		slide['slidearticleid'] = el.find('.ckslidearticleid').val();
		slide['slidepagebuilderckid'] = el.find('.ckslidepagebuilderckid').val();
		slide['slidearticlename'] = el.find('.ckslidearticlename').val();
		slide['slidepagebuilderckname'] = el.find('.ckslidepagebuilderckname').val();
		slide['imgtime'] = el.find('.ckslideimgtime').val();
		slide['state'] = el.find('.ckslidetoggle').attr('data-state');
		slide['startdate'] = el.find('.ckslidestartdate').val();
		slide['enddate'] = el.find('.ckslideenddate').val();
		slide['texttype'] = el.find('.ckbutton[data-group="text"].active').attr('data-value');
		slides[i] = slide;
		i++;
	});

	slides = JSON.stringify(slides);
	slides = slides.replace(/"/g, "|qq|");
	jQuery('#ckslides').val(slides);

}

function ckCallSlides() {
	var slides = jQuery.parseJSON(jQuery('#ckslides').val().replace(/\|qq\|/g, "\""));
	if (slides.length) {
		jQuery(slides).each(function(i, slide) {
			ckAddSlide(slide);
		});
	}
}


function ckMakeSlidesSortable() {
	jQuery("#ckslideslist").sortable({
//		placeholder: "ui-state-highlight",
		handle: ".ckslidehandle",
		items: ".ckslide",
		axis: "y",
		forcePlaceholderSize: true,
		forceHelperSize: true,
		dropOnEmpty: true,
		tolerance: "pointer",
		placeholder: "placeholder",
		connectWith: '',
		zIndex: 9999,
		update: function(event, ui) {
			ckRenumberSlides();
		},
		sort: function(event, ui) {
			jQuery(ui.placeholder).height(jQuery(ui.helper).height());
		}
	});
}

function ckRenumberSlides() {
	var index = 0;
	jQuery('.ckslide').each(function(i, slide) {
		jQuery('.ckslidenumber', jQuery(slide)).html(i);
		index++;
	});
}

jQuery(document).ready(function() {
	ckCallSlides();

	var script = document.createElement("script");
	script.setAttribute('type', 'text/javascript');
	script.text = "var CarouselCK = {};"
			+ "CarouselCK.submitbutton = Joomla.submitbutton;"
			+ "Joomla.submitbutton = function(task){"
			+ "ckStoreSlides();"
			+ "CarouselCK.submitbutton(task);"
			+ "};"
			+ "jInsertEditorText = function(text, editor) {ckInsertMedia(text, editor)};";

	document.body.appendChild(script);
});

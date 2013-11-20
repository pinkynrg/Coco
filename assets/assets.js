
$("body").ready(function () {

	//=======================PROTOTYPE========================//

	/**
	 * Delete all elements with value deleteValue from an array
	 * @param {Number} deleteValue 
	 * @return {Array} this
	 */
	Array.prototype.clean = function(deleteValue) {
		for (var i = 0; i < this.length; i++) {
			if (this[i] == deleteValue) {         
				this.splice(i, 1);
				i--;
			}
		}	
		return this;
	};

	/**
	 * Return the index of a element in an array
	 * @param {String} elt 
	 * @return {String} from
	 */
	if (!Array.prototype.indexOf){
	  Array.prototype.indexOf = function(elt /*, from*/)
	  {
	    var len = this.length >>> 0;

	    var from = Number(arguments[1]) || 0;
	    from = (from < 0)
	         ? Math.ceil(from)
	         : Math.floor(from);
	    if (from < 0)
	      from += len;

	    for (; from < len; from++)
	    {
	      if (from in this &&
	          this[from] === elt)
	        return from;
	    }
	    return -1;
	  };
	}

	//=======================FUNCTIONS========================//

	/**
	 * Updates number of row in the rowCounter of the View
	 * @param  
	 * @return
	 */
	var updateRowCounter = function () {
		$("#row_counter").html("Numero Risultati: "+$(".row_list:visible").length);
	};

	/**
	 * Gets hot keywords of a data row
	 * @param {Node} rowElem 
	 * @return {Array} keywords
	 */
	var getKeywordsFromRow = function (rowElem) {
		
		var keywords = [];
		
		rowElem.find("span:not(:has(*))").each(function () {
			keywords.push($(this).text().toLowerCase());
		});
		
		rowElem.find("span:has(input[type='hidden'])").each(function () {
			keywords.push($(this).text().toLowerCase());
		});

		rowElem.find("span input[type='text']").each(function () {
			keywords.push($(this).val().toLowerCase());
		});

		rowElem.find("option:selected").each(function () {
			keywords.push($(this).text().toLowerCase());
		});

		keywords = keywords.clean("");

		return keywords;
	}

	/**
	 * Search function
	 * @param 
	 * @return 
	 */
	var search = function () {
		var keyword = $(".basic_search input[type='text']").val();

		if (keyword) {								
			$(".row_list").each(function () {
				var show = false;
				var row_keywords = getKeywordsFromRow($(this));
				for (var i=0; i<row_keywords.length; i++) {
					if (!show) {
						if (row_keywords[i].indexOf(keyword.toLowerCase()) !== -1)
							show = true;
						else
							show = false;
					}
					if (show) 
						$(this).show();
					else 
						$(this).hide();
				}
			});
		}
		else {
			$(".row_list").show();
		}

		updateRowCounter();
	}

	/**
	 * Advanced Search function
	 * @param 
	 * @return 
	 */
	var advancedSearch = function () {
		var command = " "+$(".advanced_search input[type='text']").val().toLowerCase()+" ";
			command = command.replace(/ or /g," || ").replace(/ and /g," && ").replace(/ not /g," ! ").replace(/[ ]*\([ ]*/g," ( ").replace(/[ ]*\)[ ]*/g," ) ");

		var keywords = command.replace(/[\(\)]/g,"").replace(/ \&\& /g," ").replace(/ \|\| /g," ").replace(/ \! /g," ").replace(/\s{2,}/," ").split(" ");
			keywords = keywords.clean("");

		for (var i=0; i<keywords.length; i++) {
			var regex = new RegExp(" "+keywords[i]+" ","g");
			command = command.replace(regex,"(row_keywords.indexOf('"+keywords[i]+"') != -1)");
		}

		$(".row_list").each(function () {
			var row_keywords = getKeywordsFromRow($(this));
			if (eval(command))
				$(this).show();
			else
				$(this).hide();
		});

		updateRowCounter();
	}

	/**
	 * Opens the extra content of a row if it exists
	 * @param {Node} clicked
	 * @return 
	 */
	var expand = function (clicked) {

		var ms = 20;

		if (clicked.css("display") == "none") {
			var opened = $(".extra_info_wrapper:visible");

			opened.prev().css("background-color","#FFFFFF");
			// opened.prev().css("border-bottom","1px dashed #BBBBBB");
			// opened.prev().prev().prev().css("border-bottom","1px dashed #BBBBBB");

			clicked.prev().css("background-color","#FFE5B6");
			// clicked.prev().css("border-bottom","1px solid #BBBBBB");
			// clicked.prev().prev().prev().css("border-bottom","1px solid #BBBBBB");

			opened.slideUp(ms);

			clicked.slideDown(ms);

		} else {
			clicked.prev().css("background-color","#FFFFFF");
			clicked.prev().css("border-bottom","1px dashed #BBBBBB");
			clicked.prev().prev().prev().css("border-bottom","1px dashed #BBBBBB");
			clicked.slideUp(ms);
		}
	}

	//=======================EVENTS============================//

	/**
	 * Triggers check of the row when click on row
	 */
	$(".checkbox_list .row_list").click(function (e) {
			var checkbox = $(this).find("input[type='checkbox']");
				if (e.target === checkbox[0]) return;
				if (checkbox.prop("checked"))
					checkbox.prop("checked",false);
				else
					checkbox.prop("checked",true);
	});
	
	/**
	 * Trigger overlay whn click on submit to avoid double submits
	 */
	$("input[type='submit']").click(function () {
			$(".overlay").css("display","block");
	});

	/**
	 * Triggers check of checkboxs by clicking on a "check all" check 
	 */
	$("#checkall").click(function () {

		var boxes = $(".list input[type='checkbox']");
		var checked = $(this).prop("checked") ? true : false;

		boxes.each(function () {
			if ($(this).parent().parent().css("display") != "none")
				$(this).prop("checked", checked);
		});

	});

	/**
	 * On window scroll 
	 */
	$(window).scroll(function () {
		var y = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
		
		//  todo: se stringo la finestra su asse Y, e scrollo ... BUG!
		y = y < document.height ? y : document.height;

		if (y > 85)
			$("#menu").css("margin-top",(y-85)+"px");
		else
			$("#menu").css("margin-top","0px");
	});

	/**
	 * Trigger Search function
	 */
	$("#basic_search_button").click(function () {
		search();
	});
	
	/**
	 * If press Enter in search textbox trigger search function
	 */
	$(".basic_search input[type='text']").keydown(function (e) {
		if(e.keyCode == 13) search();
	});

	/**
	 * Trigger Advanced Search function
	 */
	$("#advanced_search_button").click(function () {
		advancedSearch();
	});

	/**
	 * If press Enter in search textbox trigger advanced search function
	 */
	$(".advanced_search input[type='text']").keydown(function (e) {
		if(e.keyCode == 13) advancedSearch();
	});

	/**
	 * Switch in between basic and advanced search
	 */
	$(".search_label").click(function () {

		var basic_search = $(".basic_search"),
			advanced_search = $(".advanced_search");

		if (advanced_search.css("display") == "none") {
			basic_search.children().hide();
			advanced_search.children().show();
			advanced_search.slideDown();
		}
		else {
			advanced_search.slideUp();
			advanced_search.children().hide();
			basic_search.children().show();
		}
	});
	
	/**
	 * Trigger the expand when click on row
	 */
	$(".row_list").click(function () {
		var clicked = $(this).next(".extra_info_wrapper");
		expand(clicked);	
	});

	/**
	 * Trigger the expand keydown left or right
	 */
	$("body").keydown(function(e) {
		if (typeof this.timer !== "undefined") clearTimeout(this.timer);
		
		this.timer = window.setTimeout(function () {
			
			if(e.keyCode == 37)	{		// left
	    		var clicked = $(".extra_info_wrapper:visible").prev(".row_list:visible").next("li");
	    		expand(clicked);
	    	} 
	  		else if(e.keyCode == 39) {	// right
	    		var clicked = $(".extra_info_wrapper:visible").next(".row_list:visible").next("li");
	    		console.log(clicked);
	    		expand(clicked);
	    	}
	    	
	  	},20);
	});

	updateRowCounter();

});

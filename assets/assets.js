$("body").ready(function () {

	Array.prototype.clean = function(deleteValue) {
		for (var i = 0; i < this.length; i++) {
			if (this[i] == deleteValue) {         
				this.splice(i, 1);
				i--;
			}
		}	
		return this;
	};

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

	var updateRowCounter = function () {
		$("#row_counter").html("Numero Risultati: "+$(".row_list:visible").length);
	};

	updateRowCounter();
	
	$(".checkbox_list .row_list").click(function (e) {
			var checkbox = $(this).find("input[type='checkbox']");
				if (e.target === checkbox[0]) return;
				if (checkbox.prop("checked"))
					checkbox.prop("checked",false);
				else
					checkbox.prop("checked",true);
	});

	$("input[type='submit']").click(function () {
			$(".overlay").css("display","block");
	});

	$("#checkall").click(function () {

		var boxes = $(".list input[type='checkbox']");
		var checked = $(this).prop("checked") ? true : false;

		boxes.each(function () {
			if ($(this).parent().parent().css("display") != "none")
				$(this).prop("checked", checked);
		});

	});

	$(window).scroll(function () {
		var y = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
		
		//  todo: se stringo la finestra su asse Y, e scrollo ... BUG!
		y = y < document.height ? y : document.height;

		if (y > 85)
			$("#menu").css("margin-top",(y-85)+"px");
		else
			$("#menu").css("margin-top","0px");
	});

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

		// keywords = keywords.filter(function(n){return n});
		keywords = keywords.clean("");

		return keywords;
	}

	var search = function () {
		var keyword = $(".basic_search input[type='text']").val();

		$(".row_list").each(function () {
			var row_keywords = getKeywordsFromRow($(this));
			if (row_keywords.indexOf(keyword.toLowerCase()) != -1)
				$(this).show();
			else
				$(this).hide();
		});

		updateRowCounter();
	}

	var advancedSearch = function () {
		var command = " "+$(".advanced_search input[type='text']").val().toLowerCase()+" ";
			command = command.replace(/ or /g," || ").replace(/ and /g," && ").replace(/ not /g," ! ").replace(/[ ]*\([ ]*/g," ( ").replace(/[ ]*\)[ ]*/g," ) ");

		var keywords = command.replace(/[\(\)]/g,"").replace(/ \&\& /g," ").replace(/ \|\| /g," ").replace(/ \! /g," ").replace(/\s{2,}/," ").split(" ");
			// keywords = keywords.filter(function(n){return n});
			keywords = keywords.clean("");

		for (var i=0; i<keywords.length; i++) {
			var regex = new RegExp(" "+keywords[i]+" ","g");
			command = command.replace(regex,"(row_keywords.indexOf('"+keywords[i]+"') != -1)");
		}

		console.log(command);

		$(".row_list").each(function () {
			var row_keywords = getKeywordsFromRow($(this));
			if (eval(command))
				$(this).show();
			else
				$(this).hide();
		});

		updateRowCounter();
	}

	$(".search_panel input").click(function () {
		var nrows = $(".row_list").length;
		if (nrows > 1000) 
			alert("Il numero di elementi sulla quale si sta' per effettuare una ricerca e' molto alto, quindi la ricerca potrebbe richiedere un tempo maggiore del solito. La preghiamo di essere paziente. ");
	});

	
	$("#basic_search_button").click(function () {
		search();
	});

	$(".basic_search input[type='text']").keydown(function (e) {
		if(e.keyCode == 13) search();
	});

	$("#advanced_search_button").click(function () {
		advancedSearch();
	});

	$(".advanced_search input[type='text']").keydown(function (e) {
		if(e.keyCode == 13) advancedSearch();
	});
	
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

	$(".row_list").click(function () {
		var clicked = $(this).next(".extra_info_wrapper");
		expand(clicked);	
	});

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
});

(function($) {
	
"use strict";
	
window.app = {
		
		defaults: {
			itemCountPerPage: 30,
			dateFormat: 'yyyy-mm-dd hh:ii'
		},
		
		// for module variables
		variables: {},
		
		user: {},
		
		_: function(text) {
			return text;
		},
			
		init: function() {
			
			var me = this;
			
			me.user = window.user || {};
			
			/* Tooltip */
			$(".tooltips").tooltip();

			/* Modal script */ 
			/* Clear modal when hidden */
			$('body').on('hidden.bs.modal', '.modal', function () {
					$(this).removeData('bs.modal');
			});	
			/* Show modal form */
			$('body').on('click', '#modal-link',
					function(e) {
						$('#formModal').remove();
						e.preventDefault();
						var $this = $(this)
			                , $remote = $this.data('remote') || $this.attr('href')
			                , $modal = $('<div class="modal fade" id="formModal"><div class="modal-body"></div></div>');
						
						var menu = $('body').find('input#menuName').val();
							$remote+='&menuName='+menu;

							$('body').append($modal);
						$modal.modal({backdrop: 'static', keyboard: false});
						$modal.load($remote);
		            }
			);	
			$("body").on("shown.bs.modal", function (e) {
					$(".tooltips").tooltip();
			});
			
			$(window).unload(function() {
				//me.startLoadingBar();
			})
		},
		
		startLoadingBar: function() {
			if ($("#loadingbar").length === 0) {
				var percentage = (30 + Math.random() * 30);
	            $("body").append("<div id='loadingbar'></div>")
	            $("#loadingbar").addClass("waiting").append($("<dt/><dd/>"));
	            $("#loadingbar").width(percentage.toString() + "%");
			}
		},
		
		stopLoadingBar: function() {
			$("#loadingbar").width("101%").delay(600).fadeOut(400, function() {
				$(this).remove();
	       });
		},
			
		baseUrl: function(part) {
			return APPLICATION_HOST + '/' + part;
		},
			
		getUser: function() {
			
		},
		
		getUserDisplayName: function(user) {
			return user.fname + ' ' + user.lname;
		},
		
		setLang: function() {
			
		},
		
		toCamelCase: function(text) {
			return text.replace(/(\-[a-z])/g, function($1){return $1.toUpperCase().replace('-','');});
		},
		
		getFileExtension: function(filename) {
			return filename.split('.').pop();
		}
		
	};

	//app.startLoadingBar();
	$(function()  {
		app.init();
		app.stopLoadingBar();
	});	
	
})(jQuery);
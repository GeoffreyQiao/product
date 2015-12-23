jQuery(document).ready(function() {
	$('#title-h').css({
		display:'none'
	});
	$('body').css({
		'background-color': '#4a4a4a',
		color: '#f02222',
		margin:'0'
	});
	$('.nav-item').css({
		display: 'inline-block',
		width: '7rem',
		'line-height':'5vh',
		height: '100%',
	}).parent().css({
		height: '5vh',
		'background-color':'black'
		});
	$('.confirm .confirm-btn').button();
	$('.nav-item').click(function(e) {
		var page = {
			home:'index.html',
			baseData:'based.html'
			/*.....*/
		}

		if ($(this).attr('name')) {
			$.ajax({
				url: 'd:/www/admin/index.php',
				type: 'GET',
				data: {cat: 'admin'}
			})
			.success(function(r,s,x) {
				alert(r);
			});

		};
	});

	$('#saleBar').dialog({
		autoOpen:true,
		modal:true,
		resize:false,
		width:'50vw',
		'min-height':500,
		title:'前台'
	});

	$('#saleBar').tooltip({
		show:false,
		position:{
			at:'right center',
			my:'left+10 center'
		}
	}).on('focusout','#barCode[title]',function(e) {
		// $(this).parent().children('.content').load("index.php",'Con=addProducts',function(r,s,x){
		// 	if (s =="success" ) {
		// 		alert(r.size());

		// 		return $('#saleBar .confirm').show();
		// 	};
		// });
		// $('.content form [title]').tooltip();

		$.ajax({
			url: 'index.php',
			data: {Con: 'addProducts'},
			success:function(r,s,x) {
				e = $('#saleBar');
				if (r == false) {
					e.children('.confirm').show();
				}else{
					e.children('.content').html(r);
				};
			}
		})

	})
});

jQuery(document).ready(function() {
	$('#title-h').css({
		display:'none'
	});
	$('body').css({
		backgroundColor: '#4a4a4a',
		color: '#f02222',
		margin:'0'
	});
	$('.nav-item').css({
		display: 'inline-block',
		width: '7rem',
		lineHeight:'5vh',
		height: '100%',
	}).parent().css({
		height: '5vh',
		backgroundColor:'black'
		});
	$('.confirm .confirm-btn,#addproduct .add-btn').button();
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
		minHeight:500,
		title:'前台'
	});

	$('#saleBar').tooltip({
		show:false,
		position:{
			at:'right center',
			my:'left+10 center'
		}
	}).on('focusout','#barCode[title]',function(e) {
		$.ajax({
			url: 'index.php',
			data: {
				Con: 'FindProducts',
				Code: $(this).val()
			},
			success:function(r,s,x) {
				g = $('#saleBar');
				if (r == false) {
					g.children('.confirm').show();
				}else{
					g.children('.content').html(r).find('button').button();
				};
			}
		});

		$('#saleBar').delegate(".confirm-btn","click",function(event) {
			if (event.currentTarget.id=="confirm-btn-1") {
				$('.confirm').hide();
				$.ajax({
					url: 'index.php',
					data: {Con: 'AddProducts'},
					success: function(r,s,x){
						$('#saleBar>.content').html(r).find('button').button();
						}
					});
			} else {
				$('.confirm').hide();
			}
		})
	})


});

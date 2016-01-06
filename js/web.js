
$(function () {
    DoProduct = {
        'pDataName': Array[
            'pBrand',
            'pName',
            'barCode',
            'pSpec',
            'pNum',
            'pPrice'
        ],
        'Id' : 0,
        'cateId' : 0,
        'getProduct' : function () {
            $.each(this.pDataName, function (index, val) {
                var itemDom = $('.ap-items[name=' + val + ']');
                if (itemDom == 'undefined') {
                    this.val() = null;
                } else {
                    this.val() = itemDom.val();
                }
            });
            this.isSale = $('.ap-items[name=isSale]').val();
        },
        'showDetail' : function () {
            if (this.Id === 0) {
                this.getProduct();
            }
            // var tt = this.pDataName[1];
            // alert(this[tt]);

            var arr = '\n',
            ss;
            var n = this.pDataName.length;
            // for (i=0,i<n;i++) {
            // 	ss = this.pDataName[i];
            // 	arr+= ss+':'+this[ss]+'\n';
            // };
            $this.each(function (index, val) {
                var name = call()
                arr += val + ':' + this.val + ':' + '\n';
            });
            alert(arr);
        }
        // this.cateId		= pData.cateId;
        // this.pBrand		= pData.pBrand;
        // this.pName		= pData.pName;
        // this.barCode	= pData.barCode;
        // this.pSpec		= pData.pSpec;
        // this.pNum		= pData.pNum;
        // this.pPrice		= pData.pPrice;
        // this.isSale		= pData.isSale;
    };


    $('#title-h').css({
        display: 'none'
    });
    $('body').css({
        backgroundColor: '#4a4a4a',
        color: '#f02222',
        margin: '0'
    });
    $('.nav-item').css({
        display: 'inline-block',
        width: '7rem',
        lineHeight: '5vh',
        height: '100%',
    }).parent().css({
        height: '5vh',
        backgroundColor: 'black'
    });
    $('.confirm .confirm-btn,#addproduct .add-btn').button();
    $('.nav-item li').click(function (event) {
        var pageId = $(this).attr('id');
        var pageLoad = function (page) {
            $('#contants').load('../tpls/' + page + '.html');
        }
        switch (pageId) {
            case 'pManage':
                pageLoad('AddProducts');
                break;
        }
    }).button();
    $('#contants').on('click', '#rightBar>#btn', function (event) {
        var item = new DoProduct();
        item.showDetail();
        // alert('haha');
    });
    $('#saleBar').dialog({
        autoOpen: false,
        modal: true,
        resize: false,
        width: '50vw',
        minHeight: 500,
        title: '前台'
    });
    $('#saleBar').tooltip({
        show: false,
        position: {
            at: 'right center',
            my: 'left+10 center'
        }
    }).on('focusout', '#barCode[title]', function (e) {
        $.ajax({
            url: 'index.php',
            data: {
                Con: 'FindProducts',
                Code: $(this).val()
            },
            success: function (r, s, x) {
                g = $('#saleBar');
                if (r == false) {
                    g.children('.confirm').show();
                    // if (g.children('.content').show()) {
                    // 	g.children('.content').hide();
                    // };
                } else {
                    g.children('.content').html(r).find('button').button();
                };
            }
        });
        $('#saleBar').delegate('.confirm-btn', 'click', function (event) {
            if (event.currentTarget.id == 'confirm-btn-1') {
                $('.confirm').hide();
                $.ajax({
                    url: 'index.php',
                    data: {
                        Con: 'AddProducts'
                    },
                    success: function (r, s, x) {
                        $('#saleBar>.content').html(r).find('button').button();
                    }
                });
            } else {
                $('.confirm').hide();
            }
        })
    })
    //商品对象
    // var product{
    // 	Id:
    // }
});
/*
[object Object]
*/

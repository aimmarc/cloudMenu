$(function () {
    function init() {
        bindEvents();
    }
    
    function bindEvents() {
        $('#btnAdd').click(function () {
            addFood();
        });
        $('#btnRemove').click(function () {
            removeFood();
        })
    }
    
    function addFood() {
        layer.open({
            title:'菜品-新增',
            type:1,
            content:$('#addForm'),
            area: ['320px'],
            shadeClose: true,
            btn:['确定','取消'],
            yes:function () {
                $.ajax({
                    url:'server/sysManager/food.php?action=addFood',
                    type:'POST',
                    dataType:'json',
                    data:{foodName:$('#foodName').val(),foodCode:$('#foodCode').val(),foodPrice:$('#foodPrice').val(),desc:$('#foodDesc').val()},
                    success:function (res) {
                        if(res){
                            if(res.code==0){
                                $('#foodGrid').datagrid('reload');
                                layer.msg('菜品新增成功',{time:1000});
                                layer.closeAll();
                            }
                        }
                    },
                    error:function (e) {

                    }
                })
            }
        })
        /*$.ajax({
            url:'server/sysManager/food.php?action=addFood',
            type:'POST',
            dataType:'json',
            data:{foodName:'菜品名称',foodCode:'CPMC',foodPrice:'25',desc:'测试而已'},
            success:function (res) {
                if(res){
                    if(res.code==0){
                        $('#foodGrid').datagrid('reload');
                    }
                }
            },
            error:function (e) {

            }
        })*/
    }

    function removeFood() {
        var rows = $('#foodGrid').datagrid('getSelected');
        if(!rows){layer.msg('请选择要删除的菜品',{time:1000});return}

        layer.confirm('确认删除？', {
            btn: ['确认','取消'] //按钮
        }, function(){
            $.ajax({
                url:'server/sysManager/food.php?action=removeFood',
                type:'POST',
                dataType:'json',
                data:{id:$('#foodGrid').datagrid('getSelected').id},
                success:function (res) {
                    if(res){
                        if(res.code==0){
                            layer.msg('删除成功',{time:1000});
                            $('#foodGrid').datagrid('reload');

                        }else{

                        }
                    }
                },
                error:function (e) {

                }
            })
        }, function(){
            layer.closeAll();
        });
    }
    
    $(document).ready(function () {
        init();
    })
})
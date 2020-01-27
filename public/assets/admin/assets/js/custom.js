$( document ).ready(function() {
    $("#Dont").tooltip();
    $('#datetimepicker1').datetimepicker();
    $('.delete-article').on('click',function(){
        const id = $(this).attr('data-id');
        if(confirm("Are you sure you want to delete"))
        {
            $.ajax({
                url:"/admin/article/delete/"+id,
                method: "DELETE",
                success:function(){
                             document.location.reload(true);
                             alert("Successfuly deleted");
                         }
            })
        }
    })
    $('.delete-account').on('click',function(){
        const id = $(this).attr('data-id');
        if(confirm("Are you sure you want to delete"))
        {
            $.ajax({
                url:"/admin/account/delete/"+id,
                method: "DELETE",
                success:function(){
                             document.location.reload(true);
                             alert("Successfuly deleted");
                         }
            })
        }
    })
    $('.delete-category').on('click',function(){
        const id = $(this).attr('data-id');
        if(confirm("Are you sure you want to delete?"))
        {
            $.ajax({
                url:"/admin/category/delete/"+id,
                method:"DELETE",
                success:function(){
                    document.location.reload(true)
                    alert("Successfuly Deleted");
                }
            })
        }
    })
    $('.delete-shiptype').on('click',function(){
        const id = $(this).attr('data-id');
        if(confirm("Are you sure you want to delete?"))
        {
            $.ajax({
                url:"/admin/shiptype/delete/"+id,
                method:"DELETE",
                success:function(){
                    document.location.reload(true)
                    alert("Successfuly Deleted");
                }
            })
        }
    })
    $('.delete-shipticket').on('click',function(){
        const id = $(this).attr('data-id');
        if(confirm("Are you sure you want to delete?"))
        {
            $.ajax({
                url:"/admin/shiptype/delete/"+id,
                method:"DELETE",
                success:function(){
                    document.location.reload(true)
                    alert("Successfuly Deleted");
                }
            })
        }
    })
    $('.delete-shipschedule').on('click',function(){
        const id = $(this).attr('data-id');
        if(confirm("Are you sure you want to delete?"))
        {
            $.ajax({
                url:"/admin/shipschedule/delete/"+id,
                method:"DELETE",
                success:function(){
                    document.location.reload(true)
                    alert("Successfuly Deleted");
                }
            })
        }
    })
});

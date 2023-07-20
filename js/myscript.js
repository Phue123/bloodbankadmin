$(document).ready(function(){
    $(document).on('click','.vbtn',function(e){
        e.preventDefault();
            let id=$(this).parent().attr('id');
           console.log(id);
           $.ajax({
            method:'post',
            url:'set_otp.php',
            data:{id:id},
            success:function(response){
                if(response="success"){
                    alert('successfully')
                    location.href="login.php";
                }
            },
            error:function(error){

            }
           })
    })
})
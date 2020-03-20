document.addEventListener('DOMContentLoaded', function(){

})

function isOnline(titleFailure, msgFailure, titleSuccess, msgSuccess){
   window.addEventListener('online', function() {
        iziToast.success({
            title: titleSuccess,
            message: msgSuccess,
            position: "topRight"

        });
    })
    window.addEventListener('offline', function(){
        iziToast.error({
            title: titleFailure,
            message: msgFailure,
            position: "topRight"
        });
    })
}

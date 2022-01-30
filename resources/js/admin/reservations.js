

(function(){
    console.log('reservation js');
})

$(document).on('click', '#bookingGenerateBtn', function(){
    console.log('test click!!!');
});


function generateReservation(){
    return new Promise(function(resolve, reject){
        $.ajax({
            url: "",
            dataType: 'JSON',
            data,
            success: res => resolve(res),
            error: err => reject(err)
        });
    });
}

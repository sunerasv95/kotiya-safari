// require('bootstrap');
$(function(){
    var checkInDatePicker = $('#check-in-datepicker');
    var checkOutDatePicker = $('#check-out-datepicker');

    setTimeout(() => {
        if ($(".alert-danger").hasClass("show")) {
            $(".alert-danger").removeClass("show").addClass("fade").remove();
        }
        if ($(".alert-success").hasClass("show")) {
            $(".alert-success").removeClass("show").addClass("fade").remove();
        }
    }, 8000);

    checkInDatePicker.datepicker({
        format: 'mm/dd/yyyy',
        startDate: "-1d",
    });

    checkOutDatePicker.datepicker({
        format: 'mm/dd/yyyy'
    });

    console.log('on load');
})

var inquiryModal = document.getElementById('reservation-inquiry-modal');

inquiryModal.addEventListener('show.bs.modal', function (event) {
    fetchCountries()
        .then(function (res) {
            //console.log('res', res);
            var opts = [];
            res?.data.forEach(c => {
                //console.log('c', c);
                var opt = `<option value='${c.abbreviation}'>${c.country}</option>`;
                opts.push(opt);
            });

            $('#country').append(opts);
        })
        .catch(function (err) {
            console.log('err', err);
        });
});

inquiryModal.addEventListener('hidden.bs.modal', function (event) {
    // fetchCountries()
    //     .then(function (res) {
    //         console.log('res', res);
    //         var opts = [];
    //         res?.data.forEach(c => {
    //             console.log('c', c);
    //             var opt = `<option value='${c.abbreviation}'>${c.country}</option>`;
    //             opts.push(opt);
    //         });

    //         $('#country').append(opts);
    //     })
    //     .catch(function (err) {
    //         console.log('err', err);
    //     });
    console.log('closed');
    var validator = $('#inquiry-form').validate();
    validator.resetForm();
});


$(document).on('click', '#inquiry-submit', function () {
    $('#inquiry-form').validate({
        rules: {
            full_name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            check_in: {
                required: true,
                date: true
            },
            check_out: {
                required: true,
                date: true
            },
            flexible_dates: {
                required: false
            },
            no_adults: {
                required: true
            },
            no_kids: {
                required: true
            },
            country: {
                required: true
            },
            tc_agreed: {
                required: true
            }
        },
        submitHandler: function (form) {
            var button = $('#inquiry-submit');
            showButtonSpinner(button);
            submitInquiry(form)
                .then(function(res){
                    console.log("inquiry res", res);
                    if(!res?.error){
                        setTimeout(function(){
                            hideButtonSpinner(button, "Submit Inquiry");
                            $('#reservation-inquiry-modal').modal('toggle');
                            if(res?.data?.callback_url) location.href = res?.data?.callback_url;
                        }, 1500);
                    }
                })
                .catch(function(err){
                    hideButtonSpinner(button, "Submit Inquiry");
                    if(err?.responseJSON?.errors){
                        var validatorErrors = {};
                        var es = err?.responseJSON?.errors;
                        Object.entries(es).forEach((e, i) => {
                            validatorErrors[e[0]] = e[1][0];
                        });
                        var validator = $( "#inquiry-form" ).validate();
                        validator.showErrors(validatorErrors);
                    }
                });
        },
        errorClass: "is-invalid",
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            error.appendTo(element.parents(".form-group"));
        }
    });
});


function showButtonSpinner(btnElement){
    if(btnElement.length){
        btnElement
            .attr("disable", "disable")
            .html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='px-1'>Submiting...</span>");
    }
}

function hideButtonSpinner(btnElement, btnText){
    if(btnElement.length){
        btnElement
            .removeAttr("disable", "disable")
            .empty()
            .text(btnText);
    }
}

function fetchCountries() {
    return new Promise(function (resolve, reject) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            url: "/guest/countries",
            dataType: "JSON",
            type: "GET",
            success: function (res) {
                resolve(res);
            },
            error: function (err) {
                reject(err);
            }
        });
    });
}

function submitInquiry(form){
    return new Promise(function (resolve, reject) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            url: "/inquiries/submitRequest",
            dataType: "JSON",
            type: "POST",
            data: $("#inquiry-form").serialize(),
            success: function (res) {
                resolve(res);
            },
            error: function (err) {
                reject(err);
            }
        });
    });
}

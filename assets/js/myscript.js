$('.buttonDelete').on('click', function(e){
    e.preventDefault();
    const href = $(this).attr('href');

    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        buttons:{
            confirm: {
                text : 'Yes, delete it!',
                className : 'btn btn-success'
            },
            cancel: {
                visible: true,
                className: 'btn btn-danger'
            }
        }
    }).then((Delete) => {
        if (Delete) {
            document.location.href = href;
        } else {
            swal.close();
        }
    });
});

$('.buttonResetPassword').on('click', function(e){
    e.preventDefault();
    const href = $(this).attr('href');

    swal({
        title: 'Are you sure?',
        // text: "You won't be able to revert this!",
        type: 'warning',
        buttons:{
            confirm: {
                text : 'Yes, reset it!',
                className : 'btn btn-success'
            },
            cancel: {
                visible: true,
                className: 'btn btn-danger'
            }
        }
    }).then((ResetPassword) => {
        if (ResetPassword) {
            document.location.href = href;
        } else {
            swal.close();
        }
    });
});

$('.buttonAddStock').on('click', function(e){
    e.preventDefault();
    const href = $(this).attr('href');

    swal({
        title: 'Are you sure?',
        // text: "You won't be able to revert this!",
        type: 'warning',
        buttons:{
            confirm: {
                text : 'Yes!',
                className : 'btn btn-success'
            },
            cancel: {
                visible: true,
                className: 'btn btn-danger'
            }
        }
    }).then((AddStock) => {
        if (AddStock) {
            document.location.href = href;
        } else {
            swal.close();
        }
    });
});

$(document).ready(function() {
    $('#basic-datatables').DataTable({
    });

    // $('#TabelOrder').DataTable({
    // });

    $('#tables').DataTable({
        "pageLength": 10,
    });

    $('.select2').select2()
});


// var rupiah = document.getElementById("payment");
// rupiah.addEventListener("keyup", function(e){
//     rupiah.value = convertRupiah(this.value, "Rp. ");
// });
// rupiah.addEventListener("keydown", function(event){
//     return isNumberKey(event);
// });

// function convertRupiah(angka, prefix){
//     var number_string = angka.replace(/[^,\d]/g, "").toString(),
//     split = number_string.split(","),
//     sisa = split[0].length % 3,
//     rupiah = split[0].substr(0, sisa),
//     ribuan = split[0].substr(sisa).match(/\d{3}/gi);

//     if(ribuan){
//         separator = sisa ? "." : "";
//         rupiah += separator + ribuan.join(".");
//     }

//     rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
//     return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
// }

// function isNumberKey(evt){
//     key = evt.which || evt.keyCode;
//     if(key != 188 && key != 8 && key != 17 && key != 86 && key != 67 && (key < 48 || key > 57)){
//         evt.preventDefault();
//         return;
//     }
// }
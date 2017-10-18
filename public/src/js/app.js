var clientId = 0;
var clientNameElement = null;
var clientCompanyElement = null;
var clientEmailElement = null;
var clientPhoneElement = null;
$('.panel').find('.div-body-modal').find('.div-add-client-modal').find('#add-client-modal-btn').on('click', function(event){
    event.preventDefault();
    $("#addClientForm")[0].reset();
    $(".form-group").removeClass('has-error');
    $("h6.editErrorRed").html('');
    $('#addClientsModal').modal();
});

$('#add_client_modal_save').on('click', function () {
    $.ajax({
        method: 'POST',
        url:urlAddClient,
        data:{
            client_name: $('#client_name').val(),
            client_company: $('#client_company').val(),
            client_email: $('#client_email').val(),
            client_phone: $('#client_phone').val(),
            _token: token},
            error: function(data){
            var errors = data.responseJSON;
            console.log('Json:');
            console.log(errors);
            var stringify = JSON.stringify(errors);
            console.log('Strigfied:');
            console.log(stringify);
            }
    }).done(function () {
        $('#addClientsModal').modal('hide');
        atable.ajax.reload(null, false);
        //$(location).attr('href',urlGetClient);
    }).fail(function(jqXHR, textStatus, errorThrown) {

        console.log('Text Status:');
        console.log(textStatus);
        console.log('Error Thrown:');
        console.log(errorThrown);
        console.log('jqXHR:');
        console.log(jqXHR.responseText);
        var responseError = JSON.parse(jqXHR.responseText);

        $.each(responseError, function(k, v) {
            console.log('Key:');
            console.log(k);
            console.log('Value:');
            console.log(v[0]);
            $('input#' + k).closest('.form-group').addClass('has-error');
            $('div#error_add-'+ k +' h6').html(v[0]);
        });


        //  edit-client_phone
    });


});
$('.panel').find('.div-body-modal').find('.table').find('.btn-group').find('.dropdown-menu').find('#edit-client-modal-btn').on('click', function(event){
    event.preventDefault();
    clientId = event.target.dataset['clientid'];
    clientNameElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[1];
    clientCompanyElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[3];
    clientEmailElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[5];
    clientPhoneElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[7];
    var clientName = clientNameElement.textContent;
    var clientCompany = clientCompanyElement.textContent;
    var clientEmail = clientEmailElement.textContent;
    var clientPhone = clientPhoneElement.textContent;
    $('#edit-client_name').val(clientName);
    $('#edit-client_company').val(clientCompany);
    $('#edit-client_email').val(clientEmail);
    $('#edit-client_phone').val(clientPhone);
    $(".form-group").removeClass('has-error');
    $("h6.editErrorRed").html('');
    $('#edit-client-modal').modal();
});

$('#edit-clients-btn').on('click', function () {
    $.ajax({
        method:'post',
        url:urlEditClient,
        data:{client_name: $('#edit-client_name').val(), client_company: $('#edit-client_company').val(), client_email: $('#edit-client_email').val(), client_phone: $('#edit-client_phone').val(), id: clientId, _token: token}
    }).done(function (msg) {
        $(clientNameElement).text(msg['client_name']);
        $(clientCompanyElement).text(msg['client_company']);
        $(clientEmailElement).text(msg['client_email']);
        $(clientPhoneElement).text(msg['client_phone']);
        $('#edit-client-modal').modal('hide');
    }).fail(function(jqXHR, textStatus, errorThrown) {

        console.log('Text Status:');
        console.log(textStatus);
        console.log('Error Thrown:');
        console.log(errorThrown);
        console.log('jqXHR:');
        console.log(jqXHR.responseText);
       var responseError = JSON.parse(jqXHR.responseText);

        $.each(responseError, function(k, v) {
            console.log('Key:');
            console.log(k);
            console.log('Value:');
            console.log(v[0]);
            $('input#edit-' + k).closest('.form-group').addClass('has-error');
            $('div#error_edit-'+ k +' h6').html(v[0]);
        });


      //  edit-client_phone
    });
});
$('.panel').find('.div-body-modal').find('.table').find('.btn-group').find('.dropdown-menu').find('#remove-client-modal-btn').on('click', function(event){
    event.preventDefault();
    clientId = event.target.dataset['clientid'];
    $('#delete-clients-modal').modal();
});

$('#delete-clients-btn').on('click', function () {
    console.log(clientId);
    $.ajax({
        method:'post',
        url:urlDeleteClient,
        data:{id: clientId, _token: token}
    }).done(function (msg) {
        $('#delete-clients-modal').modal('hide');
    });
    $(location).attr('href',urlGetClient);
});

$('#show-btn').on('click', function () {
    //$('#form1').css('display','block');
    $('#form1').fadeToggle(500);
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////CATEGORY////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var categoryId = 0;
var categoryNameElement = null;
var categoryDescriptionElement = null;
$('.panel').find('.div-body-modal').find('.div-add-category-modal').find('#add-category-modal-btn').on('click', function(event){
    event.preventDefault();
    $('#addCategoryModal').modal();
});
$('#add_category_modal_save').on('click', function () {
    $.ajax({
        method: 'POST',
        url:urlAddCategory,
        data:{
            category_name: $('#category_name').val(),
            category_description: $('#category_description').val(),
            _token: token}
    }).done(function () {
        $('#addCategoryModal').modal('hide');
        //$('#datatable').ajax.reload(null, true);
        $(location).attr('href',urlGetCategory);
    });
});

$('.panel').find('.div-body-modal').find('.table').find('.btn-group').find('.dropdown-menu').find('#edit-category-modal-btn').on('click', function(event){
    event.preventDefault();
    categoryId = event.target.dataset['productid'];
    categoryNameElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[1];
    categoryDescriptionElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[3];
    var categoryName = categoryNameElement.textContent;
    var categoryDescription = categoryDescriptionElement.textContent;
    $('#edit-category_name').val(categoryName);
    $('#edit-category_description').val(categoryDescription);
    $('#edit-category-modal').modal();
});
$('#edit-categories-btn').on('click', function () {
    $(".clean-edit-category").html('');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method:'post',
        url:urlEditCategory,
        data:{category_name: $('#edit-category_name').val(), category_description: $('#edit-category_description').val(), id: categoryId, _token: token}

    }).fail(function(error) {
        console.log('Error:');
        console.log(error);
    }).done(function (msg) {
        $(".edit-categories-footer").addClass('div-hide');
        $("#edit-category-msg").html('<p class="text-success clean-edit-category" style="text-align: center"> تم التحديث بنجاح </p>');
        setTimeout(function() {$('#edit-category-modal').modal('hide');}, 600);
    });
});



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////PRODUCTS///////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var productId = 0;
var productNameElement = null;
var productDescriptionElement = null;
var productQuantityElement = null;
var productUnitElement = null;
var unitPriceElement = null;
var initPriceElement = null;


$('.panel').find('.div-body-modal').find('.div-add-product-modal').find('#add-product-modal-btn').on('click', function(event){
    event.preventDefault();
    $('#addProductsModal').modal();
});

$('#add_product_modal_save').on('click', function () {
    $.ajax({
        method: 'POST',
        url:urlAddProduct,
        data:{
            product_name: $('#product_name').val(),
            product_description: $('#product_description').val(),
            product_quantity: $('#product_quantity').val(),
            product_unit: $('#product_unit').val(),
            unit_price: $('#unit_price').val(),
            init_price: $('#init_price').val(),
            _token: token},
        error: function(data){
            var errors = data.responseJSON;
            console.log('Json:');
            console.log(errors);
            var stringify = JSON.stringify(errors);
            console.log('Strigfied:');
            console.log(stringify);
        }
    }).done(function () {
        $('#addProductsModal').modal('hide');
        $('#datatable').ajax.reload(null, true);
        //$(location).attr('href',urlGetProduct);
    });


});
$('.panel').find('.div-body-modal').find('.table').find('.btn-group').find('.dropdown-menu').find('#edit-product-modal-btn').on('click', function(event){
    event.preventDefault();
    productId = event.target.dataset['productid'];
    productNameElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[1];
    productDescriptionElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[3];
    productQuantityElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[5];
    productUnitElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[7];
    unitPriceElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[9];
    initPriceElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[11];
    var productName = productNameElement.textContent;
    var productDescription = productDescriptionElement.textContent;
    var productQuantity = productQuantityElement.textContent;
    var productUnit = productUnitElement.textContent;
    var unitPrice = unitPriceElement.textContent;
    var initPrice = initPriceElement.textContent;
    $('#edit-product_name').val(productName);
    $('#edit-product_description').val(productDescription);
    $('#edit-product_quantity').val(productQuantity);
    $('#edit-product_unit').val(productUnit);
    $('#edit-unit_price').val(unitPrice);
    $('#edit-init_price').val(initPrice);
    $('#edit-product-modal').modal();
});

$('#edit-products-btn').on('click', function () {
    $.ajax({
        method:'post',
        url:urlEditProduct,
        data:{product_name: $('#edit-product_name').val(), product_description: $('#edit-product_description').val(), product_quantity: $('#edit-product_quantity').val(), product_unit: $('#edit-product_unit').val(), unit_price: $('#edit-unit_price').val(), init_price: $('#edit-init_price').val(), id: productId, _token: token}
    }).done(function (msg) {
        $(productNameElement).text(msg['product_name']);
        $(productDescriptionElement).text(msg['product_description']);
        $(productQuantityElement).text(msg['product_quantity']);
        $(productUnitElement).text(msg['product_unit']);
        $(unitPriceElement).text(msg['unit_price']);
        $(initPriceElement).text(msg['init_price']);
        $('#edit-product-modal').modal('hide');
    });
});
$('.panel').find('.div-body-modal').find('.table').find('.btn-group').find('.dropdown-menu').find('#remove-product-modal-btn').on('click', function(event){
    event.preventDefault();
    productId = event.target.dataset['productid'];
    $('#delete-products-modal').modal();
});

$('#delete-products-btn').on('click', function () {
    console.log(productId);
    $.ajax({
        method:'post',
        url:urlDeleteProduct,
        data:{id: clientId, _token: token}
    }).done(function (msg) {
        $('#delete-product-modal').modal('hide');
    });
    $(location).attr('href',urlGetProduct);
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////ORDERS/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//var id = null;
function addRow() {
    $("#addRowBtn").button("loading");

    var tableLength = $("#productTable tbody tr").length;
    var tableRow;
    var arrayNumber;
    var count;

    if(tableLength > 0) {
        tableRow = $("#productTable tbody tr:last").attr('id');
        arrayNumber = $("#productTable tbody tr:last").attr('class');
        count = tableRow.substring(3);
        count = Number(count) + 1;
        arrayNumber = Number(arrayNumber) + 1;
    } else {
        // no table row
        count = 1;
        arrayNumber = 0;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: urlGetFetchProduct,
        type: 'post',
        dataType: 'json',
        success:function(response) {
            $("#addRowBtn").button("reset");

            var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
                '<td>'+
                '<div class="form-group">'+

                '<select class="form-control" name="product_name[]" id="product_name'+count+'" onchange="getProductData('+count+')" >'+
                '<option value="">~~إختر~~</option>';
            // console.log(response);
            $.each(response, function(index, value) {
                tr += '<option value="'+value.id+'">'+value.product_name+'</option>';
            });

            tr += '</select>'+
                '</div>'+
                '</td>'+
                '<td style="padding-left:20px;"">'+
                '<input type="text" name="unit_price[]" id="unit_price'+count+'" autocomplete="off" disabled="true" class="form-control" />'+
                '<input type="hidden" name="unit_price[]" id="unit_price'+count+'" autocomplete="off" class="form-control" />'+
                '</td style="padding-left:20px;">'+
                '<td style="padding-left:20px;">'+
                '<div class="form-group">'+
                '<input type="number" name="product_quantity[]" id="product_quantity'+count+'" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" min="1" />'+
                '</div>'+
                '</td>'+
                '<td style="padding-left:20px;">'+
                '<input type="text" name="total_quantity" id="total_quantity'+count+'" autocomplete="off" class="form-control" disabled="true" />'+
                '</td>'+
                '<td style="padding-left:20px;">'+
                '<input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" disabled="true" />'+
                '<input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
                '</td>'+
                '<td>'+
                '<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="glyphicon glyphicon-trash"></i></button>'+
                '</td>'+
                '</tr>';
            if(tableLength > 0) {
                $("#productTable tbody tr:last").after(tr);
            } else {
                $("#productTable tbody").append(tr);
            }

        } // /success
    });	// get the product data

} // /add row

function removeProductRow(row) {
    if(row) {
        $("#row"+row).remove();


        subAmount();
    } else {
        alert('error! Refresh the page again');
    }
}

// select on product data
var original = [];
function getProductData(row) {
    if(row) {
        var productId = $("#product_name"+row).val();

        if(productId == "") {
            $("#unit_price"+row).val("");

            $("#product_quantity"+row).val("");
            $("#total"+row).val("");

            // remove check if product name is selected
            // var tableProductLength = $("#productTable tbody tr").length;
            // for(x = 0; x < tableProductLength; x++) {
            // 	var tr = $("#productTable tbody tr")[x];
            // 	var count = $(tr).attr('id');
            // 	count = count.substring(3);

            // 	var productValue = $("#productName"+row).val()

            // 	if($("#productName"+count).val() == "") {
            // 		$("#productName"+count).find("#changeProduct"+productId).removeClass('div-hide');
            // 		console.log("#changeProduct"+count);
            // 	}
            // } // /for

        } else {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: urlFetchSelectedProduct,
                type: 'post',
                dataType: 'json',
                data: {productId : productId, _token: token},
                success:function(response) {
                    console.log(response);
                    // setting the rate value into the rate input field

                    $("#unit_price"+row).val(response.unit_price);
                    original[row] = response.product_quantity;
                    $("#total_quantity"+row).val(original[row]);
                    $("#product_quantity"+row).val(0);
                    $("#product_id"+row).val(response.id);

                    var total = Number(response.unit_price) * 0;
                    total = total.toFixed(2);
                    console.log('TOOOOTal');
                    console.log(total);
                    $("#total"+row).val(total);
                    $("#totalValue"+row).val(total);

                    // check if product name is selected
                    // var tableProductLength = $("#productTable tbody tr").length;
                    // for(x = 0; x < tableProductLength; x++) {
                    // 	var tr = $("#productTable tbody tr")[x];
                    // 	var count = $(tr).attr('id');
                    // 	count = count.substring(3);

                    // 	var productValue = $("#productName"+row).val()

                    // 	if($("#productName"+count).val() != productValue) {
                    // 		// $("#productName"+count+" #changeProduct"+count).addClass('div-hide');
                    // 		$("#productName"+count).find("#changeProduct"+productId).addClass('div-hide');
                    // 		console.log("#changeProduct"+count);
                    // 	}
                    // } // /for

                    subAmount();
                } // /success
            }); // /ajax function to fetch the product data
        }

    } else {
        alert('no row! please refresh the page');
    }
} // /select on product data
function getProductDataWithId(row) {
    if(row) {
        var productId = $("#product_id"+row).val();

        if(productId == "") {
            //$("#unit_price"+row).val("");

            //$("#product_quantity"+row).val("");
            //$("#total"+row).val("");

            // remove check if product name is selected
            // var tableProductLength = $("#productTable tbody tr").length;
            // for(x = 0; x < tableProductLength; x++) {
            // 	var tr = $("#productTable tbody tr")[x];
            // 	var count = $(tr).attr('id');
            // 	count = count.substring(3);

            // 	var productValue = $("#productName"+row).val()

            // 	if($("#productName"+count).val() == "") {
            // 		$("#productName"+count).find("#changeProduct"+productId).removeClass('div-hide');
            // 		console.log("#changeProduct"+count);
            // 	}
            // } // /for

        } else {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: urlFetchSelectedProduct,
                type: 'post',
                dataType: 'json',
                data: {productId : productId, _token: token},
                success:function(response) {
                    console.log(response);
                    // setting the rate value into the rate input field

                    $("#unit_price"+row).val(response.unit_price);
                    original[row] = response.product_quantity;
                    $("#total_quantity"+row).val(original[row]);
                    $("#product_quantity"+row).val(0);
                    $("#product_name"+row).val(response.id);


                    var total = Number(response.unit_price) * 0;
                    total = total.toFixed(2);
                    $("#total"+row).val(total);
                    $("#totalValue"+row).val(total);

                    // check if product name is selected
                    // var tableProductLength = $("#productTable tbody tr").length;
                    // for(x = 0; x < tableProductLength; x++) {
                    // 	var tr = $("#productTable tbody tr")[x];
                    // 	var count = $(tr).attr('id');
                    // 	count = count.substring(3);

                    // 	var productValue = $("#productName"+row).val()

                    // 	if($("#productName"+count).val() != productValue) {
                    // 		// $("#productName"+count+" #changeProduct"+count).addClass('div-hide');
                    // 		$("#productName"+count).find("#changeProduct"+productId).addClass('div-hide');
                    // 		console.log("#changeProduct"+count);
                    // 	}
                    // } // /for

                    subAmount();
                } // /success
            }).fail(function(jqXHR, textStatus, errorThrown) {

                $("#product_name"+row).val("");
                $("#product_quantity"+row).val("");
                $("#total_quantity"+row).val("");
                $("#unit_price"+row).val("");
                $("#total"+row).val("");

            }); // /ajax function to fetch the product data
        }

    } else {
        alert('no row! please refresh the page');
    }
} // /select on product data with id

// table total
function getTotal(row) {
    if(row) {
        var total = Number($("#unit_price"+row).val()) * Number($("#product_quantity"+row).val());
        total = total.toFixed(2);
        $("#total"+row).val(total);
        $("#totalValue"+row).val(total);

        var total_quantity = Number(original[row]) - Number($("#product_quantity"+row).val());
        total_quantity = total_quantity.toFixed(2);
        console.log(total_quantity);
        $("#total_quantity"+row).val(total_quantity);
        subAmount();

    } else {
        alert('no row !! plase refresh the page');
    }
}

function subAmount() {
    var tableProductLength = $("#productTable tbody tr").length;
    var totalSubAmount = 0;
    for(x = 0; x < tableProductLength; x++) {
        var tr = $("#productTable tbody tr")[x];
        var count = $(tr).attr('id');
        count = count.substring(3);
        totalSubAmount = Number(totalSubAmount) + Number($("#total"+count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

    // sub total
    $("#subTotal").val(totalSubAmount);
    $("#subTotalValue").val(totalSubAmount);

    // vat
    var vat = (Number($("#subTotal").val())/100) * 0;
    vat = vat.toFixed(2);
    $("#vat").val(vat);
    $("#vatValue").val(vat);

    // total amount
    var total_amount = (Number($("#subTotal").val()) + Number($("#vat").val()));
    total_amount = total_amount.toFixed(2);
    $("#total_amount").val(total_amount);
    $("#totalAmountValue").val(total_amount);

    var discount = $("#discount").val();
    if(discount) {
        var grand_total = Number($("#total_amount").val()) - Number(discount);
        grand_total = grand_total.toFixed(2);
        $("#grand_total").val(grand_total);
        $("#grandTotalValue").val(grand_total);
    } else {
        $("#grand_total").val(total_amount);
        $("#grandTotalValue").val(total_amount);
    } // /else discount

    var paidAmount = $("#paid").val();
    if(paidAmount) {
        paidAmount =  Number($("#grand_total").val()) - Number(paidAmount);
        paidAmount = paidAmount.toFixed(2);
        $("#due").val(paidAmount);
        $("#dueValue").val(paidAmount);
    } else {
        $("#due").val($("#grand_total").val());
        $("#dueValue").val($("#grand_total").val());
    } // else

} // /sub total amount

function discountFunc() {
    var discount = $("#discount").val();
    var total_amount = Number($("#total_amount").val());
    total_amount = total_amount.toFixed(2);

    var grand_total;
    if(total_amount) {
        grand_total = Number($("#total_amount").val()) - Number($("#discount").val());
        grand_total = grand_total.toFixed(2);

        $("#grand_total").val(grand_total);
        $("#grandTotalValue").val(grand_total);
    } else {
    }

    var paid = $("#paid").val();

    var dueAmount;
    if(paid) {
        dueAmount = Number($("#grand_total").val()) - Number($("#paid").val());
        dueAmount = dueAmount.toFixed(2);

        $("#due").val(dueAmount);
        $("#dueValue").val(dueAmount);
    } else {
        $("#due").val($("#grand_total").val());
        $("#dueValue").val($("#grand_total").val());
    }

} // /discount function

function paidAmount() {
    var grand_total = $("#grand_total").val();

    if(grand_total) {
        var dueAmount = Number($("#grand_total").val()) - Number($("#paid").val());
        dueAmount = dueAmount.toFixed(2);
        $("#due").val(dueAmount);
        $("#dueValue").val(dueAmount);
    } // /if
} // /paid amount function


function resetOrderForm() {
    // reset the input field
    $("#createOrderForm")[0].reset();
    // remove remove text danger
    $(".text-danger").remove();
    // remove form group error
    $(".form-group").removeClass('has-success').removeClass('has-error');
} // /reset order form

$('#createOrderForm').on('submit', function(e) {

    e.preventDefault();

    /* NOT WROKING !!!!!!!!!
     $('input[name^="product_name"]').each(function() {
     console.log($(this).val());
     });
     */

    var productNameData = [];

    var inps = document.getElementsByName('product_name[]');
    for (var i = 0; i <inps.length; i++) {
        var inp = inps[i];
        productNameData.push(inp.value);
    }
    var quantityData = [];
    var inpsq = document.getElementsByName('product_quantity[]');
    for (var iq = 0; iq <inpsq.length; iq++) {
        var inpq = inpsq[iq];
        quantityData.push(inpq.value);
    }
    var unitPriceData = [];
    var inpsup = document.getElementsByName('unit_price[]');
    for (var iup = 0; iup <inpsup.length; iup++) {
        var inpup = inpsup[iup];
        unitPriceData.push(inpup.value);
    }
    var totalData = [];
    var inpst = document.getElementsByName('total[]');
    for (var it = 0; it <inpst.length; it++) {
        var inpt = inpst[it];
        totalData.push(inpt.value);
    }

    console.log(productNameData);

    $.ajax({
        type: "POST",
        url: urlAddOrder,
        data:{
            order_date:   $('#order_date').val(),
            client_id:    $('#client_id').val(),
            product_name:         productNameData,
            product_quantity:     quantityData,
            total_amount: $('#total_amount').val(),
            discount:     $('#discount').val(),
            grand_total:  $('#grand_total').val(),
            paid:         $('#paid').val(),
            unit_price:   unitPriceData,
            total:        totalData,
            due:          $('#due').val(),
            payment_type: $('#payment_type').val(),
            _token: token},
        success: function(data) {
            $("#createOrderForm")[0].reset();
            console.log('success');
            console.log(data);
            // create order button
            var id = data;
            $("#success-order").html('<div class="alert alert-success"> ' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> تم تسجيل الطلب <br /> <br /> <a type="button" href="/printOrder/'+id+'"  class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> طباعة </a>'+
                '<a href="'+urlOrder +'" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> إضافة طلب جديد </a>'+

                '</div>');

            $("html, body, div.panel, div.panel-body").animate({scrollTop: '0px'}, 100);

            // disable the modal footer button
            $(".submitButtonFooter").addClass('div-hide');
            // remove the product row
            //$(".removeProductRowBtn").addClass('div-hide');
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {

        console.log('Text Status:');
        console.log(textStatus);
        console.log('Error Thrown:');
        console.log(errorThrown);
        console.log('jqXHR:');
        console.log(jqXHR.responseText);
        var responseError = JSON.parse(jqXHR.responseText);

        var product_name = document.getElementsByName('product_name[]');
        var product_quantity = document.getElementsByName('product_quantity[]');
        $(".clean_product_name").html('');
        $(".clean_product_quantity").html('');
        $(".clean_product_name").closest('.form-group').removeClass('has-error');
        $(".clean_product_quantity").closest('.form-group').removeClass('has-error');
        for (var x = 0; x < product_name.length; x++) {
            var product_nameId = product_name[x].id;
            if(product_name[x].value == ''){
                $("#"+product_nameId+"").after('<p class="clean_product_name text-danger"> الرجاء اختيار منتج </p>');
                $("#"+product_nameId+"").closest('.form-group').addClass('has-error');
            }
            console.log('IDDDD: '+ product_nameId);
        }
        for (var x = 0; x < product_quantity.length; x++) {
            var product_quantityId = product_quantity[x].id;
            if(product_quantity[x].value == ''){
                $("#"+product_quantityId+"").after('<p class="clean_product_quantity text-danger"> حقل الكمية مطلوب </p>');
                $("#"+product_quantityId+"").closest('.form-group').addClass('has-error');
            }
        }
        $.each(responseError, function(k, v) {
            console.log('Key:');
            console.log(k);
            console.log('Value:');
            console.log(v[0]);
            $('input#' + k).closest('div').addClass('has-error');
            $('select#' + k).closest('div').addClass('has-error');
            //$('div#error_edit-'+ k +' h6').html(v[0]);
        });
    });

});


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////PAYMENTS////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var orderId = 0;
var orderTotalAmountElement = null;
var orderDiscountElement = null;
var orderGrandTotalElement = null;
var orderPaidElement = null;
var orderDueElement = null;
var orderPaymentTypeElement = null;
$('.panel').find('.panel-body').find('.table').find('.btn-group').find('.dropdown-menu').find('#edit-payment-modal-btn').on('click', function(event){
    event.preventDefault();
    orderId = event.target.dataset['orderid'];
    orderTotalAmountElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[9];
    orderDiscountElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[11];
    orderGrandTotalElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[13];
    orderPaidElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[15];
    orderDueElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[17];
    orderPaymentTypeElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[19];
    var orderTotalAmount = orderTotalAmountElement.textContent;
    var orderDiscount = orderDiscountElement.textContent;
    var orderGrandTotal = orderGrandTotalElement.textContent;
    var orderPaid = orderPaidElement.textContent;
    var orderDue = orderDueElement.textContent;
    var orderPaymentType = orderPaymentTypeElement.textContent;
    $('#edit-total_amount').val(orderTotalAmount);
    $('#edit-discount').val(orderDiscount);
    $('#edit-grand_total').val(orderGrandTotal);
    $('#edit-paid').val(orderPaid);
    $('#edit-due').val(orderDue);
    $('#edit-payment_type').val(orderPaymentType);
    $(".clean-edit-payment").html('');
    $(".edit-payment-footer").removeClass('div-hide');
    $('#edit-payment-modal').modal();
});
$('#edit-payment-btn').on('click', function () {
    $(".clean-edit-payment").html('');
    $.ajax({
        method:'post',
        url:urlEditPayment,
        data:{due: $('#edit-due').val(), paid: $('#edit-paid').val(), payment_type: $('#edit-payment_type').val(), id: orderId, _token: token}
    }).done(function (msg) {
        $(".edit-payment-footer").addClass('div-hide');
        $("#edit-payment-msg").html('<p class="text-success clean-edit-payment" style="text-align: center"> تم تحديث المدفوعات بنجاح </p>');
        setTimeout(function() {$('#edit-payment-modal').modal('hide');}, 600);


    }).fail(function(jqXHR, textStatus, errorThrown) {

        console.log('Text Status:');
        console.log(textStatus);
        console.log('Error Thrown:');
        console.log(errorThrown);
        console.log('jqXHR:');
        console.log(jqXHR.responseText);


        //  edit-payment
    });
});
function updatePayment() {
    var updatedDue = $('#edit-grand_total').val() - $('#edit-paid').val();
    $('#edit-due').val(updatedDue);
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////REMOVE ORDER ITEMS//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('.panel').find('.panel-body').find('.table').find('.btn-group').find('.dropdown-menu').find('#remove-order-items-modal-btn').on('click', function(event){
    event.preventDefault();
    orderId = event.target.dataset['orderid'];
    $.ajax({
        url: urlfetchOrderItems,
        type: 'post',
        dataType: 'json',
        data: {order_id : orderId, _token: token},
        success:function(response) {
            console.log('ORDER ITEMS: ');
            console.log(response);

        } // /success
    });

    $('#remove-order-items-modal').modal();
});

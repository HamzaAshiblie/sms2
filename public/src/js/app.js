var category_id = 0;
//////////////////////////////////////////////////////////////////////////
///////////////////////ADD PRODUCT FROM CATEGORY PAGE/////////////////////
$('.panel').find('.div-body-modal').find('.table').find('.btn-group').find('.dropdown-menu').find('#add-product-modal-btn2').on('click', function(event){
    event.preventDefault();
    category_id = event.target.dataset['categoryid'];
    var categoryNameElement2 = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[1];
    var categoryName = categoryNameElement2.textContent;
    $("#addProductForm2")[0].reset();
    $('#category_id').val(categoryName);
    $(".form-group").removeClass('has-error');
    $("h6.editErrorRed").html('');
    //$("div#error_add-category_id").html(selectCategoryAdd);
    //$('#add-category_id').val(categoryIdSelect);
    $('#addProductsModal2').modal();
});
$('#add_product_modal_save2').on('click', function () {
    $(".form-group").removeClass('has-error');
    $("h6.editErrorRed").html('');
    $.ajax({
        method: 'POST',
        url: urlAddProduct,
        data: {
            product_name: $('#product_name2').val(),
            category_id: category_id,
            //new_category: $('#new-category').val(),
            //product_quantity: $('#product_quantity').val(),
            product_unit: $('#product_unit2').val(),
            unit_price: $('#unit_price2').val(),
            //init_price: $('#init_price').val(),
            discount: $('#discount2').val(),
            limit: $('#limited2').val(),
            //supplier: $('#supplier').val(),
            //country: $('#country').val(),
            _token: token
        }
    }).done(function () {
        $('#addProductsModal2').modal('hide');
        //atable.ajax.reload(null, true);
        $(location).attr('href',"/sms2/public/product/" + category_id);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        var responseError = JSON.parse(jqXHR.responseText);

        $.each(responseError, function (k, v) {
            console.log('Key:');
            console.log(k);
            console.log('Value:');
            console.log(v[0]);
            $('input#' + k).closest('.form-group').addClass('has-error');
            $('select#' + k).closest('.form-group').addClass('has-error');
            $('div#error_add-' + k + ' h6').html(v[0]);
        });

    });
});
//////////////////////////////////////////////////////////////////////////
///////////////////////ADD PRODUCT FROM PRODUCT PAGE//////////////////////
$('.panel').find('.div-body-modal').find('.div-add-product-modal').find('#add-product-modal-btn').on('click', function(event){
    event.preventDefault();
    $("#addProductForm")[0].reset();
    $(".form-group").removeClass('has-error');
    $("h6.editErrorRed").html('');
    $("div#error_add-category_id").html(selectCategoryAdd);
    $('#add-category_id').val(categoryIdSelect);
    $('#addProductsModal').modal();
});
$('#add_product_modal_save').on('click', function () {
    $(".form-group").removeClass('has-error');
    $("h6.editErrorRed").html('');
    $.ajax({
        method: 'POST',
        url: urlAddProduct,
        data: {
            product_name: $('#product_name').val(),
            category_id: $('#add-category_id').val(),
            //new_category: $('#new-category').val(),
            //product_quantity: $('#product_quantity').val(),
            product_unit: $('#product_unit').val(),
            unit_price: $('#unit_price').val(),
            //init_price: $('#init_price').val(),
            discount: $('#discount').val(),
            //supplier: $('#supplier').val(),
            //country: $('#country').val(),
            limit: $('#limited').val(),
            _token: token
        }
    }).done(function () {
        $('#addProductsModal').modal('hide');
        //atable.ajax.reload(null, true);
        $(location).attr('href',urlGetProduct);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        var responseError = JSON.parse(jqXHR.responseText);

        $.each(responseError, function (k, v) {
            console.log('Key:');
            console.log(k);
            console.log('Value:');
            console.log(v[0]);
            $('input#' + k).closest('.form-group').addClass('has-error');
            $('select#' + k).closest('.form-group').addClass('has-error');
            $('div#error_add-' + k + ' h6').html(v[0]);
        });

    });
});


$('.panel').find('.div-body-modal').find('.table').find('.btn-group').find('.dropdown-menu').find('#purchase-product-modal-btn').on('click', function(event){
    productUpdateId = event.target.dataset['productid'];
    $("#purchaseProductForm")[0].reset();
    $(".form-group").removeClass('has-error');
    $("h6.editErrorRed").html('');
    $('#purchaseProductsModal').modal();
});
$('#purchase_product_btn').on('click', function () {
    $(".form-group").removeClass('has-error');
    $("h6.editErrorRed").html('');
    $.ajax({
        method:'post',
        url:urlPurchaseProduct,
        data:{
            product_id: productUpdateId ,
            product_quantity: $('#purchase-product_quantity').val(),
            supplier: $('#purchase-supplier').val(),
            country: $('#purchase-country').val(),
            init_price: $('#purchase-init_price').val(),
            vat: $('#purchase-total_vat').val(),
            _token: token}
    }).done(function (msg) {
        $('#purchaseProductsModal').modal('hide');
        $(location).attr('href',urlGetProduct);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        var responseError = JSON.parse(jqXHR.responseText);

        $.each(responseError, function(k, v) {
            console.log('Key:');
            console.log(k);
            console.log('Value:');
            console.log(v[0]);
            $('input#purchase-' + k).closest('.form-group').addClass('has-error');
            $('div#error_purchase-'+ k +' h6').html(v[0]);
        });

    });
});
//////////////////////////////////////////////////////////////////////////
///////////////////////CREATE ORDER///////////////////////////////////////
$('#createOrderForm').on('submit', function(e) {

    e.preventDefault();

    /* NOT WROKING !!!!!!!!!
     $('input[name^="product_name"]').each(function() {
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
    var itemDiscount = [];
    var inpsid = document.getElementsByName('discount[]');
    for (var iid = 0; iid <inpsid.length; iid++) {
        var inpid = inpsid[iid];
        itemDiscount.push(inpid.value);
    }
    var itemVat = [];
    var inpsvid = document.getElementsByName('vat[]');
    for (var viid = 0; viid <inpsvid.length; viid++) {
        var inpvid = inpsvid[viid];
        itemVat.push(inpvid.value);
    }
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
            vat:     $('#total_vat').val(),
            grand_total:  $('#grand_total').val(),
            paid:         $('#paid').val(),
            unit_price:   unitPriceData,
            total:        totalData,
            item_discount: itemDiscount,
            item_vat: itemVat,
            due:          $('#due').val(),
            payment_type: $('#payment_type').val(),
            _token: token},
        success: function(data) {
            $("#createOrderForm")[0].reset();
            // create order button
            var printOrderId = data;
            $("#success-order").html('<div class="alert alert-success"> ' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> تم تسجيل الطلب <br /> <br /> <a type="button" href="/sms2/public/printOrder/'+printOrderId+'"  class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> طباعة </a>'+
                '<a href="'+urlOrder +'" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> إضافة طلب جديد </a>'+
                '</div>');

            $("html, body, div.panel, div.panel-body").animate({scrollTop: '0px'}, 100);

            // disable the modal footer button
            $(".submitButtonFooter").addClass('div-hide');
            // remove the product row
            //$(".removeProductRowBtn").addClass('div-hide');
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
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
//////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
///////////////////////REMOVE ORDER ITEMS/////////////////////////////////
//////////////////////////////////////////////////////////////////////////
$('#removeOrderItemForm').on('submit', function(e) {

    e.preventDefault();
    var productIdData = [];
    var orderItemIdData = [];
    var removedQuantityData = [];
    var totalData = [];
    var totalDiscountData = [];

    $('input[name^="product_id"]').each(function() {
        productIdData.push($(this).val());
    });

    $('input[name^="order_item_id"]').each(function() {
        orderItemIdData.push($(this).val());
    });

    $('input[name^="removed_quantity"]').each(function() {
        removedQuantityData.push($(this).val());
    });

    $('input[name^="total"]').each(function() {
        totalData.push($(this).val());
    });
    $.ajax({
        type: "POST",
        url: urlRemoveOrderItem,
        data:{
            product_id:        productIdData,
            order_item_id:     orderItemIdData,
            removed_quantity: removedQuantityData,
            total:             totalData,
            removed_total:     $('#removed_total').val(),
            removed_discount:  $("#removed_discount").val(),
            order_id:          $('#order_id').val(),
            _token: token},
        success: function(data) {
            $("#removeOrderItemForm")[0].reset();
            var printOrderId = $('#order_id').val();
            $("#success-order").html('<div class="alert alert-success"> ' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> تم تعديل الطلب <br /> <br /> <a type="button" href="/sms2/public/printOrder/'+printOrderId+'"  class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> طباعة </a>'+
                '<a href="'+urlOrder +'" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> إضافة طلب جديد </a>'+
                '</div>');
            // disable the modal footer button
            $(".submitButtonFooter").addClass('div-hide');
            // remove the product row
            //$(".removeProductRowBtn").addClass('div-hide');
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {

    });

});
//////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
///////////////////////PRODUCT UPDATE BY OPERATION////////////////////////
$('#product_update_select').on('change',function (event) {
    var selectedOperation = event.target.value;
    if (selectedOperation == 'all'){
        selectedOperation = '';
    }
    if (selectedOperation){
        var urlPU = "/sms2/public/productUpdate/"+product_id + "/";
        $(location).attr('href',urlPU+selectedOperation);
    }else {
        $(location).attr('href',"/productUpdate/"+product_id);

    }
});
/////////////////////////////////////////////////////////////////////////

$('#showInvoice').on('click', function (e) {
    e.preventDefault();
    var orderId = $('#order_id').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: urlReportInvoice,
        data:{
            order_id: orderId,
            _token: token}
    });
    var orderId = $('#order_id').val();
    var urlInvoice = "/sms2/public/printOrder/"+orderId;
    window.open(urlInvoice);
});
$('#showReportSales').on('click', function (e) {
    e.preventDefault();
    var condition1 = $('#condition1').val();
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    $.ajax({
        type: "POST",
        url: urlReportSales,
        data:{
            start_date: from_date,
            end_date:   to_date,
            client_id:  condition1,
            _token: token},
            success: function(data) {
            $("#reportSalesForm")[0].reset();
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log('Text Status:');
        console.log(textStatus);
        console.log('Error Thrown:');
        console.log(errorThrown);
        console.log('jqXHR:');
        console.log(jqXHR.responseText);
    });

});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////PAYMENTS-MOVED//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var orderId = 0;
var orderTotalAmountElement = null;
var orderDiscountElement = null;
var orderVatElement = null;
var orderGrandTotalElement = null;
var orderPaidElement = null;
var orderDueElement = null;
var orderPaymentTypeElement = null;
$('.panel').find('.panel-body').find('.table').find('.btn-group').find('.dropdown-menu').find('#edit-payment-modal-btn').on('click', function(event){
    event.preventDefault();
    orderId = event.target.dataset['orderid'];
    orderTotalAmountElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[9];
    orderDiscountElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[11];
    orderVatElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[13];
    orderGrandTotalElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[15];
    orderPaidElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[17];
    orderDueElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[19];
    orderPaymentTypeElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[21];
    var orderTotalAmount = orderTotalAmountElement.textContent;
    var orderDiscount = orderDiscountElement.textContent;
    var orderVat = orderVatElement.textContent;
    var orderGrandTotal = orderGrandTotalElement.textContent;
    var orderPaid = orderPaidElement.textContent;
    var orderDue = orderDueElement.textContent;
    var orderPaymentType = orderPaymentTypeElement.textContent;
    $('#edit-total_amount').val(orderTotalAmount);
    $('#edit-discount').val(orderDiscount);
    $('#edit-vat').val(orderVat);
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
        data:{due: $('#edit-due').val(),
            paid: $('#edit-pay').val(),
            payment_type: $('#edit-payment_type').val(),
            id: orderId, _token: token}
    }).done(function (msg) {
        $(".edit-payment-footer").addClass('div-hide');
        $("#edit-payment-msg").html('<p class="text-success clean-edit-payment" style="text-align: center"> تم تحديث المدفوعات بنجاح </p>');
        setTimeout(function() {$('#edit-payment-modal').modal('hide');}, 600);


    }).fail(function(jqXHR, textStatus, errorThrown) {
        //  edit-payment
    });
});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////PAYMENTS-MOVED//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var original = [];
var maxDiscount = 0;
var minPrice = 0;
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
    $(".form-group").removeClass('has-error');
    $("h6.editErrorRed").html('');
    $.ajax({
        method: 'POST',
        url:urlAddClient,
        data:{
            client_name: $('#client_name').val(),
            client_company: $('#client_company').val(),
            client_email: $('#client_email').val(),
            client_phone: $('#client_phone').val(),
            _token: token}
    }).done(function () {
        $('#addClientsModal').modal('hide');
        $(location).attr('href',urlGetClient);
     //   atable.ajax.reload(null, false);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        var responseError = JSON.parse(jqXHR.responseText);

        $.each(responseError, function(k, v) {
            console.log('Key:');
            console.log(k);
            console.log('Value:');
            console.log(v[0]);
            $('input#' + k).closest('.form-group').addClass('has-error');
            $('div#error_add-'+ k +' h6').html(v[0]);
        });


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
    $(".form-group").removeClass('has-error');
    $("h6.editErrorRed").html('');
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
       var responseError = JSON.parse(jqXHR.responseText);

        $.each(responseError, function(k, v) {
            console.log('Key:');
            console.log(k);
            console.log('Value:');
            console.log(v[0]);
            $('input#edit-' + k).closest('.form-group').addClass('has-error');
            $('div#error_edit-'+ k +' h6').html(v[0]);
        });

    });
});

$('.panel').find('.div-body-modal').find('.table').find('.btn-group').find('.dropdown-menu').find('#remove-client-modal-btn').on('click', function(event){
    event.preventDefault();
    clientId = event.target.dataset['clientid'];
    $('#delete-clients-modal').modal();
});
$(document).ready(function() {

$('#delete-clients-btn').on('click', function () {
    $.ajax({
        method:'post',
        url:urlDeleteClient,
        data:{id: clientId, _token: token}
    }).done(function (msg) {
        $('#delete-clients-modal').modal('hide');
    });
    //$(location).attr('href',urlGetClient);
    //cTable.ajax.reload(null, false);
});
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
    $("#addCategoryForm")[0].reset();
    $(".form-group").removeClass('has-error');
    $("h6.editErrorRed").html('');
    $('#addCategoryModal').modal();
});
$('#add_category_modal_save').on('click', function () {
    $(".form-group").removeClass('has-error');
    $("h6.editErrorRed").html('');
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
    }).fail(function(jqXHR, textStatus, errorThrown) {
        var responseError = JSON.parse(jqXHR.responseText);

        $.each(responseError, function(k, v) {
            console.log('Key:');
            console.log(k);
            console.log('Value:');
            console.log(v[0]);
            $('input#' + k).closest('.form-group').addClass('has-error');
            $('div#error_add-'+ k +' h6').html(v[0]);
        });

    });
});

$('.panel').find('.div-body-modal').find('.table').find('.btn-group').find('.dropdown-menu').find('#edit-category-modal-btn').on('click', function(event){
    event.preventDefault();
    categoryId = event.target.dataset['categoryid'];
    categoryNameElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[1];
    categoryDescriptionElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[3];
    var categoryName = categoryNameElement.textContent;
    var categoryDescription = categoryDescriptionElement.textContent;
    $('#edit-category_name').val(categoryName);
    $('#edit-category_description').val(categoryDescription);
    $(".form-group").removeClass('has-error');
    $("h6.editErrorRed").html('');
    $("div#edit-category-msg").html('');
    $(".edit-categories-footer").removeClass('div-hide');
    $('#edit-category-modal').modal();
});
$('#edit-categories-btn').on('click', function () {
    $(".form-group").removeClass('has-error');
    $("h6.editErrorRed").html('');
    $.ajax({
        method:'post',
        url:urlEditCategory,
        data:{category_name: $('#edit-category_name').val(), category_description: $('#edit-category_description').val(), id: categoryId, _token: token}

    }).fail(function(jqXHR, textStatus, errorThrown) {
        var responseError = JSON.parse(jqXHR.responseText);

        $.each(responseError, function(k, v) {
            console.log('Key:');
            console.log(k);
            console.log('Value:');
            console.log(v[0]);
            $('input#edit-' + k).closest('.form-group').addClass('has-error');
            $('div#error_edit-'+ k +' h6').html(v[0]);
        });

    }).done(function (msg) {
        $(".edit-categories-footer").addClass('div-hide');
        $("#edit-category-msg").html('<p class="text-success clean-edit-category" style="text-align: center"> تم التحديث بنجاح </p>');
        setTimeout(function() {$('#edit-category-modal').modal('hide');}, 600);
    });
});

$('.panel').find('.div-body-modal').find('.table').find('.btn-group').find('.dropdown-menu').find('#remove-category-modal-btn').on('click', function(event){
    event.preventDefault();
    categoryId = event.target.dataset['categoryid'];
    $('#delete-categories-modal').modal();
});

$('#delete-categories-btn').on('click', function () {
    $.ajax({
        method:'post',
        url:urlDeleteCategory,
        data:{id: categoryId, _token: token}
    }).done(function (msg) {
        $('#delete-categories-modal').modal('hide');
    });
    $(location).attr('href',urlGetCategory);
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////PRODUCTS///////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////GET CATEGORY IN PRODUCT///////////////////////////////////////////////////////
var selectCategory = null;
var selectCategoryAdd = null;
var selectCategoryEdit = null;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajax({
    method: 'POST',
    url:urlGetCategoryInProduct,
    dataType: 'json'
}).done(function (response) {
    var header1 = '';
    var header2 = '';
    var header3 = '';
    header1 = '<select class="form-control" name="category_id" id="category_id">';
    header2 = '<select class="form-control" name="add-category_id" id="add-category_id">';
    header3 = '<select class="form-control" name="edit-category_id" id="edit-category_id">';
    var option = '<option value="">~~الكل~~</option>';
    $.each(response, function(index, value) {
        option += '<option value="'+value.id+'">'+value.category_name+'</option>';
    });
    option += '</select><h6 class="editErrorRed"></h6>';
    header1 +=  option;
    header2 +=  option;
    header3 +=  option;
    selectCategory = header1;
    selectCategoryAdd = header2;
    selectCategoryEdit = header3;
    $("div#switchCategory").html(selectCategory);
    if (categoryIdSelect){
        $('#category_id').val(categoryIdSelect);
    }
});
///////////////////////////////////////END GET CATEGORY IN PRODUCT///////////////////////////////////////////////////////
var productId = 0;
var categoryIdElement = null;
var categoryNameElement = null;
var productNameElement = null;
var productQuantityElement = null;
var productUnitElement = null;
var unitPriceElement = null;
var discountElement = null;
var limitElement = null;
var initPriceElement = null;
var productUpdateId = null;

$('.panel').find('.div-body-modal').find('.table').find('.btn-group').find('.dropdown-menu').find('#edit-product-modal-btn').on('click', function(event){
    event.preventDefault();
    productId = event.target.dataset['productid'];
    categoryId = event.target.dataset['categoryid'];
    categoryNameElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[3];
    productNameElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[5];
    productQuantityElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[7];
    productUnitElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[9];
    //initPriceElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[11];
    unitPriceElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[13];
    discountElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[15];
    limitElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[17];
    var categoryName = categoryNameElement.textContent;
    var productName = productNameElement.textContent;
    var productQuantity = productQuantityElement.textContent;
    var productUnit = productUnitElement.textContent;
    var unitPrice = unitPriceElement.textContent;
    //var initPrice = initPriceElement.textContent;
    var discount = discountElement.textContent;
    var limit = limitElement.textContent;
    $("div#error_edit-category_id").html(selectCategoryEdit);
    $('#edit-category_id').val(categoryId);
    $('#edit-product_name').val(productName);
    $('#edit-product_quantity').val(productQuantity);
    $('#edit-product_unit').val(productUnit);
    $('#edit-unit_price').val(unitPrice);
    $('#edit-discount').val(discount);
    $('#edit-limit').val(limit);
    //$('#edit-init_price').val(initPrice);
    $(".form-group").removeClass('has-error');
    $("h6.editErrorRed").html('');
    $('#edit-product-modal').modal();
});
$('#edit-products-btn').on('click', function () {
    $(".form-group").removeClass('has-error');
    $("h6.editErrorRed").html('');
    $.ajax({
        method:'post',
        url:urlEditProduct,
        data:{category_id: $('#edit-category_id').val(),
            product_name: $('#edit-product_name').val(),
            product_quantity: $('#edit-product_quantity').val(),
            product_unit: $('#edit-product_unit').val(),
            unit_price: $('#edit-unit_price').val(),
            //init_price: $('#edit-init_price').val(),
            discount: $('#edit-discount').val(),
            limit: $('#edit-limit').val(),
            id: productId,
            _token: token}
    }).done(function (msg) {
        $(categoryIdElement).text(msg['category_id']);
        $(productNameElement).text(msg['product_name']);
        $(productQuantityElement).text(msg['product_quantity']);
        $(productUnitElement).text(msg['product_unit']);
        $(unitPriceElement).text(msg['unit_price']);
        $(discountElement).text(msg['discount']);
        $(limitElement).text(msg['limit']);
        //$(initPriceElement).text(msg['init_price']);
        $('#edit-product-modal').modal('hide');
    }).fail(function(jqXHR, textStatus, errorThrown) {
        var responseError = JSON.parse(jqXHR.responseText);
        $.each(responseError, function(k, v) {
            console.log('Key:');
            console.log(k);
            console.log('Value:');
            console.log(v[0]);
            $('input#edit-' + k).closest('.form-group').addClass('has-error');
            $('select#edit-' + k).closest('.form-group').addClass('has-error');
            $('div#error_edit-'+ k +' h6').html(v[0]);
        });

    });
});

$('.panel').find('.div-body-modal').find('.table').find('.btn-group').find('.dropdown-menu').find('#remove-product-modal-btn').on('click', function(event){
    event.preventDefault();
    productId = event.target.dataset['productid'];
    $('#delete-products-modal').modal();
});
$('#delete-products-btn').on('click', function () {
    $.ajax({
        method:'post',
        url:urlDeleteProduct,
        data:{id: productId, _token: token}
    }).fail(function (msg) {
    }).done(function (msg) {
        $('#delete-product-modal').modal('hide');
        $(location).attr('href',urlGetProduct);
    });
});

$('#switchCategory').on('change',function (event) {
    selectedCatId = event.target.value;
    if (selectedCatId){
        $(location).attr('href',"/sms2/public/product/"+selectedCatId);
    }else {
        $(location).attr('href',urlGetProduct);
    }
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
                '<td style="padding-left:20px;">'+
                '<input type="text" name="product_id[]" id="product_id'+count+'" onkeyup="getProductDataWithId('+count+')" autocomplete="off" class="form-control" />'+
                '</td>'+
                '<td>'+
                '<div class="form-group">'+

                '<select class="form-control" name="product_name[]" id="product_name'+count+'" onchange="getProductData('+count+')" >'+
                '<option value="">~~إختر~~</option>';
            $.each(response, function(index, value) {
                    tr += '<option value="'+value.id+'">'+value.product_name+'</option>';
            });

            tr += '</select>'+
                '</div>'+
                '</td>'+
                '<td style="padding-left:20px;"">'+
                '<input type="number" name="unit_price[]" id="unit_price'+count+'" disabled="true" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" />'+
                '</td style="padding-left:20px;">'+
                '<td style="padding-left:20px;"">'+
                '<input type="number" name="discount" id="discount'+count+'" disabled="true" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" />'+
                '</td style="padding-left:20px;">'+
                '<td style="padding-left:20px;">'+
                '<div class="form-group">'+
                '<input type="number" name="product_quantity[]" id="product_quantity'+count+'" disabled="true" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" min="1" />'+
                '</div>'+
                '</td>'+
                '<td style="padding-left:20px;">'+
                '<input type="text" name="total_quantity" id="total_quantity'+count+'" autocomplete="off" class="form-control" disabled="true" />'+
                '</td>'+
                '<td style="padding-left:1px;">'+
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
function getProductData(row) {
    if(row) {
        var productId = $("#product_name"+row).val();
        if(productId == "") {
            $("#product_id"+row).val("");
            $("#discount"+row).prop('disabled', true);
            $("#discount"+row).val("");
            $("#product_quantity"+row).prop('disabled', true);
            $("#unit_price"+row).prop('disabled', true);
            $("#unit_price"+row).val("");
            $("#total_quantity"+row).val("");
            $("#product_quantity"+row).val("");
            $("#total"+row).val("");
        } else {
            // check if product name is selected
            var tableProductLength = $("#productTable tbody tr").length;
            for(x = 0; x < tableProductLength; x++) {
                var tr = $("#productTable tbody tr")[x];
                var count = $(tr).attr('id');
                count = count.substring(3);
                if(Number($("#product_name"+count).val()) == productId && count!=row) {
                    $("#product_name"+count).val("");
                    $("#product_id"+count).val("");
                    $("#discount"+count).prop('disabled', true);
                    $("#discount"+count).val("");
                    $("#product_quantity"+count).prop('disabled', true);
                    $("#unit_price"+count).prop('disabled', true);
                    $("#unit_price"+count).val("");
                    $("#vat"+count).val("");
                    $("#total_quantity"+count).val("");
                    $("#product_quantity"+count).val("");
                    $("#total"+count).val("");
                }
            } // /for
            $("#discount"+row).prop('disabled', false);
            $("#product_quantity"+row).prop('disabled', false);
            $("#unit_price"+row).prop('disabled', false);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: urlFetchSelectedProduct,
                type: 'post',
                dataType: 'json',
                data: {productId : productId,  _token: token},
                success:function(response) {
                    // setting the rate value into the rate input field
                    var percentage = (Number(response.unit_price)*5)/100;
                    var price = Number(response.unit_price) + percentage;
                    price = price.toFixed(2);
                    $("#unit_price"+row).val(price);
                    $("#unit_price"+row).attr("min",response.unit_price);
                    $("#discount"+row).attr("max",response.discount);
                    maxDiscount = response.discount;
                    minPrice = response.unit_price;
                    original[row]=response.product_quantity;
                    $("#total_quantity"+row).val(original[row]);
                    $("#product_quantity"+row).val(0);
                    $("#product_id"+row).val(response.id);

                    var total = Number(response.unit_price) * 0;
                    total = total.toFixed(2);
                    $("#total"+row).val(total);
                    var itemDiscount = 0;
                    itemDiscount = itemDiscount.toFixed(2);
                    $("#discount"+row).val(itemDiscount);
                    $("#totalValue"+row).val(total);

                    subAmount();
                } // /success
            }).fail(function(jqXHR, textStatus, errorThrown) {

                $("#product_name"+row).val("");
                $("#product_quantity"+row).val("");
                $("#total_quantity"+row).val("");
                $("#product_quantity"+row).prop('disabled', true);
                $("#unit_price"+row).val("");
                $("#total"+row).val("");

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
            $("#product_name"+row).val("");
            $("#discount"+row).prop('disabled', true);
            $("#discount"+row).val("");
            $("#product_quantity"+row).prop('disabled', true);
            $("#unit_price"+row).prop('disabled', true);
            $("#unit_price"+row).val("");
            $("#total_quantity"+row).val("");
            $("#product_quantity"+row).val("");
            $("#total"+row).val("");
        } else {
            // check if product name is selected
            var tableProductLength = $("#productTable tbody tr").length;
            for(x = 0; x < tableProductLength; x++) {
                var tr = $("#productTable tbody tr")[x];
                var count = $(tr).attr('id');
                count = count.substring(3);
                if(Number($("#product_name"+count).val()) == productId && count!=row) {
                    $("#product_name"+count).val("");
                    $("#product_id"+count).val("");
                    $("#discount"+count).prop('disabled', true);
                    $("#discount"+count).val("");
                    $("#product_quantity"+count).prop('disabled', true);
                    $("#unit_price"+count).prop('disabled', true);
                    $("#unit_price"+count).val("");
                    $("#vat"+count).val("");
                    $("#total_quantity"+count).val("");
                    $("#product_quantity"+count).val("");
                    $("#total"+count).val("");
                }
            } // /for
            $("#discount"+row).prop('disabled', false);
            $("#product_quantity"+row).prop('disabled', false);
            $("#unit_price"+row).prop('disabled', false);
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
                    // setting the rate value into the rate input field
                    var percentage = (Number(response.unit_price)*5)/100;
                    var price = Number(response.unit_price) + percentage;
                    price = price.toFixed(2);
                    $("#unit_price"+row).val(price);
                    $("#unit_price"+row).attr("min",response.unit_price);
                    $("#discount"+row).attr("max",response.discount);
                    maxDiscount = response.discount;
                    minPrice = response.unit_price;
                    original[row] = response.product_quantity;
                    $("#total_quantity"+row).val(original[row]);
                    $("#product_quantity"+row).val(0);
                    $("#product_name"+row).val(response.id);

                    var total = Number(response.unit_price) * 0;
                    total = total.toFixed(2);
                    $("#total"+row).val(total);
                    var itemDiscount = 0;
                    itemDiscount = itemDiscount.toFixed(2);
                    $("#discount"+row).val(itemDiscount);
                    var totalDiscount = 0;
                    totalDiscount = Number($("#discount").val());
                    totalDiscount = totalDiscount.toFixed(2);
                    $("#totalValue"+row).val(total);
                    $("#discount").val(totalDiscount);
                    subAmount();
                } // /success
            }).fail(function(jqXHR, textStatus, errorThrown) {

                $("#product_id"+row).val("");
                $("#product_name"+row).val("");
                $("#product_quantity"+row).val("");
                $("#total_quantity"+row).val("");
                $("#product_quantity"+row).prop('disabled', true);
                $("#discount"+row).prop('disabled', true);
                $("#unit_price"+row).prop('disabled', true);
                $("#unit_price"+row).val("");
                $("#total"+row).val("");
                $("#discount"+row).val("");

            }); // /ajax function to fetch the product data
        }

    } else {
        alert('no row! please refresh the page');
    }
} // /select on product data with id

// table total
function getTotal(row) {
    var discount = $("#discount"+row).val();
    var quantity = $("#product_quantity"+row).val();
    var unit_price = $("#unit_price"+row).val();
    if(row && !isNaN(parseFloat(unit_price)) && isFinite(unit_price)) {
        var total = (unit_price - discount) * quantity;
        var vat = (5 * total)/100;
        total = total.toFixed(2);
        vat = vat.toFixed(2);
        $("#vat"+row).val(vat);
        $("#total"+row).val(total);
        $("#totalValue"+row).val(total);

        var total_quantity = Number(original[row]) - quantity;
        $("#total_quantity"+row).val(total_quantity);
        subAmount();
    } else if(isNaN(parseFloat(unit_price)) || isFinite(unit_price)){
        alert('فضلا أدخل رقم فقط');
    }
    else {

    }
}

function subAmount() {
    var tableProductLength = $("#productTable tbody tr").length;
    var totalSubAmount = 0;
    var totalDiscount = 0;
    for(x = 0; x < tableProductLength; x++) {
        var tr = $("#productTable tbody tr")[x];
        var count = $(tr).attr('id');
        count = count.substring(3);
        totalSubAmount = Number(totalSubAmount) + Number($("#total"+count).val());
        totalDiscount = Number(totalDiscount) + (Number($("#discount"+count).val())* Number($("#product_quantity"+count).val()));

    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);
    totalDiscount = totalDiscount.toFixed(2);

    // sub total
    $("#subTotal").val(totalSubAmount);
    //$("#subTotalValue").val(totalSubAmount);

    // dicount total
    $("#discount").val(totalDiscount);

    // vat
    var vat = (Number($("#subTotal").val())/100) * 0;
    vat = vat.toFixed(2);
    $("#total_vat").val(vat);
    $("#vatValue").val(vat);

    // total amount
    var total_amount = (Number($("#subTotal").val()) + Number($("#total_vat").val()) + Number(totalDiscount));
    total_amount = total_amount.toFixed(2);
    $("#total_amount").val(total_amount);
    $("#totalAmountValue").val(total_amount);

    var discount = $("#discount").val();
    if(discount) {
        var grand_total = Number($("#total_amount").val()) - Number(discount);
        var vat_total = (grand_total*5/100);
        //vat_total = vat_total.toFixed(2);
        grand_total += vat_total;
        grand_total = grand_total.toFixed(2);
        $("#total_vat").val(vat_total.toFixed(2));
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

function setQuantity(row) {
    if (row){
        var total = Number($("#removed_quantity"+row).val()) * Number($("#unit_price"+row).val()- $("#item_discount"+row).val());
        $("#total"+row).val(total);
        removedTotal();
    }
} // /setQuantity amount

function removedTotal() {
    var tableLength = $("#removedItemTable tbody tr").length;
    var removedTotalAmount = 0;
    var removedDiscountAmount = 0;
    var removedVatAmount = 0;
    for(x = 0; x < tableLength; x++) {
        var tr = $("#removedItemTable tbody tr")[x];
        var count = $(tr).attr('id');
        count = count.substring(3);
        removedTotalAmount = Number(removedTotalAmount) + Number($("#total"+count).val());
        removedVatAmount = Number(removedVatAmount) + (Number($("#vat"+count).val())*Number($("#removed_quantity"+count).val()));
        removedDiscountAmount = Number(removedDiscountAmount) + (Number($("#removed_quantity"+count).val())*Number($("#item_discount"+count).val()));
    } // /for
    removedTotalAmount = removedTotalAmount.toFixed(2);
    // removed total amount
    $("#removed_total").val(removedTotalAmount);
    // removed discount amount
    $("#removed_discount").val(removedDiscountAmount);
    // removed vat amount
    $("#removed_vat").val(removedVatAmount);
} // /removedTotal

$('#createOrderForm').on('submit', function(e) {

    e.preventDefault();

    /* NOT WROKING !!!!!!!!!
     $('input[name^="product_name"]').each(function() {
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
    var itemDiscount = [];
    var inpsid = document.getElementsByName('discount[]');
    for (var iid = 0; iid <inpsid.length; iid++) {
        var inpid = inpsid[iid];
        itemDiscount.push(inpid.value);
    }

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
            item_discount: itemDiscount,
            due:          $('#due').val(),
            payment_type: $('#payment_type').val(),
            _token: token},
        success: function(data) {
            $("#createOrderForm")[0].reset();
            // create order button
            var printOrderId = data;
            $("#success-order").html('<div class="alert alert-success"> ' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> تم تسجيل الطلب <br /> <br /> <a type="button" href="/sms2/public/printOrder/'+printOrderId+'"  class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> طباعة </a>'+
                '<a href="'+urlOrder +'" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> إضافة طلب جديد </a>'+
                '</div>');

            $("html, body, div.panel, div.panel-body").animate({scrollTop: '0px'}, 100);

            // disable the modal footer button
            $(".submitButtonFooter").addClass('div-hide');
            // remove the product row
            //$(".removeProductRowBtn").addClass('div-hide');
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
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
        }
        for (var x = 0; x < product_quantity.length; x++) {
            var product_quantityId = product_quantity[x].id;
            if(product_quantity[x].value == ''){
                $("#"+product_quantityId+"").after('<p class="clean_product_quantity text-danger"> حقل الكمية مطلوب </p>');
                $("#"+product_quantityId+"").closest('.form-group').addClass('has-error');
            }
        }
        $.each(responseError, function(k, v) {
            $('input#' + k).closest('div').addClass('has-error');
            $('select#' + k).closest('div').addClass('has-error');
            //$('div#error_edit-'+ k +' h6').html(v[0]);
        });
    });

});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////PAYMENTS////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function updatePayment() {
    var updatedDue = $('#edit-grand_total').val() - $('#edit-paid').val();
    $('#edit-due').val(updatedDue);
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////REMOVE ORDER ITEMS//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$('#removeOrderItemForm').on('submit', function(e) {

    e.preventDefault();
    var productIdData = [];
    var orderItemIdData = [];
    var removedQuantityData = [];
    var totalData = [];
    var totalDiscountData = [];

    $('input[name^="product_id"]').each(function() {
        productIdData.push($(this).val());
    });

    $('input[name^="order_item_id"]').each(function() {
        orderItemIdData.push($(this).val());
    });

    $('input[name^="removed_quantity"]').each(function() {
        removedQuantityData.push($(this).val());
    });

    $('input[name^="total"]').each(function() {
        totalData.push($(this).val());
    });


    $.ajax({
        type: "POST",
        url: urlRemoveOrderItem,
        data:{
            product_id:        productIdData,
            order_item_id:     orderItemIdData,
            removed_quantity: removedQuantityData,
            total:             totalData,
            removed_total:     $('#removed_total').val(),
            removed_discount:  $("#removed_discount").val(),
            order_id:          $('#order_id').val(),
            _token: token},
        success: function(data) {
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
    });

});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////VALIDATE NUMERIC INPUTS /////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var v = 0;
var m = 0;

function minMax(value, min, row){
    v = value;
    m = original[row.id.substring(3)];
    if(parseInt(value) < min || isNaN(value)){
        return min;
    } else if(parseInt(value) > m){
        return min;
    } else {
        return value;
    }
}
function minMaxDiscount(value){
    v = value;
    m = maxDiscount;
    if(parseInt(value) < 0 || isNaN(value)){
        return 0;
    } else if(parseInt(value) > m){
        return 0;
    } else {
        return value;
    }
}
function minMaxPrice(value){
    v = value;
    var plus = Number(minPrice) +((Number(minPrice)*5)/100);
    if(parseInt(value) < 0 || isNaN(value)){
        return plus;
    } else if(parseInt(value) < minPrice){
        return minPrice;
    } else {
        return value;
    }
}
function updateTotal(row) {
    if (parseInt(v) <= parseInt(m)){
        getTotal(row.id.substring(3));
    }else {
        $("#total_quantity"+row.id.substring(3)).val(m-1);
    }
}
function numInput(value)
{
    //v = value;
    if(parseInt(value) < 0 || isNaN(value)){
        return 0;
    } else {
        return value;
    }
}
function numericInput(value)
{
    //v = value;
    if(parseInt(value) < 0 || isNaN(value)){
        return 0;
    } else if($("#unit_price").val()=='' ||value > parseInt($("#unit_price").val())){
        return 0;
    } else {
        return value;
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////END OF VALIDATE NUMERIC INPUTS //////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var clientId = 0;
var clientNameElement = null;
var clientCompanyElement = null;
var clientEmailElement = null;
var clientPhoneElement = null;

$('.panel').find('.div-body-modal').find('.div-add-client-modal').find('#add-client-modal-btn').on('click', function(event){
    event.preventDefault();
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
        $(location).attr('href',urlGetClient);
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

//////////////////////////////////////PRODUCTS/////////////////////////////////////////////////////////////////////////

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
        $(location).attr('href',urlGetProduct);
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
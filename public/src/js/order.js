var manageOrderTable;
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
                console.log();
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

function removeProductRow(row = null) {
    if(row) {
        $("#row"+row).remove();


        subAmount();
    } else {
        alert('error! Refresh the page again');
    }
}

// select on product data
function getProductData(row = null) {
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
                    $("#unit_price"+row).val(response.unit_price);
                    $("#total_quantity"+row).val(response.product_quantity);

                    $("#product_quantity"+row).val(1);

                    var total = Number(response.unit_price) * 1;
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
            }); // /ajax function to fetch the product data
        }

    } else {
        alert('no row! please refresh the page');
    }
} // /select on product data

// table total
function getTotal(row = null) {
    if(row) {
        var total = Number($("#unit_price"+row).val()) * Number($("#product_quantity"+row).val());
        total = total.toFixed(2);
        $("#total"+row).val(total);
        $("#totalValue"+row).val(total);

        var total_quantity = Number($("#total_quantity"+row).val()) - Number($("#product_quantity"+row).val());
        total_quantity = total_quantity.toFixed(2);
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
} // /paid amoutn function


function resetOrderForm() {
    // reset the input field
    $("#createOrderForm")[0].reset();
    // remove remove text danger
    $(".text-danger").remove();
    // remove form group error
    $(".form-group").removeClass('has-success').removeClass('has-error');
} // /reset order form


// remove order from server
function removeOrder(orderId = null) {
    if(orderId) {
        $("#removeOrderBtn").unbind('click').bind('click', function() {
            $("#removeOrderBtn").button('loading');

            $.ajax({
                url: 'php_action/removeOrder.php',
                type: 'post',
                data: {orderId : orderId},
                dataType: 'json',
                success:function(response) {
                    $("#removeOrderBtn").button('reset');

                    if(response.success == true) {

                        manageOrderTable.ajax.reload(null, false);
                        // hide modal
                        $("#removeOrderModal").modal('hide');
                        // success messages
                        $("#success-messages").html('<div class="alert alert-success">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
                            '</div>');

                        // remove the mesages
                        $(".alert-success").delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                            });
                        }); // /.alert

                    } else {
                        // error messages
                        $(".removeOrderMessages").html('<div class="alert alert-warning">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
                            '</div>');

                        // remove the mesages
                        $(".alert-success").delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                            });
                        }); // /.alert
                    } // /else

                } // /success
            });  // /ajax function to remove the order

        }); // /remove order button clicked


    } else {
        alert('error! refresh the page again');
    }
}
// /remove order from server

// Payment ORDER
function paymentOrder(orderId = null) {
    if(orderId) {

        $("#orderDate").datepicker();

        $.ajax({
            url: 'php_action/fetchOrderData.php',
            type: 'post',
            data: {orderId: orderId},
            dataType: 'json',
            success:function(response) {

                // due
                $("#due").val(response.order[10]);

                // pay amount
                $("#payAmount").val(response.order[10]);

                var paidAmount = response.order[9]
                var dueAmount = response.order[10];
                var grand_total = response.order[8];

                // update payment
                $("#updatePaymentOrderBtn").unbind('click').bind('click', function() {
                    var payAmount = $("#payAmount").val();
                    var payment_type = $("#payment_type").val();
                    var paymentStatus = $("#paymentStatus").val();

                    if(payAmount == "") {
                        $("#payAmount").after('<p class="text-danger">The Pay Amount field is required</p>');
                        $("#payAmount").closest('.form-group').addClass('has-error');
                    } else {
                        $("#payAmount").closest('.form-group').addClass('has-success');
                    }

                    if(payment_type == "") {
                        $("#payment_type").after('<p class="text-danger">The Pay Amount field is required</p>');
                        $("#payment_type").closest('.form-group').addClass('has-error');
                    } else {
                        $("#payment_type").closest('.form-group').addClass('has-success');
                    }

                    if(paymentStatus == "") {
                        $("#paymentStatus").after('<p class="text-danger">The Pay Amount field is required</p>');
                        $("#paymentStatus").closest('.form-group').addClass('has-error');
                    } else {
                        $("#paymentStatus").closest('.form-group').addClass('has-success');
                    }

                    if(payAmount && paymentType && paymentStatus) {
                        $("#updatePaymentOrderBtn").button('loading');
                        $.ajax({
                            url: 'php_action/editPayment.php',
                            type: 'post',
                            data: {
                                orderId: orderId,
                                payAmount: payAmount,
                                payment_type: paymentType,
                                paymentStatus: paymentStatus,
                                paidAmount: paidAmount,
                                grand_total: grand_total
                            },
                            dataType: 'json',
                            success:function(response) {
                                $("#updatePaymentOrderBtn").button('loading');

                                // remove error
                                $('.text-danger').remove();
                                $('.form-group').removeClass('has-error').removeClass('has-success');

                                $("#paymentOrderModal").modal('hide');

                                $("#success-messages").html('<div class="alert alert-success">'+
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
                                    '</div>');

                                // remove the mesages
                                $(".alert-success").delay(500).show(10, function() {
                                    $(this).delay(3000).hide(10, function() {
                                        $(this).remove();
                                    });
                                }); // /.alert

                                // refresh the manage order table
                                manageOrderTable.ajax.reload(null, false);

                            } //

                        });
                    } // /if

                    return false;
                }); // /update payment

            } // /success
        }); // fetch order data
    } else {
        alert('Error ! Refresh the page again');
    }
}

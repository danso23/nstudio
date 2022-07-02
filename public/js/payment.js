$(document).ready(function() {
   $('input[name="rdPayment"]').click(function () { 
        let id = this.id
        if(id == "rdCard"){
            $("#frmPaymentCard").show();
            $("#frmPaymentOxxo").hide()
        }
        else{
            $("#frmPaymentOxxo").show()
            $("#frmPaymentCard").hide();
        }
   });
});
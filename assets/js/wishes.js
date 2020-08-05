
$('.carousel').carousel();

function rp(va) {
            //display+thousand sperator
            va += '';
            var x = va.split('.');
            var x1 = x[0];
            var x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            var d =  x1 + x2;
            var d = 'Rp.'+d;
            return d;
        } 

$(function(){
	$('.add-to-cart').on('click',function(e){
	e.preventDefault();
	var r = confirm("Tambah ke Keranjang?");
	if (r == false) {
	    return false;
	} else {
	    id_produk = $(this).data('id');
	    price = $(this).data('price');
		//alert('a');
		$.ajax({
			url :'process/add_cart.php',
			type :'POST',
			data : 'id='+id_produk+'&price='+price,
			dataType : 'html',
			success : function(data){
				console.log(data);
				$(".cart-dropdown").load('process/div_cart.php/?ajax=1');
			},
			error:function(){
				alert('terjadi error');
			}
		});
	}
	
})
})
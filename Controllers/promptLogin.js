function promtLogin(productID, productPrice) {
    if (is_loggedIn == 0) {
        //which means the user is not logged in, then prompt the user to log in

        window.alert('Please Log In First!');


    } else {
        //just add the product to the cart through ajax
        
        var ajaxreq = new XMLHttpRequest();
        ajaxreq.open("GET", "insertToCart_Ajax.php?productID=" + productID + "&user_id=" + user_id + "&product_price=" + productPrice);
        //console.log(member.id);
        ajaxreq.onreadystatechange = function() {
            if (ajaxreq.readyState == 4 && ajaxreq.status == 200) {

                var response = ajaxreq.responseText;

                var divelm = document.getElementById('shoppingBag');


                divelm.innerHTML = response;
            }
        }

        ajaxreq.send();
    }
}
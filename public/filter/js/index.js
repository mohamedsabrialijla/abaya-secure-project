var arrtaps=document.querySelectorAll(".user-information .show .tap"),
    arrtaplink=document.querySelectorAll(".user-information .tap-link"),
    arr=[],
    arrtaps_sales=document.querySelectorAll(".tap-sale"),
    arrtaps_sales_link=document.querySelectorAll(".sales .show .tap-links span"),
    arr_sales=[],
    pop_edit_prof=document.querySelector(".popup-edit-profile"),
    button_open_edit_prof=document.querySelector(".open-pop-edit-pro"),
    popup=document.querySelectorAll(".popup"),
    close_pop=document.querySelectorAll('.close-popup');

// // genral taps
// for(var x = 0;x<arrtaplink.length;x++){
//     arr.push(arrtaplink[x]);
//     arrtaplink[x].onclick=function(){
//         for(var y =0;y<arrtaplink.length;y++){
//             arrtaps[y].classList.remove("active-show")
//             arrtaplink[y].classList.remove("active_hover")
//         }
//         this.classList.add("active_hover")
//         var n = arr.indexOf(this)
//         arrtaps[n].classList.add("active-show")
//     }
// }
//tap sales
for(var u = 0;u<arrtaps_sales_link.length;u++){

    arr_sales.push(arrtaps_sales_link[u]);
    arrtaps_sales_link[u].onclick=function(){
        for(var w =0;w<arrtaps_sales_link.length;w++){
            arrtaps_sales[w].classList.remove("active-sale")
            arrtaps_sales_link[w].classList.remove("sales_tap_active")
        }
        this.classList.add("sales_tap_active")
        var n = arr_sales.indexOf(this)
        arrtaps_sales[n].classList.add("active-sale")
    }
}

function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


//open popup edit profile
// button_open_edit_prof.onclick=function(){
//     pop_edit_prof.classList.add("down-popup")
// }
// //close popup
// for(var q = 0 ;q<close_pop.length;q++){
//     close_pop[q].onclick=function(){
//         this.parentElement.classList.remove("down-popup");
//     }
// }
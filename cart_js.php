<script>
var app = new Vue({
    el: '#cart',
    data: {
        itemList: [
            <?php
            if($p_r){
                while ($row = oci_fetch_assoc($product_result)){
                    $pId = $row['PNO'];
                    $title = $row['PNAME'];
                    $photo = $row['PICTURE'];
                    $price = $row['UNITPRICE'];
                    $o_quantity = $row['OAMOUNT'];
            
            ?> {
                id: "<?=$pId?>",
                itemName: "<?=$title?>",
                imgUrl: "<?=$photo?>",
                price: "<?=$price?>",
                count: "<?=$o_quantity?>",
            },
            <?php
                }
            }
            else{
                ?>
                document.getElementById("cart_dis").style.display = "none";
                document.getElementById("cart_go").style.display = "block";
            <?php
            }
            ?>
        ]
    },
    methods: {
        handlePlus: function(item) {
            if (item.count >= 1) {
                $.ajax({
                    url: 'cart_ajax.php',
                    data: '&method=add&pId=' + item.id + "&cartTime=" +
                        '<?=$cart_time?>' + "&count=" + item.count,
                    type: 'POST',
                    dataType: 'json',
                    cache: false
                }).done(function(data) {
                    if (data['status'] = "success") {
                        item.count++;
                    
                    }
                })
            }
        },
        handleSub: function(item) {
            if (item.count > 1) {
                $.ajax({
                    url: 'cart_ajax.php',
                    data: '&method=minus&pId=' + item.id + "&cartTime=" + '<?=$cart_time?>' +
                        "&count=" + item.count,
                    type: 'POST',
                    dataType: 'json',
                    cache: false
                }).done(function(data) {
                    if (data['status'] = "success") {
                        item.count--;
                        //$(".total_price").text("商品總金額: $");
                    }
                })
            }
        },
        handledelete: function(item, index) {
            console.log(this);
            console.log(item);
            console.log(index);
            this.itemList.splice(index, 1);
            $.ajax({
                url: 'cart_ajax.php',
                data: '&method=del&pId=' + item.id + "&cartTime=" + '<?=$cart_time?>' + "&count=" +
                    item.count,
                type: 'POST',
                dataType: 'json',
                cache: false
            }).done(function(data) {
                if (data['status'] = "success") {
                    location.reload();
                    /*
                    Swal.fire({
                        icon: 'success',
                        title: '刪除成功',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        $('.cart_count').text(data['count']);

                    })
                    */
                    // if(data['q_c'] == 0){
                    //         $("#cart_dis").hide();
                    //         $("#cart_go").show();
                    // }
                }
            })

        }
    },
    computed: {

    }
})

$(document).ready(function() {
   
    // if(==0){
    //     $("#cart_dis").hide();
    //     $("#cart_go").show();
    // }
    // else{
    //     $("#cart_go").hide();
    //     $("#cart_dis").show();
    // }
});
</script>
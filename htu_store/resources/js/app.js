

$(function () {
    const items = $('#items');
    const addItem = $('#add-item');
    const table = $('#tbody1');

    $(document).ready(function() {
        items.change(function(event) {  
          // Get the value of the 'id' field
          let item = $('#items').val();
          // Send an AJAX request to the PHP script
          $.ajax({
            type: 'GET',
            url: 'http://htu_store.local/api/item?id='+ item,
            success: function(response) {
              // Display the data in the 'result'
              let  item_name = response.body.item_name;
              let availableQuantity = response.body.stock;
              let price = response.body.selling_price;
              table.empty();
              table.append(`
              <tr>
                <td>1</td>
                <td>${item_name}</td>
                <td>${availableQuantity}</td>
                <td>${price} (JD)</td>
              </tr>
              `);
            },
            error: function(xhr, status, error) {
                console.log("There was an error with the AJAX request.");
                console.log("Error status:", status);
                console.log("Error message:", error);
              }
          }); 
        });

        addItem.click(function(e) {
            e.preventDefault();// prevent the form from submitting
            let item = $('#items').val();
            if (item == "" || $('#quantity').val() == "" || $('#quantity').val() == 0) {
              alert("You need to enter an item or quntity to proceed!");
              return;
              }         
            $.ajax({
              type: 'GET',
              url: 'http://htu_store.local/api/item?id='+ item,
              success: function(response) {
                // Get the data in to create transaction
                let availableQuantity = response.body.stock;
                let data = {
                  item_name: response.body.item_name,
                  item_quantity: $('#quantity').val(),
                  item_price: response.body.selling_price,
                  total_price: response.body.selling_price * parseInt($('#quantity').val()),};

                if ( parseInt($('#quantity').val()) > availableQuantity) {
                    alert("your quantity more than available quantity");
                    return;
                }  

                $.ajax({
                  type: "POST",
                  url: "http://htu_store.local/api/transaction/create",
                  data: JSON.stringify(data),
                  success: function(response) {
                    $.post("http://htu_store.local/api/transaction/update", {

                      item_id: $('#items').val(),
                      quantity: $('#quantity').val(),
                      user_id: $('#user-id').val(),
                    }, function(response) {
                      // handle the response
                    });
                    $('#userInputContainer').trigger('reset');
                    alert('done') 
                    location.reload();
                    },
                  error: function(xhr, status, error) {
                    console.log("There was an error with the AJAX request.");
                    console.log("Error status:", status);
                    console.log("Error message:", error);
                  } }); 
                },

              error: function(xhr, status, error) {
                  console.log("There was an error with the AJAX request.");
                  console.log("Error status:", status);
                  console.log("Error message:", error);
                }
            });           
        });

    });
});

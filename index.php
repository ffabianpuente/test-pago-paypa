<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paypal</title>
</head>
<body>
    <!-- Replace "test" with your own sandbox Business account app client ID -->

    <script src="https://www.paypal.com/sdk/js?client-id=AeBw-7WOL21fjRlNQ3TvdApaU140A9CwrPXjj3rd3zYcnGFAo-pokMEpkGy9Ds89dOvJSCeOjOWoYP5Q&currency=USD"></script>

    <!-- Set up a container element for the button -->

    <div id="paypal-button-container"></div>

    <script>

      paypal.Buttons({
          style: {
              color: 'blue',
              shape: 'pill',
              label: 'pay'
          },

        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: 10 // Can also reference a variable or function
              }
            }]
          });
        },
        onCancel: function (data) {
            alert('Cancelado');
        },
        // Finalize the transaction after payer approval

        onApprove: (data, actions) => {
          return actions.order.capture().then( function (detalles) {
              // llamar a api para actualizar datos de la db, actualizar compra
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
          });

        }

      }).render('#paypal-button-container');

    </script>
    
</body>
</html>
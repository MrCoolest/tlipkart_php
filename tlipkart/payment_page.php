<meta name="viewport" content="width=device-width, initial-scale=1">


<style>
    .container {
    background-color: rgb(240, 240, 240);
    margin: auto;
    width: calc(70%);

    border: none;
    border-radius: 4px;
    margin-top : 4rem ;
    padding-top : 2rem;
}

#checkout-form {
    position: relative;
    width: calc(70%);
    margin: auto;
    padding: 10px;
}

#checkout-form label {
    display: block;
    min-height: 25px;

    font-size: 15px;
    font-weight: 500;
    margin: 5px 0;
    padding: 0;
    color: red;
}

#card-number, #card-cvv, #card-expiry {
    background-color: #FFF;
    display: block;
    width: calc(90%);
    border-radius: 2px;
    border: 1px solid rgba(200, 200, 200, 1);
    padding: 14px 60px 13px 20px;
    margin: auto;
    transition: all 100ms ease-out;
}

/* card images are added to card number */
#card-number {
    background-image: none;

    background-origin: content-box;
    background-position: calc(100% + 40px) center;
    background-repeat: no-repeat;
    background-size: contain;
}

/* buttons */
.btn {
    vertical-align: top;
}

.btn {
    position: relative;
    border: none;
    border-radius: 4px;
    background-color: rgba(120, 71, 181, 1);
    color: rgba(255, 255, 255, 1);
    display: inline-block;
    transition: all 100ms ease-out;
    padding: 11px 25px;
}

.btn:hover, .btn:active {
    background-color: rgba(69, 36, 89, 1);
}

.btn:active {
    box-shadow: inset 0 0 35px rgba(0, 0, 0, 0.3);
}

.btn:disabled {
    background-color: rgba(255, 255, 255, 1);
    border: 1px solid rgba(120, 71, 181, 1);
    color: rgba(120, 71, 181, 1);
}

/* feedback is displayed after tokenization */
#feedback {
    position: relative;
    left: 15px;
    display: inline-block;
    background-color: transparent;
    border: 0px solid rgba(200, 200, 200, 1);
    border-radius: 4px;
    transition: all 100ms ease-out;
    padding: 11px;
}

#feedback.error {
    color: red;
    border: 1px solid;
}

#feedback.success {
    color: seagreen;
    border: 1px solid;
}
</style>

<script src='https://libs.na.bambora.com/customcheckout/1/customcheckout.js'></script>


<div class="container p-5 m-5">
    <form id="checkout-form">
        <div id="card-number"></div>
        <label for="card-number" id="card-number-error"></label>

        <div id="card-cvv"></div>
        <label for="card-cvv" id="card-cvv-error"></label>

        <div id="card-expiry"></div>
        <label for="card-expiry" id="card-expiry-error"></label>

        <input id="pay-button" type="submit" class="btn disabled" value="Pay" disabled="true" />

        <div id="feedback"></div>
    </form>
</div>


<script>
    /* global customcheckout */

(function() {
  var customCheckout = customcheckout();

  var isCardNumberComplete = false;
  var isCVVComplete = false;
  var isExpiryComplete = false;

  var customCheckoutController = {
    init: function() {
      console.log('checkout.init()');
      this.createInputs();
      this.addListeners();
    },
    createInputs: function() {
      console.log('checkout.createInputs()');
      var options = {};

      // Create and mount the inputs
      options.placeholder = 'Card number';
      customCheckout.create('card-number', options).mount('#card-number');

      options.placeholder = 'CVV';
      customCheckout.create('cvv', options).mount('#card-cvv');

      options.placeholder = 'MM / YY';
      customCheckout.create('expiry', options).mount('#card-expiry');
    },
    addListeners: function() {
      var self = this;

      // listen for submit button
      if (document.getElementById('checkout-form') !== null) {
        document
          .getElementById('checkout-form')
          .addEventListener('submit', self.onSubmit.bind(self));
      }

      customCheckout.on('brand', function(event) {
        console.log('brand: ' + JSON.stringify(event));

        var cardLogo = 'none';
        if (event.brand && event.brand !== 'unknown') {
          var filePath =
            'https://cdn.na.bambora.com/downloads/images/cards/' +
            event.brand +
            '.svg';
          cardLogo = 'url(' + filePath + ')';
        }
        document.getElementById('card-number').style.backgroundImage = cardLogo;
      });

      customCheckout.on('blur', function(event) {
        console.log('blur: ' + JSON.stringify(event));
      });

      customCheckout.on('focus', function(event) {
        console.log('focus: ' + JSON.stringify(event));
      });

      customCheckout.on('empty', function(event) {
        console.log('empty: ' + JSON.stringify(event));

        if (event.empty) {
          if (event.field === 'card-number') {
            isCardNumberComplete = false;
          } else if (event.field === 'cvv') {
            isCVVComplete = false;
          } else if (event.field === 'expiry') {
            isExpiryComplete = false;
          }
          self.setPayButton(false);
        }
      });

      customCheckout.on('complete', function(event) {
        console.log('complete: ' + JSON.stringify(event));

        if (event.field === 'card-number') {
          isCardNumberComplete = true;
          self.hideErrorForId('card-number');
        } else if (event.field === 'cvv') {
          isCVVComplete = true;
          self.hideErrorForId('card-cvv');
        } else if (event.field === 'expiry') {
          isExpiryComplete = true;
          self.hideErrorForId('card-expiry');
        }

        self.setPayButton(
          isCardNumberComplete && isCVVComplete && isExpiryComplete
        );
      });

      customCheckout.on('error', function(event) {
        console.log('error: ' + JSON.stringify(event));

        if (event.field === 'card-number') {
          isCardNumberComplete = false;
          self.showErrorForId('card-number', event.message);
        } else if (event.field === 'cvv') {
          isCVVComplete = false;
          self.showErrorForId('card-cvv', event.message);
        } else if (event.field === 'expiry') {
          isExpiryComplete = false;
          self.showErrorForId('card-expiry', event.message);
        }
        self.setPayButton(false);
      });
    },
    onSubmit: function(event) {
      var self = this;

      console.log('checkout.onSubmit()');

      event.preventDefault();
      self.setPayButton(false);
      self.toggleProcessingScreen();

      var callback = function(result) {
        console.log('token result : ' + JSON.stringify(result));

        if (result.error) {
          self.processTokenError(result.error);
        } else {
          self.processTokenSuccess(result.token);
          self.sendtopayment(result.token);
        }
      };

      console.log('checkout.createToken()');
      customCheckout.createToken(callback);
    },
    hideErrorForId: function(id) {
      console.log('hideErrorForId: ' + id);

      var element = document.getElementById(id);

      if (element !== null) {
        var errorElement = document.getElementById(id + '-error');
        if (errorElement !== null) {
          errorElement.innerHTML = '';
        }

        var bootStrapParent = document.getElementById(id + '-bootstrap');
        if (bootStrapParent !== null) {
          bootStrapParent.className = 'form-group has-feedback has-success';
        }
      } else {
        console.log('showErrorForId: Could not find ' + id);
      }
    },
    showErrorForId: function(id, message) {
      console.log('showErrorForId: ' + id + ' ' + message);

      var element = document.getElementById(id);

      if (element !== null) {
        var errorElement = document.getElementById(id + '-error');
        if (errorElement !== null) {
          errorElement.innerHTML = message;
        }

        var bootStrapParent = document.getElementById(id + '-bootstrap');
        if (bootStrapParent !== null) {
          bootStrapParent.className = 'form-group has-feedback has-error ';
        }
      } else {
        console.log('showErrorForId: Could not find ' + id);
      }
    },
    setPayButton: function(enabled) {
      console.log('checkout.setPayButton() disabled: ' + !enabled);

      var payButton = document.getElementById('pay-button');
      if (enabled) {
        payButton.disabled = false;
        payButton.className = 'btn btn-primary';
      } else {
        payButton.disabled = true;
        payButton.className = 'btn btn-primary disabled';
      }
    },
    toggleProcessingScreen: function() {
      var processingScreen = document.getElementById('processing-screen');
      if (processingScreen) {
        processingScreen.classList.toggle('visible');
      }
    },
    showErrorFeedback: function(message) {
      var xMark = '\u2718';
      this.feedback = document.getElementById('feedback');
      this.feedback.innerHTML = xMark + ' ' + message;
      this.feedback.classList.add('error');
    },
    showSuccessFeedback: function(message) {
      var checkMark = '\u2714';
      this.feedback = document.getElementById('feedback');
      this.feedback.innerHTML = checkMark + ' ' + message;
      this.feedback.classList.add('success');
    },
    processTokenError: function(error) {
      error = JSON.stringify(error, undefined, 2);
      console.log('processTokenError: ' + error);

      this.showErrorFeedback(
        'Error creating token: </br>' + JSON.stringify(error, null, 4)
      );
      this.setPayButton(true);
      this.toggleProcessingScreen();
    },
    processTokenSuccess: function(token) {
      console.log('processTokenSuccess: ' + token);

      this.showSuccessFeedback('Success! Created token: ' + token);
      this.setPayButton(true);
      this.toggleProcessingScreen();

      // Use token to call payments api
      // this.makeTokenPayment(token);
    },
    sendtopayment : function(token){
      url= './payment.php'
//       var xhttp = new XMLHttpRequest();
//       xhttp.open("POST", url , true); 
//       xhttp.setRequestHeader("Content-Type", "application/json");
//       xhttp.onreadystatechange = function() {
//    if (this.readyState == 4 && this.status == 200) {
//      // Response
//      var response = this.responseText;
//      console.log(response);
//      console.log("ok");
//    }
// };

const data = {name: "A", transaction : token.toString()}        ;
console.log(data);
// xhttp.send(JSON.stringify(data));
fetch(url, {
  method: 'POST', // or 'PUT'
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify(data),
})
.then(response => response.text())
.then(data => {
  console.log('Success:', data);
})
    }
  };

  customCheckoutController.init();
})();
</script>

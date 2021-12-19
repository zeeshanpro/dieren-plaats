<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Stripe Checkout Sample</title>
    <!-- <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/global.css" /> -->
  </head>
  <body>
    <div class="sr-root">
      <div class="sr-main">
        <div class="sr-payment-summary completed-view">
            <h1>Your payment succeeded</h1>
            <h4>
              View CheckoutSession response:</a>
            </h4>
          </div>
          <div class="sr-section completed-view">
            <div class="sr-callout">
              <pre><?= $session_json ?></pre>
            </div>
            <button onclick="window.location.href = '/';">Restart demo</button>
            <form action="subscription-success" method="POST">
              <!-- This is only used for demonstration. In practice, you should use the customer related to the authenticated user. -->
              <input type="hidden" name="sessionId" value="<?php echo $checkout_session_id ?>" />

              <button>Manage Billing</button>
            </form>
          </div>
        </div>
        <div class="sr-content">
        <div class="pasha-image-stack">
          <img
            src="https://picsum.photos/280/320?random=1"
            width="140"
            height="160"
          />
          <img
            src="https://picsum.photos/280/320?random=2"
            width="140"
            height="160"
          />
          <img
            src="https://picsum.photos/280/320?random=3"
            width="140"
            height="160"
          />
          <img
            src="https://picsum.photos/280/320?random=4"
            width="140"
            height="160"
          />
        </div>
      </div>
    </div>
  </body>
</html>
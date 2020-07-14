var stripe = Stripe('pk_test_lg65pJjeTnXY3J3m9v3vAerr00fxkhXMoc');
var elements = stripe.elements();
var card = elements.create('card');
## About Project

This project is somewhat similar to the food ordering project between the user, the eatery, and the delivery person ,,,
The delivery person here is a freelancer

-   After the process of registering a new user, we can send a verification number to the user via Twilo
-   Here the user has become logged in, and has no right to enter anywhere other than his own account, except after verifying
    his verification number.
-   After the verification process
-   The user can visit the page of restaurants near him within a distance of 15 km to order one of the restaurant’s products
-   The system measures the distance between the user and the restaurant, and this depends on the user’s coordinates
    during registration
-   After this, he can visit his order page to see the order process he requested, if he wants

-   .....................

-   Here comes the role of Delivery Lyra for orders close to it within 15 km on its own pages
-   He can also know the distance between his current location and the restaurant, and also know the distance from the
    restaurant to the user

-   You can log in from this number if you do not want to log in to the database "+201095610720"
-   The default password is "password"
-   Don't forget to put your twilio credentials And also FCM credentials
-   Don't forget to Generate secret key artisan jwt:secret
-   when authentication don't forget to set token USER_TOKEN when auth by user
    or DELIVERY_TOKEN when auth by delivery in environments postman

-   postman collection in Storage Directory
-   database in database directory

# RESTFUL-API
#

Restful api programmed using php mysql

1- you need to install xampp,,if you dont have it you can download it from https://www.apachefriends.org/download.html.
2- create database named (sign up) dont add any password,, you can you use database file in this folder to eazy build the tables.
3- put the folder in xampp that you downloaded ,put it in this path (xampp\htdocs).
4- now you need to download postman app to use the api and test it , you can download it from https://www.postman.com/downloads/ 
5- open postman and choose post and in url enter http://localhost/RESTFUL-API/Sign-up.php , and go to header and add Content-Type as key and application/json as value
then go to body and enter user info in json , you can you use the (tamplet 1) in (data) file. now you'll see the info is added in the table.
6- now for sign in enter http://localhost/RESTFUL-API/Sign-in.php ,then in body enter email and password , you can use (tamplet 2), in the console you'll see jwt is printed,,copy it to use it later.
7- for changing first name and last name enter http://localhost/RESTFUL-API/ChangeUserInfo.php and then go to header and add Authorization as key and Bearer (here paste jwt) as value , and in body use tamplet 3 to change the info.if you changed just 1 letter in jwt ,,you'll see that you'll not be able to change user info.
8 - for storing authenticated user customer support ticket enter http://localhost/RESTFUL-API/customer_support_ticket.php and in header use jwt for the user that you want and in body use tamplet 4,now see customer_support_ticket table to see the results.
9 - last for getting the tickets enter http://localhost/RESTFUL-API/GettingTickets.php and use jwt in header and now you'll see the result in console below..try use jwt for user has (role = user) and you'll not be able to get this data.
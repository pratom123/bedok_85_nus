create table Account_information
(account_id int unsigned auto_increment primary key,
firstname varchar(40) not null,
lastname varchar(40) not null,
username varchar(40) not null,
password_info varchar(40) not null,
e_mail varchar(40) not null,
mobile_no int unsigned not null,
Address1 varchar(40),
Address2 varchar(40),
Address3 varchar(40),
credit_card varchar(40) not null,
card_name varchar(40) not null,
cv2 varchar(40) not null,
expirydate varchar(40) not null,
admin BIT not null
);


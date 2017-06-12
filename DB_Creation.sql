







###############testowa wiadomosc

    insert into Tweets(user_id, message, msg_date)
  values (1, 'test message loaded manual its working', now());

################ testowy user

 insert into Users(email, username, hashed_password) values('kruchy@ruchy.com', 'kruchy', '1');


   CREATE TABLE Messages (
       id int unsigned not null auto_increment,
       author_id int not null,
       receiver_id int not null,
       creationDate datetime not null,
       text blob not null,
       `status` varchar(255) not null,
       primary key (id),
       foreign key (author_id) references Users(id),
       foreign key (receiver_id) references Users(id)
       on delete cascade
   );

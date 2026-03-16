create table users (
`id` int(11) unsigned AUTO_INCREMENT not null PRIMARY key ,
 `name`  varchar(100) not null,
 `email` varchar(100) not null,
 `password` varchar(255) not null ,
`created_at` timestamp DEFAULT CURRENT_TIMESTAMP

);

ALTER TABLE `users` ADD UNIQUE(`email`);


create table tasks(

    `id` int(11) unsigned AUTO_INCREMENT not null PRIMARY KEY,
    `title` varchar(200)  not null ,
    `description` text not null ,
    `status` ENUM('pending','done') not null DEFAULT 'pending',
    `user_id` int(11) unsigned not null ,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp null DEFAULT null ,
    CONSTRAINT fk_tasks_user FOREIGN key (user_id)
    REFERENCES users(id) on UPDATE CASCADE on DELETE CASCADE 
    
);
  -- > Table utilisateur
  
drop table utilisateur;
create table utilisateur (
	id_utilisateur  int primary key auto_increment,
	email_ut varchar(255),
	mdp_ut varchar(255),
    dateDeCreation_ut timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    dateDeModification_ut timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

insert into utilisateur ( email_ut, mdp_ut )
values 
	( "John@mail.fr", "bd73d35759d75cc215150d1bbc94f1b1078bee01"),
	( "Serge@email.com", "00762ccfa703393e0daff813a6ecc19f7cd02421"),
    ( "aa@aa", "e0c9035898dd52fc65c41454cec9c4d2611bfb37")
;

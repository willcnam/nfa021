  -- > Table evenement

drop table evenement;
create table sharedgifts.evenement (
	id_evenement int primary key auto_increment,
	nom_evt varchar(255) NOT NULL UNIQUE,
    dateDeCreation_evt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    dateDeModification_evt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

insert into evenement ( nom_evt )
values 
	( "Noel 2018"),
	( "Noel 2019"), 
	("Annif Céline"),
	("Annif Adèle")
;

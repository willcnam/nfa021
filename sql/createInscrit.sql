  -- > Table inscrit
  
drop table inscrit;
create table sharedgifts.inscrit (
	id_inscrit int primary key auto_increment,
	id_utilisateur_ins int,
	id_evenement_ins int,
    dateDeCreation_ins timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    dateDeModification_ins timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX id_utilisateur_index (id_utilisateur_ins),
    FOREIGN KEY (id_utilisateur_ins)
        REFERENCES utilisateur(id_utilisateur)
        ON DELETE CASCADE,
    INDEX id_evenement_index (id_evenement_ins),
    FOREIGN KEY (id_evenement_ins)
        REFERENCES evenement(id_evenement)
        ON DELETE CASCADE,
     CONSTRAINT ParticipationUnique UNIQUE (id_utilisateur_ins, id_evenement_ins)
);

insert into inscrit ( id_utilisateur_ins, id_evenement_ins )
values 
	( "1", "1"),
    ( "1", "2"),
	( "2","1"),
	( "3", "1")
;

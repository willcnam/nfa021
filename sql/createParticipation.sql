  -- > Table participation
  
drop table participation;
create table sharedgifts.participation (
	id_participation int primary key auto_increment,
    montant_part int,
	id_inscrit_de_part int,
    id_inscrit_pour_part int,
    dateDeCreation_part timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    dateDeModification_part timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX id_inscrit_de_index (id_inscrit_de_part),
    FOREIGN KEY (id_inscrit_de_part)
        REFERENCES inscrit(id_inscrit)
        ON DELETE CASCADE,
    INDEX id_inscrit_pour_index (id_inscrit_pour_part),
    FOREIGN KEY (id_inscrit_pour_part)
        REFERENCES inscrit(id_inscrit)
        ON DELETE CASCADE
);

insert into participation ( montant_part, id_inscrit_de_part, id_inscrit_pour_part )
values 
	( "20", "1", "2"),
    ( "30", "1", "3"),
	( "100", "2", "2"),
	( "15000", "3", "2")
;

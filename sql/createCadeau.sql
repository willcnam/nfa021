  -- > Table cadeau
  
drop table cadeau;
create table cadeau (
	id_cadeau int primary key auto_increment,
	nom_cad varchar(255),
    prix_cad int,
	id_inscrit_de_cad int,
    id_inscrit_pour_cad int,
    dateDeCreation_cad timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    dateDeModification_cad timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX id_inscrit_de_index (id_inscrit_de_cad),
    FOREIGN KEY (id_inscrit_de_cad)
        REFERENCES inscrit(id_inscrit)
        ON DELETE CASCADE,
    INDEX id_inscrit_pour_index (id_inscrit_pour_cad),
    FOREIGN KEY (id_inscrit_pour_cad)
        REFERENCES inscrit(id_inscrit)
        ON DELETE CASCADE
);

insert into cadeau ( nom_cad, prix_cad, id_inscrit_de_cad, id_inscrit_pour_cad )
values 
	( "Cafetière", "150", "1", "1"),
    ( "Pantalon", "89", "1", "2"),
	( "Genois","2300", "2", "2"),
	( "Roman policier", "15", "3", "2")
;

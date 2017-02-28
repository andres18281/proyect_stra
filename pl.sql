use `stratecsa%%`;
delimiter ||
CREATE EVENT mount_facture 
 ON SCHEDULE EVERY '1' MONTH 
 STARTS '2016-06-17 09:16:45'
 ON COMPLETION PRESERVE ENABLE 
 DO 
  BEGIN 
   DECLARE done INT DEFAULT FALSE;
   DECLARE codigo int(10);
   DECLARE costo int(10);
   DECLARE empresa varchar(60);
   DECLARE nit varchar(12);
   DECLARE tiempo int(2);
   DECLARE cur CURSOR FOR 
        SELECT Id_contrat,Contra_costo,Empres_nomb,Empres_nit,Contra_time
        FROM contrato con
        INNER JOIN empresa_stra emp ON emp.Empres_nit = con.Contra_id_client
        WHERE DATE_FORMAT(Contra_time_ini,'%Y%m') >= DATE_FORMAT(now(),'%Y%m') 
        AND DATE_FORMAT(Contra_time_fin,'%Y%m') <= DATE_FORMAT(now(),'%Y%m')
        AND Contra_Form_pago = 2 
        AND Contra_stado = 1 
        AND Contra_time >= (SELECT COUNT(*) FROM pagos_str WHERE pago_id_contrat = Id_contrat); 
	      DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
        OPEN cur;
        start_loop:loop 
          fetch cur into codigo,costo,empresa,nit,tiempo;
            IF done THEN 
		          LEAVE start_loop;
	          END if;
            INSERT INTO `pagos_str`(`pagos_id`,`pago_fecha`,`pago_fecha_fin`,`pago_fecha_pago`,`pago_id_fact`,`pago_id_empre`,`pago_costo`,`pago_confir`) VALUES(null,now(),LAST_DAY(now()),null,codigo,nit,(costo/tiempo),2);
          END loop start_loop;
        close cur;
  END ||
delimiter; 


delimiter ||
CREATE EVENT trimestre_facture 
 ON SCHEDULE EVERY '3' MONTH 
 STARTS '2016-06-17 09:16:45'
 ON COMPLETION PRESERVE ENABLE 
 DO 
  BEGIN 
   DECLARE done INT DEFAULT FALSE;
   DECLARE codigo int(10);
   DECLARE costo int(10);
   DECLARE empresa varchar(60);
   DECLARE nit varchar(12);
   DECLARE tiempo int(2);
   DECLARE cur CURSOR FOR 
        SELECT Id_contrat,Contra_costo,Empres_nomb,Empres_nit,Contra_time
        FROM contrato con
        INNER JOIN empresa_stra emp ON emp.Empres_nit = con.Contra_id_client
        WHERE DATE_FORMAT(Contra_time_ini,'%Y%m') >= DATE_FORMAT(now(),'%Y%m') 
        AND DATE_FORMAT(Contra_time_fin,'%Y%m') <= DATE_FORMAT(now(),'%Y%m')
        AND Contra_Form_pago = 3 
        AND Contra_stado = 1 
        AND Contra_time >= (SELECT COUNT(*) FROM pagos_str WHERE pago_id_fact = Id_contrat); 
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
        OPEN cur;
        start_loop:loop 
          fetch cur into codigo,costo,empresa,nit,tiempo;
            IF done THEN 
              LEAVE start_loop; 
            END if;
            INSERT INTO `pagos_str`(`pagos_id`,`pago_fecha`,`pago_fecha_fin`,`pago_fecha_pago`,`pago_id_fact`,`pago_id_empre`,`pago_costo`,`pago_confir`) VALUES(null,now(),LAST_DAY(now()),null,codigo,nit,(costo/tiempo),2);
          END loop start_loop;
        close cur;
  END ||
delimiter ;

delimiter ||
CREATE EVENT semestre_facture 
 ON SCHEDULE EVERY '6' MONTH 
 STARTS '2016-06-17 09:16:45'
 ON COMPLETION PRESERVE ENABLE 
 DO 
  BEGIN 
   DECLARE done INT DEFAULT FALSE;
   DECLARE codigo int(10);
   DECLARE costo int(10);
   DECLARE empresa varchar(60);
   DECLARE nit varchar(12);
   DECLARE tiempo int(2);
   DECLARE cur CURSOR FOR 
        SELECT Id_contrat,Contra_costo,Empres_nomb,Empres_nit,Contra_time
        FROM contrato con
        INNER JOIN empresa_stra emp ON emp.Empres_nit = con.Contra_id_client
        WHERE DATE_FORMAT(Contra_time_ini,'%Y%m') >= DATE_FORMAT(now(),'%Y%m') 
        AND DATE_FORMAT(Contra_time_fin,'%Y%m') <= DATE_FORMAT(now(),'%Y%m')
        AND Contra_Form_pago = 4 
        AND Contra_stado = 1 
        AND Contra_time >= (SELECT COUNT(*) FROM pagos_str WHERE pago_id_fact = Id_contrat); 
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
        OPEN cur;
        start_loop:loop 
          fetch cur into codigo,costo,empresa,nit,tiempo;
            IF done THEN 
              LEAVE start_loop; 
            END if;
            INSERT INTO `pagos_str`(`pagos_id`,`pago_fecha`,`pago_fecha_fin`,`pago_fecha_pago`,`pago_id_fact`,`pago_id_empre`,`pago_costo`,`pago_confir`) VALUES(null,now(),LAST_DAY(now()),null,codigo,nit,(costo/tiempo),2);
          END loop start_loop;
        close cur;
  END ||
delimiter ;



delimiter ||
CREATE EVENT mount_facture 
 ON SCHEDULE EVERY '1' MONTH 
 STARTS '2016-06-17 09:16:45'
 ON COMPLETION PRESERVE ENABLE 
 DO 
  BEGIN 
   DECLARE done INT DEFAULT FALSE;
   DECLARE codigo int(10);
   DECLARE costo int(10);
   DECLARE cost INT(10);
   DECLARE empresa varchar(60);
   DECLARE nit varchar(12);
   DECLARE tiempo int(2);
   DECLARE contador int(1) DEFAULT 0;
   DECLARE last_id_fact int(10);
   DECLARE id int(10);
   DECLARE cont INT(2);
   DECLARE total INT(10) DEFAULT 0;
   DECLARE cur CURSOR FOR 
        SELECT Id_contrat,Contra_costo,Empres_nomb,Empres_nit,Contra_time
        FROM contrato con
        INNER JOIN empresa_stra emp ON emp.Empres_nit = con.Contra_id_client
        WHERE DATE_FORMAT(Contra_time_ini,'%Y%m') >= DATE_FORMAT(now(),'%Y%m') 
        AND DATE_FORMAT(Contra_time_fin,'%Y%m') <= DATE_FORMAT(now(),'%Y%m')
        AND Contra_Form_pago = 2 
        AND Contra_stado = 1 
        AND Contra_time >= (SELECT COUNT(*) FROM pagos_str WHERE pago_id_fact = Id_contrat);
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
        OPEN cur;
        start_loop:loop 
          fetch cur into codigo,costo,empresa,nit,tiempo;
            IF done THEN 
              LEAVE start_loop;
            END if;
            DECLARE pag CURSOR FOR 
              SELECT pagos_id,pago_costo,COUNT(*)
              FROM pagos_str
              WHERE DATE_FORMAT(pago_fecha_inic,'%Y%m') >= DATE_FORMAT(now(),'%Y%m') 
              AND DATE_FORMAT(pago_fecha_fin,'%Y%m') <= DATE_FORMAT(now(),'%Y%m') 
              AND pago_id_empre = nit;
              DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
              OPEN pag;
              start_loop:loop 
                fetch pag into id,cost,cont;
                IF contador == 0 THEN 
                  INSERT INTO factura_stra (Fact_id_client,Fact_id_contrat,Fact_fecha,fact_fecha_final,Fact_total,Fact_cancelado) VALUES(nit,codigo,NOW(),CONCAT(YEAR(NOW()),"-",MONTH(NOW()),"-",30),0,2);   
                  SET contador = 1;
                  SET last_id_fact = LAST_INSERT_ID();
                END IF
                IF done THEN 
                  LEAVE start_loop;
                  SET contador = 0;
                  SET last_id_fact = 0;
                END if;
                SET total = cost + total;
                INSERT INTO detalles_fact(Deta_id_fact,Deta_id_pago) VALUES(last_id_fact,id);
              END loop start_loop;
            close cur;    
        END loop start_loop;
        close cur;
   END ||
delimiter; 



delimiter ||
CREATE PROCEDURE generar_fact()
  BEGIN 
   DECLARE done INT DEFAULT FALSE;
   DECLARE done2 INT DEFAULT FALSE;
   DECLARE codigo int(10);
   DECLARE costo int(10);
   DECLARE cost INT(10);
   DECLARE empresa varchar(60);
   DECLARE nit varchar(12);
   DECLARE tiempo int(2);
   DECLARE contador int DEFAULT 0;
   DECLARE last_id_fact int(10);
   DECLARE id int(10);
   DECLARE cont INT(2);
   DECLARE total INT(10) DEFAULT 0;
   DECLARE cur CURSOR FOR 
        SELECT Id_contrat,Contra_costo,Empres_nomb,Empres_nit,Contra_time
        FROM contrato con
        INNER JOIN empresa_stra emp ON emp.Empres_nit = con.Contra_id_client
        WHERE DATE_FORMAT(Contra_time_ini,'%Y%m') <= DATE_FORMAT(now(),'%Y%m') 
        AND DATE_FORMAT(Contra_time_fin,'%Y%m') >= DATE_FORMAT(now(),'%Y%m')
        AND Contra_Form_pago = 2 
        AND Contra_stado = 1 
        AND Contra_time >= (SELECT COUNT(*) FROM pagos_str WHERE pago_id_contrat = Id_contrat);
        DECLARE pag CURSOR FOR 
              SELECT pagos_id,pago_costo,COUNT(*)
              FROM pagos_str
              WHERE DATE_FORMAT(pago_fecha_inic,'%Y%m') = DATE_FORMAT(now(),'%Y%m') 
              AND pago_id_empre = nit 
              AND pago_confir = 2;
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
        OPEN cur;
        LOOP1:loop
            fetch cur into codigo,costo,empresa,nit,tiempo;
            IF done THEN 
              LEAVE LOOP1;
              close cur; 
            END IF;
            OPEN pag;
            LOOP2:loop 
              fetch pag into id,cost,cont;
              IF contador = 0 THEN 
                INSERT INTO factura_stra (Fact_id_client,Fact_id_contrat,Fact_fecha,fact_fecha_final,Fact_total,Fact_cancelado) VALUES(nit,codigo,NOW(),CONCAT(YEAR(NOW()),"-",MONTH(NOW()),"-",30),0,2);   
                SET contador = 1;
                SET last_id_fact = LAST_INSERT_ID();
              END IF;
              IF done THEN 
                LEAVE LOOP2;
                SET contador = 0;
                SET last_id_fact = 0;
                close pag; 
              END IF;
              SET total = cost + total;
              INSERT INTO detalles_fact(Deta_id_fact,Deta_id_pago) VALUES(last_id_fact,id);
            END loop LOOP2;
            UPDATE factura_stra SET Fact_total = total WHERE Fact_id = last_id_fact;
            SET contador = 0;
        END loop LOOP1;
  END ||
delimiter; 



----------------------------------------------------




delimiter ||
CREATE EVENT trimestre_facture 
 ON SCHEDULE EVERY '1' MONTH 
 STARTS '2016-06-17 09:16:45'
 ON COMPLETION PRESERVE ENABLE 
 DO 
  BEGIN 
     DECLARE done INT DEFAULT FALSE;
    DECLARE done2 INT DEFAULT FALSE;
    DECLARE codigo int(10);
    DECLARE costo int(10);
    DECLARE cost INT(10);
    DECLARE empresa varchar(60);
    DECLARE nit varchar(12);
    DECLARE tiempo int(2);
    DECLARE contador int DEFAULT 0;
    DECLARE last_id_fact int(10);
    DECLARE id int(10);
    DECLARE cont INT(2);
    DECLARE total INT(10) DEFAULT 0;
    DECLARE cur CURSOR FOR 
        SELECT Id_contrat,Contra_costo,Empres_nomb,Empres_nit,Contra_time
        FROM contrato con
        INNER JOIN empresa_stra emp ON emp.Empres_nit = con.Contra_id_client
        WHERE DATE_FORMAT(Contra_time_ini,'%Y%m') <= DATE_FORMAT(now(),'%Y%m') 
        AND DATE_FORMAT(Contra_time_fin,'%Y%m') >= DATE_FORMAT(now(),'%Y%m')
        AND Contra_Form_pago = 2 
        AND Contra_stado = 1 
        AND Contra_time >= (SELECT COUNT(*) FROM pagos_str WHERE pago_id_contrat = Id_contrat);
        DECLARE pag CURSOR FOR 
              SELECT pagos_id,pago_costo,COUNT(*)
              FROM pagos_str
              WHERE DATE_FORMAT(pago_fecha_inic,'%Y%m') = DATE_FORMAT(now(),'%Y%m') 
              AND pago_id_empre = nit 
              AND pago_confir = 2;
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
        OPEN cur;
        LOOP1:loop
            fetch cur into codigo,costo,empresa,nit,tiempo;
            IF done THEN 
              LEAVE LOOP1;
              close cur; 
            END IF;
            OPEN pag;
            LOOP2:loop 
              fetch pag into id,cost,cont;
              IF contador = 0 THEN 
                INSERT INTO factura_stra (Fact_id_client,Fact_id_contrat,Fact_fecha,fact_fecha_final,Fact_total,Fact_cancelado) VALUES(nit,codigo,NOW(),CONCAT(YEAR(NOW()),"-",MONTH(NOW()),"-",30),0,2);   
                SET contador = 1;
                SET last_id_fact = LAST_INSERT_ID();
              END IF;
              IF done THEN 
                LEAVE LOOP2;
                SET contador = 0;
                SET last_id_fact = 0;
                close pag; 
              END IF;
              SET total = cost + total;
              INSERT INTO detalles_fact(Deta_id_fact,Deta_id_pago) VALUES(last_id_fact,id);
            END loop LOOP2;
            UPDATE factura_stra SET Fact_total = total WHERE Fact_id = last_id_fact;
            SET contador = 0;
        END loop LOOP1; 
  END ||
delimiter; 






delimiter ||
CREATE EVENT mount_facture 
 ON SCHEDULE EVERY '3' MONTH 
 STARTS '2016-06-17 09:16:45'
 ON COMPLETION PRESERVE ENABLE 
 DO 
  BEGIN 
    DECLARE done INT DEFAULT FALSE;
    DECLARE done2 INT DEFAULT FALSE;
    DECLARE codigo int(10);
    DECLARE costo int(10);
    DECLARE cost INT(10);
    DECLARE empresa varchar(60);
    DECLARE nit varchar(12);
    DECLARE tiempo int(2);
    DECLARE contador int DEFAULT 0;
    DECLARE last_id_fact int(10);
    DECLARE id int(10);
    DECLARE cont INT(2);
    DECLARE total INT(10) DEFAULT 0;
    DECLARE cur CURSOR FOR 
        SELECT Id_contrat,Contra_costo,Empres_nomb,Empres_nit,Contra_time
        FROM contrato con
        INNER JOIN empresa_stra emp ON emp.Empres_nit = con.Contra_id_client
        WHERE DATE_FORMAT(Contra_time_ini,'%Y%m') <= DATE_FORMAT(now(),'%Y%m') 
        AND DATE_FORMAT(Contra_time_fin,'%Y%m') >= DATE_FORMAT(now(),'%Y%m')
        AND Contra_Form_pago = 3 
        AND Contra_stado = 1 
        AND Contra_time >= (SELECT COUNT(*) FROM pagos_str WHERE pago_id_contrat = Id_contrat);
        DECLARE pag CURSOR FOR 
              SELECT pagos_id,pago_costo,COUNT(*)
              FROM pagos_str
              WHERE DATE_FORMAT(pago_fecha_inic,'%Y%m') = DATE_FORMAT(now(),'%Y%m') -3 
              AND DATE_FORMAT(pago_fecha_fin,'%Y%m') = DATE_FORMAT(now(),'%Y%m')
              AND pago_id_empre = nit 
              AND pago_confir = 2;
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
        OPEN cur;
        LOOP1:loop
            fetch cur into codigo,costo,empresa,nit,tiempo;
            IF done THEN 
              LEAVE LOOP1;
              close cur; 
            END IF;
            OPEN pag;
            LOOP2:loop 
              fetch pag into id,cost,cont;
              IF contador = 0 THEN 
                INSERT INTO factura_stra (Fact_id_client,Fact_id_contrat,Fact_fecha,fact_fecha_final,Fact_total,Fact_cancelado) VALUES(nit,codigo,NOW(),CONCAT(YEAR(NOW()),"-",MONTH(NOW()),"-",30),0,2);   
                SET contador = 1;
                SET last_id_fact = LAST_INSERT_ID();
              END IF;
              IF done THEN 
                LEAVE LOOP2;
                SET contador = 0;
                SET last_id_fact = 0;
                close pag; 
              END IF;
              SET total = cost + total;
              INSERT INTO detalles_fact(Deta_id_fact,Deta_id_pago) VALUES(last_id_fact,id);
            END loop LOOP2;
            UPDATE factura_stra SET Fact_total = total WHERE Fact_id = last_id_fact;
            SET contador = 0;
        END loop LOOP1;
  END ||
delimiter; 




delimiter ||
CREATE EVENT mount_facture 
 ON SCHEDULE EVERY '6' MONTH 
 STARTS '2016-06-17 09:16:45'
 ON COMPLETION PRESERVE ENABLE 
 DO 
  BEGIN 
    DECLARE done INT DEFAULT FALSE;
    DECLARE done2 INT DEFAULT FALSE;
    DECLARE codigo int(10);
    DECLARE costo int(10);
    DECLARE cost INT(10);
    DECLARE empresa varchar(60);
    DECLARE nit varchar(12);
    DECLARE tiempo int(2);
    DECLARE contador int DEFAULT 0;
    DECLARE last_id_fact int(10);
    DECLARE id int(10);
    DECLARE cont INT(2);
    DECLARE total INT(10) DEFAULT 0;
    DECLARE cur CURSOR FOR 
        SELECT Id_contrat,Contra_costo,Empres_nomb,Empres_nit,Contra_time
        FROM contrato con
        INNER JOIN empresa_stra emp ON emp.Empres_nit = con.Contra_id_client
        WHERE DATE_FORMAT(Contra_time_ini,'%Y%m') <= DATE_FORMAT(now(),'%Y%m') 
        AND DATE_FORMAT(Contra_time_fin,'%Y%m') >= DATE_FORMAT(now(),'%Y%m')
        AND Contra_Form_pago = 4 
        AND Contra_stado = 1 
        AND Contra_time >= (SELECT COUNT(*) FROM pagos_str WHERE pago_id_contrat = Id_contrat);
        DECLARE pag CURSOR FOR 
              SELECT pagos_id,pago_costo,COUNT(*)
              FROM pagos_str
              WHERE DATE_FORMAT(pago_fecha_inic,'%Y%m') = DATE_FORMAT(now(),'%Y%m') -6 
              AND DATE_FORMAT(pago_fecha_fin,'%Y%m') = DATE_FORMAT(now(),'%Y%m')
              AND pago_id_empre = nit 
              AND pago_confir = 2;
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
        OPEN cur;
        LOOP1:loop
            fetch cur into codigo,costo,empresa,nit,tiempo;
            IF done THEN 
              LEAVE LOOP1;
              close cur; 
            END IF;
            OPEN pag;
            LOOP2:loop 
              fetch pag into id,cost,cont;
              IF contador = 0 THEN 
                INSERT INTO factura_stra (Fact_id_client,Fact_id_contrat,Fact_fecha,fact_fecha_final,Fact_total,Fact_cancelado) VALUES(nit,codigo,NOW(),CONCAT(YEAR(NOW()),"-",MONTH(NOW()),"-",30),0,2);   
                SET contador = 1;
                SET last_id_fact = LAST_INSERT_ID();
              END IF;
              IF done THEN 
                LEAVE LOOP2;
                SET contador = 0;
                SET last_id_fact = 0;
                close pag; 
              END IF;
              SET total = cost + total;
              INSERT INTO detalles_fact(Deta_id_fact,Deta_id_pago) VALUES(last_id_fact,id);
            END loop LOOP2;
            UPDATE factura_stra SET Fact_total = total WHERE Fact_id = last_id_fact;
            SET contador = 0;
        END loop LOOP1;
  END ||
delimiter; 






delimiter ||
CREATE EVENT mount_facture 
 ON SCHEDULE EVERY '1' YEAR 
 STARTS '2016-06-17 09:16:45'
 ON COMPLETION PRESERVE ENABLE 
 DO 
  BEGIN 
    DECLARE done INT DEFAULT FALSE;
    DECLARE done2 INT DEFAULT FALSE;
    DECLARE codigo int(10);
    DECLARE costo int(10);
    DECLARE cost INT(10);
    DECLARE empresa varchar(60);
    DECLARE nit varchar(12);
    DECLARE tiempo int(2);
    DECLARE contador int DEFAULT 0;
    DECLARE last_id_fact int(10);
    DECLARE id int(10);
    DECLARE cont INT(2);
    DECLARE total INT(10) DEFAULT 0;
    DECLARE cur CURSOR FOR 
        SELECT Id_contrat,Contra_costo,Empres_nomb,Empres_nit,Contra_time
        FROM contrato con
        INNER JOIN empresa_stra emp ON emp.Empres_nit = con.Contra_id_client
        WHERE DATE_FORMAT(Contra_time_ini,'%Y%m') <= DATE_FORMAT(now(),'%Y%m') 
        AND DATE_FORMAT(Contra_time_fin,'%Y%m') >= DATE_FORMAT(now(),'%Y%m')
        AND Contra_Form_pago = 5 
        AND Contra_stado = 1 
        AND Contra_time >= (SELECT COUNT(*) FROM pagos_str WHERE pago_id_contrat = Id_contrat);
        DECLARE pag CURSOR FOR 
              SELECT pagos_id,pago_costo,COUNT(*)
              FROM pagos_str
              WHERE DATE_FORMAT(pago_fecha_inic,'%Y%m') = DATE_FORMAT(now(),'%Y%m') - 100 
              AND pago_id_empre = nit 
              AND pago_confir = 2;
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
        OPEN cur;
        LOOP1:loop
            fetch cur into codigo,costo,empresa,nit,tiempo;
            IF done THEN 
              LEAVE LOOP1;
              close cur; 
            END IF;
            OPEN pag;
            LOOP2:loop 
              fetch pag into id,cost,cont;
              IF contador = 0 THEN 
                INSERT INTO factura_stra (Fact_id_client,Fact_id_contrat,Fact_fecha,fact_fecha_final,Fact_total,Fact_cancelado) VALUES(nit,codigo,NOW(),CONCAT(YEAR(NOW()),"-",MONTH(NOW()),"-",30),0,2);   
                SET contador = 1;
                SET last_id_fact = LAST_INSERT_ID();
              END IF;
              IF done THEN 
                LEAVE LOOP2;
                SET contador = 0;
                SET last_id_fact = 0;
                close pag; 
              END IF;
              SET total = cost + total;
              INSERT INTO detalles_fact(Deta_id_fact,Deta_id_pago) VALUES(last_id_fact,id);
            END loop LOOP2;
            UPDATE factura_stra SET Fact_total = total WHERE Fact_id = last_id_fact;
            SET contador = 0;
        END loop LOOP1;
  END ||
delimiter; 



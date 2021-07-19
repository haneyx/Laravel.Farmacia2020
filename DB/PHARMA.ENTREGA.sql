SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
DROP DATABASE IF EXISTS farmacia;
CREATE DATABASE farmacia DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE farmacia;
-- -----------------------------------------------------------------------------------------
-- Base de datos: `farmacia`
-- -----------------------------------------------------------------------------------------
DELIMITER ;

CREATE TABLE caja (
  id INT(10) NOT NULL AUTO_INCREMENT,
  fecha DATE NOT NULL,
  inicial FLOAT(5,1) NOT NULL,
  dinero FLOAT(5,1) NULL DEFAULT 0.0,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE linea (
  id INT(10) NOT NULL AUTO_INCREMENT,
  producto_id INT(10) NOT NULL,
  cantidad INT(3) NOT NULL,
  precio FLOAT(5,1) NOT NULL,
  venta_id INT(10) NOT NULL,
  PRIMARY KEY(id),
  INDEX venta_FKIndex1(producto_id),
  INDEX linea_FKIndex2(venta_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE persona (
  id INT(5) NOT NULL AUTO_INCREMENT,
  tipo TINYINT(1) UNSIGNED NULL,
  dni_ruc INT(11) NULL,
  nombre_razon VARCHAR(30) COLLATE latin1_spanish_ci NULL,
  apellidos VARCHAR(35) COLLATE latin1_spanish_ci NULL,
  direccion VARCHAR(50) COLLATE latin1_spanish_ci NULL,
  PRIMARY KEY(id)
);

CREATE TABLE producto (
  id INT(10) NOT NULL AUTO_INCREMENT,
  codigo VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL,
  detalle VARCHAR(70) COLLATE latin1_spanish_ci NOT NULL,
  contiene INT(3) NULL,
  pcompra FLOAT(5,1) NOT NULL,
  pventa FLOAT(5,1) NOT NULL,
  ppromo FLOAT(5,1) NULL,
  stock INT(6) NOT NULL,
  expmes INT(2) NULL,
  expanio INT(4) NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE usuario (
  id INT(2) NOT NULL AUTO_INCREMENT,
  persona_id INT(5) NOT NULL,
  pass VARCHAR(20) COLLATE latin1_spanish_ci NULL,
  master TINYINT(1) UNSIGNED NULL,
  PRIMARY KEY(id),
  INDEX usuario_FKIndex1(persona_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE venta (
  id INT(10) NOT NULL AUTO_INCREMENT,
  fecha DATE NULL,
  formato TINYINT(1) UNSIGNED NULL,
  persona_id INT(5) NULL,
  total FLOAT(5,1) NULL DEFAULT 0.0,
  atiende VARCHAR(23) COLLATE latin1_spanish_ci NULL,
  ticket TINYINT(1) UNSIGNED NULL,
  serie VARCHAR(4) NULL,
  numero INT(11) NULL,
  PRIMARY KEY(id),
  INDEX venta_FKIndex3(persona_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE activa (
  id INT(1) NOT NULL AUTO_INCREMENT,
  llave VARCHAR(20) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- -----------------------------------------------------------------------------------------
-- Procedimientos por Mg.Sc. Harold Coila
-- -----------------------------------------------------------------------------------------
DELIMITER //

-- Usuario --------------------------------------------------------------

DROP PROCEDURE IF EXISTS Get_N//
CREATE PROCEDURE Get_N(IN dr INT(11))
  BEGIN
    DECLARE us VARCHAR(65);
    SET @n=(SELECT nombre_razon FROM persona WHERE dni_ruc=dr);
    SET @a=(SELECT left(apellidos,1) FROM persona WHERE dni_ruc=dr);
    SET us=CONCAT(@n,' ',@a,'.');
  SELECT us;
END//

DROP PROCEDURE IF EXISTS Add_U//
CREATE PROCEDURE Add_U(IN m INT(1),IN dr INT(11),IN p VARCHAR(20),IN n VARCHAR(30),IN a VARCHAR(35)) -- tipo:DNI=1
  BEGIN
    DECLARE error TINYINT(1) DEFAULT 0;
    SET @enum=(SELECT count(id) FROM persona WHERE dni_ruc=dr);
  IF(@enum>0) THEN SET error=1;
  ELSE
    INSERT INTO persona (tipo,dni_ruc,nombre_razon,apellidos) VALUES (1,dr,n,a);
    INSERT INTO usuario (persona_id,pass,master) VALUES (LAST_INSERT_ID(),p,m);
  END IF;
  SELECT error;
END//

DROP PROCEDURE IF EXISTS Upd_U//
CREATE PROCEDURE Upd_U(IN i INT(5),IN m INT(1),IN dr INT(11),IN p VARCHAR(20),IN n VARCHAR(30),IN a VARCHAR(35))
  BEGIN
    DECLARE error TINYINT(1) DEFAULT 0;
    UPDATE usuario SET pass=p,master=m WHERE usuario.persona_id=i;
    UPDATE persona SET dni_ruc=dr,nombre_razon=n,apellidos=a WHERE persona.id=i;
  SELECT error;
END//

DROP PROCEDURE IF EXISTS Del_U//
CREATE PROCEDURE Del_U(IN i INT(5))
  BEGIN
    DECLARE error TINYINT(1) DEFAULT 0;
    DELETE FROM usuario WHERE usuario.persona_id=i; 
    DELETE FROM persona WHERE persona.id=i;
  SELECT error;
END//

-- Activate -------------------
DROP PROCEDURE IF EXISTS Chk_K//
CREATE PROCEDURE Chk_K()
  BEGIN
    DECLARE error TINYINT(1) DEFAULT 0;
    SET @y=(SELECT YEAR(CURDATE()));
    IF(@y>2021) THEN
      SET @k=(SELECT count(id) FROM activa WHERE llave='keyreg2021/on');
      IF(@k<1) THEN SET error=1; END IF;
    END IF;
  SELECT error;
END//

DROP PROCEDURE IF EXISTS Ins_K//
CREATE PROCEDURE Ins_K(IN ll VARCHAR(20))
  BEGIN
    DECLARE error TINYINT(1) DEFAULT 0;
    INSERT INTO activa (llave) VALUES (ll);
  SELECT error;
END//

-- Venta -----------------------------------------------------------------
DROP PROCEDURE IF EXISTS Venta_P//
CREATE PROCEDURE Venta_P(IN fo TINYINT(1),IN tk TINYINT(1),IN a VARCHAR(23),IN s VARCHAR(4),IN n INT(11),IN ls INT(1),IN array VARCHAR(255))
  BEGIN
    DECLARE error TINYINT(1) DEFAULT 0;
    DECLARE nume INT(1) DEFAULT 0;
    DECLARE suma FLOAT(5,1) DEFAULT 0.0;
    
    INSERT INTO venta (fecha,formato,ticket,atiende,serie,numero) VALUES (CURDATE(),fo,tk,a,s,n);
    SET @alpha=(SELECT LAST_INSERT_ID());
    
    WHILE (nume<ls) DO
	  SET @x=(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(array,',',(3*nume)+1),',',-1));
	  SET @y=(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(array,',',(3*nume)+2),',',-1));
	  SET @z=(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(array,',',(3*nume)+3),',',-1));
      INSERT INTO linea (producto_id,cantidad,precio,venta_id) VALUES (@x,@y,@z,@alpha);

      SET @stok = (SELECT stock FROM producto WHERE id=@x);
      SET @stok = @stok-@y;
      UPDATE producto SET stock=@stok WHERE producto.id=@x;

      SET suma = suma + @z;
      SET nume = nume + 1;
    END WHILE;
    
    UPDATE venta SET total=suma WHERE venta.id=@alpha;
    SET @box=(SELECT dinero FROM caja WHERE caja.fecha=CURDATE());
    SET @box = @box + suma;
    UPDATE caja SET dinero=@box WHERE caja.fecha=CURDATE();

    SELECT error;
END//

DROP PROCEDURE IF EXISTS Ult_V//
CREATE PROCEDURE Ult_V()
  BEGIN
    DECLARE ult TINYINT(1) DEFAULT 0;
    SELECT max(id) INTO ult from VENTA;
SELECT ult;
END//

-- Caja -----------------------------------------------------------------
DROP PROCEDURE IF EXISTS Rev_C//
CREATE PROCEDURE Rev_C()
  BEGIN
    DECLARE ini TINYINT(1) DEFAULT 0;
    SET @box=(SELECT count(id) FROM caja WHERE fecha=CURDATE());
  IF(@box>0) THEN SET ini=1; END IF;
  SELECT ini;
END//

DROP PROCEDURE IF EXISTS Set_C//
CREATE PROCEDURE Set_C(IN ini FLOAT(5,1))
  BEGIN
    DECLARE error TINYINT(1) DEFAULT 0;
    INSERT INTO caja(fecha,inicial) VALUES(CURDATE(),ini);
  SELECT error;
END//

DROP PROCEDURE IF EXISTS Ini_C//
CREATE PROCEDURE Ini_C(IN fe DATE)
  BEGIN
    DECLARE ini FLOAT(5,1) DEFAULT 0.0;
    SELECT inicial INTO ini FROM caja WHERE caja.fecha=fe; 
  SELECT ini;
END//

DROP PROCEDURE IF EXISTS Dia_C//
CREATE PROCEDURE Dia_C(IN fe DATE)
  BEGIN
    DECLARE dia FLOAT(5,1) DEFAULT 0.0;
    SELECT SUM(dinero) INTO dia FROM caja WHERE caja.fecha=fe; 
  SELECT dia;
END//

DROP PROCEDURE IF EXISTS Sum_C//
CREATE PROCEDURE Sum_C(IN fe DATE)
  BEGIN
    DECLARE sum FLOAT(5,1) DEFAULT 0.0;
    SELECT SUM(inicial)+SUM(dinero) INTO sum FROM caja WHERE caja.fecha=fe; 
  SELECT sum;
END//

DROP PROCEDURE IF EXISTS Upd_C//
CREATE PROCEDURE Upd_C(IN fe DATE, IN ini FLOAT(5,1))
  BEGIN
    DECLARE error TINYINT(1) DEFAULT 0;
    UPDATE caja SET inicial=ini WHERE caja.fecha=fe;
  SELECT error;
END//

-- Login  ----------------------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS Login//
CREATE PROCEDURE Login(IN u INT(11), IN p VARCHAR(20))
  BEGIN
    DECLARE link TINYINT(1) DEFAULT 0;
    SET @log=(SELECT count(master) FROM usuario INNER JOIN persona ON persona.id=usuario.persona_id WHERE dni_ruc=u AND pass=p);
  IF(@log>0) THEN
    SELECT master INTO link FROM usuario INNER JOIN persona ON persona.id=usuario.persona_id WHERE dni_ruc=u AND pass=p;
  END IF;
  SELECT link;
END//
-- --------------

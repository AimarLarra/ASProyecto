-- Archivo init.sql
CREATE DATABASE IF NOT EXISTS webbase;

USE webbase;

CREATE TABLE IF NOT EXISTS usuarios (
    nombre VARCHAR(30) PRIMARY KEY,
    correo VARCHAR(50) UNIQUE NOT NULL,
    contrasena VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30),
    titulo VARCHAR(255) NOT NULL,
    texto TEXT NOT NULL,
    FOREIGN KEY (nombre) REFERENCES usuarios(nombre),
    UNIQUE KEY unique_combination (nombre(30), titulo(255))
);

INSERT INTO usuarios (correo, contrasena, nombre) VALUES
  ('aimarlarehu@gmail.com', 'password1', 'aimarlarehu'),
  ('aimarlarrazabal2002@gmail.com', 'password2', 'Druida'),
  ('newsAPI@gmail.com', 'newsAPIpass', 'NewsAPI');

INSERT INTO posts (nombre, titulo, texto) VALUES
  ('aimarlarehu', 'Primer Post', 'Hola a todos! Este es mi primer post en Xtra Blog, espero que Docker no me de muchos problemas de configuracion'),
  ('Druida', 'Receta para pocima digital de Docker', 'Buenas!! Soy Druida, os dejo por aqui la receta para una pocima digital para que Docker os sea mas facil de configurar: Necesitaremos unas cuantas horas libres para troubleshooting y revisar logs de contenedores, mucha paciencia y buen manejo del estres. La clave esta en la mezcla, es crucial que todos los ingredientes sean anadidos en partes iguales, de este forma seguro conseguireis configurar vuestro entorno Docker. Mucha suerte!!!'),
  ('NewsAPI', 'Introduccion a NewsAPI', 'NewsAPI es una API que permite mediante una request recibir un JSON con las ultimas noticias importantes del país que se solicite. En Xtra Blog hemos recibido el JSON mediante un servidor Flask en el backend las hemos guardado en nuestra base de datos y en el apartado Global podras visualizar todas las noticias que desees junto con los posts de los demas usuarios de Blog Xtra'),
  ('aimarlarehu', 'Sobre la pocima digital de Docker de: Druida', 'Buenas Druida, tu receta digital de Docker es una estafa!! :( He conseguido a duras penas reunir todos los ingredientes y mezclarlos a partes iguales y armar un entorno Docker no ha sido nada placentero, de hecho el troubleshooting ha acabado ocupando alrededor de un 60% de mi receta! No confieis en soluciones magicas para armar vuestro proyecto en Docker usuarios, tan solo debeis ir con calma y revisar correctamente todos vuestros archivos de configuracion!');


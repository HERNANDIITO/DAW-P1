-- SQLBook: Code
-- Crear base de datos

DROP DATABASE Fotocasa2;
CREATE DATABASE IF NOT EXISTS Fotocasa2;
USE Fotocasa2;

-- Tabla TiposMensajes
CREATE TABLE IF NOT EXISTS TiposMensajes (
    IdTMensaje INT AUTO_INCREMENT PRIMARY KEY,
    NomTMensaje TEXT NOT NULL,
    Icono TEXT
);

-- Tabla TiposAnuncios
CREATE TABLE IF NOT EXISTS TiposAnuncios (
    IdTAnuncio TINYINT AUTO_INCREMENT PRIMARY KEY,
    NomTAnuncio TEXT NOT NULL
);

-- Tabla TiposViviendas
CREATE TABLE IF NOT EXISTS TiposViviendas (
    IdTVivienda TINYINT AUTO_INCREMENT PRIMARY KEY,
    NomTVivienda TEXT NOT NULL
);

-- Tabla Paises (asumida por las referencias)
CREATE TABLE IF NOT EXISTS Paises (
    IdPais INT AUTO_INCREMENT PRIMARY KEY,
    Nombre TEXT NOT NULL
);

-- Tabla Estilos
CREATE TABLE IF NOT EXISTS Estilos (
    IdEstilo INT AUTO_INCREMENT PRIMARY KEY,
    Nombre TEXT NOT NULL,
    Descripcion TEXT,
    Fichero TEXT
);

-- Tabla Usuarios
CREATE TABLE IF NOT EXISTS Usuarios (
    IdUsuario INT AUTO_INCREMENT PRIMARY KEY,
    NomUsuario VARCHAR(255) UNIQUE NOT NULL,
    Clave VARCHAR(15) NOT NULL,
    Email VARCHAR(254) NOT NULL,
    Sexo TINYINT,
    FNacimiento DATE,
    Ciudad VARCHAR(255),
    Pais INT,
    Foto TEXT,
    FRegistro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Estilo INT,
    Icono VARCHAR(25),
    FOREIGN KEY (Estilo) REFERENCES Estilos(IdEstilo),
    FOREIGN KEY (Pais) REFERENCES Paises(IdPais)
);

-- Tabla Anuncios
CREATE TABLE IF NOT EXISTS Anuncios (
    IdAnuncio INT AUTO_INCREMENT PRIMARY KEY,
    TAnuncio TINYINT,
    TVivienda TINYINT,
    Foto TEXT,
    Alternativo VARCHAR(255) NOT NULL,
    Titulo TEXT,
    Precio FLOAT,
    Texto TEXT,
    Ciudad VARCHAR(255),
    Pais INT,
    Superficie FLOAT,
    Nhabitaciones INT,
    Nbanyos INT,
    Planta INT,
    Anyo INT,
    FRegistro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Usuario INT,
    FOREIGN KEY (TAnuncio) REFERENCES TiposAnuncios(IdTAnuncio),
    FOREIGN KEY (TVivienda) REFERENCES TiposViviendas(IdTVivienda),
    FOREIGN KEY (Pais) REFERENCES Paises(IdPais),
    FOREIGN KEY (Usuario) REFERENCES Usuarios(IdUsuario) ON DELETE CASCADE
);

-- Tabla Mensajes
CREATE TABLE IF NOT EXISTS Mensajes (
    IdMensaje INT AUTO_INCREMENT PRIMARY KEY,
    TMensaje INT,
    Texto TEXT,
    Anuncio INT,
    UsuarioOrigen INT,
    UsuarioDestino INT,
    FRegistro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (TMensaje) REFERENCES TiposMensajes(IdTMensaje),
    FOREIGN KEY (Anuncio) REFERENCES Anuncios(IdAnuncio) ON DELETE CASCADE,
    FOREIGN KEY (UsuarioOrigen) REFERENCES Usuarios(IdUsuario) ON DELETE CASCADE,
    FOREIGN KEY (UsuarioDestino) REFERENCES Usuarios(IdUsuario) ON DELETE CASCADE
);

-- Tabla Fotos
CREATE TABLE IF NOT EXISTS Fotos (
    IdFoto INT AUTO_INCREMENT PRIMARY KEY,
    Titulo TEXT,
    Fichero TEXT,
    Alternativo VARCHAR(255) NOT NULL,
    Anuncio INT,
    FOREIGN KEY (Anuncio) REFERENCES Anuncios(IdAnuncio) ON DELETE CASCADE
);


-- Tabla Solicitudes
CREATE TABLE IF NOT EXISTS Solicitudes (
    IdSolicitud INT AUTO_INCREMENT PRIMARY KEY,
    Anuncio INT,
    Texto TEXT,
    Nombre VARCHAR(200),
    Email VARCHAR(200),
    Direccion TEXT,
    Telefono VARCHAR(20),
    Color TEXT,
    Copias INT,
    Resolucion INT,
    Fecha DATE,
    IColor BOOLEAN,
    IPrecio BOOLEAN,
    FRegistro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Coste FLOAT,
    FOREIGN KEY (Anuncio) REFERENCES Anuncios(IdAnuncio) ON DELETE CASCADE
);
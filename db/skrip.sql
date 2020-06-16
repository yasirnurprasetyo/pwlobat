create database obat;
use obat;

create table obat(
  id_obat int not null primary key auto_increment,
  kode_obat varchar(20) not null,
  nama_obat varchar(50),
  harga_obat int,
  stock_obat int,
  gambar_obat text,
  unique(kode_obat)
);

create table transaksi(
  id_transaksi int not null primary key auto_increment,
  no_transaksi varchar(50),
  tanggal_transaksi datetime
);

create table item_transaksi(
  id_item_transaksi int not null primary key auto_increment,
  harga_item_transaksi int,
  qty_item_transaksi int,
  total_item_transaksi int,
  id_obat int,
  id_transaksi int,
  foreign key(id_transaksi) references transaksi(id_transaksi),
  foreign key(id_obat) references obat(id_obat)
);

alter table obat add is_active tinyint default 1;

alter table transaksi add nomor int default 0;

create table users(
    id_user int not null primary key auto_increment,
    nama_user varchar(100),
    email_user varchar(100),
    password_user varchar(200),
    role_user enum("admin","kasir")
);

insert into users value (null,"Admin","admin@mail.com","$2y$10$065KApwfqfNTQ32ktF.PoOJFnEfMpMZkPMQlR2Nw8I7BLqDYC4saO","admin");

alter table users
add first_login tinyint default 1,
add is_active tinyint default 1;
CREATE TABLE SIRIMA.PERIODE_PENERIMAAN (
	nomor SMALLINT NOT NULL,
	tahun CHAR(4) NOT NULL,
	PRIMARY KEY(nomor, tahun)
);

CREATE TABLE SIRIMA.PROGRAM_STUDI(
	kode SERIAL NOT NULL,
	nama VARCHAR(100) NOT NULL,
	jenis_kelas VARCHAR(50) NOT NULL,
	nama_fakultas VARCHAR(50) NOT NULL,
	jenjang CHAR(2) NOT NULL,
	PRIMARY KEY(kode),
	FOREIGN KEY(jenjang) REFERENCES JENJANG(nama)
	ON UPDATE CASCADE
	ON DELETE RESTRICT
);

CREATE TABLE SIRIMA.PENDAFTARAN(
	id SERIAL NOT NULL,
	status_lulus BOOLEAN NOT NULL DEFAULT FALSE,
	status_verifikasi BOOLEAN NOT NULL DEFAULT FALSE,
	npm CHAR(10),
	pelamar VARCHAR(50) NOT NULL,
	nomor_periode SMALLINT NOT NULL,
	tahun_periode CHAR(4) NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(pelamar) REFERENCES PELAMAR(username) 
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	FOREIGN KEY(nomor_periode, tahun_periode) REFERENCES 
	PERIODE_PENERIMAAN(nomor, tahun)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE SIRIMA.PENDAFTARAN_SEMAS(
	id_pendaftaran INT NOT NULL,
	status_hadir BOOLEAN NOT NULL,
	nilai_ujian INT NOT NULL,
	no_kartu_ujian CHAR(10) NOT NULL,
	lokasi_kota VARCHAR(100) NOT NULL,
	lokasi_tempat VARCHAR(150) NOT NULL,
	PRIMARY KEY(id_pendaftaran),
	FOREIGN KEY(id_pendaftaran) REFERENCES PENDAFTARAN(id)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	FOREIGN KEY(lokasi_kota, lokasi_tempat) REFERENCES LOKASI_UJIAN(kota, tempat)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE SIRIMA.PEMBAYARAN(
	id SERIAL NOT NULL,
	waktu_bayar TIMESTAMP NOT NULL,
	jumlah_bayar NUMERIC(10,2) NOT NULL,
	id_pendaftaran INT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(id_pendaftaran) REFERENCES 
	PENDAFTARAN_SEMAS(id_pendaftaran)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE SIRIMA.PENGAWAS(
	nomor_induk VARCHAR(16) NOT NULL,
	nama VARCHAR(100) NOT NULL,
	no_telp TEXT NOT NULL,
	lokasi_kota VARCHAR(100) NOT NULL,
	lokasi_tempat VARCHAR(150) NOT NULL,
	lokasi_id SMALLINT NOT NULL,
	PRIMARY KEY(nomor_induk),
	FOREIGN KEY(lokasi_kota, lokasi_tempat, lokasi_id) REFERENCES RUANG_UJIAN(kota, tempat, id)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE JADWAL_PENTING(
	nomor SMALLINT NOT NULL,
	tahun CHAR(4) NOT NULL,
	jenjang CHAR(2) NOT NULL,
	waktu_mulai TIMESTAMP NOT NULL,
	waktu_selesai TIMESTAMP NOT NULL,
	deskripsi VARCHAR NOT NULL,
	PRIMARY KEY (nomor, tahun, jenjang, waktu_mulai),
	FOREIGN KEY (nomor, tahun) REFERENCES PERIODE_PENERIMAAN(nomor, tahun)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	FOREIGN KEY (jenjang) REFERENCES JENJANG(nama)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE PENERIMAAN_PRODI(
	nomor_periode INTEGER NOT NULL,
	tahun_periode CHAR(4) NOT NULL,
	kode_prodi INTEGER NOT NULL,
	kuota INTEGER NOT NULL,
	jumlah_pelamar INTEGER,
	jumlah_diterima INTEGER,
	PRIMARY KEY (nomor_periode, tahun_periode, kode_prodi),
	FOREIGN KEY (nomor_periode, tahun_periode) REFERENCES PERIODE_PENERIMAAN(nomor, tahun)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	FOREIGN KEY (kode_prodi) REFERENCES PROGRAM_STUDI(kode)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE PENDAFTARAN_UUI(
	id_pendaftaran INTEGER NOT NULL,
	rapot VARCHAR(100) NOT NULL,
	surat_rekomendasi VARCHAR(100) NOT NULL,
	asal_sekolah VARCHAR(100) NOT NULL,
	jenis_sma VARCHAR(50) NOT NULL,
	alamat_sekolah TEXT NOT NULL,
	nisn VARCHAR(10) NOT NULL,
	tgl_lulus DATE NOT NULL,
	nilai_uan NUMERIC(10,2) NOT NULL,
	PRIMARY KEY (id_pendaftaran),
	FOREIGN KEY (id_pendaftaran) REFERENCES PENDAFTARAN(id)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE PENDAFTARAN_SEMAS_SARJANA(
	id_pendaftaran INTEGER NOT NULL,
	asal_sekolah VARCHAR(100) NOT NULL,
	jenis_sma VARCHAR(50) NOT NULL,
	alamat_sekolah TEXT NOT NULL,
	nisn VARCHAR(10) NOT NULL,
	tgl_lulus DATE NOT NULL,
	nilai_uan NUMERIC(10,2) NOT NULL,
	PRIMARY KEY (id_pendaftaran),
	FOREIGN KEY (id_pendaftaran) REFERENCES PENDAFTARAN_SEMAS(id_pendaftaran)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE LOKASI_UJIAN(
	kota VARCHAR(100) NOT NULL,
	tempat VARCHAR(150) NOT NULL,
	nomor_periode SMALLINT NOT NULL,
	tahun_periode CHAR(4) NOT NULL,
	jenjang CHAR(2) NOT NULL,
	waktu_awal TIMESTAMP NOT NULL,
	PRIMARY KEY (kota, tempat),
	FOREIGN KEY (nomor_periode, tahun_periode, jenjang, waktu_awal) REFERENCES JADWAL_PENTING(nomor, tahun, jenjang, waktu_mulai)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE PENDAFTARAN_PRODI(
	id_pendaftaran INTEGER NOT NULL,
	kode_prodi INTEGER NOT NULL,
	status_lulus BOOLEAN NOT NULL,
	PRIMARY KEY (id_pendaftaran, kode_prodi),
	FOREIGN KEY (id_pendaftaran) REFERENCES PENDAFTARAN(id)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	FOREIGN KEY (kode_prodi) REFERENCES PROGRAM_STUDI(kode)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);


-- -aim
-- CREATE TABLE PENDAFTARAN_PRODI(
-- 	id_pendaftaran INTEGER NOT NULL,
-- 	kode_prodi INTEGER NOT NULL,
-- 	PRIMARY KEY (id_pendaftaran, kode_prodi),
-- 	FOREIGN KEY (id_pendaftaran) REFERENCES PENDAFTARAN(id),
-- 	FOREIGN KEY (kode_prodi) REFERENCES PROGRAM_STUDI(kode)
-- );

CREATE TABLE AKUN(
    username VARCHAR,
    role BOOLEAN NOT NULL,
    password VARCHAR(20) NOT NULL,
    PRIMARY KEY (username)
);

CREATE TABLE JENJANG(
    nama CHAR(2),
    PRIMARY KEY (nama)
);

CREATE TABLE PELAMAR(
    username VARCHAR(50),
    nama_lengkap VARCHAR(100) NOT NULL,
    alamat TEXT NOT NULL,
    jenis_kelamin CHAR(1) NOT NULL,
    tanggal_lahir DATE NOT NULL,
    no_ktp CHAR(16) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    PRIMARY KEY (username),
    FOREIGN KEY (username) REFERENCES AKUN(username)
    ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE REKOMENDASI(
    tgl_review DATE,
    id_pendaftaran INT,
    status BOOLEAN NOT NULL,
    nilai INT NOT NULL,
    komentar TEXT NOT NULL,
    PRIMARY KEY (tgl_review, id_pendaftaran),
    FOREIGN KEY (id_pendaftaran) REFERENCES PENDAFTARAN_UUI(id_pendaftaran)
    ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE PENDAFTARAN_SEMAS_PASCASARJANA(
    id_pendaftaran INT,
    nilai_tpa INT NOT NULL,
    nilai_toefl INT NOT NULL,
    jenjang_terakhir CHAR(2) NOT NULL,
    asal_univ VARCHAR(100) NOT NULL,
    alamat_univ TEXT NOT NULL,
    prodi_terakhir VARCHAR(100) NOT NULL,
    nilai_ipk NUMERIC(10, 2) NOT NULL,
    no_ijazah VARCHAR(50) NOT NULL,
    tgl_lulus DATE NOT NULL,
    jenjang CHAR(2) NOT NULL,
    nama_rekomender VARCHAR(100),
    prop_penelitian VARCHAR(100), 
    PRIMARY KEY (id_pendaftaran),
    FOREIGN KEY (id_pendaftaran) REFERENCES PENDAFTARAN_SEMAS(id_pendaftaran)
    ON UPDATE CASCADE
	ON DELETE CASCADE,
    FOREIGN KEY (jenjang_terakhir) REFERENCES JENJANG(nama) 
    ON UPDATE CASCADE
	ON DELETE CASCADE,
    FOREIGN KEY (jenjang) REFERENCES JENJANG(nama) 
    ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE RUANG_UJIAN(
    kota VARCHAR(100),
    tempat VARCHAR(150),
    id SMALLINT,
    PRIMARY KEY (kota, tempat, id),
    FOREIGN KEY (kota, tempat) REFERENCES LOKASI_UJIAN(kota, tempat)
    ON UPDATE CASCADE
	ON DELETE CASCADE
);

-- 1. stored prodecure buat ngitung jumlah_pelamar
CREATE OR REPLACE FUNCTION hitung_pelamar()
RETURNS TRIGGER AS
$$
DECLARE 
	jumlah_per_prodi INTEGER;
BEGIN
IF(TG_OP = 'INSERT') THEN
SELECT COUNT(PD.*) INTO jumlah_per_prodi
FROM PENERIMAAN_PRODI PN, PENDAFTARAN_PRODI PD, PROGRAM_STUDI PS, PERIODE_PENERIMAAN PER, PENDAFTARAN P
WHERE PD.kode_prodi = PS.kode 
	AND PS.kode = PN.kode_prodi 
	AND PN.tahun_periode = PER.tahun
	AND PS.kode = NEW.kode_prodi
	AND P.id = NEW.id_pendaftaran;

UPDATE PENERIMAAN_PRODI PN SET jumlah_pelamar = (jumlah_per_prodi)
WHERE PS.kode_prodi = NEW.kode_prodi AND P.id = NEW.id_pendaftaran;
RETURN NEW;
END IF;

IF(TG_OP = 'DELETE') THEN
SELECT COUNT(PD.*) INTO jumlah_per_prodi
FROM PENERIMAAN_PRODI PN, PENDAFTARAN_PRODI PD, PROGRAM_STUDI PS, PERIODE_PENERIMAAN PER, PENDAFTARAN P
WHERE PD.kode_prodi = PS.kode 
	AND PS.kode = PN.kode_prodi 
	AND PN.tahun_periode = PER.tahun
	AND PS.kode = NEW.kode_prodi
	AND P.id = NEW.id_pendaftaran;
UPDATE PENERIMAAN_PRODI PN SET jumlah_pelamar = (jumlah_per_prodi)
WHERE PS.kode_prodi = OLD.kode_prodi AND P.id = OLD.id_pendaftaran;
RETURN OLD;
END IF;

IF (TG_OP = 'UPDATE') THEN 
SELECT COUNT(PD.*) INTO jumlah_per_prodi
FROM PENERIMAAN_PRODI PN, PENDAFTARAN_PRODI PD, PROGRAM_STUDI PS, PERIODE_PENERIMAAN PER, PENDAFTARAN P
WHERE PD.kode_prodi = PS.kode 
	AND PS.kode = PN.kode_prodi 
	AND PN.tahun_periode = PER.tahun
	AND PS.kode = NEW.kode_prodi
	AND P.id = NEW.id_pendaftaran;

UPDATE PENERIMAAN_PRODI PN SET jumlah_pelamar = (jumlah_per_prodi)
WHERE PS.kode_prodi = NEW.kode_prodi AND P.id = NEW.id_pendaftaran;

SELECT COUNT(PD.*) INTO jumlah_per_prodi
FROM PENERIMAAN_PRODI PN, PENDAFTARAN_PRODI PD, PROGRAM_STUDI PS, PERIODE_PENERIMAAN PER, PENDAFTARAN P
WHERE PD.kode_prodi = PS.kode 
	AND PS.kode = PN.kode_prodi 
	AND PN.tahun_periode = PER.tahun
	AND PS.kode = OLD.kode_prodi
	AND P.id = OLD.id_pendaftaran;

UPDATE PENERIMAAN_PRODI PN SET jumlah_pelamar = (jumlah_per_prodi)
WHERE PS.kode_prodi = OLD.kode_prodi AND P.id = OLD.id_pendaftaran;
RETURN NEW;
END IF;
END LOOP;
END;
$$
LANGUAGE plpgsql;


--trigger
CREATE TRIGGER trigger_jumlah_pelamar
AFTER INSERT OR DELETE OR UPDATE






2. stored procedure dan trigger buat ngupdate jumlah_diterima (old.prodi-1 dan new.prodi+1)